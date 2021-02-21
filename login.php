<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    include_once("connections/connection.php");

    $con = connection(); // create new variable with connection function


  if(isset($_POST['login']) && ($_SESSION['Access'] = "administrator")){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password' ";
    
    $user = $con->query($sql) or die ($con->error); //query the statement
    $row = $user->fetch_assoc(); //fetch data

    $total = $user->num_rows; //view row count if meron

    if($total > 0){   //if data is greater than 0, STORE this data
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];  
       
        echo header("Location: index.php");
        
    }  else {

        echo "No User found.";
    };

  }

  
  if(isset($_POST['submitRef']) && ($_SESSION['Access'] == "applicant")){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password' ";
    
    $user = $con->query($sql) or die ($con->error); //query the statement
    $row = $user->fetch_assoc(); //fetch data

    $total = $user->num_rows; //view row count if meron

    if($total > 0){   //if data is greater than 0, STORE this data
        $_SESSION['ReferLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];  
       
        echo header("Location: application_details.php");
        
    }  else {

        echo "No Reference number found.";
    };

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
        <h1>Admin Login</h1>
        <br>
        <form action="" method="post">
            <label>Username</label>
            <input type="text" name="username" id="username">
            <label>Password</label>
            <input type="text" name="password" id="password">
            <button type="submit" name="login">LOGIN</button>
        </form>
        <br/>
        <br/>



        <h1>Application Process Login</h1>
    <br/>
    <br/>
 <br>
        
        <form action="application_details.php" method="post">
         <input type="hidden" name="ID" id="id">
         <input type="text" name="search" id="search">
         <input type="text" name="refPassword" id="refPassword">
        <button type="submit" name="submitRef">search</button>
    </form>
</body>
</html>