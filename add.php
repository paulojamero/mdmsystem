<?php 
      if(!isset($_SESSION)){
        session_start();
        
    }
    
    if(isset($_SESSION['UserLogin'])){
        echo "Welcome"." ".$_SESSION['UserLogin']."<br>"; 
        echo "Account:"." ".$_SESSION['Access']."<br>";
        echo "Add Student"."<br>";

    } else { 
        echo header("Location: login.php");
    };





    include_once("connections/connection.php");

    $con = connection(); // create new variable with connection function

if(isset($_POST['submit'])){

    // ilagay sa isang variable
    $fName = $_POST['firstname'];
    $lName = $_POST['lastname'];
    $gender = $_POST['gender'];
    $grades = $_POST['grades'];

    $sql = "INSERT INTO `student_list`(`firstName`, `lastName`, `gender`, `grade`) VALUES ('$fName','$lName','$gender', '$grades')";

    $con->query($sql) or die ($con->error);

    echo header("Location:index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <form action="" method="post">
        <label>First Name</label>
        <input type="text" name="firstname" id="firstname">

        <label>Last Name</label>
        <input type="text" name="lastname" id="lastname">

        <label>Gender</label>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>Grade Level</label>
        <input type="text" name="grades" id="grades">


        <input type="submit" name="submit" value="Submit Form">
    
    
    </form>
  







</body>
</html>