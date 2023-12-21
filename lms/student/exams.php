<?php

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];

$sql = "SELECT * FROM students_master WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['student_id'];
    $grade = $row['grade'];
}

$sqlsub = "SELECT * FROM selected_subjects WHERE students_id = '$id'";
$resultsub = mysqli_query($conn, $sqlsub);

$selectedSubjects = array();
while ($rowsub = mysqli_fetch_assoc($resultsub)) {
    $selectedSubjects[] = $rowsub['selected_subjects']; 
}


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
	<link rel="stylesheet" href="./other styles/exams.css">
	<!-- <link rel="stylesheet" href="other styles/login.css"> -->
	<link href="assets/css/bootstrap.min.css">
</head>

<body>

	<?php include'header.php'?>

	<section class="head-padd exams">
		<h1>Exams</h1>
		<table>
			<thead>
				<thead>
					<tr>
						<th>Name</th>
						<th>Subject</th>
						<th>Published Date</th>
						<th>Deadline</th>
						<th>Download</th>
					</tr>
				</thead>
			<tbody>

				<?php
				if (count($selectedSubjects) > 0) {
					$subjectList = "'" . implode("', '", $selectedSubjects) . "'";
					$current_date = date('Y-m-d');
				
					$sqlexams = "SELECT * FROM exams WHERE subject IN ($subjectList) AND deadline >= '$current_date'";
					$resultexams = mysqli_query($conn, $sqlexams);
				
				while($row= mysqli_fetch_assoc($resultexams)){
				$name = $row['name'];
				$subject = $row['subject'];
				$subject = $row['start_date'];
				$deadline = $row['deadline'];
				$link = $row['link'];
				$examgrade = $row['grade'];
				if($grade == $examgrade){
					echo"
					<tr>
					<td>$name</td>
					<td>$subject</td>
					<td>$subject</td>
					<td>$deadline</td>
					<td><a href='$link' class='download-button'>View</a></td>
				</tr>
					";
				}
				}
				} 
				?>

			</tbody>
			</thead>
		</table>
	</section>

	<script src="../script.js"></script>

</body>

</html>