<?php
session_start();
include('../db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al Hikmah</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="../admin/styles/login.css">
</head>

<body>
	<div class="main-bg">
		<!-- <img src="images/index-bg.jpg" alt="background"> -->
		<div class="l-contents">
			<div class="l-content-left">
				<img src="./Images/adminlogin-sec.jpg" alt="login">
			</div>
			<div class="l-content-right">
				<img src="../student/Images/Logo.png" alt="NO">
				<h3>Admin Login</h3>
				<form class="form-1" method="post" enctype="multipart/form-data">
					<label for="email">Username</label>
					<input type="text" name="email" placeholder="User Name">
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password">
					<input type="submit" value="Login" name="login">
				</form>
			</div>
			<?php 
			if(isset($_POST['login'])){
				$username = $_POST['email'];
				$password = $_POST['password'];

				$sql = "SELECT * FROM admin WHERE username ='$username'";
				$result = mysqli_query($conn,$sql);

				if(mysqli_num_rows($result)===1){
					$row = mysqli_fetch_assoc($result);
					if (password_verify($password, $row['password'])) {
						$_SESSION['SESSION_EMAIL'] = $username;
						header("Location: index.php");
					} else {
						echo "<script>alert('wrong password')</script>";
					}
				}else{
					echo "<script>alert('Email Not Found')</script>";
					die();
				}
				
			}
			?>
		</div>
	</div>
</body>

</html>