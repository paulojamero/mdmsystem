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
        <select name="grades" id="grades">
            <option value="na">Please Select</option>

            <option value="pc">Pre Casa</option>
            <option value="jc">Junior Casa</option>
            <option value="sc">Senior Casa</option>
            <option value="gr1">Grade 1</option>
            <option value="gr2">Grade 2</option>
            <option value="gr3">Grade 3</option>
            <option value="gr4">Grade 4</option>
            <option value="gr5">Grade 5</option>
            <option value="gr6">Grade 6</option>
            <option value="gr7">Grade 7</option>
            <option value="gr8">Grade 8</option>
            <option value="gr9">Grade 9</option>
            <option value="gr10">Grade 10</option>
            <option value="gr11">Grade 11</option>
            <option value="gr12">Grade 12</option>

        </select>
       


        <input type="submit" name="submit" value="Submit Form">
    
    
    </form>
  







</body>
</html>