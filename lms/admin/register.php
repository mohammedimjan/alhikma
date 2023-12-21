<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include necessary files and start the session
require '../../vendor/autoload.php';
include('../db.php');
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}

// Create a new instance of PHPMailer
$mail = new PHPMailer(true); // Set true to enable exceptions

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	$min = 100; // Minimum value
	$max = 1000; // Maximum value
	$randomNumber = random_int($min, $max);
    // Gather user input from the form
    $name = $_POST['fullname'];
    $address = $_POST['address'];
    $school = $_POST['school'];
    $grade = $_POST['grade'];
    $age = $_POST['age'];
    $language = $_POST['language'];
    $email = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];
    $guardian_num = $_POST['guardiancontact'];
    $password = "Alhik@".$randomNumber;
    $confpassword = $password;
    $regdate = date('Y-m-d');
    $code = 1;
    $student_image = $_FILES['student_image']['name'];
    $temp_name = $_FILES['student_image']['tmp_name'];
    $upload_path = "../studentsimage/" . basename($student_image);

    // Check if the email already exists in the database
    $check_email_query = "SELECT * FROM students_master WHERE email=?";
    $check_email_stmt = mysqli_prepare($conn, $check_email_query);
    mysqli_stmt_bind_param($check_email_stmt, "s", $email);
    mysqli_stmt_execute($check_email_stmt);
    $check_email_result = mysqli_stmt_get_result($check_email_stmt);

    // Check for existing email and password match
    if (mysqli_num_rows($check_email_result) > 0) {
        echo "<script>alert('Email already exists. Please use a different email.')</script>";
    } elseif ($password !== $confpassword) {
        echo "<script>alert('Passwords do not match. Please try again.')</script>";
    } else {
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        // Move uploaded image to the desired directory
        if (move_uploaded_file($temp_name, $upload_path)) {
            // Insert new student into the database
            $add_students_query = "INSERT INTO students_master (full_name, age, address, school, grade, lanuage, email, whatsapp, gurdiannum, password, regdate, student_image, code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $add_students_stmt = mysqli_prepare($conn, $add_students_query);
            mysqli_stmt_bind_param($add_students_stmt, "sssssssssssss", $name, $age, $address, $school, $grade, $language, $email, $whatsapp, $guardian_num, $hashpassword, $regdate, $student_image, $code);
            mysqli_stmt_execute($add_students_stmt);

            // Check if the student was added successfully
            if (mysqli_stmt_affected_rows($add_students_stmt) > 0) {
                // Get the auto-incremented student ID
                $student_id = mysqli_insert_id($conn);

                // Loop through the selected subjects
                if (isset($_POST['subjects'])) {
                    $selected_subjects = $_POST['subjects'];
                    foreach ($selected_subjects as $subject) {
                        // Insert the subject along with the student ID into the 'subjects' table
                        $add_subject_query = "INSERT INTO selected_subjects (selected_subjects, students_id) VALUES (?, ?)";
                        $add_subject_stmt = mysqli_prepare($conn, $add_subject_query);
                        mysqli_stmt_bind_param($add_subject_stmt, "si", $subject, $student_id);
                        mysqli_stmt_execute($add_subject_stmt);

                        // Check if subject insertion was successful
                        if (mysqli_stmt_affected_rows($add_subject_stmt) <= 0) {
                            echo "Error adding subject: " . mysqli_error($conn);
                        }
                    }
                }

                // Send registration confirmation email using PHPMailer
                try {
                    // Server settings
                    // ... (your email configuration)

					$mail->isSMTP();
					$mail->Host       = 'smtp.gmail.com';
					$mail->SMTPAuth   = true;
					$mail->Username   = 'alhikmaheducatinalcentre@gmail.com';
					$mail->Password   = 'mzjlbsmcyrdcjddx';
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
					$mail->Port       = 465; 

					
                    // Sender and recipient settings
                    $mail->setFrom('alhikmaheducatinalcentre@gmail.com', 'AlHikmah');
                    $mail->addAddress($email);

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Registration Confirmation';
                    $mail->Body    = '
					Dear '.$name.',
					<br>
					<br>
					Congratulations on your successful registration with AlHikmah Educational Centre LMS. Your temporary password is '.$password.'. 
					Kindly Login <b><a href="http://localhost/alhikma/lms/student/profile.php">here</a></b> to update your password. 
					<br>
					Thank you.
					<br>
					Best regards,<br>
					AlHikmah Educational Centre
					
					';

                    
                     $mail->send();
                } catch (Exception $e) {
                    echo "Mailer Error: {$mail->ErrorInfo}";
                }

                echo "<script>alert('Added successfully!')</script>";
                echo "<script>window.location = 'viewstudents.php';</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // Close prepared statements
            mysqli_stmt_close($add_students_stmt);
            mysqli_stmt_close($add_subject_stmt);
        } else {
            echo "<script>alert('Image upload failed!')</script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al Hikmah</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="./styles/register.css">
</head>

<body>
	<?php include 'header.php' ?>

	<div class="main-bg" style="margin-top: 2rem;">
		<div class="r-contents">
			<div class="r-contents-right">
				<img src="../student/Images/register-main.jpg" alt="register">
			</div>
			<div class="r-contents-left">

				<h3>Create an Account</h3>

				<form class="form-container" method="post" enctype="multipart/form-data"
					onsubmit="return validateForm();">

					<div class=" inline-2">
						<div>
							<label for="name">Full Name</label>
							<input type="text" id="name" name="fullname" placeholder="Full Name" required>

						</div>
						<div>
							<label for="address">Address</label>
							<input type="text" id="address" name="address" placeholder="Address" required>

						</div>
					</div>

					<div class="inline-2">
						<div>
							<label for="school">School</label>
							<input type="text" id="school" name="school" placeholder="School" required>

						</div>
						<div>
							<label for="grade">Grade</label>
							<select id="grade" name="grade" required>
								<?php 
								$sqlgrade ="SELECT * FROM grade";
								$resultgrade = mysqli_query($conn,$sqlgrade);
								if(mysqli_num_rows($resultgrade)>0){
									while($row=mysqli_fetch_assoc($resultgrade)){
										$grade = $row['grade'];

										echo"
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
							<input type="number" id="age" name="age" placeholder="Age" required>
						</div>

						<div>
							<label for="language">Language</label>
							<select id="language" name="language" required>
								<option value="">Select Language</option>
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
							<label for="guardian-contact">Guardian Contact Number</label>
							<input type="text" id="guardian-contact" name="guardiancontact"
								placeholder="Guardian Contact Number" required>
						</div>
						<div>
							<label for="student-image">Upload Student Image</label>
							<input type="file" id="student-image" name="student_image" accept="image/*" required>
						</div>
					</div>

					<!-- <div class="inline-2">
						<div>
							<label for="password">Password</label>
							<input type="password" id="password" name="password" placeholder="Password" required>
						</div>
						<div>
							<label for="confirm-password">Confirm Password</label>
							<input type="password" id="confirm-password" name="confirmpassword"
								placeholder="Confirm Password" required>
						</div>
					</div> -->

					<input type="submit" value="Register" name="register">
				</form>
				<!-- <p>Already have an account? <a href="login.php">Login</a></p> -->
			</div>
		</div>
	</div>

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