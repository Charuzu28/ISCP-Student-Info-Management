<?php 
    require_once('../dbcon.php');
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);

        $studentDelete = "DELETE FROM student WHERE studentID = ? ";
        $stmt = $conn->prepare($studentDelete); 
        $stmt->bind_param('i', $studentID); 
        if($stmt->execute()){
            $_SESSION['delete_success'] = true;

            $stmt->close();
            header('Location: ../dashboard.php');
            exit;
        }else{
            echo "Error 404!";
        }
    }

    mysqli_close($conn);
    exit;

?>