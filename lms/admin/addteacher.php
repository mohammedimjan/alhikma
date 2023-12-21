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
	<link rel="stylesheet" href="styles/editteachers.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>
	<?php include 'header.php' ?>

	<section class="head-padd edit-profile">
		<div class="r-contents-left">
			<h3>Add Teacher</h3>
			<?php
            if (isset($_POST['save'])) {
				$regdate = date('Y-m-d');
				$name = mysqli_real_escape_string($conn, $_POST['name']);
				$address = mysqli_real_escape_string($conn, $_POST['address']);
				$age = mysqli_real_escape_string($conn, $_POST['age']);
				$teacherimage = $_FILES['teacherimage']['name'];
				$temp_name = $_FILES['teacherimage']['tmp_name'];
				$upload_path = "../uploadimages/" . basename($teacherimage);
				move_uploaded_file($temp_name, $upload_path);
				$whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp']);
				$email = mysqli_real_escape_string($conn, $_POST['email']);
				$password = mysqli_real_escape_string($conn, $_POST['password']);
				$confpassword = mysqli_real_escape_string($conn, $_POST['confpassword']);

				
                // Check if the email already exists in the database
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $emailCheckQuery = "SELECT email FROM teachers_master WHERE email = '$email'";
                $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

				$emailCheckQuery = "SELECT email FROM teachers_master WHERE email = '$email'";
				$emailCheckResult = mysqli_query($conn, $emailCheckQuery);
			
				if (mysqli_num_rows($emailCheckResult) > 0) {
					echo "<script>alert('Email address already exists. Please use a different email.')</script>";
				} else {


					if($password !== $confpassword){
						echo "<script>alert('Wrong Password')</script>";	
					} else {
					// Insert teacher information into the database

					$hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO teachers_master (regdate, name, address, age, teacherimage, whatsapp, email, password) VALUES ('$regdate', '$name', '$address', '$age', '$teacherimage', '$whatsapp', '$email', '$hashed_password')";
                    $results = mysqli_query($conn, $sql);
					}

					if ($results) {
						// Get the ID of the newly inserted teacher
						$id = mysqli_insert_id($conn);
			
						// Process selected subjects and insert them into teachers_subjects table
						if (isset($_POST['subjects']) && is_array($_POST['subjects'])) {
							foreach ($_POST['subjects'] as $subject) {
								$subjectName = mysqli_real_escape_string($conn, $subject);
								$subjectsql = "INSERT INTO teachers_subjects (teachers_id, subjects) VALUES ('$id', '$subjectName')";
								$subjectResult = mysqli_query($conn, $subjectsql);
							}
						}
			
						echo "<script>alert('Teacher and subjects added successfully.')</script>";
					} else {
						echo "<script>alert('Error')</script>";
					}
                }
            }
            ?>
			<form class="form-container" enctype="multipart/form-data" method="post" onsubmit="return validateForm();">
				<div class="inline-2">
					<div>
						<label for="name">Name *</label>
						<input type="text" id="name" name="name" placeholder="Name" required>
					</div>
					<div>
						<label for="address">Address</label>
						<input type="text" id="address" name="address" placeholder="Address" required>
					</div>
				</div>

				<div class="inline-2">
					<div>
						<label for="age">Age</label>
						<input type="number" id="age" name="age" placeholder="Age" required>
					</div>
					<div>
						<label for="teacher-image">Upload Teacher Image</label>
						<input type="file" id="teacher-image" name="teacherimage" accept="image/*" required>
					</div>
				</div>

				<label for="subjects">Subjects</label>
				<div class="subject-checkboxes">
					<?php
                    $sql = "SELECT * FROM subjects";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $subjectName = $row['subject'];
                        echo '<div>';
                        echo '<input type="checkbox" id="' . $subjectName . '" name="subjects[]" value="' . $subjectName . '">';
                        echo '<label for="' . $subjectName . '">' . $subjectName . '</label>';
                        echo '</div>';
                    }
                    ?>
				</div>

				<div class="inline-2">
					<div>
						<label for="email">Email</label>
						<input type="email" id="email" name="email" placeholder="Email" required>
					</div>
					<div>
						<label for="whatsapp">WhatsApp Number</label>
						<input type="text" id="whatsapp" name="whatsapp" placeholder="WhatsApp Number" required>
					</div>
				</div>
				<div class="inline-2">
					<div>
						<label for="password">Password</label>
						<input type="password" id="password" name="password" placeholder="password" required>
					</div>
					<div>
						<label for="confpassword">Confirm Password</label>
						<input type="password" id="confpassword" name="confpassword" placeholder="Confirm Password"
							required>
					</div>
				</div>

				<input type="submit" value="Save" name="save">
			</form>
		</div>
	</section>

	<script src="../script.js"></script>
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

</html>