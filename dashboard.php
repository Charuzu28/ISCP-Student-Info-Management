<?php
session_start();

// Redirect to login if session variables are not set
if (empty($_SESSION['registerID'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="modal.css">
    <title>Dashboard</title>
</head>
<body class="gradient-background">
    <audio id="backgroundAudio" loop src="Karera.mp3"></audio>
    <?php 
    include('nav.php');
    ?>

    <div class="d-flex">
        <?php 
            include("sidebar.php");
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
                           <?php include('fetch-student.php'); ?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php 
        include('modal.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="bg-audio.js"></script>
    <script src="time.js"></script>
    <script src="modal.js"></script>
    <script src="delete.js"></script>
    <script src="edit-modal.js"></script>
</body>
</html>
