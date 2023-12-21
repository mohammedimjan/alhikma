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

		<h1 class="section-h1">Exams</h1>
		<table class="table-admin">
			<thead>
				<tr>
					<th>Exam Name</th>
					<th>Subject</th>
					<th>Grade</th>
					<th>Teachers Name</th>
					<th>Published Date</th>
					<th>DeadLine</th>
					<th>View</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
                $Sql = "SELECT * FROM exams";
                $result = mysqli_query($conn, $Sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $delid = $row['id'];
                        $teachers_id = $row['teachers_id'];
                        $deadline = $row['deadline'];
                        $start_date = $row['start_date'];
                        $link = $row['link'];
                        $name = $row['name'];
                        $grade = $row['grade'];
                        $subject = $row['subject'];
                        $currentDate = date('Y-m-d');

                        $sqlteacher = "SELECT * FROM teachers_master WHERE id = '$teachers_id'";
                        $reslteacher = mysqli_query($conn, $sqlteacher);

                        if (mysqli_num_rows($reslteacher) === 1) {
                            $row = mysqli_fetch_assoc($reslteacher);

                            $teachers_name = $row['name'];

                            // Check if the deadline is greater than the current date
                            $rowClass = ($deadline > $currentDate) ? '' : 'expired-row';

                            echo "
                            <tr class='$rowClass'>
                                <td>$name</td>
                                <td>$subject</td>
                                <td>$grade</td>
                                <td>$teachers_name</td>
                                <td>$start_date</td>
                                <td>$deadline</td>
                                <td><a href='$link' target='_blank' class='download-button'>View</a></td>
                                <td>
                                    <form method='post' enctype='multipart/form-data'>
                                        <input type='hidden' value='$delid' name='delete_id'>
                                        <input type='submit' name='delete' value='Delete' class='delete-button'>
                                    </form>
                                </td>
                            </tr>
                            ";
                        }

						if(isset($_POST['delete'])){
							$delid = $_POST['delete_id'];
							$sqldel = "DELETE FROM exams WHERE id = '$delid'";
							$result = mysqli_query($conn,$sqldel);
		
							if($result){
								echo "<script>alert('Success')</script>";
								echo "<script>window.location = 'exams.php';</script>";
							} else{
								echo "<script>alert('Error')</script>";
							}
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