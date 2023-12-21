<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
	header("Location: login.php");
	die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];

$sql = "SELECT * FROM teachers_master WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
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
	<link rel="stylesheet" href="styles/index.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>


	<?php include 'header.php' ?>

	<section class="manage-l-m head-padd">
		<div class="container">
			<div class="all-forms">

				<form method="post" enctype="multipart/form-data" class="nml-form">
					<h1>Add Results</h1>
					<label for="selectstudent">Select Student Gmail</label>
					<select name="selectstudent">
						<option selected disabled>Student</option>
						<?php
						$sqlstudents = "SELECT * FROM students_master";
						$resultsstudents = mysqli_query($conn, $sqlstudents);

						if (mysqli_num_rows($resultsstudents) > 0) {
							while ($row = mysqli_fetch_assoc($resultsstudents)) {
								$studentsgmail = $row['email'];
								echo "
								<option value='$studentsgmail'>$studentsgmail</option>
								";
							}
						}

						?>
					</select>
					<label for="selectexam">Select Exam</label>
					<select name="selectexam">
						<option selected disabled>Exam</option>
						<?php
						$sqlexam = "SELECT * FROM exams WHERE teachers_id ='$id'";
						$resultexam = mysqli_query($conn, $sqlexam);

						if (mysqli_num_rows($resultexam) > 0) {
							while ($row = mysqli_fetch_assoc($resultexam)) {
								$examid = $row['id'];
								$examname = $row['name'];
								echo "
								<option value='$examid'>$examname</option>
								";
							}
						}

						?>
					</select>
					<label for=" Results">Results</label>
					<input type="number" placeholder="Results" min="0" max="100" name="results" required>
					<label for="Feedback">Feedback</label>
					<input type="text" placeholder="Feedback" name="feedback" required>
					<input type="submit" name="add" value="Add Results">
				</form>

				<?php
				if (isset($_POST['add'])) {
					$email = $_POST['selectstudent'];

					$sqlgetstudents = "SELECT * FROM students_master WHERE email ='$email'";
					$sqlgetstudentsres = mysqli_query($conn, $sqlgetstudents);

					if ($sqlgetstudentsres) {
						if (mysqli_num_rows($sqlgetstudentsres) === 1) {
							$row = mysqli_fetch_assoc($sqlgetstudentsres);
							$stud_id = $row['student_id'];
							$student_name = $row['full_name'];
							$student_grade = $row['grade'];

							$examid = $_POST['selectexam'];

							$sqlgetexam = "SELECT * FROM exams WHERE id ='$examid'";
							$sqlgetexamres = mysqli_query($conn, $sqlgetexam);

							if ($sqlgetexamres) {
								if (mysqli_num_rows($sqlgetexamres) === 1) {
									$row = mysqli_fetch_assoc($sqlgetexamres);
									$exam_name = $row['name'];
									$subject = $row['subject'];

									$results = $_POST['results'];
									$feedback = $_POST['feedback'];
									$current_date = date('Y-m-d');

									$sql = "INSERT INTO results(name,email,students_id,results,feedback,subject,grade,exam,teachers_id,publish_date) VALUES('$student_name','$email','$stud_id','$results','$feedback','$subject','$student_grade','$exam_name','$id','$current_date')";
									$result = mysqli_query($conn, $sql);

									if ($result) {
										echo "<script>alert('Success')</script>";
										echo "<script>window.location = 'results.php';</script>";
									} else {
										echo "<script>alert('Error inserting into results table: " . mysqli_error($conn) . "')</script>";
									}
								} else {
									echo "<script>alert('Error: No matching exam found')</script>";
								}
							} else {
								echo "<script>alert('Error retrieving exam information: " . mysqli_error($conn) . "')</script>";
							}
						} else {
							echo "<script>alert('Error: No matching student found')</script>";
						}
					} else {
						echo "<script>alert('Error retrieving student information: " . mysqli_error($conn) . "')</script>";
					}
				}


				?>
			</div>
		</div>
	</section>

	<script src="../script.js"></script>

</body>

</html>