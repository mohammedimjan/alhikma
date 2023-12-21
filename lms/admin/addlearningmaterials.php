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
	<link rel="stylesheet" href="styles/editteachers.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>
	<?php include 'header.php' ?>

	<section class="head-padd edit-profile">
		<div class="r-contents-left">
			<h3>Add Learning Materials</h3>
			<form class="form-container" method="post" enctype="multipart/form-data">
				<div class="inline-2">
					<div class="in-sub">
						<label for="filename">File Name</label>
						<input type="text" id="Subjects" name="filename" placeholder="Name" required>
						<label for="description">Description</label>
						<textarea id="Subjects" name="description" placeholder="Description"
							style="height: 100px; padding:5px 5px 0 5px; resize: none;" required></textarea>
						<label for="addfile">Add File</label>
						<input type="file" id="Subjects" name="addfile"
							accept=".doc, .docx, .xls, .xlsx, .pdf, .jpg, .jpeg, .png, .gif, .txt, .csv, .zip" required>
					</div>
				</div>

				<input type="submit" value="Save" name="save">
			</form>
		</div>
	</section>

	<?php 
	if(isset($_POST['save'])){
		$filename = $_POST['filename'];
		$description = $_POST['description'];
		$addfile = $_FILES['addfile']['name'];
		$temp_name = $_FILES['addfile']['tmp_name'];
		$upload_path = "../learnmat/" . basename($addfile);
		move_uploaded_file($temp_name, $upload_path);
		$adddate = date('Y-m-d');

		$sql = "INSERT INTO learning_mat(filename,description,file,date) VALUES('$filename','$description','$addfile','$adddate')";
		$results = mysqli_query($conn,$sql);


		if($results){
			echo "<script>alert('Success')</script>";
			echo "<script>window.location = 'learningmat.php';</script>";
		} else{
			echo "<script>alert('Error')</script>";
		}
	}
	
	?>
	<script src="../script.js"></script>
</body>

</html>