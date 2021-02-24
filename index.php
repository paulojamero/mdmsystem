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


//PAGINATION
 $showRecordPerPage = 25;

 if(isset($_GET['page']) && !empty($_GET['page'])){
     $currentPage = $_GET['page'];
 } else {
     $currentPage = 1;
 }

 $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
 $totalStudSQL = "SELECT * FROM student_list";
 $allStudResult = mysqli_query($con, $totalStudSQL);
 $totalStudRow = mysqli_num_rows($allStudResult);
 $lastPage = ceil($totalStudRow/$showRecordPerPage);
 $firstPage = 1;
 $nextPage = $currentPage + 1;
 $previousPage = $currentPage - 1;

$sql = "SELECT * FROM student_list ORDER BY addedAt DESC LIMIT $startFrom, $showRecordPerPage";
$students = mysqli_query($con, $sql);

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

    <h1>Student Management System</h1>
    <h3>Master List</h3>
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
    <a href="reserve.php">View Reserve</a>
    <table>
        <thead>
            <tr>
               
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>GENDER</th>
                <th>GRADE</th>

                <th>Actions</th>
                
            </tr>
        </thead>
                         <!-- PAGINATION -->
                         <nav aria-label="Page navigation">
              <ul class="pagination">
                <?php if($currentPage != $firstPage) {   ?>
                  <li class="page-item">
                      <a class="page-link" href="?page=<?php $firstPage?>" tabindex="-1" aria-label="Previous"> 
                        <span aria-hidden="true">First</span>
                      </a>
                  </li>
                  <?php } ?>
                  <?php if($currentPage >=2 ) {  ?>
                  <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $previousPage?>"><?php echo $previousPage ?></a></li>
                  <?php } ?>
                  <li class="page-item active">
                     <a class="page-link" href="?page=<?php echo $currentPage?>"><?php echo $currentPage ?></a></li>
                     
                  <?php if($currentPage != $lastPage) {  ?>
                    <li class="page-item">
                     <a class="page-link" href="?page=<?php echo $nextPage?>"><?php echo $nextPage ?></a></li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $lastPage?>" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                    </a>
                    </li>
                     <?php } ?>
              </ul>
          </nav>

        <tbody> <!-- DISPLAY DATA ON TABLE -->
          
          <?php 
            while($stud = mysqli_fetch_assoc($students)) {
            ?>
            <tr>
                  
                    <td><?php echo $stud['firstName']; ?></td>
                    <td><?php echo $stud['lastName']; ?></td>
                    <td><?php echo $stud['gender']; ?></td>
                    <td><?php echo $stud['grade']; ?></td>
                    <td><a href="details.php?ID=<?php echo $stud['id']; ?>">VIEW</a></td> <!--GET PARAMETER AS ID -->
            
            </tr>
          <?php  } ?>
        
        </tbody>
    </table>
                            <!-- PAGINATION -->
    <nav aria-label="Page navigation">
              <ul class="pagination">
                <?php if($currentPage != $firstPage) {   ?>
                  <li class="page-item">
                      <a class="page-link" href="?page=<?php $firstPage?>" tabindex="-1" aria-label="Previous"> 
                        <span aria-hidden="true">First</span>
                      </a>
                  </li>
                  <?php } ?>
                  <?php if($currentPage >=2 ) {  ?>
                  <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $previousPage?>"><?php echo $previousPage ?></a></li>
                  <?php } ?>
                  <li class="page-item active">
                     <a class="page-link" href="?page=<?php echo $currentPage?>"><?php echo $currentPage ?></a></li>
                     
                  <?php if($currentPage != $lastPage) {  ?>
                    <li class="page-item">
                     <a class="page-link" href="?page=<?php echo $nextPage?>"><?php echo $nextPage ?></a></li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $lastPage?>" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                    </a>
                    </li>
                     <?php } ?>
              </ul>
          </nav>

</body>
</html>