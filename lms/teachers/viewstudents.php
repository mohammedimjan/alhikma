<?php

session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');

// Check if the search form has been submitted
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM students_master WHERE full_name LIKE '%$search%' OR email LIKE '%$search%'";
} else {
    // If the search form is not submitted, retrieve all records
    $sql = "SELECT * FROM students_master";
}

$result = mysqli_query($conn, $sql);

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
		<h1 class="section-h1">Student Details</h1>

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
					<th>email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['full_name'];
                        $id = $row['student_id'];
                        $email = $row['email'];
                        echo "<tr>
                            <td>$name</td>
                            <td>$email</td>
							<td><a href='studentprofile.php?id=$id' class='download-button'>View More</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr>
                        <td colspan='3'>No students found</td>
                    </tr>";
                }
                ?>
			</tbody>
		</table>
	</section>

	<script src="../script.js"></script>
</body>

</html>