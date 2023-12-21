<?php

session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];


$sql = "SELECT * FROM teachers_master WHERE email = '$email'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) === 1){
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
	<link rel="stylesheet" href="styles/viewlearnmat.css">
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

	<section class="head-padd all-sec-p viewlearn-m">

		<h1 class="section-h1">Learning Materials</h1>
		<table class="table-teach">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>View</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>


				<?php 
			
			$sql = "SELECT * FROM learning_mat WHERE teacher_id ='$id'";
			$result = mysqli_query($conn,$sql);

			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					$delId = $row['id'];
					$name = $row['filename'];
					$desc = $row['description'];
					$file = $row['file'];

					echo ";
					<tr>
					<td>$name</td>
					<td>$desc</td>
					<td><a href='../learnmat/$file' class='download-button' target='_blank'>Download</a></td>
					<td>
						<form method='post' enctype='multipart/form-data'>
							<input type='hidden' value='$delId' name='delete_id'>
							<input type='submit' name='delete' value='Delete' class='delete-button'>
						</form>
					</td>
				</tr>
					";
				}

				if(isset($_POST['delete'])){
					$did = $_POST['delete_id'];
					$sqldel = "DELETE FROM learning_mat WHERE id = '$did'";
					$result = mysqli_query($conn,$sqldel);

					if($result){
						echo "<script>alert('Success')</script>";
						echo "<script>window.location = 'viewlearnmat.php';</script>";
					} else{
						echo "<script>alert('Error')</script>";
					}
				}

			}
			else {
				echo "
					<tr>
					<td>No Data</td>
					<td>No Data</td>
					<td>No Data</td>
					<td>
					No Data
					</td>
				</tr>";
			}


			?>


			</tbody>
		</table>


	</section>
	<script src="../script.js"></script>

</body>

</html>