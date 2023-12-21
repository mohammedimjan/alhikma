<?php
// Start the session and check if the user is logged in

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
} else {
    // Get the current page filename
    $currentPage = basename($_SERVER['PHP_SELF']);

    echo "
        <header>
            <div class='sidebar-header'>
                ";
    echo '<div id="mySidebar" class="sidebar">
    <ul>
        <li class="' . ($currentPage == 'index.php' ? 'active-link' : '') . '">
            <a href="index.php"><i class="fa-solid fa-house"></i>Home</a>
        </li>
        <li class="' . ($currentPage == 'learningmat.php' ? 'active-link' : '') . '">
            <a href="learningmat.php"><i class="fa-sharp fa-solid fa-book"></i>Learning Materials</a>
        </li>
        <li class="' . ($currentPage == 'exams.php' ? 'active-link' : '') . '">
            <a href="exams.php"><i class="fa-solid fa-book-open"></i>Exams</a>
        </li>
        <li class="' . ($currentPage == 'addteacher.php' ? 'active-link' : '') . '">
            <a href="addteacher.php"><i class="fa-solid fa-person-circle-plus"></i>Add Teachers</a>
        </li>
        <li class="' . ($currentPage == 'viewteachers.php' ? 'active-link' : '') . '">
            <a href="viewteachers.php"><i class="fa-solid fa-id-badge"></i>Teachers</a>
        </li>
        <li class="' . ($currentPage == 'register.php' ? 'active-link' : '') . '">
            <a href="register.php"><i class="fa-solid fa-person-circle-plus"></i>Add Students</a>
        </li>
        <li class="' . ($currentPage == 'viewstudents.php' ? 'active-link' : '') . '">
            <a href="viewstudents.php"><i class="fa-solid fa-user-group"></i>Students</a>
        </li>
        <li class="' . ($currentPage == 'subjects.php' ? 'active-link' : '') . '">
            <a href="subjects.php"><i class="fa-solid fa-book-bookmark"></i>Subjects</a>
        </li>
        <li class="' . ($currentPage == 'teacherdir.php' ? 'active-link' : '') . '">
            <a href="teacherdir.php"><i class="fa-regular fa-address-book"></i>Teachers Directory</a>
        </li>
        <li class="' . ($currentPage == 'studentsdir.php' ? 'active-link' : '') . '">
            <a href="studentsdir.php"><i class="fa-solid fa-address-book"></i>Students Directory</a>
        </li>
        <li class="' . ($currentPage == 'calender.php' ? 'active-link' : '') . '">
            <a href="calender.php"><i class="fa-solid fa-calendar-days"></i>Calendar</a>
        </li>
        <li class="' . ($currentPage == 'grade.php' ? 'active-link' : '') . '">
            <a href="grade.php"><i class="fa-regular fa-calendar-plus"></i>Classes</a>
        </li>
        <li class="' . ($currentPage == 'results.php' ? 'active-link' : '') . '">
            <a href="results.php"><i class="fa-solid fa-xmarks-lines"></i>Results</a>
        </li>
        <li class="' . ($currentPage == 'profile.php' ? 'active-link' : '') . '">
            <a href="profile.php"><i class="fa-solid fa-book-medical"></i>Profile</a>
        </li>
        <li class="' . ($currentPage == 'https://app.crisp.chat/website/877f5dd6-ac10-429a-a22a-46edb02ef3f4/inbox/' ? 'active-link' : '') . '">
            <a target="_blank" href="https://app.crisp.chat/website/877f5dd6-ac10-429a-a22a-46edb02ef3f4/inbox/"><i class="fa-solid fa-comments"></i>Manage Live Chat</a>
        </li>
    </ul>
</div>

<!-- Open/Close icon for sidebar -->
<span class="openbtn" onclick="toggleSidebar()">&#9776;</span>';
    echo "
            </div>

            <img src='../student/Images/Logo.png' class='logo' alt=''>";

    echo "
            <div>
                <a href='../../logout.php' class='logout'>Logout</a>
            </div>
        </header>
    ";
}

include('../db.php');
?>