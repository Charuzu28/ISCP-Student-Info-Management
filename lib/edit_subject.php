<?php
require_once('../dbcon.php');

if (isset($_GET['subjID'])) {
    $subjID = $_GET['subjID'];

    // Fetch the subject details
    $query = "SELECT * FROM subject WHERE subjID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $subjID);
    $stmt->execute();
    $result = $stmt->get_result();
    $subject = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Subject</title>
</head>
<body class="gradient-background">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Edit Subject</h3>
            </div>
            <div class="card-body">
                <form action="update_subject.php" method="post">
                    <input type="hidden" name="subjID" value="<?php echo $subject['subjID']; ?>">
                    <div class="mb-3">
                        <label for="courseCode" class="form-label">Course Code</label>
                        <input type="text" class="form-control" id="courseCode" name="courseCode" value="<?php echo $subject['courseCode']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="subDetails" class="form-label">Subject Details</label>
                        <textarea class="form-control" id="subDetails" name="subDetails" required><?php echo $subject['subDetails']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="prerequisite" class="form-label">Prerequisite</label>
                        <input type="text" class="form-control" id="prerequisite" name="prerequisite" value="<?php echo $subject['prerequisite']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="lab" class="form-label">Room</label>
                        <input type="text" class="form-control" id="lab" name="lab" value="<?php echo $subject['lab']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Units</label>
                        <input type="number" class="form-control" id="unit" name="unit" value="<?php echo $subject['unit']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Subject</button>
                    <a href="../dashboard.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
