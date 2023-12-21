<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
header("Location: login.php");
die();
}
include('../db.php');

$id = $_GET['id'];


$sql = "SELECT * FROM students_master WHERE student_id = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_assoc($result);

	$name = $row['full_name'];
	$age = $row['age'];
	$address = $row['address'];
	$grade = $row['grade'];
	$lanuage = $row['lanuage'];
	$school = $row['school'];
	$email = $row['email'];
	$whatsapp = $row['whatsapp'];
	$gaurdiannum = $row['gurdiannum'];
	$image = $row['student_image'];
}

$sqlsub = "SELECT * FROM selected_subjects WHERE students_id = '$id'";
$resultsub = mysqli_query($conn, $sqlsub);

$subjects = array();

if ($resultsub && mysqli_num_rows($resultsub) > 0) {
	while ($row = mysqli_fetch_assoc($resultsub)) {
		$subjects[] = htmlspecialchars($row['selected_subjects']);
	}
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al Hikmah</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="./styles/register.css">
</head>

<body>
	<div class="main-bg">
		<div class="r-contents">
			<div class="r-contents-right">
				<img src="../student/Images/register-main.jpg" alt="register">
			</div>
			<div class="r-contents-left">

				<h3>Update Students Profile</h3>

				<form class="form-container" method="post" enctype="multipart/form-data"
					onsubmit="return validateForm();">

					<div class=" inline-2">
						<div>
							<label for="name">Full Name</label>
							<input type="text" id="name" name="fullname" value="<?php echo htmlspecialchars($name); ?>"
								placeholder="Full Name" required>

						</div>
						<div>
							<label for="address">Address</label>
							<input type="text" id="address" name="address"
								value="<?php echo htmlspecialchars($address); ?>" placeholder="Address" required>

						</div>
					</div>

					<div class="inline-2">
						<div>
							<label for="school">School</label>
							<input type="text" id="school" name="school"
								value="<?php echo htmlspecialchars($school); ?>" placeholder="School" required>

						</div>
						<div>
							<label for="grade">Grade</label>
							<select id="grade" name="grade" required>
								<option selected disabled value='<?php $grade ?>'>
									<?php echo htmlspecialchars($grade); ?>
								</option>
								<?php
								$sqlgrade = "SELECT * FROM grade";
								$resultgrade = mysqli_query($conn, $sqlgrade);
								if (mysqli_num_rows($resultgrade) > 0) {
									while ($row = mysqli_fetch_assoc($resultgrade)) {
										$grade = $row['grade'];

										echo "
										<option value='$grade'>$grade</option>
										";
									}
								}
								?>
							</select>
						</div>
					</div>

					<div class="inline-2">
						<div>
							<label for="age">Age</label>
							<input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>"
								placeholder="Age" required>
						</div>

						<div>
							<label for="language">Language</label>
							<select id="language" name="language" required>
								<option value='<?php $school ?>' selected disabled>
									<?php echo htmlspecialchars($lanuage); ?></option>
								<option value="English">English</option>
								<option value="Tamil">Sinhala</option>
								<option value="Tamil">Tamil</option>
							</select>
						</div>
					</div>

					<label for="subjects">Selected Subjects</label>
					<div class="subject-checkboxes">
						<?php
						$sql = "SELECT * FROM subjects";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							$subjectName = $row['subject'];
							$checked = in_array($subjectName, $subjects) ? 'checked' : ''; // Check if the subject is in the $subjects array
							echo '<div>';
							echo '<input type="checkbox" id="' . $subjectName . '" name="subjects[]" value="' . $subjectName . '" ' . $checked . '>';
							echo '<label for="' . $subjectName . '">' . $subjectName . '</label>';
							echo '</div>';
						}
						?>
					</div>

					<div class="inline-2">
						<div>
							<label for="email">Email</label>
							<input type="email" disabled id="email" name="email"
								value="<?php echo htmlspecialchars($email); ?>" placeholder="Email" required>

						</div>
						<div>
							<label for="whatsapp">WhatsApp Number</label>
							<input type="text" id="whatsapp" name="whatsapp"
								value="<?php echo htmlspecialchars($whatsapp); ?>" placeholder="WhatsApp Number"
								required>
						</div>
					</div>
					<div class="inline-2">
						<div>
							<label for="guardian-contact">Guardian Contact Number</label>
							<input type="text" id="guardian-contact" name="guardiancontact"
								placeholder="Guardian Contact Number"
								value="<?php echo htmlspecialchars($gaurdiannum); ?>" required>
						</div>
						<div>
							<label for="student-image">Upload Student Image</label>
							<input type="file" id="student-image" disabled
								value="<?php echo htmlspecialchars($image); ?>" name="student_image" accept="image/*"
								required>
						</div>
					</div>



					<input type="submit" value="Update" name="update">
				</form>

				<?php

				if (isset($_POST['update'])) {
					// Update student's general information
					$edited_name = mysqli_real_escape_string($conn, $_POST['fullname']);
					$edited_age = mysqli_real_escape_string($conn, $_POST['age']);
					$edited_address = mysqli_real_escape_string($conn, $_POST['address']);
					$edited_grade = mysqli_real_escape_string($conn, $_POST['grade']);
					$edited_language = mysqli_real_escape_string($conn, $_POST['language']);
					$edited_school = mysqli_real_escape_string($conn, $_POST['school']);
					$edited_whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp']);
					$edited_guardian_num = mysqli_real_escape_string($conn, $_POST['guardiancontact']);

					$updatesql = "UPDATE students_master SET full_name='$edited_name', age='$edited_age', address='$edited_address',
    school='$edited_school', grade='$edited_grade', lanuage='$edited_language', whatsapp='$edited_whatsapp', gurdiannum='$edited_guardian_num' WHERE student_id ='$id'";

					$updateres = mysqli_query($conn, $updatesql);

					if ($updateres) {
						// Delete existing subjects for the student
						$deletesql = "DELETE FROM selected_subjects WHERE students_id = '$id'";
						$deleteres = mysqli_query($conn, $deletesql);

						if ($deleteres) {
							// Insert newly selected subjects
							if (isset($_POST['subjects'])) {
								$selected_subjects = $_POST['subjects'];
								foreach ($selected_subjects as $subject) {
									// Insert the subject along with the student ID into the 'selected_subjects' table
									$add_subject_query = "INSERT INTO selected_subjects (selected_subjects, students_id) VALUES ('$subject','$id')";
									$subject_result = mysqli_query($conn, $add_subject_query);

									if (!$subject_result) {
										echo "Error adding subject: " . mysqli_error($conn);
									}
									echo "<script>alert('Updated successfully!')</script>";
									echo "<script>window.location = 'editstudents.php?id=$id';</script>";
								}
							}
						} else {
							echo "Error deleting existing subjects: " . mysqli_error($conn);
						}
					} else {
						echo "Error updating student information: " . mysqli_error($conn);
					}
				}
				?>
				<!-- <p>Already have an account? <a href="login.php">Login</a></p> -->
			</div>
		</div>
	</div>

	<script>
	function validateForm() {
		var checkboxes = document.getElementsByName('subjects[]');
		var isChecked = false;
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				isChecked = true;
				break;
			}
		}
		if (!isChecked) {
			alert('Select at least one subject');
			return false;
		}
		return true;
	}
	</script>
</body>


</html> i