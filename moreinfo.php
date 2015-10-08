<!DOCTYPE HTML>
<!--
	Template credits: Horizons by TEMPLATED, Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	Developed for INF 385M : Database Management
	Instructor: Stan Gunn
	Programmers: Jullianne Ballou, Tim Kindseth, Hannah Rainey, Shwetha Mallya
	Database: bartonplants
	Page: moreinfo.php
-->
<html>
	<head>
		<title>Search Results</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		
	</head>
	<body class="left-sidebar">

		<!-- Header -->
			<div id="header">
				<div class="container">
						
					<!-- Logo -->
						<h1><a href="#" id="logo">Search Results</a></h1>
					
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.php">Home</a></li>
									<li>
									<a href="">Plants</a>
									<ul>
										<li><a href="seasonsearch.php">By Month</a></li>
										<li><a href="colorsearch.php">By Color</a></li>
										<li><a href="sizesearch.php">By Size</a></li>
									</ul>
								</li>              
								<li><a href="about.html">About</a></li>
							</ul>
						</nav>

				</div>
			</div>

		<!-- Main -->
			<div id="main" class="wrapper style1">
				<div class="container">
					<div class="row">
						
						<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header class="major">
									<h2>Plant Information</h2>
									</header>
									
									<?php
									
									$host = "localhost";
									$user = "bartonplants";
									$password = "sage";
									$database = "bartonplants";
									$link = mysqli_connect($host,$user,$password,$database);

									$plant = $_GET['plant'];
									$plant = preg_replace("/[^ 0-9a-zA-Z]+/", "", $plant);
		
									// Main query to fetch more info based on the plant selected by user on the search results page
									$search_query = "SELECT plant_name.name as name, family.family_name as family_name, species.name as species_name, genus.name as genus_name, image.img as img, 
													plant.fun_facts as fun, size.size as size, plant.start_month as start,plant.end_month as end
													FROM plant_name, family, species, genus, image, plant, size
													WHERE plant_name.family_id = family.family_id
														AND plant_name.species_id = species.species_id 
														AND plant_name.genus_id = genus.genus_id
														AND plant.plant_name_id =  $plant
														AND plant.image_id = image.image_id
														AND plant.plant_name_id = plant_name.plant_name_id
														AND size.size_id = plant.size_id";

									// fetch the corresponding link to national wildflower database
									$link_search_query = "SELECT plant.plant_name_id, plant.plant_id, link.link as link
															FROM plant, link
															WHERE plant.plant_id = link.plant_id
																AND plant.plant_name_id = $plant";

									// get bloom start month name
									$start_month_query =  "	SELECT month.month_name
															FROM  month
															WHERE month_id IN (SELECT plant.start_month
																				FROM plant
																				WHERE plant.plant_id = $plant )";
									// get bloom end month name
									$end_month_query = "SELECT month.month_name
														FROM  month
														WHERE month_id IN (SELECT plant.end_month
																			FROM plant
																			WHERE plant.plant_id = $plant )";
									//present more information in html table	
									$listresult = mysqli_query($link, $search_query);
									$row = mysqli_fetch_array($listresult);
									$img_link = "http://corvette.ischool.utexas.edu/bartonplants/images/".$row['img'];
									print '<div style="display:inline width:100%" align="center"><img src="'.$img_link.'" alt="sample image" height="400" width ="400" align="middle"/> <br/>';
									print "<table><h3 align = \"center\"><p align =\"center\">$row[name]</p></h3>";
									print "<tr><td>Family Name: </td><td>$row[family_name]</td></tr>";
									print "<tr><td>Genus: </td><td>$row[genus_name]</td></tr>";
									print "<tr><td>Species: </td><td>$row[species_name]</td></tr>";
									print "<tr><td>Size: </td><td>$row[size]</td></tr>";
									
									//show bloom start month
									$startmonthresult = mysqli_query($link, $start_month_query);
									$start_month_row = mysqli_fetch_array($startmonthresult);
									print "<tr><td>Starts to Bloom: </td><td>$start_month_row[month_name]</td></tr>";
									//show bloom end month									
									$endmonthresult = mysqli_query($link, $end_month_query);
									$end_month_row = mysqli_fetch_array($endmonthresult);
									print "<tr><td>Ends Bloom: </td><td>$end_month_row[month_name]</td></tr>";
									
									//Print fun fact
									if($row['fun'])
										print "<tr><td>Fun Fact: </td><td>$row[fun]</td></tr>";
								
									//close html table	
									print "</table></div>";
									
									//show link to Ladybird Johnson Wildflower Center database
									$linkresult= mysqli_query($link, $link_search_query);
									$link_row = mysqli_fetch_array($linkresult);
									print "<p>National Wildflower Database: <a href='$link_row[link]' target='_blank'>$link_row[link]</a></p>";
									
									//close connection
									mysqli_close($link);
									
								?>
								
							</section>
							<a href="javascript:history.back()">Return to Search Results</a>
						</div>
					</div>
				</div>
			</div>

		<!-- Footer -->
			<div id="footer">
				<div class="container">

					<!-- Lists -->
						<div class="row">
							<div class="8u">
								<section>
									<header class="major">
										<h3>Database Management Spring 2015</h3>
										<span class="byline">Taught by Stan Gunn</span>
									</header>
									<div class="row">
											<ul class="default">
												<li><a href="http://www.wildflower.org/plants/" target="_blank">All photographs borrowed from the Lady Bird Johnson Wildflower Center</a></li>
											</ul>
									</div>
								</section>
							</div>
							<div class="4u">
								<section>
									<header class="major">
										<h3>Contact</h3>
										<span class="byline">Send us your questions</span>
									</header>
									<ul class="contact">
										
										<li>
											<span class="mail">Mail</span>
											<span><a href="#">bartonplants@somewhere.net</a></span>
										</li>
										<li>
											<span class="phone">Phone</span>
											<span>(000) 000-0000</span>
										</li>
									</ul>	
								</section>
							</div>
						</div>

					<!-- Copyright -->
						<div class="copyright">
							Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
						</div>

				</div>
			</div>

	</body>
</html>
