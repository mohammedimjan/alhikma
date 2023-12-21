<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];

include('../db.php');

$sql = "SELECT * FROM teachers_master WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $id = $row['id'];
    $age = $row['age'];
    $address = $row['address'];
    $email = $row['email'];
    $whatsapp = $row['whatsapp'];
    $image = $row['teacherimage'];


} else {
    $name = "Unknown";
}

// Fetch the teacher's subjects
$sql = "SELECT * FROM teachers_subjects WHERE teachers_id = '$id'";
$results = mysqli_query($conn, $sql);
$subjects = array();

if ($results && mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
        $subjects[] = htmlspecialchars($row['subjects']);
    }
}

// Close the database connection
mysqli_close($conn);
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
	<link rel="stylesheet" href="styles/profile.css">
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
	<section class="head-padd profile-con">
		<div class="profile">
			<h1>Profile</h1>
			<?php
            if (empty($image)) {
                echo "<img src='../assets/noimg.jpg' alt='noimg'>";
            } else {
                echo "<img src='../uploadimages/$image' alt='noimg'>";
            }
            ?>

			<div class="profile-table">
				<table id="profile">
					<tr>
						<th>Name:</th>
						<td><?php echo htmlspecialchars($name); ?></td>
					</tr>
					<tr>
						<th>Teacher Id:</th>
						<td><?php echo htmlspecialchars($id); ?></td>
					</tr>
					<tr>
						<th>Age:</th>
						<td><?php echo htmlspecialchars($age); ?></td>
					</tr>
					<tr>
						<th>Address:</th>
						<td><?php echo htmlspecialchars($address); ?></td>
					</tr>
					<tr>
						<th>Subjects:</th>
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
						<th>Number:</th>
						<td><?php echo htmlspecialchars($whatsapp); ?></td>
					</tr>

				</table>

			</div>
		</div>
	</section>

	<script src="../script.js"></script>
</body>

</html>