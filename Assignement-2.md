##Grade

|    |Possible|Earned|Category           | Objective                                          | 
|:--:|:------:|:----:|:-----------------:|----------------------------------------------------|
|![1]|    10  |   10   | OGR Command     | Ogr command was present.                           |
|![1]|    35  |   40   | OGR Command     | Ogr command was syntactically correct.             |
|    |        |        |                 |                                                    |
|![1]|    10  |   10   | Table Structure | Table structure was present.                       |
|![1]|    35  |   40   | Table Structure | Table structure was correct.                       |
|![2]|    10  |   0    | Markdown        | Used proper markdown.                              |
|    | Total  |        |                 |                                                    |
|    |    100 |**90**  |                 |                                                    |



![1] = Correct <br>
![2] = Incorrect <br>
![3] = Partially Correct <br>

[1]: https://raw.githubusercontent.com/rugbyprof/5443-Spatial-Database/master/media/correct.png
[2]: https://raw.githubusercontent.com/rugbyprof/5443-Spatial-Database/master/media/incorrect.png
[3]: https://raw.githubusercontent.com/rugbyprof/5443-Spatial-Database/master/media/partial.png


#Assignement-2
# Aparna Vamulapalli

#Org2org Cammand

```
ogr2ogr -f "MySQL" MySQL:"avamulapalli,host=localhost,user=avamulapalli,password=appuchandu,port=3036" TM_WORLD_BORDERS-0.3.shp -nln World_Borders -update -overwrite -lco engine=MYISAM
```


# Table damp Structure

```sql
CREATE TABLE IF NOT EXISTS `world_borders` (
  `OGR_FID` int(11) NOT NULL AUTO_INCREMENT,
  `SHAPE` geometry NOT NULL,
  `fips` varchar(2) DEFAULT NULL,
  `iso2` varchar(2) DEFAULT NULL,
  `iso3` varchar(3) DEFAULT NULL,
  `un` decimal(3,0) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `area` decimal(7,0) DEFAULT NULL,
  `pop2005` decimal(10,0) DEFAULT NULL,
  `region` decimal(3,0) DEFAULT NULL,
  `subregion` decimal(3,0) DEFAULT NULL,
  `lon` double(8,3) DEFAULT NULL,
  `lat` double(7,3) DEFAULT NULL,
  UNIQUE KEY `OGR_FID` (`OGR_FID`),
  SPATIAL KEY `SHAPE` (`SHAPE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;
```
