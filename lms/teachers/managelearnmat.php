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
	<link rel="stylesheet" href="styles/managelearnmat.css">
	<link rel="stylesheet" href="../teachers/styles/style.css">
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

	<section class="manage-l-m head-padd">
		<div class="container">
			<div class="all-forms">

				<form method="post" enctype="multipart/form-data" class="nml-form">
					<h1>Add Resource</h1>
					<label for="name-of-resource">Name of Resource</label>
					<input type="text" placeholder="Name" name="filename" required>
					<label for="description">Description</label>
					<textarea id="Subjects" name="description" placeholder="Description"
						style="height: 100px; padding:5px 5px 0 5px; resize: none;" required></textarea>
					<label for="resource-file">Upload Resource File</label>
					<input type="file" id="student-image" name="addfile" required>
					<input type="submit" value="Add Resource" name="addlearnmat">
				</form>
			</div>
		</div>
		<?php 
		if(isset($_POST['addlearnmat'])){
			$filename = $_POST['filename'];
			$description = $_POST['description'];
			$addfile = $_FILES['addfile']['name'];
			$temp_name = $_FILES['addfile']['tmp_name'];
			$upload_path = "../learnmat/" . basename($addfile);
			move_uploaded_file($temp_name, $upload_path);
			$adddate = date('Y-m-d');

			
		$sql = "INSERT INTO learning_mat(filename,description,file,teacher_id,date) VALUES('$filename','$description','$addfile','$id','$adddate')";
		$results = mysqli_query($conn,$sql);


		if($results){
			echo "<script>alert('Success')</script>";
			echo "<script>window.location = 'managelearnmat.php';</script>";
		} else{
			echo "<script>alert('Error')</script>";
		}
		}
		?>
	</section>


	<script src="../script.js"></script>

</body>

</html>