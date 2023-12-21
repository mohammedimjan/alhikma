<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al-Hikmah Educational centre</title>
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap"
		rel="stylesheet">
	<script src="https://kit.fontawesome.com/01a55d6f88.js" crossorigin="anonymous"></script>

</head>

<body class="b-panel">


	<section class="log-pannel">
		<div class="login-btns">
			<div class="card">
				<div class="icon"><i class="fas fa-user-circle"></i></div>
				<!-- You can replace this with your desired icon -->
				<h2>Student's Corner</h2>
				<a href="lms/student/login.php" id="button">Login</a>
			</div>

			<div class="card">
				<div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
				<!-- You can replace this with your desired icon -->
				<h2>Teacher's Corner</h2>
				<a href="lms/teachers/login.php" id="button">Login</a>
			</div>

			<div class="card">
				<div class="icon"><i class="fas fa-user-shield"></i></i></div>
				<!-- You can replace this with your desired icon -->
				<h2>Admin Dashboard</h2>
				<a href="lms/admin/login.php" id="button">Login</a>
			</div>


		</div>

	</section>






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