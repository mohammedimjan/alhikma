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
	if(isset($_POST['save'])){

			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			$event = $_POST['event'];
	
			$sql = "INSERT INTO calendar(day,month,year,events) VALUES('$day','$month','$year','$event')";
			$results = mysqli_query($conn,$sql);
	
			if($results){
				echo "<script>alert('success')</script>";
				echo "<script>window.location = 'calender.php';</script>";
			} 
			else {
				echo "<script>alert('Error)</script>";
			}
			//header("Location: editcalender.php");
		}
	?>

	<section class="head-padd edit-profile">
		<div class="r-contents-left">
			<h3>Add Calender</h3>
			<form class="form-container" method="post" enctype="multipart/form-data">
				<div class="inline-2">
					<div>
						<label for="Day">Day *</label>
						<input type="number" id="Day" name="day" placeholder="Day" required min="1" max="31"
							title="Enter a Valid Date!">
					</div>
					<div>
						<label for="month">Month *</label>
						<select id="month" name="month" required>
							<option disabled>Select Month</option>
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
					</div>
				</div>

				<div class="inline-2">
					<div>
						<label for="Year">Year *</label>
						<input type="number" id="Year" name="year" placeholder="Year" required min="1000" max="9999"
							title="Enter a Valid Year!">
					</div>
					<div>
						<label for="Event">Event *</label>
						<input type="text" id="Event" name="event" placeholder="Event" required
							title="Event cannot be empty!">

					</div>
				</div>

				<input type="submit" value="Save" name="save">
			</form>
		</div>
	</section>

	<script src="../script.js"></script>
</body>

</html>