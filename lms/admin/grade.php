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
	<link rel="stylesheet" href="../admin/styles/register.css">
	<link rel="stylesheet" href="styles/viewstudents.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>

	<?php include 'header.php' ?>

	<section class="head-padd all-sec-p">
		<h1 class="section-h1">Classes</h1>
		<table class="table-admin">
			<div class="grade">
				<?php 
				if(isset($_POST['add'])){
					$grade = $_POST['grade'];
					$sqladd = "INSERT INTO grade(grade) VALUES('$grade')";
					$resultadd = mysqli_query($conn,$sqladd);

					if($resultadd){
						echo "<script>window.location = 'grade.php';</script>";
					} else{
						echo "<script>alert('Error')</script>";
					}
				}

				?>
				<form action="" enctype="multipart/form-data" method="post">
					<div class="inline-2 grade-sec">
						<div>
							<input type="text" id="name" name="grade" placeholder="Ex: Grade 1" required>

						</div>
						<div>
							<input type="submit" id="address" name="add" value="Add Class" required>
						</div>
					</div>
				</form>
			</div>

			<thead>
				<tr>
					<th>Id</th>
					<th>Grade</th>
					<th>Delete</th>
				</tr>
			</thead>

			<tbody>
				<?php 
			$sql = "SELECT * FROM grade";
			$result = mysqli_query($conn,$sql);

			if(mysqli_num_rows($result)>0){
				while($row=mysqli_fetch_assoc($result)){
					$grade = $row['grade'];
					$id = $row['id'];
					
					echo"
					<tr>
					<td>$id</td>
					<td>$grade</td>
					<td>
					<form method='post' enctype='multipart/form-data'>
						<input type='hidden' name='deleteid' value='$id'>
						<input type='submit' style='background-color:red;' name='delete' value='Delete' class='delete-button'>
					</form>
				</td>
				</tr>
					";
				}

				if(isset($_POST['delete'])){
					$delid = $_POST['deleteid'];

					$sqldel = "DELETE FROM grade WHERE id ='$delid'";
					$resultdel = mysqli_query($conn,$sqldel);

					if($resultdel){
						echo "<script>window.location = 'grade.php';</script>";
					} else {
						echo "<script>alert('Su')</script>";
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