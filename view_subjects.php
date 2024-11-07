<?php
// Include the database connection
require_once('dbcon.php');

// Check if studentID and courseID are set in the query string
if (!isset($_GET['studentID']) || !isset($_GET['courseID'])) {
    die('Error: Missing studentID or courseID.');
}

$studentID = $_GET['studentID'];
$courseID = $_GET['courseID'];

// Fetch student details
$query = "SELECT studentName FROM student WHERE studentID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $studentID);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc(); // Fetch student data

// Check if the student exists
if (!$student) {
    $studentName = "Unknown Student"; // Fallback name if student not found
} else {
    $studentName = htmlspecialchars($student['studentName']); // Use fetched studentName with htmlspecialchars for security
}

// Fetch subjects for the student's course
$subjectQuery = "SELECT subjID, courseCode, subDetails, prerequisite, lab, unit, created_at 
                 FROM subject WHERE courseID = ?";
$stmt = $conn->prepare($subjectQuery);
$stmt->bind_param('i', $courseID);
$stmt->execute();
$subjectsResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View Subjects</title>
</head>
<body class="gradient-background">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Subjects for <?php echo $studentName; ?></h3> <!-- Updated to use fallback name -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSubjectModal">Add Subject</button>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Subject Details</th>
                            <th>Prerequisite</th>
                            <th>Room</th>
                            <th>Units</th>
                            <th>Created At</th>
                            <th>Actions</th> <!-- Added Actions column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($subjectsResult->num_rows > 0) {
                            while ($subject = $subjectsResult->fetch_assoc()) {
                                echo "<tr>
                                    <td>".htmlspecialchars($subject['courseCode'])."</td>
                                    <td>".htmlspecialchars($subject['subDetails'])."</td>
                                    <td>".htmlspecialchars($subject['prerequisite'])."</td>
                                    <td>".htmlspecialchars($subject['lab'])."</td>
                                    <td>".htmlspecialchars($subject['unit'])."</td>
                                    <td>".htmlspecialchars($subject['created_at'])."</td>
                                    <td>
                                        <a href='lib/edit_subject.php?subjID=".htmlspecialchars($subject['subjID'])."' class='btn btn-warning'>Edit</a>
                                        
                                        <form action='lib/delete_subject.php' method='post' style='display:inline;'>
                                            <input type='hidden' name='subjID' value='".htmlspecialchars($subject['subjID'])."'>
                                            <input type='hidden' name='studentID' value='".htmlspecialchars($studentID)."'>
                                            <input type='hidden' name='courseID' value='".htmlspecialchars($courseID)."'>
                                            <button type='submit' class='btn btn-danger'>Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No subjects found for this course.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
                        <?php 
                            include "add-subject-modal.php";
                        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
