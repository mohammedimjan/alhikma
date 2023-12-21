<?php

session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');

$id = $_GET['id'];


$sql = "SELECT * FROM students_master WHERE student_id = '$id'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) === 1){
	$row = mysqli_fetch_assoc($result);

	$name = $row['full_name'];
	$id = $row['student_id'];
	$age = $row['age'];
	$address = $row['address'];
	$language = $row['lanuage'];
	$grade = $row['grade'];
	$school = $row['school'];
	$email = $row['email'];
	$whatsapp = $row['whatsapp'];
	$gaurdiannum = $row['gurdiannum'];
	$image = $row['student_image'];
}

$sqlsub = "SELECT * FROM selected_subjects WHERE students_id = '$id'";
$resultsub = mysqli_query($conn,$sqlsub);

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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Al Hikmah</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="styles/studentsprofile.css">
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

	<section class="head-padd profile-con">
		<div class="profile">
			<h1>Profile</h1>
			<?php
            if (empty($image)) {
                echo "<img src='../assets/noimg.jpg' alt='noimg'>";
            } else {
                echo "<img src='../studentsimage/$image' alt='noimg'>";
            }
            ?>
			<div class="profile-table">
				<table id="profile">
					<?php 

					?>
					<tr>
						<th>Name:</th>
						<td><?php echo htmlspecialchars($name); ?></td>
					</tr>
					<tr>
						<th>Student Id:</th>
						<td><?php echo htmlspecialchars($id); ?></td>
					</tr>
					<tr>
						<th>Age:</th>
						<td><?php echo htmlspecialchars($age); ?></td>
					</tr>
					<tr>
						<th>Language:</th>
						<td><?php echo htmlspecialchars($language); ?></td>
					</tr>
					<tr>
						<th>Address:</th>
						<td><?php echo htmlspecialchars($address); ?></td>
					</tr>
					<tr>
						<th>School:</th>
						<td><?php echo htmlspecialchars($school); ?></td>
					</tr>
					<tr>
						<th>Grade:</th>
						<td><?php echo htmlspecialchars($grade); ?></td>
					</tr>
					<tr>
						<th>Selected Subjects:</th>
						<td>
							<?php
                            if (!empty($subjects)) {
                                echo implode('<br>', $subjects);
                            } else {
                                echo "No subjects found";
                            }
                        ?>
						</td>
					</tr>
					<tr>
						<th>Email:</th>
						<td><?php echo htmlspecialchars($email); ?></td>
					</tr>
					<tr>
						<th>WhatsApp Number:</th>
						<td><?php echo htmlspecialchars($whatsapp); ?></td>
					</tr>
					<tr>
						<th>Guardian Contact Number:</th>
						<td>Guardian Contact Number<?php echo htmlspecialchars($gaurdiannum); ?>

				</table>
			</div>
		</div>
	</section>

	<script src="../script.js"></script>

</body>

</html>