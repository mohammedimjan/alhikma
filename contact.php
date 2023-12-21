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
		<h1>Contact Us</h1>
	</section>

	</section>

	<!-- Contact Us -->
	<section class="location">
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.3059729384!2d-74.25986816097694!3d40.69714941285065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2slk!4v1661841760935!5m2!1sen!2slk"
			width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"></iframe>
	</section>

	<section class="contact-us">
		<div class="row">
			<div class="contact-col">
				<div>
					<i class="fa-solid fa-house"></i>
					<span>
						<h5>xyz road, Abc Buliding</h5>
						<p>Newyork,USA</p>
					</span>
				</div>
				<div>
					<i class="fa-solid fa-phone"></i>
					<span>
						<h5>+1 0123456789</h5>
						<p>Monday to saturday, 10 AM to 6 PM</p>
					</span>
				</div>
				<div>
					<i class="fa-solid fa-envelope"></i>
					<span>
						<h5>info@testemail.com</h5>
						<p>Email Us Your Query</p>
					</span>
				</div>
			</div>
			<div class="contact-col">
				<form action="form-handler.php" method="post">
					<input type="text" name="name" placeholder="Enter Your Name" required>
					<input type="email" name="email" placeholder="Enter Your email address" required>
					<input type="text" name="subject" placeholder="Enter Your Subject" required>
					<textarea rows="8" name="message" placeholder="Message" required></textarea>
					<button type="submit" class="hero-btn red-btn">Send Message</button>

				</form>
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