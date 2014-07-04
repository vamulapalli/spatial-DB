<?php
error_reporting(0);

//Establish connection to database.
$Conn = new PDO("pgsql:host=localhost;dbname=5443","5443","5443");

if(isset($argv[1]) && $argv[1]=='debug'){
	$_POST = unserialize(file_get_contents("array.out"));
	print_r($_POST);
}

$fp = fopen('array.out','w');
fwrite($fp,serialize($_POST));
fclose($fp);


$fp = fopen('error.log','a');
fwrite($fp,time()."\n");
$out = print_r($_POST,true);
fwrite($fp,$out);


if(isset($argv[1]) && $argv[1]=='debug' || $_GET['debug']){
	$_POST['lat'] = 33.546;
	$_POST['lng'] = -122.546;
	$_POST['earthQuakes'] = true;
	$debug = true;
}

switch($_POST['QueryNum']){
	case 1:
		$Data = ExampleQuery1($_POST);
		break;
	case 2:
		$Data = ExampleQuery2($_POST);
		break;
	case 3:
	case 4:
		$Data = ExampleQuery4($_POST);
		break;
	
}

echo json_encode($Data);


function ExampleQuery1($post){
	global $fp;
	global $Conn;
	
	$Lat1 = $post['lat1'];
	$Lon1 = $post['lon1'];
	$Lat2 = $post['lat2'];
	$Lon2 = $post['lon2'];
	
	$Points = array();
	
	foreach($post['sources'] as $source){
		$sql = "
			SELECT ST_AsGeoJSON(wkb_geometry) AS wkb
			FROM {$source}
			WHERE wkb_geometry @ ST_MakeEnvelope({$Lon1}, {$Lat1},{$Lon2},{$Lat2})
			
		";
		$result = $Conn->query($sql);
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$Points[] = $row['wkb'];
		}
	}
	fwrite($fp,print_r($Points,true));
	//print_r($Points);
	return $Points;
}


function ExampleQuery2($post){
	global $fp;
	global $Conn;
	
	$Lat1 = $post['lat1'];
	$Lon1 = $post['lon1'];
	$Lat2 = $post['lat2'];
	$Lon2 = $post['lon2'];
	
	$Points = array();
	
	foreach($post['sources'] as $source){
		$sql = "
			SELECT ST_AsGeoJSON(wkb_geometry) AS wkb
			FROM {$source}
			WHERE ST_Intersects(ST_SetSRID(wkb_geometry,4269) , ST_MakeEnvelope({$Lon1}, {$Lat1},{$Lon2},{$Lat2},4269))
			";
		//echo $sql."\n";
		fwrite($fp,print_r($sql,true));
		$result = $Conn->query($sql);
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			fwrite($fp,print_r("Hello\n",true));
			fwrite($fp,print_r($row['wkb'],true));
			$Points[] = $row['wkb'];
		}
	}
	fwrite($fp,print_r($Points,true));
	//print_r($Points);
	return $Points;
}




function ExampleQuery4($post){
	global $fp;
	global $Conn;
	
	$Lat1 = $post['lat1'];
	$Lon1 = $post['lon1'];
	$Lat2 = $post['lat2'];
	$Lon2 = $post['lon2'];
	
	$Points = array();
	
	foreach($post['sources'] as $source){
		$sql = "
			SELECT ST_AsGeoJSON(wkb_geometry) AS wkb
			FROM {$source}
			WHERE wkb_geometry @ ST_MakeEnvelope({$Lon1}, {$Lat1},{$Lon2},{$Lat2})
			
		";
		$result = $Conn->query($sql);
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$Points[] = $row['wkb'];
		}
	}
	fwrite($fp,print_r($Points,true));
	//print_r($Points);
	return $Points;
}

function sql_to_coordinates($blob)
{
	$blob = str_replace("))", "", str_replace("POLYGON((", "", $blob));
	$coords = explode(",", $blob);
	$coordinates = array();
	foreach($coords as $coord)
	{
		$coord_split = explode(" ", $coord);
		$coordinates[]=array(str_replace("\n","",$coord_split[0]),str_replace("\n","",$coord_split[1]));
	}
	return $coordinates;
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

function getFeatures(){
    $sql = "SELECT * FROM pg_catalog.pg_tables WHERE schemaname = 'public'";
    $result = $db->query($sql);
    $TableArray = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $TableArray[] = $row['tablename'];
    }
    echo json_encode($TableArray);
}
fclose($fp);
