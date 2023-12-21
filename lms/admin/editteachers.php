<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
header("Location: login.php");
die();
}
include('../db.php');
$id = $_GET['id'];


$sql = "SELECT * FROM teachers_master WHERE id ='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_assoc($result);

	$name = $row['name'];
	$address = $row['address'];
	$age = $row['age'];
	$whatsapp = $row['whatsapp'];
	$email = $row['email'];
}

$sqlsub = "SELECT * FROM teachers_subjects WHERE teachers_id = '$id'";
$resultsub = mysqli_query($conn, $sqlsub);

$subjects = array();

if ($resultsub && mysqli_num_rows($resultsub) > 0) {
	while ($row = mysqli_fetch_assoc($resultsub)) {
		$subjects[] = htmlspecialchars($row['subjects']);
	}
}


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
			<h3>Edit Teacher</h3>

			<form class="form-container" enctype="multipart/form-data" method="post" onsubmit="return validateForm();">
				<div class="inline-2">
					<div>
						<label for="name">Name</label>
						<input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"
							placeholder="Name" required>
					</div>
					<div>
						<label for="address">Address</label>
						<input type="text" id="address" name="address" placeholder="Address"
							value="<?php echo htmlspecialchars($address); ?>" required>
					</div>
				</div>

				<div class="inline-2">
					<div>
						<label for="age">Age</label>
						<input type="number" id="age" name="age" placeholder="Age"
							value="<?php echo htmlspecialchars($age); ?>" required>
					</div>
					<div>
						<label for="teacher-image">Upload Teacher Image</label>
						<input type="file" disabled="teacher-image" name="teacherimage" accept="image/*" required>
					</div>
				</div>

				<label for="subjects">Subjects</label>
				<div class="subject-checkboxes">
					<?php
					$sql = "SELECT * FROM subjects";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						$subjectName = $row['subject'];
						$checked = in_array(strtolower($subjectName), array_map('strtolower', $subjects)) ? 'checked' : ''; // Check if the subject is in the $subjects array
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
						<input type="email" id="email" name="email" placeholder="Email"
							value="<?php echo htmlspecialchars($email); ?>" disabled required>
					</div>
					<div>
						<label for="whatsapp">WhatsApp Number</label>
						<input type="text" id="whatsapp" name="whatsapp" placeholder="WhatsApp Number"
							value="<?php echo htmlspecialchars($whatsapp); ?>" required>
					</div>
				</div>
				<div class="inline-2">
					<a href='teacherchangepassword.php?id=$id' class='download-button'>Change Password</a>
				</div>

				<input type="submit" value="Update" name="update" style="padding: 0.8rem 0.5rem !important;">

			</form>

			<?php
			if (isset($_POST['update'])) {
				$edited_name = $_POST['name'];
				$edited_address = $_POST['address'];
				$edited_age = $_POST['age'];
				$edited_whatsapp = $_POST['whatsapp'];

				$sql = "UPDATE teachers_master SET name='$edited_name', address ='$edited_address', age = '$edited_age', whatsapp = '$edited_whatsapp' WHERE id = '$id'";
				$result = mysqli_query($conn, $sql);

				if ($result) {
					$deletesql = "DELETE FROM teachers_subjects WHERE teachers_id = '$id'";
					$delresult = mysqli_query($conn, $deletesql);

					if ($delresult) {
						if (isset($_POST['subjects'])) {
							$selected_subjects = $_POST['subjects'];
							foreach ($selected_subjects as $subject) {
								$sqlsub = "INSERT INTO teachers_subjects(teachers_id, subjects) VALUES('$id', '$subject')";
								$resultsub = mysqli_query($conn, $sqlsub);

								if (!$resultsub) {
									echo "Error adding subject: " . mysqli_error($conn);
								}
							}
						}
						echo "<script>alert('Updated successfully!')</script>";
						echo "<script>window.location = 'editteachers.php?id=$id';</script>";
					}
				}
			}
			?>
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