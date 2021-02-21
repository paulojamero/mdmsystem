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
    $lName = $_POST['lasttname'];
    $gender = $_POST['gender'];

    $sql = "UPDATE student_list SET firstName= '$fName', lastName = '$lName', gender = '$gender' WHERE id = '$id' ";

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
        <input type="text" name="lasttname" id="lastname" value="<?php echo $row['lastName']; ?>">

        <label>Gender</label>
        <select name="gender" id="gender">   <!-- IF STATEMENT -- shorthand -- Good for dropdown -->
            <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '' ;?> 
            >Male</option> 
            <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '' ;?>
            >Female</option>
        
        </select>


        <input type="submit" name="submit" value="Update">
    
    
    </form>
  







</body>
</html>