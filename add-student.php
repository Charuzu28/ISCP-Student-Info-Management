<?php 
    require_once('dbcon.php');
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $schoolID = mysqli_real_escape_string($conn, $_POST['schoolID']);
        $studentName = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['studentName']));
        $courseID = mysqli_real_escape_string($conn, $_POST['course']);  // sanitize input
        $year = mysqli_real_escape_string($conn,$_POST['year']);

        $studentDetails = "INSERT INTO student (schoolID, studentName, courseID, year) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($studentDetails); 
        
        // Bind course as an integer (i)
        $stmt->bind_param("isis", $schoolID, $studentName, $courseID, $year); 

        
        if($stmt->execute()){
            $_SESSION['add_student_success'] = true;
            $stmt->close();

            header('Location: dashboard.php');
            exit;
        }else{
            $_SESSION['add_student_success'] = false;
            echo "Error";
            $stmt->close();
        }
    }

    mysqli_close($conn);
    exit;
?>
