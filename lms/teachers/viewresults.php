<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
	header("Location: login.php");
	die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];

$sql_teacher = "SELECT * FROM teachers_master WHERE email = '$email'";
$result_teacher = mysqli_query($conn, $sql_teacher);

if (mysqli_num_rows($result_teacher) === 1) {
	$row = mysqli_fetch_assoc($result_teacher);
	$id = $row['id'];
}

// Handle search form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
    
    $sql_results = "SELECT * FROM results WHERE teachers_id ='$id' AND (name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%')";
} else {
    $sql_results = "SELECT * FROM results WHERE teachers_id ='$id'";
}

$result_results = mysqli_query($conn, $sql_results);
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
	<link rel="stylesheet" href="styles/viewstudents.css">
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

	<?php include 'header.php'?>
	<section class="head-padd all-sec-p">
		<h1 class="section-h1">Student Results</h1>

		<div class="student-search">
			<form action="" method="POST">
				<div class="frm-search">
					<input type="search" name="search" placeholder="Search Students">
					<input type="submit" value="Search">
				</div>
			</form>
		</div>

		<table class="table-teach">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Exam</th>
					<th>Subject</th>
					<th>Results</th>
					<th>Feedback</th>
					<th>Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (mysqli_num_rows($result_results) > 0) {
					while ($row_results = mysqli_fetch_assoc($result_results)) {
						$name = $row_results['name'];
						$email_result = $row_results['email'];
						$exam = $row_results['exam'];
						$subject = $row_results['subject'];
						$result = $row_results['results'];
						$feedback = $row_results['feedback'];
						$date = $row_results['publish_date'];
						$delid = $row_results['id'];

						echo "
						<tr>
							<td>$name</td>
							<td>$email_result</td>
							<td>$exam</td>
							<td>$subject</td>
							<td>$result%</td> 
							<td>$feedback</td> 
							<td>$date</td> 
							<td>
								<form method='post' enctype='multipart/form-data'>
									<input type='hidden' value='$delid' name='delete_id'>
									<input type='submit' name='delete' value='Delete' class='delete-button'>
								</form>
							</td>
						</tr>
						";
					}
					if(isset($_POST['delete'])){
						$delid = $_POST['delete_id'];
						$sqldel = "DELETE FROM results WHERE id = '$delid'";
						$result = mysqli_query($conn,$sqldel);
	
						if($result){
							echo "<script>alert('Success')</script>";
							echo "<script>window.location = 'viewresults.php';</script>";
						} else{
							echo "<script>alert('Error')</script>";
						}
					}
				}
				?>

			</tbody>
		</table>
	</section>

	<script src="../script.js"></script>
</body>

</html>