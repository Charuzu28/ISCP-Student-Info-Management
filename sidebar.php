<div class="sidebar">
            <h4><?php echo date("l, F j, Y"); ?></h4>
            <p id="currentTime"></p>
            <hr>
            <h4>Account Info</h4>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['fname']); ?></p>
            <p><strong>Faculty ID:</strong> <?php echo htmlspecialchars($_SESSION['facultyID']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <hr>
            <h4>Navigation</h4>
            <a href="dashboard.php" class="nav-link">Dashboard</a>
            <a href="assessment.php" class="nav-link">Assessment</a>
            <a href="advisement.php" class="nav-link">Advisement</a>
            <a href="events.php" class="nav-link">Events</a>
        </div>