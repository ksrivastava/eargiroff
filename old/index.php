<html>
	<head>
		<title>Emma Argiroff</title>
		<meta name="description" content="This is a website for Emma Argiroff, a student at the University of Michigan School of Art and Design, to showcase her works." />
		<meta name="keywords" content="Emma, Argiroff, Michigan, Art, Design, printmaking, Ann Arbor, commissions" />
		<meta name="author" content="Kaustubh Srivastava"
		<meta name="robots" content="index, follow" />
		<link rel="stylesheet" type="text/css" href="style/style.css?<?php echo time(); ?>">
		<link href='http://fonts.googleapis.com/css?family=Mate+SC' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
		<!-- <script type="text/javascript" src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
		<script type="text/javascript" src="scripts/navigation.js?<?php echo time(); ?>"></script>
	</head>
	<body>
	<div id="container">
		<div id="logo" class="hidden"> <img src="images/logo/logo.png"></div>
		<div id="sidebar">
			<div id="blurb"></div>
			<div class="header">
				<ul id="navlinks">
					<li id="home">Home</li>
					<li id="about">About</li>
					<li id="portfolio">Portfolio</li>
					<ul id="portfoliolinks" class ="no-display">
						<li id="paintings">Paintings</li>
						<li id="printmaking">Printmaking</li>
						<li id="illustrations">Illustrations</li>
					</ul>
					<li id="commissions">Commissions</li>
					<li id="contact">Contact</li>
				</ul>
			</div>
		</div>
		<div id="wrapper">
			<div id="title"></div>
			<div id="content">
				<div id="text"></div>
				<div id="gallery"></div>
			</div>
		</div>
	</div>
	<div class="footer hidden">
		<p>2014 Emma Argiroff &nbsp;&nbsp;| &nbsp; Website designed by <a href="http://iamkos.com">Kaustubh Srivastava</a>
		&nbsp;&nbsp;| &nbsp; Hosted by <a href="http://ipage.com">iPage</a></p>
	</div>
	</body>
</html>

<?php
	ini_set('display_errors', 'On');
	$links = array("home", "about", "illustrations", "paintings", 
				"printmaking", "commissions", "contact");
	$path = $_SERVER['REQUEST_URI'];
	$path_elm = explode("/", $path);
	$elm = $path_elm[sizeof($path_elm)-1];
	if (empty($elm)) $elm = "home";
	if (in_array($elm, $links)) {
		echo "<script>navigate('$elm');</script>";
	}
	else {
		header('HTTP/1.0 404 Not Found');
		header('Location: 404.html');
		exit;
	}
?>
