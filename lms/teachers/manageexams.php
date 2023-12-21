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

	<section class="manage-l-m head-padd">
		<div class="container">
			<div class="all-forms">
				<?php 

				if(isset($_POST['save'])){
					$name = $_POST['name_exam'];
					$grade = $_POST['grade'];
					$subject = $_POST['subject'];
					$link = $_POST['link_exam'];
					$currentdate = date('Y-m-d');
					$deadline = $_POST['deadline'];
					$current_date = date('Y-m-d');

					if($deadline < $currentdate){
						echo "<script>alert('Date cannont be less the'.$currentdate)</script>";
						echo "<script>window.location = 'manageexams.php';</script>";
					}else{
						$sql = "INSERT INTO exams(teachers_id,start_date,deadline,link,name,grade,subject) VALUES('$id','$currentdate','$deadline','$link','$name','$grade','$subject')";
						$result = mysqli_query($conn,$sql);

						if($result){
							echo "<script>alert('Success')</script>";
							echo "<script>window.location = 'manageexams.php';</script>";
						} else {
							echo "<script>alert('Error While Adding')</script>";
						}
					}
				}
				?>

				<form method="post" enctype="multipart/form-data" class="nml-form">
					<h1>Add Exam</h1>
					<label for="name-of-Exam">Name of Exam</label>
					<input type="text" placeholder="Name" name="name_exam" required>
					<label for="grade">Grade</label>
					<select id="grade" name="grade" required>
						<?php 
								$sqlgrade ="SELECT * FROM grade";
								$resultgrade = mysqli_query($conn,$sqlgrade);
								if(mysqli_num_rows($resultgrade)>0){
									while($row=mysqli_fetch_assoc($resultgrade)){
										$grade = $row['grade'];
										
										echo"
										<option value='$grade'>$grade</option>
										";
									}
								}
								?>
					</select>
					<label for="subject">Subjects</label>
					<select id="subject" name="subject" required>
						<?php 
								$sqlsubject ="SELECT * FROM teachers_subjects WHERE teachers_id ='$id'";
								$resultsubject = mysqli_query($conn,$sqlsubject);
								if(mysqli_num_rows($resultsubject)>0){
									while($row=mysqli_fetch_assoc($resultsubject)){
										$subject = $row['subjects'];

										echo"
										<option value='$subject'>$subject</option>
										";
									}
								}
								?>
					</select>
					<label for="Link-of-Exam">Link of Exam</label>
					<input type="text" placeholder="Link" name="link_exam" required>
					<label for="Date">Deadline</label>
					<input type="date" id="date" placeholder="Link" name="deadline" required>
					<input type="submit" value="Add Exams" name="save">
				</form>
			</div>
		</div>
	</section>
	<script src="../script.js"></script>

</body>

</html>