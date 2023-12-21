<?php
session_start();
require('../vendor/fpdf/fpdf.php');

if (isset($_POST['getReport'])) {
    // Your database connection code
    include('../db.php');

    // Retrieve user ID
    $email = $_SESSION['SESSION_EMAIL'];
    $sql_user = "SELECT * FROM students_master WHERE email = '$email'";
    $result_user = mysqli_query($conn, $sql_user);

    if (mysqli_num_rows($result_user) === 1) {
        $row_user = mysqli_fetch_assoc($result_user);
        $id = $row_user['student_id'];
        $name = $row_user['full_name'];
        $email = $row_user['email'];
        $grade = $row_user['grade'];
    }

    // Retrieve data for PDF
    $sql_results = "SELECT * FROM results WHERE students_id ='$id'";
    $result_results = mysqli_query($conn, $sql_results);

    // Create PDF
    class PDF extends FPDF
    {
        private $id;
        private $name;
        private $email;
        private $grade;

        function setStudentInfo($id, $name, $email, $grade)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->grade = $grade;
        }

        function Header()
        {
            // Logo with a bottom margin of 1rem (16 pixels)
            $this->Image('../assets/Logo.png', 10, 8, 33, 0, 'PNG');

            // Set font
            $this->SetFont('Arial', 'B', 14);

            // Title
            $this->Cell(0, 10, 'Al-Hikma Educational Centre', 0, 1, 'C');

            // Student Details
            $this->SetFont('Arial', '', 12);
            $this->Ln();
            $this->Cell(0, 10, "Student ID: $this->id", 0, 1, 'L');
            $this->Cell(0, 10, "Name: $this->name", 0, 1, 'L');
            $this->Cell(0, 10, "Email: $this->email", 0, 1, 'L');
            $this->Cell(0, 10, "Current Class: $this->grade", 0, 1, 'L');

            // Author
            $this->SetFont('Arial', 'I', 12);
            $this->Cell(0, 10, 'Results Report', 0, 1, 'C');
        }

        function Footer()
        {
            // Footer
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->setStudentInfo($id, $name, $email, $grade);
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Set up the PDF document
    $pdf->SetTitle('Results Report');
    $pdf->SetAuthor('Al-Hikma');

    if (mysqli_num_rows($result_results) > 0) {
        // Set background color for the table header to gray
        $pdf->SetFillColor(230, 230, 230);

        // Add a table header
        $pdf->Cell(40, 10, 'Exam', 1, 0, 'C', 1);
        $pdf->Cell(40, 10, 'Class', 1, 0, 'C', 1);
        $pdf->Cell(40, 10, 'Subject', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'Results', 1, 0, 'C', 1);
        $pdf->Cell(40, 10, 'Date', 1, 1, 'C', 1);

        // Reduce font size for data rows
        $pdf->SetFont('Arial', '', 10);

        while ($row = mysqli_fetch_assoc($result_results)) {
            // Check if there's enough space for the row, else add a new page
            if ($pdf->GetY() + 10 > $pdf->GetPageHeight() - 15) {
                $pdf->AddPage();
                // Add header and reset Y position
                $pdf->Header();
            }

            // Add data to PDF
            $pdf->Cell(40, 10, $row['exam'], 1);
            $pdf->Cell(40, 10, $row['grade'], 1);
            $pdf->Cell(40, 10, $row['subject'], 1);
            $pdf->Cell(30, 10, $row['results'], 1);
            $pdf->Cell(40, 10, $row['publish_date'], 1);
            $pdf->Ln();
        }
    } else {
        // No results found message
        $pdf->Cell(0, 10, 'No results found.', 1, 1, 'C');
    }

    // Output PDF and force download
    $pdf->Output('Results_Report.pdf', 'D');
}
?>