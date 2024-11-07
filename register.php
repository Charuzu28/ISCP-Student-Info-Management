<?php

$facultyID = bin2hex(random_bytes(3)); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registration Form</title>
    <style>
        .gradient-background {
            background: rgb(0,0,0);
            background: linear-gradient(312deg, rgba(0,0,0,1) 5%, rgba(6,13,53,1) 15%, rgba(21,46,184,1) 15%, rgba(28,60,195,1) 28%, rgba(14,30,120,1) 28%, rgba(21,46,184,1) 41%, rgba(38,81,212,1) 63%, rgba(39,83,214,1) 68%, rgba(5,12,156,1) 68%, rgba(33,70,203,1) 80%, rgba(2,4,57,1) 80%, rgba(0,0,0,1) 89%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            width: 100%;
            max-width: 600px; /* Widen the form for better input spacing */
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-size: 0.875rem;
        }

        .form-control {
            padding: 0.5rem;
        }

        button {
            padding: 0.5rem;
        }

        .form-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .form-header img {
            width: 30px;
            height: 30px;
        }

        .form-header h4 {
            margin-left: 8px;
            font-size: 1.25rem;
        }
    </style>
</head>
<body class="gradient-background">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <form action="registration.php" method="POST" class="text-bg-light" onsubmit="return validateForm()">
        <div class="form-header">
            <img src="img/ISCP-LOGO.GIF" alt="Logo">
            <h4>ISCP Portal</h4>
        </div>

        <!-- 3 inputs per line -->
        <div class="row g-2 mb-2">
            <div class="col-md-4">
                <label for="fname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
            </div>
            <div class="col-md-4">
                <label for="mname" class="form-label">Middle Name:</label>
                <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" required>
            </div>
            <div class="col-md-4">
                <label for="lname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
            </div>
        </div>

        <div class="row g-2 mb-2">
            <div class="col-md-4">
                <label for="facultyID" class="form-label">Faculty ID:</label>
                <input type="text" class="form-control" id="facultyID" name="FacultyID" value="<?php echo $facultyID ?>" disabled required>
                <input type="hidden" class="form-control" id="facultyID" name="FacultyID" value="<?php echo $facultyID ?>" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="col-md-4">
                <label for="birthday" class="form-label">Birthday:</label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>
        </div>

        <div class="row g-2 mb-2">
            <div class="col-md-4">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="col-md-4">
                <label for="repeat-password" class="form-label">Repeat Password:</label>
                <input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="Repeat your password" required>
            </div>
        </div>

        <div class="mb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">Have an account?</p>
            <a href="login.php" class="text-decoration-none">Log In</a>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
