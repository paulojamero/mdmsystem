<?php 

//
     if(!isset($_SESSION)){
        session_start();
       
    }
//if naka set ang userLogin / if may naka login
    if(isset($_SESSION['UserLogin'])){
        echo "Welcome"." ".$_SESSION['UserLogin']."<br>"; 
        echo "Account:"." ".$_SESSION['Access'];

    } else { 
        echo header("Location: login.php");
    };

    //
    include_once("connections/connection.php");
    $con = connection(); // create new variable with connection function

    
    $sql = "SELECT * FROM student_reserve ORDER BY rsDate ASC";
   
    $students = $con->query($sql) or die ($con->error);
    //yung result ilalagay sa row
    $row = $students->fetch_assoc();







?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application List</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <h1>Application List</h1>
    <br/>
    <br/>
    <a href="index.php">Back</a>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>Date Reserved</th>
                <th>ACTIONS</th>
                
            </tr>
        </thead>

        <tbody> <!-- DISPLAY DATA ON TABLE -->
            <?php do { ?>
            <tr>
                <td><a href="reserve_details.php?ID=<?php echo $row['id']; ?>">VIEW></a></td> <!--GET PARAMETER AS ID -->
                <td><?php echo $row['rsFName']; ?></td>
                <td><?php echo $row['rsLName']; ?></td>
                <td><?php echo $row['rsDate']; ?></td>
                <td>
                    <form action="reserve_approve.php" method="POST">
                        <button type="submit" name="approve">Approve</button>
                        <input type="hidden" name="rsID" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="rFName" id="rFName">
                        <input type="hidden" name="rLName" id="rLName">
                        <input type="hidden" name="rGrade" id="rGrade">
                        <button type="submit" name="decline">Decline</button>
                    </form> 

                </td>
            </tr>
            <?php } while ($row = $students->fetch_assoc()); ?>


        </tbody>
    </table>







</body>
</html>