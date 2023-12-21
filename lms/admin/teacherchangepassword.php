<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');
$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al Hikmah</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="styles/editteachers.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>
	<?php include 'header.php' ?>

	<section class="head-padd edit-profile">
		<div class="r-contents-left">
			<h3>Change Password</h3>

			<form class="form-container" enctype="multipart/form-data" method="post">
				<div class="inline-2">
					<div>
						<label for="name">Pasword</label>
						<input type="password" id="password" name="password" placeholder="password" required>
					</div>
					<div>
						<label for="password">Confirm Password</label>
						<input type="password" id="password" name="conf_password" placeholder="Confirm password"
							required>
					</div>
				</div>
				<input type="hidden" name="id" value='$id'>
				<input type="submit" value="Update" name="update" style="padding: 0.8rem 0.5rem !important;">

			</form>
		</div>
		<?php 
		if(isset($_POST['update'])){
			$password = $_POST['password'];
			$conf_password = $_POST['conf_password'];
			$id = $_POST['id'];

			if($password == $conf_password){
				$hashpassword = password_hash($password, PASSWORD_DEFAULT);
				
				$sql = "UPDATE teachers_master SET password = '$hashpassword' WHERE id = '$id'";
				$result = mysqli_query($conn,$sql);

				if($result){
					echo "<script>alert('Password Changed Successfully')</script>";
					echo "<script>window.location = 'viewteachers.php';</script>";
				} else {
					echo "<script>alert('Error While Chaning Password')</script>";
				}
			}else{
				echo "<script>alert('Password didnt match!')</script>";
			}
		}
		?>
	</section>

	<script src="../script.js"></script>
</body>

</html>