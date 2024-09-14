<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
         .gradient-background {
            background: rgb(0,0,0);
            background: linear-gradient(312deg, rgba(0,0,0,1) 5%, rgba(6,13,53,1) 15%, rgba(21,46,184,1) 15%, rgba(28,60,195,1) 28%, rgba(14,30,120,1) 28%, rgba(21,46,184,1) 41%, rgba(38,81,212,1) 63%, rgba(39,83,214,1) 68%, rgba(5,12,156,1) 68%, rgba(33,70,203,1) 80%, rgba(2,4,57,1) 80%, rgba(0,0,0,1) 89%);
            height: 100vh;
        }
    </style>
</head>
<body class="gradient-background">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form method="post" action="authenticate.php" class="text-bg-light p-4 border rounded shadow" style="width: 100%; max-width: 350px;">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <img src="img/iscp-logo.gif" alt="Logo" class="me-2" style="width: 100px; height: 100px;">
                <h3 class="m-0">ISCP Portal</h3>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your Username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me" class="form-check-label ms-2">Remember Me</label>
                </div>
                <a href="#" class="text-decoration-none">Forget Password?</a>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="register.php" class="text-decoration-none">Create account</a>
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
