<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
header("Location: login.php");
die();
}
include('../db.php');
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
	<link rel="stylesheet" href="styles/viewstudents.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>
	<?php include 'header.php' ?>

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

		<table class="table-admin">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
					<th></th>
					<th>View</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
                if (isset($_POST['search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql = "SELECT * FROM students_master WHERE full_name LIKE '%$search%'";
                } else {
                    $sql = "SELECT * FROM students_master";
                }

                $results = mysqli_query($conn, $sql);

                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        $id = $row['student_id'];
                        $code = $row['code'];

                        if ($code == 1) {
                            $sts = "Deactive";
                            $color = "delete-button";

                            $status = "Active";
                            $statuscolor = "green";
                        } else if ($code == 0) {
                            $sts = "Active";
                            $color = "active-button";

                            $status = "Deactive";
                            $statuscolor = "red";
                        }

                        echo "
                        <tr>
                            <td>{$row['full_name']}</td>
                            <td>{$row['email']}</td>
                            <td style='color:$statuscolor'>$status</td>
                            <td>
                                <form method='post' enctype='multipart/form-data'>
                                    <input type='hidden' name='up_id' value='$id'>
                                    <input type='hidden' name='code' value='$code'>
                                    <input type='submit' name='status' value='$sts' class='$color'>
                                </form>
                            </td>
                            <td><a href='studentprofile.php?id=$id' class='download-button'>View Profile</a></td>
                            <td><a href='editstudents.php?id=$id' class='download-button'>Edit Profile</a></td>
                            <td>
                                <form method='post' enctype='multipart/form-data'>
                                    <input type='hidden' name='delete_id' value='$id'>
                                    <input type='submit' style='background-color:red;' name='delete' value='Delete' class='delete-button'>
                                </form>
                            </td>
                        </tr>";
                    }

                    if (isset($_POST['delete'])) {
                        $deleteid = $_POST['delete_id'];
                        $sql = "DELETE FROM students_master WHERE student_id = $deleteid";
                        $deleteresults = mysqli_query($conn, $sql);

                        if ($deleteresults) {
                            echo "<script>alert('Student deleted successfully')</script>";
                            echo "<script>window.location = 'viewstudents.php';</script>";
                        }
                    }

                    if (isset($_POST['status'])) {
                        $upid = $_POST['up_id'];
                        $code = $_POST['code'];

                        if ($code == 1) {
                            $upcode = 0;
                        } else if ($code == 0) {
                            $upcode = 1;
                        }
                        $sql = "UPDATE students_master SET code = $upcode WHERE student_id = $upid";
                        $upresults = mysqli_query($conn, $sql);

                        if ($upresults) {
                            echo "<script>alert('Student Status Updated successfully')</script>";
                            echo "<script>window.location = 'viewstudents.php';</script>";
                        } else {
                            echo "<script>alert('Error while updating Status')</script>";
                        }
                    }
                } else {
                    echo "
                    <tr>
                        <td colspan='5'>No Data</td>
                    </tr>";
                }
                ?>
			</tbody>
		</table>
	</section>
	<script src="../script.js"></script>
</body>

</html>