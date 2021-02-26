<?php 
    if (!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['UserLogin'])){ 

    } else {
        echo header("Location: login.php");
    }

    include_once("connections/connection.php");

    $con = connection(); // create new variable with connection function\

    $id = $_GET['ID'];

    $sql = "SELECT * FROM student_list WHERE id = '$id' ";
    $students = $con->query($sql) or die ($con->error);

    //yung result ilalagay sa row
    $row = $students->fetch_assoc();




if(isset($_POST['submit'])){

    // ilagay sa isang variable
    $fName = $_POST['firstname'];
    $lName = $_POST['lastname'];
    $gender = $_POST['gender'];
    $grades = $_POST['grades'];
    $bday = $_POST['bday'];
    $schoolYear = $_POST['schoolYear'];
    

    $sql = "UPDATE student_list SET firstName= '$fName', lastName = '$lName', gender = '$gender', grade = '$grades', birthDay= '$bday', school_year='$schoolYear' WHERE id = '$id' ";

    $con->query($sql) or die ($con->error);

    echo header("Location: details.php?ID=".$id);
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
        <input type="text" name="firstname" id="firstname" value="<?php echo $row['firstName']; ?>">

        <label>Last Name</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastName']; ?>">

        <label>Gender</label>
        <select name="gender" id="gender">   <!-- IF STATEMENT -- shorthand -- Good for dropdown -->
            <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '' ;?> 
            >Male</option> 
            <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '' ;?>
            >Female</option>
        
        </select>
          <label>Grade Level</label>
        <select name="grades" id="grades">
            <option value="na">Please Select</option>

            <option value="Pre Casa" <?php echo ($row['grade'] == "Pre Casa")? 'selected' : '' ; ?>>Pre Casa</option>
            <option value="Junior Casa" <?php echo ($row['grade'] == "Junior Casa")? 'selected' : '' ; ?>>Junior Casa</option>
            <option value="Senior Casa"<?php echo ($row['grade'] == "Senior Casa")? 'selected' : '' ; ?>>Senior Casa</option>
            <option value="Grade 1"<?php echo ($row['grade'] == "Grade 1")? 'selected' : '' ; ?>>Grade 1</option>
            <option value="Grade 2"<?php echo ($row['grade'] == "Grade 2")? 'selected' : '' ; ?>>Grade 2</option>
            <option value="Grade 3"<?php echo ($row['grade'] == "Grade 3")? 'selected' : '' ; ?>>Grade 3</option>
            <option value="Grade 4"<?php echo ($row['grade'] == "Grade 4")? 'selected' : '' ; ?>>Grade 4</option>
            <option value="Grade 5"<?php echo ($row['grade'] == "Grade 5")? 'selected' : '' ; ?>>Grade 5</option>
            <option value="Grade 6"<?php echo ($row['grade'] == "Grade 6")? 'selected' : '' ; ?>>Grade 6</option>
            <option value="Grade 7"<?php echo ($row['grade'] == "Grade 7")? 'selected' : '' ; ?>>Grade 7</option>
            <option value="Grade 8"<?php echo ($row['grade'] == "Grade 8")? 'selected' : '' ; ?>>Grade 8</option>
            <option value="Grade 9"<?php echo ($row['grade'] == "Grade 9")? 'selected' : '' ; ?>>Grade 9</option>
            <option value="Grade 10"<?php echo ($row['grade'] == "Grade 10")? 'selected' : '' ; ?>>Grade 10</option>
            <option value="Grade 11"<?php echo ($row['grade'] == "Grade 11")? 'selected' : '' ; ?>>Grade 11</option>
            <option value="Grade 12"<?php echo ($row['grade'] == "Grade 12")? 'selected' : '' ; ?>>Grade 12</option>

        </select>

            <label>Birthday</label>
             <input type="date" class="m-wrap" name="bday" value="<?php echo strftime('%Y-%m-%d',
  strtotime($row['birthDay'])); ?>">
            


            <label>School Year</label>
            <select name="schoolYear" id="schoolYear">
                <option value="2018-2019" <?php echo ($row['school_year'] == "2018-2019")? 'selected' : '' ; ?>>2018-2019</option>
                <option value="2019-2020"<?php echo ($row['school_year'] == "2019-2020")? 'selected' : '' ; ?>>2019-2020</option>
                <option value="2020-2021"<?php echo ($row['school_year'] == "2020-2021")? 'selected' : '' ; ?>>2020-2021</option>
                <option value="2021-2022"<?php echo ($row['school_year'] == "2021-2022")? 'selected' : '' ; ?>>2021-2022</option>
            </select>


        <input type="submit" name="submit" value="Update">
        
    </form>
    
    
  




</body>
</html>