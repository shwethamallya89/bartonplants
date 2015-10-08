<!DOCTYPE HTML>
<!--
	Horizons by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Search by Season</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body class="left-sidebar">

		<!-- Header -->
			<div id="header">
				<div class="container">
						
					<!-- Logo -->
						<h1><a href="#" id="logo">Search by Month</a></h1>
					
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
									<h2>Search by Month</h2>
									<!--<span class="byline">Native Plants of Barton Springs/Edwards Aquifer District Database</span>-->
								</header>
								<?php
								//these variables contain login information for the bartonplants database 
									$host = "localhost";
									$user = "bartonplants";
									$password = "sage";
									$database = "bartonplants";
								//setting parameters for database connection  	
									$link = mysqli_connect($host,$user,$password,$database);
								//begin html form using the GET method, action sent to results.php
									echo"<div style='text-align:center;'><form method = 'GET' action = 'results.php'>
										<select name='season'>";
								//this variable pulls month names from month table in database		
								$listresult=mysqli_query($link, "SELECT * FROM month");
									while ($row=mysqli_fetch_array($listresult)) {
									print "<option value='$row[month_id]'>$row[month_name]</option>";
											}
									print "<input type= 'submit' value = 'search' name = 'submit'></form></div>";
								//close link connection	
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