<?php 

include_once("connections/connection.php");
$con = connection();



if (isset($_POST['approve'])) { 

    $status = $_POST['STATUS'];
    $rsFName = $_POST['rFName'];
    $rsLName = $_POST['rLName'];
    $rsGrade = $_POST['rGrade'];

    $sql = "INSERT INTO student_list (firstName, lastName, grade)
            SELECT rsFName, rsLName, rsGrade 
            FROM student_reserve 
            WHERE status = 'Approve' ";
    $con->query($sql) or die ($con->error);

echo header("Location: index.php");
}




?>



