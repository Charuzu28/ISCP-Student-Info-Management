 <?php
// Include the database connection
require_once('../dbcon.php');

// Get student ID from query string
$studentID = $_GET['studentID'];

// Fetch student details from the database
$query = "SELECT s.studentID, s.schoolID, s.studentName, s.courseID, s.year, c.course 
          FROM student s JOIN courses c ON s.courseID = c.courseID 
          WHERE s.studentID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $studentID);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Fetch all courses from the database
$coursesQuery = "SELECT courseID, course FROM courses";
$coursesResult = $conn->query($coursesQuery);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update student details
    $studentName = $_POST['studentName'];
    $courseID = $_POST['course']; 
    $year = $_POST['year'];

    // Update query
    $updateQuery = "UPDATE student SET studentName = ?, courseID = ?, year = ? WHERE studentID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('sisi', $studentName, $courseID, $year, $studentID);
    
    if ($updateStmt->execute()) {
        header('Location: ../dashboard.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Student</title>
</head>
<body class="gradient-background">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Edit Student</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <label for="studentName">Name</label>
                        <input type="text" class="form-control" name="studentName" id="studentName" value="<?php echo $student['studentName']; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="course">Course</label>
                        <select class="form-control" name="course" id="course" required>
                            <?php
                            // Dynamically populate the course dropdown
                            while ($course = $coursesResult->fetch_assoc()) {
                                // Check if this is the student's current course
                                $selected = ($course['courseID'] == $student['courseID']) ? 'selected' : '';
                                echo "<option value='{$course['courseID']}' $selected>{$course['course']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" name="year" id="year" value="<?php echo $student['year']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="../dashboard.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
