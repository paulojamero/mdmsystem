<?php 

include_once("connections/connection.php");
$con = connection();



if (isset($_POST['approve'])) {  // NEEDS CONFIRMATION BEFORE CLICKING APPROVE

    $id = $_POST['rsID'];
    $rsFName = $_POST['rFName'];
    $rsLName = $_POST['rLName'];
    $rsGrade = $_POST['rGrade'];

    $sql = "INSERT INTO student_list (firstName, lastName, grade, gender)
            SELECT rsFName, rsLName, rsGrade, rsGender
            FROM student_reserve 
            WHERE id = '$id' ";
    $con->query($sql) or die ($con->error);


echo header("Location: index.php");
}

if (isset($_POST['approve'])) { 

    $id = $_POST['rsID'];

    $sql = "DELETE from student_reserve WHERE id = '$id' ";
    $con->query($sql) or die ($con->error);

}

?>



