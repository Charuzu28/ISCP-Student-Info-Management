<?php
require_once('dbcon.php'); // Include database connection
session_start(); // Start session

if (!isset($_SESSION['registerID'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

$registerID = $_SESSION['registerID'];

// Initialize variables for user data
$fname = $mname = $lname = $email = $profile_pic = "";
$uploadError = "";
$passwordError = "";

// Fetch current user data, including password from the login table
$query = "SELECT r.fname, r.mname, r.lname, r.email, r.profile_pic, l.password 
          FROM register r 
          JOIN login l ON r.registerID = l.registerID 
          WHERE r.registerID = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $registerID);
    $stmt->execute();
    $stmt->bind_result($fname, $mname, $lname, $email, $profile_pic, $hashedPassword);
    $stmt->fetch();
    $stmt->close();
}

// Handle profile info update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_changes'])) {
    $newFname = htmlspecialchars(trim($_POST['fname']));
    $newMname = htmlspecialchars(trim($_POST['mname']));
    $newLname = htmlspecialchars(trim($_POST['lname']));
    $newEmail = htmlspecialchars(trim($_POST['email']));
    $newPassword = htmlspecialchars(trim($_POST['new_password']));
    
    $enteredPassword = htmlspecialchars(trim($_POST['entered_password']));
    
    // Verify current password
    if (!password_verify($enteredPassword, $hashedPassword)) {
        $passwordError = "Current password verification failed. Please try again.";
    } else {
        updateUserInfo($conn, $newFname, $newMname, $newLname, $newEmail, $newPassword, $registerID);
        echo "<script>alert('Profile updated successfully.'); window.location.href = 'update-profile.php';</script>";
    }
}

// Handle profile picture upload separately
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile_pic'])) {
    handleProfilePictureUpload($conn, $registerID, $profile_pic, $uploadError);
}

function updateUserInfo($conn, $newFname, $newMname, $newLname, $newEmail, $newPassword, $registerID) {
    // Update user info in register table
    $updateQuery = "UPDATE register SET fname = ?, mname = ?, lname = ?, email = ? WHERE registerID = ?";
    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("ssssi", $newFname, $newMname, $newLname, $newEmail, $registerID);
        $stmt->execute();
        $stmt->close();
    }

    // If password is provided, update it in the login table
    if (!empty($newPassword)) {
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE login SET password = ? WHERE registerID = ?";
        if ($stmt = $conn->prepare($updatePasswordQuery)) {
            $stmt->bind_param("si", $hashedNewPassword, $registerID);
            $stmt->execute();
            $stmt->close();
        }
    }
}

function handleProfilePictureUpload($conn, $registerID, &$profile_pic, &$uploadError) {
    $targetDir = "img/"; // Ensure this folder exists
    $targetFile = $targetDir . basename($_FILES['profile_pic']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Check file type
    if (in_array($imageFileType, $allowedTypes)) {
        // Move uploaded file
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
            $profile_pic = basename($_FILES['profile_pic']['name']);
            
            // Update profile picture in the database
            $updatePicQuery = "UPDATE register SET profile_pic = ? WHERE registerID = ?";
            if ($stmt = $conn->prepare($updatePicQuery)) {
                $stmt->bind_param("si", $profile_pic, $registerID);
                $stmt->execute();
                $stmt->close();
                echo "<script>alert('Profile picture updated successfully.'); window.location.href = 'update-profile.php';</script>";
            }
        } else {
            $uploadError = "Error moving the uploaded file.";
        }
    } else {
        $uploadError = "Only JPG, JPEG, PNG & GIF files are allowed.";
    }

    if ($uploadError) {
        echo "<script>alert('$uploadError');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-pic {
            width: 100px; /* Set the desired width */
            height: 100px; /* Set the desired height */
            border-radius: 50%; /* Makes the image circular */
            object-fit: cover; /* Ensures the image covers the area without stretching */
        }

        .profile-pic-section {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the items */
            justify-content: center;
        }
        .container{
            margin-bottom: 30px;
            margin-top: 5px;
        }
    </style>
    <title>Account Settings</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Update Account Information</h2>

        <!-- Profile Picture Section -->
        <div class="mb-3 text-center profile-pic-section">
            <?php if ($profile_pic): ?>
                <img src="img/<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" class="profile-pic mb-3">
            <?php else: ?>
                <p>No profile picture available.</p>
            <?php endif; ?>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#profilePicModal">Change Profile Picture</button>
        </div>

        <!-- Form for User Information Update -->
        <form action="update-profile.php" method="POST" enctype="multipart/form-data" onsubmit="return validatePasswords()">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo htmlspecialchars($fname); ?>" required>
            </div>
            <div class="mb-3">
                <label for="mname" class="form-label">Middle Name:</label>
                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo htmlspecialchars($mname); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo htmlspecialchars($lname); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password (leave blank if not changing):</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <div class="mb-3">
                <label for="entered_password" class="form-label">Verify (Enter Old Password):</label>
                <input type="password" class="form-control" id="entered_password" name="entered_password" required>
            </div>
            <?php if ($passwordError): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($passwordError); ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary" name="confirm_changes">Save Changes</button>
            <a href="dashboard.php" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <!-- Modal for Profile Picture Update -->
    <div class="modal fade" id="profilePicModal" tabindex="-1" aria-labelledby="profilePicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profilePicModalLabel">Upload Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update-profile.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="file" class="form-control" id="profile_pic" name="profile_pic" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update_profile_pic">Update Picture</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to validate password match -->
    <script>
        function validatePasswords() {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword && newPassword !== confirmPassword) {
                alert('New password and confirmation password do not match!');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>
</html>
