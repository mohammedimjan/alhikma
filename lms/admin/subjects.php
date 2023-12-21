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
		<h1 class="section-h1">Subjects</h1>
		<div class="add-lm-btn"><a href="addsubjects.php" class="download-button">Add
				Subjects</a>
			<table class="table-admin" style="margin-top: 1rem;">
				<thead>
					<tr>
						<th>Subject ID</th>
						<th>Subject</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
				$sql = "SELECT * FROM subjects";
				$results = mysqli_query($conn, $sql);

				if (mysqli_num_rows($results) > 0) {
					while ($row = mysqli_fetch_assoc($results)) {
						$id = $row['id'];
						echo "
						<tr>
							<td>{$row['id']}</td>
							<td>{$row['subject']}</td>
							<td>
								<form method='post' enctype='multipart/form-data'>
								<input type='hidden' value='$id' name='delid'>
									<input type='submit' class='delete-button' style='background-color:red;' name='delete' value='Delete'>
								</form>		
							</td>
						</tr>
						";
					}
				} else {
					echo "
					<tr>
						<td>No Data</td>
						<td>No Data</td>
						<td>
							No Data	
						</td>
					</tr>
					";
				}
				?>
				</tbody>
			</table>

			<?php
		if (isset($_POST['delete'])) {
			$delid = $_POST['delid'];
			$sql = "DELETE FROM subjects WHERE id = $delid";
			$results = mysqli_query($conn, $sql);

			if ($results) {
				echo "<script>alert('Deleted')</script>";
				echo "<script>window.location = 'subjects.php';</script>";
				
			} else {
				echo "<script>alert('Error')</script>";
			}
		}

		?>




	</section>


	<script src="../script.js"></script>

</body>

</html>