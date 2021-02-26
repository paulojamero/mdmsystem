<?php 
    include_once("connections/connection.php");
    include_once("generate_reference.php");

    $con = connection();

if(isset($_POST['rsubmit'])) {

    $refNum = $_POST['refNum'];
    $rFName = $_POST['rFName'];
    $rLName = $_POST['rLName'];
    $rGrade = $_POST['rGrade'];
    $rGender = $_POST['rGender'];

    $sql = "INSERT INTO `student_reserve`(`referenceNum`,`rsFName`, `rsLName`, `rsGrade`, `rsGender`) VALUES ('$refNum','$rFName', '$rLName', '$rGrade', '$rGender') "; //DONT FORGET TO ENCLOSE VALUES
    
    $reference = $con->query($sql) or die ($con->error);
  //  $row = $reference->fetch_assoc();
   // $ref = $reference->num_rows;
    echo header("Location: reserve_form.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
</head>
<body>

            <h1>Reservation Form</h1>
    
       <form action="reserve_form.php" method="post">

        <input type="hidden" name="refNum" value="<?php echo "MDM" . random_strings(5); ?>">
            
       <label>First Name</label>
        <input type="text" name="rFName">
        
        <label>Last Name</label>
            <input type="text" name="rLName">

        <label>Grade Level</label> 
           <select name="rGrade">
            <option value="gr1">Grade 1</option>
            <option value="gr2">Grade 2</option>
            <option value="gr3">Grade 3</option>
            <option value="gr4">Grade 4</option>
            <option value="gr5">Grade 5</option>
           </select>

        <label>Gender</label>
            <select name="rGender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <input type="submit" name="rsubmit" value="Submit Reservation">

       </form>



</body>
</html>
