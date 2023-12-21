<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];

$sql = "SELECT * FROM teachers_master WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn)); // Handle the database error here
}

if (mysqli_num_rows($result) === 1) {
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
	<?php include 'header.php' ?>
	<section class="head-padd all-sec-p viewlearn-m">
		<h1 class="section-h1">Exams</h1>
		<table class="table-teach">
			<thead>
				<tr>
					<th>Name</th>
					<th>Grade</th>
					<th>Subject</th>
					<th>Published Date</th>
					<th>Deadline</th>
					<th>Download</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
                $current_date = date('Y-m-d');
                $sql = "SELECT * FROM exams WHERE teachers_id = '$id' AND deadline >= '$current_date'";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    die("Error: " . mysqli_error($conn)); // Handle the database error here
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $delid = $row['id'];
                        $name = $row['name'];
                        $grade = $row['grade'];
                        $subject = $row['subject'];
                        $start_date = $row['start_date'];
                        $deadline = $row['deadline'];
                        $link = $row['link'];

                        echo "
                        <tr>
                            <td>$name</td>
                            <td>$grade</td>
                            <td>$subject</td>
                            <td>$start_date</td>
                            <td>$deadline</td>
                            <td><a href='$link' class='download-button' target='_blank'>Download</a></td>
                            <td>
                                <form method='post'  method='post' enctype='multipart/form-data' class='nml-form'>
                                    <input type='hidden' name='deleteid' value='$delid'>
                                    <input type='submit' name='delete' value='Delete' class='delete-button'>
                                </form>
                            </td>
                        </tr>
                        ";
                    }

					if(isset($_POST['delete'])){
						$del = $_POST['deleteid'];
						$sqldel = "DELETE FROM exams WHERE id ='$del'";
						$delresult = mysqli_query($conn,$sqldel);

						if($delresult){
							echo "<script>alert('Deleted')</script>";
							echo "<script>window.location = 'viewexams.php';</script>";
						} else {
							echo "<script>alert('Error')</script>";
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