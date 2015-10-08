
<html>
<head>
<title> Search Details </title>
</head>
<body>
<?php

$host = "localhost";
									$user = "bartonplants";
									$password = "sage";
									$database = "bartonplants";
									$link = mysqli_connect($host,$user,$password,$database);
$book = $_GET['plant'];
$book = preg_replace("/[^ 0-9a-zA-Z]+/", "", $book);
$search_query = "select plant_name.name as name, family.family_name as family_name, species.name, genus.name
				from plant_name, family, species, genus
				where plant_name.family_id = family.family_id
					and plant_name.species_id = species.species_id 
					and plant_name.genus_id = genus.genus_id
					and plant_name_id = $book"; 
$listresult = mysqli_query($link, $search_query);
$row = mysqli_fetch_array($listresult);
print "The plant you selected, $row[name] is from family $row[family_name]";
mysqli_close($link);
?>
</body>
</html>
