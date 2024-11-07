<?php 
require_once('../dbcon.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $schoolID = mysqli_real_escape_string($conn, $_POST['schoolID']);
    $studentName = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['studentName']));
    $courseID = mysqli_real_escape_string($conn, $_POST['course']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    // Check if the schoolID already exists
    $checkQuery = "SELECT * FROM student WHERE schoolID = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $schoolID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // SchoolID already exists
        $_SESSION['add_student_success'] = false;
        echo "Error: schoolID already exists.";
        $stmt->close();
    } else {
        // Proceed to insert
        $studentDetails = "INSERT INTO student (schoolID, studentName, courseID, year) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($studentDetails); 
        $stmt->bind_param("isis", $schoolID, $studentName, $courseID, $year); 

        if ($stmt->execute()) {
            $_SESSION['add_student_success'] = true;
            $stmt->close();
            header('Location: ../dashboard.php');
            exit;
        } else {
            $_SESSION['add_student_success'] = false;
            echo "Error: Could not add student.";
            $stmt->close();
        }
    }
}

mysqli_close($conn);
exit;
?>
