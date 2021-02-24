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
    $bday = $_POST['bday'];
    $schoolYear = $_POST['schoolYear'];

    $sql = "INSERT INTO `student_list`(`firstName`, `lastName`, `gender`, `grade`, `birthDay`, `school_year`) VALUES ('$fName','$lName','$gender', '$grades', '$bday', '$schoolYear')";

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

        <label>Grade Level</label>
        <select name="grades" id="grades">
            <option value="na">Please Select</option>

            <option value="Pre Casa">Pre Casa</option>
            <option value="Junior Casa">Junior Casa</option>
            <option value="Senior Casa">Senior Casa</option>
            <option value="Grade 1">Grade 1</option>
            <option value="Grade 2">Grade 2</option>
            <option value="Grade 3">Grade 3</option>
            <option value="Grade 4">Grade 4</option>
            <option value="Grade 5">Grade 5</option>
            <option value="Grade 6">Grade 6</option>
            <option value="Grade 7">Grade 7</option>
            <option value="Grade 8">Grade 8</option>
            <option value="Grade 9">Grade 9</option>
            <option value="Grade 10">Grade 10</option>
            <option value="Grade 11">Grade 11</option>
            <option value="Grade 12">Grade 12</option>
        </select>
        

        <label>Gender</label>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>Birthday</label>
        <input type="date" name="bday" id="bday" min="31/12/1950" date-date-format='m/d/yyyy'>

    

        
        <input type="hidden" name="schoolYear" value="2021-2022">    <!---CHANGE SCHOOL YEAR -->





        <input type="submit" name="submit" value="Submit Form">
    </form>
  


</body>
</html>