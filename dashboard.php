<?php
require_once('dbcon.php');
session_start();

// Redirect to login if session variables are not set
if (empty($_SESSION['registerID'])) {
    header('Location: login.php');
    exit;
}

    $query = "SELECT r.fname, r.mname, r.lname, r.email, r.profile_pic, l.password 
    FROM register r 
    JOIN login l ON r.registerID = l.registerID 
    WHERE r.registerID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['registerID']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['fname'] = $row['fname'];
    $_SESSION['profile_pic'] = $row['profile_pic'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/modal.css">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body class="gradient-background">
    <!-- <audio id="backgroundAudio" loop src="Karera.mp3"></audio> -->
    <?php 
    include('lib/nav.php');
    ?>

    <div class="d-flex">
        <?php 
            include("lib/sidebar.php");
        ?>

        <div class="main-content">
            <div class="container">
                <div class="card p-4 shadow-sm">
                    <div class="text-center mb-4">
                        <img src="img/iscp-logo.png" alt="Logo" class="mb-3" style="width: 100px; height: 100px;">
                        <h1 class="card-title">Welcome, ISCP portal!</h1>
                    </div>
                    <div class="card-body">
                        <!-- CRUD functionality placeholders -->
                        <div class="d-flex justify-content-between mb-3">
                            <h4>Manage Data</h4>
                            <button class="btn btn-primary add-button">Add New Record</button>
                        </div>
                        
                        <!-- Records Table (Example Placeholder) -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SchoolID</th>
                                    <th>Student name</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                           <tbody>
                           <?php include('lib/fetch-student.php'); ?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php 
        include('lib/modal.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/bg-audio.js"></script>
    <script src="js/time.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/delete.js"></script>
    <script src="js/edit-modal.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
