<?php 


session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
	header("Location: login.php");
	die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];


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
	<link rel="stylesheet" href="./other styles/index.css">
	<link rel="stylesheet" href="other styles/learningmaterials.css">
	<link href="assets/css/bootstrap.min.css">
</head>

<body>

	<?php include 'header.php' ?>


	<section class="learning-main head-padd">

		<h1>Learning Materials</h1>
		<table class="table table-dark table-sm download-table">
			<thead>
				<tr>
					<th>Date</th>
					<th>Name</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>File 1</td>
					<td>File 1</td>
					<td>File 1</td>
					<td><a href='' class='download-button'>Download</a></td>
				</tr>
				<?php 
				
				$sql = "SELECT * FROM learning_mat";
				$result = mysqli_query($conn,$sql);

				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
						$date = $row['date'];
						$name = $row['filename'];
						$description = $row['description'];
						$file = $row['file'];

						echo "
						<tr>
						<td>$date</td>
						<td>$name</td>
						<td>$description</td>
						<td><a href='../learnmat/$file' class='download-button' target='_blank'>Download</a></td>
						</tr>
						";
					}
				}

				?>

			</tbody>
		</table>


	</section>

	<script src="../script.js"></script>
</body>

</html>