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
	<link rel="stylesheet" href="styles/index.css">
	<link rel="stylesheet" href="styles/style.css">
</head>

<body>
	<?php include 'header.php' ?>

	<section class="head-padd all-sec-p viewlearn-m">
		<h1 class="section-h1">Learning Materials</h1>
		<div class="add-lm-btn"><a href="addlearningmaterials.php" class="download-button">Add Materials</a>
		</div>
		<table class="table-admin">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>View</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
                // Retrieve learning materials from the database.
                $sql = "SELECT * FROM learning_mat";
                $results = mysqli_query($conn, $sql);

                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        $id = $row['id'];
                        $filename = $row['filename'];
                        $description = $row['description'];
                        $file = $row['file'];

                        echo "<tr>
                                <td>$filename</td>
                                <td>$description</td>
                                <td>	
                                    <a href='../learnmat/$file' target='_blank' class='download-button'>Download</a>
                                </td>
                                <td>
                                    <form method='post' enctype='multipart/form-data'>
                                        <input type='hidden' name='deleteid' value='$id'>
                                        <input type='submit' style='background-color:red;' name='delete' value='Delete' class='delete-button'>
                                    </form>
                                </td>
                              </tr>";
                    }
                }

				// Check if the 'delete' form has been submitted.
					if (isset($_POST['delete'])) {
					    // Get the ID to delete from the form.
					    $id = $_POST['deleteid'];
					
					    // Create and execute the SQL query to delete the learning material.
					    $sql = "DELETE FROM learning_mat WHERE id = $id";
					    $results = mysqli_query($conn, $sql);
					
					    // Check if the deletion was successful and show an alert.
					    if ($results) {
					        echo "<script>alert('Deleted successfully')</script>";
							echo "<script>window.location = 'learningmat.php';</script>";
					    } else {
					        echo "<script>alert('Error')</script>";
					    }
					}
                ?>
			</tbody>
		</table>
	</section>
	<script src="../script.js"></script>
</body>

</html>