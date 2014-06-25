Answer for my sql Querry:

SELECT S.SHAPE, location, state
FROM  `earth_quakes` AS E,  `state_borders` AS S
WHERE state =  'Maine'
AND CONTAINS( S.SHAPE, E.SHAPE ) 
ORDER BY location
