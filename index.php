<!DOCTYPE HTML>
<!--
	Template credits: Horizons by TEMPLATED, Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	Develeoped as a part of INF 385M : Database Management
	Instructor: Stan Gunn
	Programmers: Jullianne Ballou, Tim Kindseth, Hannah Rainey, Shwetha Mallya
	Database: bartonplants
	Page: index.php
-->
<html>
	<head>
		<title>Native Plants of Barton Creek</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
				
		
		<!-- All of these js scripts were included in the template. They make the page look pretty and responsive-->
		
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/search.css" />
		</noscript>
				

	</head>
	<body class="homepage">

		<!-- Header -->
			<div id="header">
								
					<!-- Logo -->
						<h1><a href="#" id="logo">BARTON PLANTS</a></h1>
					
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


					<!-- Banner -->
						<div id="banner">
							<div class="container">
								<section>
									<header class="major">
										<h2>Explore the native plants of Barton Creek</h2>
										<span class="byline">Search by name below or browse by Plants above</span>
									</header>
									
								</section>			
							</div>
						</div>
							<div id="search">
							<div class="container">
		
								<!-- Our code begins here-->
								<?php
		
									//these variables contain login information for the bartonplants database 
									$host = "localhost";
									$user = "bartonplants";
									$password = "sage"; // *Shh!*
									$database = "bartonplants";
									
									//setting parameters for database connection 
									$link = mysqli_connect($host,$user,$password,$database);
									
									//html form uses GET method and sends search results to results.php
									echo(
									"<form method = 'GET' action = 'results.php'>
										<input type = 'text' size = '40' name = 'search'>
										<input type= 'submit' value = 'search' name = 'submit' >
									</form>");
								
								
									//form validation
									if(isset($_GET['search'])){
											$search = $_GET['search'];
										
											//sanitize the input
											$search = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search);
									
											//assign a variable to the MySQL query
											$search_query = "SELECT * FROM plant_name
															 WHERE name LIKE '%$search%'
															 GROUP BY name";

											//run the query via connection link established 
											$listresult = mysqli_query($link,$search_query);
											print "<p> Search Results </p>";

											// using $row as variable to point to the results array retrieved from the query
											while($row = mysqli_fetch_array($listresult)){
													print "<a href=\" plantinfo.php?plant=$row[plant_name_id]\">$row[name]</a><br/>";
											}
											
											//close link connection
											mysqli_close($link);
									}
						
									
								?>
							 </div> 
						</div> 
				
				</div>
			</div>

		<!-- Featured -->
			<div class="wrapper style2">
				<section class="container">
					<header class="major">
						<h2>Additional Resources</h2>
						<span class="byline">Find out more about native plants in Texas</span>
					</header>
					<div class="row no-collapse-1">
						<section class="4u">
							<a href="http://www.austintexas.gov/department/plants" target="_blank" class="image feature"><img src="images/austin.jpg" alt="">
							<p>City of Austin</p></a>
						</section>
						<section class="4u">
							<a href="https://www.wildflower.org/" target ="_blank" class="image feature"><img src="images/Lady_bird.jpg" alt="">
							<p>Lady Bird Johnson Wildflower Center</p></a>
						</section>
						<section class="4u">
							<a href="http://npsot.org/wp/" target="_blank" class="image feature"><img src="images/nspot.jpg" alt="">
							<p>Native Plant Society of Texas</p></a>
						</section>
	
					</div>
				</section>
			</div>

		<!-- Main -->
			<div id="main" class="wrapper style1">
				<section class="container">
					<header class="major">
						<h2>About Us</h2>
						<span class="byline">Students at the UT School of Information</span>
					</header>
					<div class="row">
					
						<!-- Content -->
							<div class="6u">
								<section>
									<ul class="style">
										<li>
											<span class="fa fa-leaf"></span>
											<h3>Jullianne Ballou</h3>
											<span>Jullianne is a master's student at UT's School of Information. She 
loves Texas's wildflower-strewn landscapes, but has a special fondness for the common yarrow.</span> 
										</li>
										<li>
											<span class="fa fa-leaf"></span>
											<h3>Tim Kindseth</h3>
											<span>A master's student at UT's 
School of Information, Tim was born on the blackland prairie and prefers Bedichek to Thoreau.</span>
										</li>
									</ul>
								</section>
							</div>
							<div class="6u">
								<section>
									<ul class="style">
										<li>
											<span class="fa fa-leaf"></span>
											<h3>Shwetha Mallya</h3>
											<span>Shwetha is currently pursuing her masters at the School of Information
												  at UT Austin. She is a big foodie and loves watching TV in her free time. Her favorite native plant is the bluebonnet.</span>
										</li>
										<li>
											<span class="fa fa-leaf"></span>
											<h3>Hannah Rainey</h3>
											<span>When Hannah isn’t busy with school and work, she loves to jog, hike, and climb. Her favorite native plant is the Texas prickly pear.</span>
										</li>
									</ul>
								</section>
							</div>

					</div>
				</section>
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
												<li><a href="http://www.wildflower.org/plants/" target="_blank">All plant photographs borrowed from the Lady Bird Johnson Wildflower Center</a></li>
												<li> Photo Credits for background image: Nishanth Bhargava </li>
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
							Design credits: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
						</div>

				</div>
			</div>

	</body>
</html>
