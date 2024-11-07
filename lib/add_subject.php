<?php
require_once('../dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseCode = $_POST['courseCode'];
    $subDetails = $_POST['subDetails'];
    $prerequisite = $_POST['prerequisite'];
    $lab = $_POST['lab'];
    $unit = $_POST['unit'];
    $courseID = $_POST['courseID'];
    $studentID = $_POST['studentID'];

    $query = "INSERT INTO subject (courseCode, subDetails, prerequisite, lab, unit, courseID) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssii', $courseCode, $subDetails, $prerequisite, $lab, $unit, $courseID);

    if ($stmt->execute()) {
        header("Location: ../view_subjects.php?studentID={$studentID}&courseID={$courseID}");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
