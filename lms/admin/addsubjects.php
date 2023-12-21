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
	<link rel="stylesheet" href="styles/editteachers.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>
	<?php include 'header.php' ?>

	<?php
if (isset($_POST['save'])) {
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $subject = strtoupper($subject);

    // Check if the subject already exists in the database
    $checkSql = "SELECT COUNT(*) as subjectCount FROM subjects WHERE subject = '$subject'";
    $checkResult = mysqli_query($conn, $checkSql);
    $row = mysqli_fetch_assoc($checkResult);
    $subjectCount = $row['subjectCount'];

    if ($subjectCount > 0) {
        echo "<script>alert('Subject already exists')</script>";
		echo "<script>window.location = 'addsubjects.php';</script>";
    } else {
        $sql = "INSERT INTO subjects (subject) VALUES ('$subject')";
        $results = mysqli_query($conn, $sql);

        if ($results) {
            echo "<script>alert('Success')</script>";
			echo "<script>window.location = 'addsubjects.php';</script>";
        } else {
            echo "<script>alert('Error')</script>";
        }
    }
}
	?>
	<section class="head-padd edit-profile">

		<div class="r-contents-left">
			<h3>Add Subjects</h3>
			<form class="form-container" method="post" enctype="multipart/form-data">
				<div class="inline-2">
					<div class="in-sub">
						<label for="Subjects">Subjects</label>
						<input type="text" id="Subjects" name="subject" placeholder="Subjects" required>

					</div>
					<!-- <div>
						<label for="Month">Month</label>
						<input type="text" id="Month" name="Month" placeholder="Month" required>

					</div> -->
				</div>

				<input type="submit" value="Save" name="save">
			</form>
		</div>
	</section>

	<script src="../script.js"></script>
</body>

</html>