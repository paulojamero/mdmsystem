<?php
session_start();


if(isset($_POST['submitRef'])){
    $reference = $_POST['search'];
    $passwordRef = $_POST['refPassword'];

    $sqlRef = "SELECT * FROM application_accounts WHERE referenceNum = '$reference' AND referencePass = '$passwordRef' ";

    $userRef = $con->query($sqlRef) or die ($con->error);
    $rowRef = $userRef->fetch_assoc();

    $totalRef = $userRef->num_rows;

    if ($totalRef > 0) {
        $_SESSION['RefLogin'] = $rowRef['referenceNum'];

    
        echo header("Location: application_details.php");
        
    } else {
        echo "No reference found";
    }

} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
</head>
<body>

<h1>APPLICATION DETAILS</h1>


  <!-- SEARCH -->
  <form action="application_details.php" method="post">
         <input type="hidden" name="ID" id="id">
         <input type="text" name="search" id="search">
         <input type="text" name="refPassword" id="refPassword">
        <button type="submit" name="submitRef">search</button>
    </form>


</body>
</html>































