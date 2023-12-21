<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Collage web Design</title>
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap"
		rel="stylesheet">
	<script src="https://kit.fontawesome.com/01a55d6f88.js" crossorigin="anonymous"></script>


	<script type="text/javascript">
	window.$crisp = [];
	window.CRISP_WEBSITE_ID = "877f5dd6-ac10-429a-a22a-46edb02ef3f4";
	(function() {
		d = document;
		s = d.createElement("script");
		s.src = "https://client.crisp.chat/l.js";
		s.async = 1;
		d.getElementsByTagName("head")[0].appendChild(s);
	})();
	</script>

</head>

<body>
	<section class="sub-header">
		<?php include 'header.php' ?>
		<h1>About Us</h1>
	</section>

	<!-- About Us Content -->

	<section class="about-us">
		<div class="row">
			<div class="about-col">
				<h1>We are the most awarded Collage</h1>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus itaque saepe inventore
					rem voluptates eum, eius numquam, modi dolor animi aut voluptate consequuntur nemo, molestiae
					magni qui. Minima nemo iusto veritatis cupiditate mollitia nesciunt animi dolorem fuga nihil aliquam
					modi possimus eaque dolorum repellat, sapiente commodi hic aliquid! Quo, sint!</p>
				<a href="" class="hero-btn red-btn">Explore Now</a>
			</div>
			<div class="about-col">
				<img src="images/about.jpg" alt="">
			</div>
		</div>
	</section>




	<?php include 'footer.php' ?>



	<!-- Javascript for Toggle Menu -->
	<script>
	var navLinks = document.getElementById("navLinks");

	function showmenu() {
		navLinks.style.right = "0px";
	}

	function hidemenu() {
		navLinks.style.right = "-200px";
	}
	</script>
</body>

</html>