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
	<link rel="stylesheet" href="other styles/login.css">
</head>

<body>
	<div class="main-bg">
		<div class="i-contents">
			<div class="i-content-left">
				<h2><span class="col">Welcome To</span><br /> AL-Hikmah Educational Centre</h2>
				<img src="images/Logo.png" alt="logo">
			</div>
			<div class="i-content-right">
				<h3>Login To Your Account</h3>
				<form class="form-1" method="post" enctype="multipart/form-data">
					<label for="email">Email</label>
					<input type="email" name="email" placeholder="Email">
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password">
					<input type="submit" value="Login" name="login">
				</form>
			</div>
		</div>
		<?php
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $code = "1";
            $sql = "SELECT * FROM students_master WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $status = $row['code'];

                // Debugging statements

                if (!$status == $code) {
					echo "<script>alert('Your Account is Deactivated..')</script>";
                } else {
					if (password_verify($password, $row['password'])) {
                        $_SESSION['SESSION_EMAIL'] = $email;
                        header("Location: index.php");
                    } else {
                        echo "<script>alert('Incorrect password')</script>";
                    }
                }
            } else {
                echo "<script>alert('Email Not Found')</script>";
                die();
            }
        }
        ?>
	</div>
</body>

</html>