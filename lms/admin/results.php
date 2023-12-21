<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
header("Location: login.php");
die();
}
include('../db.php');

// Initialize search variable
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

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
		<h1 class="section-h1">Check Results</h1>
		<table class="table-admin">
			<div class="student-search">
				<form action="" method="GET">
					<div class="frm-search">
						<input type="search" name="search" placeholder="Check Result"
							value="<?= htmlspecialchars($searchTerm) ?>">
						<input type="submit" value="Search">
					</div>
				</form>
			</div>


			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Student Id</th>
					<th>Exam</th>
					<th>Subject Name</th>
					<th>Results</th>
					<th>Feedback</th>
					<th>Teachers Name</th>
					<th>Published Date</th>
					<th>Report</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>

				<?php
                $sql = "SELECT results.*, teachers_master.name AS teachers_name
                        FROM results
                        JOIN teachers_master ON results.teachers_id = teachers_master.id";

                // Modify the SQL query to include search conditions
                if (!empty($searchTerm)) {
                    $sql .= " WHERE results.name LIKE '%$searchTerm%' OR results.email LIKE '%$searchTerm%' OR results.students_id LIKE '%$searchTerm%'
                              OR results.exam LIKE '%$searchTerm%' OR results.subject LIKE '%$searchTerm%' OR teachers_master.name LIKE '%$searchTerm%'";
                }

                $result = mysqli_query($conn, $sql);

                // Check for errors in the query execution
                if ($result === false) {
                    die("Error in SQL query: " . mysqli_error($conn));
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $delid = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $students_id = $row['students_id'];
                        $exam = $row['exam'];
                        $subject = $row['subject'];
                        $results = $row['results'];
                        $feedback = $row['feedback'];
                        $teachers_name = $row['teachers_name'];
                        $publish_date = $row['publish_date'];

                        echo "
                            <tr>
                            <td>$name</td>
                            <td>$email</td>
                            <td>$students_id</td>
                            <td>$exam</td>
                            <td>$subject</td>
                            <td>$results%</td>
                            <td>$feedback</td>
                            <td>$teachers_name</td>
                            <td>$publish_date</td>
							<td>
							<div class='genrate-report gen-rep-padd'>
							<form action='generate_report.php?email=$email' method='post'>
								<input type='submit' name='getReport' value='Get a Report'>
							</form>
						</div>
						</td>
                            <td>
                                <form method='post' enctype='multipart/form-data'>
                                    <input type='hidden' value='$delid' name='delete_id'>
                                    <input type='submit' name='delete' value='Delete' class='delete-button'>
                                </form>
                            </td>
                        </tr>
                        ";

						if(isset($_POST['delete'])){
							$delid = $_POST['delete_id'];
							$sql = "DELETE FROM results WHERE id ='$delid'";

							$results = mysqli_query($conn,$sql);

							if($results){
								echo "<script>alert('Deleted successfully!')</script>";
								echo "<script>window.location = 'results.php';</script>";
							} else{
								echo "<script>alert('Error While Deleting!')</script>";
							}
						}

                    }
					
                } else {

                    echo "<tr><td colspan='10'>No results found.</td></tr>";
                }
                ?>

			</tbody>
		</table>
	</section>

	<script src="../script.js"></script>

</body>

</html>