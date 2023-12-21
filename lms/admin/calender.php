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
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>
	<?php include 'header.php' ?>


	<section class="head-padd calender">

		<h1 class="section-h1">Calender</h1>

		<div class="add-lm-btn"><a href="editcalender.php" class="download-button">Add EVENTS</a>
		</div>

		<table class="table-admin">
			<thead>
				<tr>
					<th>Year</th>
					<th>Month</th>
					<th>Date</th>
					<th>Event</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				
				$sql = "SELECT * FROM calendar";
				$results = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($results)>0){
					while($row = mysqli_fetch_assoc($results)){
						$id = $row['id'];
						echo"
						<tr>
							<td>{$row['day']}</td>
							<td>{$row['month']}</td>
							<td>{$row['year']}</td>
							<td>{$row['events']}</td>
							<td>
								<form method='post' enctype='multipart/form-data'>
									<input type='submit'  class='delete-button' value='DELETE' name='delete'>
								</form>		
							</td>
						</tr>
						";	
					} 

					if(isset($_POST['delete'])){
						try{
							$sql = "DELETE FROM calendar WHERE id = $id";
							$results = mysqli_query($conn,$sql);
	
							if($results){
								echo "<script>alert('success')</script>";
								echo "<script>window.location = 'calender.php';</script>";
							} else {
								echo "<script>alert('Error')</script>";
							}
					} 
					catch (Exception $e){
						echo "<script>alert(Error: '.$e.')</script>";
					}
					// finally{
					// 	header("Location: calender.php");
					// }
				} else if(mysqli_num_rows($results)== 0){

						
						echo "
						<tr>
						<td>No Data</td>
						<td>No Data</td>
						<td>No Data</td>
						<td>No Data</td>
						<td>
						No Data	
						</td>
					</tr>
						";

				}



				}

				?>

				<?php 
				// if(isset($_POST['delete'])){

				// 	$sql = "DELETE FROM 'calendar' WHERE";
				// 	$results = 
				// }
				?>

				<!-- <tr>
					<td>2002</td>
					<td>Jan</td>
					<td>20</td>
					<td>Saniyan Ondu porantha Day</td>
					<button class="download-button" name="delete">Delete</button>
					<td><a href="studentprofile.php" class="download-button">Delete</a></td>
				</tr>
				<tr>
					<td>2002</td>
					<td>Jan</td>
					<td>20</td>
					<td>Saniyan Ondu porantha Day</td>
					<td><a href="studentprofile.php" class="download-button">Delete</a></td>
				</tr>
				<tr>
					<td>2002</td>
					<td>Jan</td>
					<td>20</td>
					<td>Saniyan Ondu porantha Day</td>
					<td><a href="studentprofile.php" class="download-button">Delete</a></td>
				</tr> -->
			</tbody>
		</table>
	</section>


	<script src="../script.js"></script>

</body>

</html>