<?php
require_once('dbcon.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize user input
    $fname = htmlspecialchars($_POST['fname']); 
    $mname = htmlspecialchars($_POST['mname']); 
    $lname = htmlspecialchars($_POST['lname']); 
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['password']);
    $birthday = $_POST['birthday'];
    //login table
    $username = htmlspecialchars($_POST['username']);
    $facultyID = mysqli_real_escape_string($conn, $_POST['facultyID']);

    // Generate a random ID for facultyID
    

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Calculate the age
    $birthDate = new DateTime($birthday);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    // Check if the email already exists in the register table
    $checkUser = "SELECT * FROM register WHERE email = ?";
    if ($stmt = $conn->prepare($checkUser)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();  // Store the result to check the number of rows
        $count = $stmt->num_rows;

        if ($count > 0) {
            echo "<script>
                    alert('Email already registered!');
                    window.location.href = 'register.php';
                  </script>";
        } else {
            // Insert user details into the register table
            $insertRegister = "INSERT INTO register (facultyID, fname, mname, lname, email, birthday, age) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($insertRegister)) {
                $stmt->bind_param("ssssssi", $facultyID, $fname, $mname, $lname, $email, $birthday, $age);
                if ($stmt->execute()) {
                    // Get the last inserted ID for use in the login table
                    $registerID = $stmt->insert_id;

                    // Insert login credentials into the login table
                    $insertLogin = "INSERT INTO login (registerID, username, password) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($insertLogin);
                    $stmt->bind_param("iss", $registerID, $username, $hashedPassword);
                    if ($stmt->execute()) {
                            echo "<script>
                                    alert('Account created successfully!');
                                    window.location.href = 'login.php';
                                  </script>";
                        } else {
                            echo "<script>
                                    alert('Error creating login entry.');
                                    window.location.href = 'register.php';
                                  </script>";
                        }
                    
                } else {
                    echo "<script>
                            alert('Error creating account.');
                            window.location.href = 'register.php';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Error preparing SQL statement for register.');
                        window.location.href = 'register.php';
                      </script>";
            }
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>
                alert('Error preparing SQL statement.');
                window.location.href = 'register.php';
              </script>";
    }

    // Close the connection
    $conn->close();
}
?>