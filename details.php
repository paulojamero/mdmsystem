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



$sql = "SELECT * FROM student_list WHERE id = '$id' ";
$students = $con->query($sql) or die ($con->error);

//yung result ilalagay sa row
$row = $students->fetch_assoc();

//image
$image = $row['image_name'];
$image_src = "uploads/".$image;



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
    <a href="index.php"> <-Back </a>
    <a href="edit.php?ID=<?php echo $row['id'];?>">Edit</a>

    <!-- DELETE BUTTON HIDDEN TO NOT ADMIN USER -->
        <?php 
            if ($_SESSION['Access'] == "administrator"){ ?>
                <form action="delete.php" method="post">
                <button class="submit" name="delete">DELETE</button>

        <?php    } ?>
    
        <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
    </form>

   <br>
   
    <h2><?php echo $row['firstName']; ?> <?php echo $row['lastName'];?></h2>
    

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Grade</th>
                <th>Birthday</th>
                <th>School Year</th>
                <th>Image</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><?php echo $row['firstName']; ?></td>
                <td><?php echo $row['lastName'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['grade'];?></td>
                <td><?php echo $row['birthDay'];?></td>
                <td><?php echo $row['school_year'];?></td>

                
                <td><img src='<?php echo $image_src; ?>' height="50px" width="50px";> </td>
            
            
            </tr>
        
        </tbody>
    
    
    </table>

</body>
</html>