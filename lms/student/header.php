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
        <li class="' . ($page == 'learningmaterials.php' ? 'active-link' : '') . '">
            <a href="learningmaterials.php"><i class="fa-sharp fa-solid fa-book"></i>Learning Materials</a>
        </li>
        <li class="' . ($page == 'exams.php' ? 'active-link' : '') . '">
            <a href="exams.php"><i class="fa-solid fa-book-open-reader"></i>Exams</a>
        </li>
        <li class="' . ($page == 'calender.php' ? 'active-link' : '') . '">
            <a href="calender.php"><i class="fa-solid fa-calendar-days"></i>Calender</a>
        </li>
        <li class="' . ($page == 'results.php' ? 'active-link' : '') . '">
            <a href="results.php"><i class="fa-sharp fa-solid fa-square-poll-vertical"></i>Results</a>
        </li>
        <li class="' . ($page == 'profile.php' ? 'active-link' : '') . '">
            <a href="profile.php"><i class="fa-solid fa-id-badge"></i>Profile</a>
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
		<?php echo $sidebar; ?>
	</div>

	<img src="images/Logo.png" class="logo" alt="">
</header>