<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['SESSION_EMAIL'])) {
	header("Location: login.php");
	die();
}
include('../db.php');

$email = $_SESSION['SESSION_EMAIL'];



// Get the current page basename
$page = basename($_SERVER['PHP_SELF']);

$sidebar = '
<div id="mySidebar" class="sidebar">
    <ul>
        <li class="' . ($page == 'index.php' ? 'active-link' : '') . '">
            <a href="index.php"><i class="fa-solid fa-house"></i>Home</a>
        </li>
        <li class="' . ($page == 'calender.php' ? 'active-link' : '') . '">
            <a href="calender.php"><i class="fa-solid fa-calendar-days"></i>Calender</a>
        </li>
        <li class="' . ($page == 'viewlearnmat.php' ? 'active-link' : '') . '">
            <a href="viewlearnmat.php"><i class="fa-solid fa-book"></i>Learn Materials</a>
        </li>
        <li class="' . ($page == 'managelearnmat.php' ? 'active-link' : '') . '">
            <a href="managelearnmat.php"><i class="fa-solid fa-pen-nib"></i>Edit Learning Materials</a>
        </li>
        <li class="' . ($page == 'viewstudents.php' ? 'active-link' : '') . '">
            <a href="viewstudents.php"><i class="fa-solid fa-user-group"></i>Students</a>
        </li>
        <li class="' . ($page == 'viewexams.php' ? 'active-link' : '') . '">
            <a href="viewexams.php"><i class="fa-solid fa-book-open"></i>Exam</a>
        </li>
        <li class="' . ($page == 'viewresults.php' ? 'active-link' : '') . '">
            <a href="viewresults.php"><i class="fa-solid fa-book-open"></i>View Results</a>
        </li>
        <li class="' . ($page == 'manageexams.php' ? 'active-link' : '') . '">
            <a href="manageexams.php"><i class="fa-solid fa-file-circle-plus"></i>Add Exams</a>
        </li>
        <li class="' . ($page == 'results.php' ? 'active-link' : '') . '">
            <a href="results.php"><i class="fa-solid fa-xmarks-lines"></i>Add Results</a>
        </li>
        <li class="' . ($page == 'profile.php' ? 'active-link' : '') . '">
            <a href="profile.php"><i class="fa-solid fa-id-badge"></i>Teachers Profile</a>
        </li>
        <li>
            <a href="../../logout.php"><i class="fa fa-file "></i>Log Out</a>
        </li>
    </ul>
</div>

<!-- Open/Close icon for sidebar -->
<span class="openbtn" onclick="toggleSidebar()">&#9776;</span>
';
?>
<header>
	<div class="sidebar-header">
		<?php echo  $sidebar?>
	</div>

	<img src="../student/Images/Logo.png" class="logo" alt="">

</header>