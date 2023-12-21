<?php 

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
header("Location: login.php");
die();
}
include('../db.php');

$username = $_SESSION['SESSION_EMAIL'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al Hikmah</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="styles/studentsprofile.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>

	<?php include 'header.php' ?>

	<section class="head-padd profile-con">
		<div class="profile">
			<h1>Admin Profile</h1>
			<div class="profile-table">
				<table id="profile">
					<?php 

					?>
					<tr>
						<th>User Name:</th>
						<td><?php echo htmlspecialchars($username); ?></td>
					</tr>


				</table>

				<a href='editadmin.php' class='download-button'>Change Password</a>

			</div>
		</div>
	</section>


	<script src="../script.js"></script>

</body>

</html>