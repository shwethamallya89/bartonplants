<!DOCTYPE HTML>
<!--
	Template credits: Horizons by TEMPLATED, Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	Developed for INF 385M : Database Management
	Instructor: Stan Gunn
	Programmers: Jullianne Ballou, Tim Kindseth, Hannah Rainey, Shwetha Mallya
	Database: bartonplants
	Page: results.php
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
									<h2>Results</h2>
								</header>
		
								<!-- code starts here --> 
								<?php
									
									$host = "localhost";
									$user = "bartonplants";
									$password = "sage";
									$database = "bartonplants";
									$link = mysqli_connect($host,$user,$password,$database);

									// Search from the search bar on index.php
									if(isset($_GET['search'])){
											$search = $_GET['search'];
									//sanitize inputs		
											$search = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search);
									// query results from database based on keywords entered by user
											$search_query = "SELECT plant_name.plant_name_id, plant_name.name as name ,image.img as img FROM image,plant_name, plant 
															 WHERE name LIKE '%$search%'
															 and  plant.image_id = image.image_id
															 and plant_name.plant_name_id = plant.plant_name_id
															 GROUP BY name";
									}
									
									// Search based on month from seasonsearch.php
									elseif(isset($_GET['season'])){
											$season = $_GET['season'];
									//query results based on selection entered by user
											$search_query = "SELECT plant_name.plant_name_id, plant_name.name as name ,image.img as img  
															 FROM image,plant_name, plant 
															 WHERE plant.image_id = image.image_id 
																AND plant_name.plant_name_id = plant.plant_name_id  
																AND '$season' between plant.start_month and plant.end_month";
									}
									
									//Search based on color from colorsearch.php
									elseif(isset($_GET['color'])){
											$color = $_GET['color'];
									//query results based on selection entered by user
											$search_query = "SELECT plant_name.plant_name_id, plant_name.name as name ,image.img as img  
															 FROM image,plant_name, plant 
															 WHERE plant.image_id = image.image_id 
																AND plant_name.plant_name_id = plant.plant_name_id  
																AND plant.color_id = '$color'";
															
									}
									
									//Search based on height from sizesearch.php
									elseif(isset($_GET['size'])){
											$size = $_GET['size'];
									//query results based on selection entered by user
											$search_query = "SELECT plant_name.plant_name_id, plant_name.name as name ,image.img as img  
															 FROM image,plant_name, plant 
															 WHERE plant.image_id = image.image_id 
																AND plant_name.plant_name_id = plant.plant_name_id  
																AND plant.size_id = '$size'";
															
									}
									
										
									//print results in html table
									$listresult = mysqli_query($link,$search_query);
									print '<div style="display:inline width:100%" align="center">';
									print "<table>";
									
									$num_rows = mysqli_num_rows($listresult);
									$count = 0;
									while($row = mysqli_fetch_array($listresult)){
									
										// To restrict 3 columns in the results table 
										if($count % 3 == 0 )
											echo '<tr>';
										echo '<td>';
									//this variable is set to the image page on the server. The file name is retrieved from the databse based on the search results		
										$img_link = "http://corvette.ischool.utexas.edu/bartonplants/images/".$row['img'];
										print "<a href=\" moreinfo.php?plant=$row[plant_name_id]\">";	//creates a link to the moreinfo.php page, sets plant=plant_name_id
										print '<img src="'.$img_link.'" alt="sample image" height="200" width ="200"  />';
										print '<br />';
										print "$row[name]</a></td>";
										echo "<th colspan=\"8\"><hr width=\"100%\" color=\"green\"></th>";
										echo '</td>';		
										
										// To restrict 3 columns in the results table 
										if($count % 3 == 2)
											echo '</tr>';
										$count++;
									}
									//if no results found
									if($num_rows == 0){
											print " No results found. Please try using other keywords";

									}
									
									print "<hr/>";
									print "</table>";
									print "</div>";
									
									//close connection
									mysqli_close($link);
								?>
								
							</section>
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
