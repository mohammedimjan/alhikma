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
	<link rel="stylesheet" href="styles/index.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>



	<?php include 'header.php' ?>

	<section class="head-padd admin-home">
		<ul class="container">
			<li>
				<a href="learningmat.php"><i class="fa-sharp fa-solid fa-book"></i>Learning Materials</a>
			</li>
			<li>
				<a href="exams.php"><i class="fa-solid fa-book-open"></i>Exams</a>
			</li>
			<li>
				<a href="addteacher.php"><i class="fa-solid fa-person-circle-plus"></i>Add Teachers</a>
			</li>
			<li>
				<a href="viewteachers.php"><i class="fa-solid fa-id-badge"></i>Teachers</a>
			</li>
			<li>
				<a href="viewstudents.php"><i class="fa-solid fa-user-group"></i>Students</a>
			</li>
			<li>
				<a href="addsubjects.php"><i class="fa-solid fa-book-medical"></i>Add Subjects</a>
			</li>
			<li>
				<a href="subjects.php"><i class="fa-solid fa-book-bookmark"></i>Subjects</a>
			</li>
			<li>
				<a href="teacherdir.php"><i class="fa-regular fa-address-book"></i>Teachers Directory</a>
			</li>
			<li>
				<a href="studentsdir.php"><i class="fa-solid fa-address-book"></i>Students Directory</a>
			</li>
			<li>
				<a href="calender.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
			</li>
			<li>
				<a href="editcalender.php"><i class="fa-regular fa-calendar-plus"></i>Edit Calendar</a>
			</li>
			<li>
				<a href="results.php"><i class="fa-solid fa-xmarks-lines"></i>Results</a>
			</li>
		</ul>
	</section>



	<script src="../script.js"></script>

</body>

</html>