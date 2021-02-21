<?php 

//
    
        session_start();
      
//if naka set ang userLogin / if may naka login

    //
    include_once("connections/connection.php");

    $con = connection(); // create new variable with connection function

    if(isset($_SESSION['ReferLogin'])){
        echo "Welcome"." ".$_SESSION['ReferLogin']."<br>"; 
        echo "Account:"." ".$_SESSION['Access'];

    }   else { 
        echo header("Location: login.php");
    };
 
 
       // $sql = "SELECT * FROM student_reserve WHERE referenceNum = '$search' ";
  


        //Displaying the data on 2 different table with same ID
       $sql = "SELECT * FROM student_reserve WHERE id = (SELECT id FROM accounts WHERE username ='".$_SESSION['ReferLogin']."') "; 


   
         $students = $con->query($sql) or die($con->error);
     
         $row = $students->fetch_assoc();
       
     

  

   

//yung result ilalagay sa row

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>

    <h1>Application Process Details</h1>


 <!-- SEARCH -->


    <br/>
    <br/>
    <?php 
      if (isset($_SESSION['UserLogin'])){ ?>
         <a href="logout.php">Logout</a>
            <?php } else { ?>
             <a href="login.php">Login</a>
        
            <?php    } ?>  

      

        
          

 
 

    <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">

    </form>



                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Grade</th>
                            <th>Gender</th>
                        </tr>
                    </thead>

                    <tbody>
                 <?php if(isset($_SESSION['ReferLogin'])){ ?>

                        <tr>
                            <td><?php echo $row['rsFName'];  ?></td>
                            <td><?php echo $row['rsLName'];  ?></td>
                            <td><?php echo $row['rsGrade'];  ?></td>
                            <td><?php echo $row['rsGender'];  ?></td>
                        
                        </tr>  
                        <?php } ?>


                    </tbody>              
                </table>

</body>
</html>