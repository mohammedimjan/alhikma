<?php

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
	header("Location: login.php");
	die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];


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
	<link rel="stylesheet" href="./other styles/index.css">
	<link href="assets/css/bootstrap.min.css">
</head>

<body>

	<?php include 'header.php' ?>

	<section class="home">
		<div class="home-left">
			<h2>Events Calender</h2>
			<table class="event-table">
				<thead>
					<tr>
						<th class="year">Year</th>
						<th class="month">Month</th>
						<th class="date">Date</th>
						<th class="event">Event</th>
					</tr>
				</thead>
				<tbody>
					<?php
				$sql = "SELECT * FROM calendar ORDER BY CONCAT(year, '-', month, '-', day) DESC LIMIT 4";
				$result = mysqli_query($conn, $sql);

				if (!$result) {
					die("Database query failed: " . mysqli_error($conn));
				}

				while ($row = mysqli_fetch_assoc($result)) {
					echo "
					<tr>
						<td class='year'>{$row['year']}</td>
						<td class='month'>" . $row['month'] . "</td>
						<td class='date'>" . $row['day'] . "</td>
						<td class='event'>" . $row['events'] . "</td>
					</tr>
					";
				}
				mysqli_free_result($result); // Free the result set
				?>
				</tbody>
			</table>
			<div class="land-btn">
				<a href="calender.php">View Calender</a>
			</div>
		</div>
		<div class="home-right">
			<div class="land-btn">
				<a href="learningmaterials.php">Learning Materials</a>
			</div>
			<div class="land-btn">
				<a href="results.php">Results</a>
			</div>
			<div class="land-btn">
				<a href="exams.php">Exams</a>
			</div>

		</div>
	</section>

	<script src="../script.js"></script>

</body>

</html>