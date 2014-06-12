
#### Assignment 2 

####  Database Connection Test 

``````


<?php
$con=mysqli_connect("localhost","avamulapalli","appuchandu","avamulapalli");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "table connected";
$result = mysqli_query($con,"SELECT * FROM Planets");

echo "<table border='1'>
<tr>
<th>Name</th>
<th>NumMoons</th>
<th>Type</th>
<th>LengthOfYear</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['NumMoons'] . "</td>";
  echo "<td>" . $row['Type'] . "</td>";
  echo "<td>" . $row['LengthOfYear'] . "</td>";
  echo "</tr>";
}
?>


`````
