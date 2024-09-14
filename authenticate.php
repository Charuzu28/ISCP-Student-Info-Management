<?php
require_once('dbcon.php');
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize user input
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Check if the user exists in the login table
    $checkUser = "SELECT l.registerID, r.fname, l.password , r.facultyID
                  FROM login l
                  JOIN register r ON l.registerID = r.registerID
                  WHERE l.username = ?";
    if ($stmt = $conn->prepare($checkUser)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($registerID, $fname, $hashedPassword, $facultyID);
        $stmt->fetch();

        if ($stmt->num_rows == 1) {
            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, start a session and set session variables
                $_SESSION['registerID'] = $registerID;
                $_SESSION['fname'] = $fname;
                $_SESSION['username'] = $username;
                $_SESSION['facultyID'] = $facultyID;
                // Redirect to dashboard
                echo "<script>
                        alert('Login successful!');
                        window.location.href = 'dashboard.php';
                      </script>";
            } else {
                // Password is incorrect
                echo "<script>
                        alert('Invalid password!');
                        window.location.href = 'login.php';
                      </script>";
            }
        } else {
            // username$username doesn't exist
            echo "<script>
                    alert('No account found with that username.');
                    window.location.href = 'login.php';
                  </script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>
                alert('Error preparing statement.');
                window.location.href = 'login.php';
              </script>";
    }

    $conn->close(); // Close the database connection
}
?>
