<?php 

//
     if(!isset($_SESSION)){
        session_start();
    }

    //
    include_once("connections/connection.php");

    $con = connection(); // create new variable with connection function
    $search = $_GET['search']; // SEARCH Variable
    $sql = "SELECT * FROM student_list WHERE firstName LIKE '%$search%' || lastName LIKE '%$search%' ORDER BY id DESC";  // % sa hulihan at unahan ng $search = contain yung word na nasearch
    $students = $con->query($sql) or die ($con->error);

    //yung result ilalagay sa row
    $row = $students->fetch_assoc();

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

    <h1>View Details of your Application</h1>
    <br/>
    <br/>
    <!-- SEARCH -->
    <form action="result.php" class="get">
     <input type="text" name="search" id="search">
        <button type="submit">search</button>
    </form>



    <?php 
        if (isset($_SESSION['UserLogin'])){ ?>
         <a href="logout.php">Logout</a>
            <?php } else { ?>
             <a href="login.php">Login</a>
        
            <?php    } ?>

    <a href="add.php">Add New</a>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>GENDER</th>
                
            </tr>
        </thead>

        <tbody> <!-- DISPLAY DATA ON TABLE -->
            <?php do { ?>
            <tr>
                <td><a href="details.php?ID=<?php echo $row['id']; ?>">VIEW</a></td> <!--GET PARAMETER AS ID -->
                <td><?php echo $row['firstName']; ?></td>
                <td><?php echo $row['lastName']; ?></td>
                <td><?php echo $row['gender']; ?></td>
            </tr>
            <?php } while ($row = $students->fetch_assoc()); ?>


        </tbody>
    </table>







</body>
</html>