<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');
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
	<link rel="stylesheet" href="styles/calender.css">
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


	<?php include'header.php'?>

	<section class="head-padd calender">

		<h1 class="section-h1">Calender</h1>

		<table class="table-teach">
			<thead>
				<tr>
					<th>Year</th>
					<th>Month</th>
					<th>Date</th>
					<th>Event</th>
				</tr>
			</thead>
			<tbody>

				<?php 
			$sql = "SELECT * FROM calendar ORDER BY CONCAT(year, '-', month, '-', day) DESC";
			$result = mysqli_query($conn,$sql);

			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					echo"
					<tr>
					<td>{$row['year']}</td>
					<td>{$row['month']}</td>
					<td>{$row['day']}</td>
					<td>{$row['events']}</td>
				</tr>
					";
				}
			}


			?>
			</tbody>
		</table>
	</section>
	<script src="../script.js"></script>

</body>

</html>