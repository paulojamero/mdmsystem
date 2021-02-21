<?php 

//
     if(!isset($_SESSION)){
        session_start();
    }
//if naka set ang userLogin
    if(isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator" && ($_SESSION['UserLogin'])){   //Only the user with this 'ACCESS' level can view the data
        echo "Welcome"." ".$_SESSION['UserLogin']."<br>"; 
        echo "Account:"." ".$_SESSION['Access']."<br><br>";

    } else { 
        echo header("Location: index.php");
    };


    //
    include_once("connections/connection.php");

    $con = connection(); // create new variable with connection function

    $id = $_GET['ID'];



$sql = "SELECT * FROM student_reserve WHERE id = '$id'";
$students = $con->query($sql) or die ($con->error);

//yung result ilalagay sa row
$row = $students->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Details</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <a href="reserve.php"> <-Back </a>
  

    <!-- DELETE BUTTON HIDDEN TO NOT ADMIN USER -->
        <?php 
            if ($_SESSION['Access'] == "administrator"){ ?>
                <form action="delete.php" method="post">
                <button class="submit" name="delete">DELETE</button>

        <?php    } ?>
    
        <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
    </form>

   <br>
   
    <h2><?php echo $row['rsFName']; ?> <?php echo $row['rsLName'];?></h2>
    

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Grade</th>
                <th>Gender</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><?php echo $row['rsFName']; ?></td>
                <td><?php echo $row['rsLName'];?></td>
                <td><?php echo $row['rsGrade'];?></td>
                <td><?php echo $row['rsGender'];?></td>
                <td><?php echo $row['rsDate'];?></td>
              
            </tr>
        
        </tbody>
    
    
    </table>

</body>
</html>