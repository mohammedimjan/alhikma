<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');

$username = $_SESSION['SESSION_EMAIL'];
$sql = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error in SQL query: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
}

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
			<h3>Update Admin</h3>

			<form class="form-container" enctype="multipart/form-data" method="post">
				<div class="inline-2">
					<div>
						<label for="name">User Name</label>
						<input type="text" id="name" name="name" value="<?php echo htmlspecialchars($username); ?>"
							placeholder="Name" required>
					</div>
					<div>
						<label for="password">Password</label>
						<input type="password" id="password" name="password" placeholder="password" required>
					</div>
				</div>
				<input type="submit" value="Update" name="update">
			</form>
		</div>

		<?php 
        if(isset($_POST['update'])){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE admin SET username = '$name', password = '$hashpassword' WHERE id =$id";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo "Error While Updating: " . mysqli_error($conn);
            } else {
                echo "<script>alert('Updated successfully!')</script>";
                echo "<script>window.location = 'profile.php';</script>";
            }
        }
        ?>
	</section>

	<script src="../script.js"></script>
</body>

</html>