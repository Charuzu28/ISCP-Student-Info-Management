<?php
// Include the database connection
require_once('dbcon.php');

// Fetch students from the database
$query = "SELECT  s.studentID, s.schoolID, s.studentName, c.course, s.year FROM student s 
          JOIN courses c ON s.courseID = c.courseID";
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['schoolID']}</td>
                <td>{$row['studentName']}</td>
                <td>{$row['course']}</td>
                <td>{$row['year']}</td>
                <td class='actionBtn'>
                     <a href='edit.php?studentID={$row['studentID']}' class='btn btn-warning'>Edit</a>
                    <form action='delete.php' method='post'>
                    <input type='hidden' name='studentID' value='{$row['studentID']}'>
                    <button class='btn btn-danger deleteBtn'>Delete</button>
                    </form>
                    
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No records found</td></tr>";
}
?>
