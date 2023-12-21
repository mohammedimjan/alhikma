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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al Hikmah</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="other styles/changepassword.css">
</head>

<body>
	<div class="main-bg">
		<div class="c-contents">
			<div class="c-contents-left">
				<img src="./Images/changepassword-sec.jpg" alt="backgroud-sec">
			</div>
			<div class="c-contents-right">
				<img src="./Images/Logo.png" alt="logo">
				<h3>New Password</h3>
				<form enctype="multipart/form-data" method="post">
					<label for="password">New Password</label>
					<input type="password" name="password" required placeholder="New Password">
					<label for="password">Confirm Password</label>
					<input type="password" name="conf_password" required placeholder="Confirm Password">
					<input type="hidden" name="id" value='<?php echo $id; ?>'>
					<input type="submit" name="change" value="Change Password">
				</form>
				<?php 
		if(isset($_POST['change'])){
			$password = $_POST['password'];
			$conf_password = $_POST['conf_password'];
			$id = $_POST['id'];

			if($password == $conf_password){
				$hashpassword = password_hash($password, PASSWORD_DEFAULT);
				
				$sql = "UPDATE students_master SET password = '$hashpassword' WHERE student_id  = '$id'";
				$result = mysqli_query($conn,$sql);

				if($result){
					echo "<script>alert('Password Changed Successfully')</script>";
					echo "<script>window.location = 'profile.php';</script>";
				} else {
					echo "<script>alert('Error While Chaning Password')</script>";
				}
			}else{
				echo "<script>alert('Password didnt match!')</script>";
			}
		}
		?>
			</div>
		</div>
	</div>
</body>

</html>