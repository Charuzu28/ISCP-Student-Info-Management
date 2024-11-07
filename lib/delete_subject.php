<?php
require_once('../dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjID = $_POST['subjID'];
    $studentID = $_POST['studentID'];
    $courseID = $_POST['courseID'];

    // Ensure subjID is valid
    if ($subjID && $studentID && $courseID) {
        $query = "DELETE FROM subject WHERE subjID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $subjID);

        if ($stmt->execute()) {
            // Redirect back to view_subjects.php with studentID and courseID in the URL
            header("Location: ../view_subjects.php?studentID={$studentID}&courseID={$courseID}");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: Missing required data.";
    }
}
?>
