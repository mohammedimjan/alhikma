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
	<link rel="stylesheet" href="styles/index.css">
	<link rel="stylesheet" href="styles/style.css">

	<script type="text/javascript">
	window.$crisp = [];
	window.CRISP_WEBSITE_ID = "877f5dd6-ac10-429a-a22a-46edb02ef3f4";
	(function() {
		d = document;
		s = d.createElement("script");
		s.src = "https://client.crisp.chat/l.js";
		s.async = 1;
		d.getElementsByTagName("head")[0].appendChild(s);
	})();
	</script>
</head>

<body>

	<?php include 'header.php' ?>

	<section class="home">
		<div class="home-left">
			<h2>Events Calendar</h2>
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
				<a href="calender.php">View Calendar</a>
			</div>
		</div>
		<div class="home-right">
			<div class="land-btn">
				<a href="viewlearnmat.php">Learning Materials</a>
			</div>
			<div class="land-btn">
				<a href="results.php">Results</a>
			</div>
			<div class="land-btn">
				<a href="viewexams.php">Exams</a>
			</div>
		</div>
	</section>

	<script src="../script.js"></script>


</body>

</html>