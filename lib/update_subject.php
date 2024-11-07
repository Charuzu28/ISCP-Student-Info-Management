<?php
require_once('../dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjID = $_POST['subjID'];
    $courseCode = $_POST['courseCode'];
    $subDetails = $_POST['subDetails'];
    $prerequisite = $_POST['prerequisite'];
    $lab = $_POST['lab'];
    $unit = $_POST['unit'];

    $query = "UPDATE subject SET courseCode = ?, subDetails = ?, prerequisite = ?, lab = ?, unit = ? WHERE subjID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssi', $courseCode, $subDetails, $prerequisite, $lab, $unit, $subjID);

    if ($stmt->execute()) {
        header("Location: ../view_subjects.php?studentID={$_GET['studentID']}&courseID={$_GET['courseID']}");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
