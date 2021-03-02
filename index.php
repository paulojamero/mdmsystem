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

//School year QUERY
$sql="SELECT school_year from student_list";
$q=mysqli_query($con, $sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  
</head>
<body>
<div class="jumbotron jumbotron-fluid">
<div class="container">

<?php 
      if (isset($_SESSION['UserLogin'])){ ?>
         <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php } else { ?>
             <a href="login.php" class="btn btn-primary">Login</a>
        
            <?php    } ?>  
    <h1>Student Management System</h1>
    <h3>Master List</h3>

   <!-- SEARCH -->
   <form action="result.php" class="get">
     <input type="text" name="search" id="search">


     School Year <?php
                                  
       $sql = "SELECT DISTINCT school_year FROM student_list ";
       $result = $con->query($sql);

       $total = $result->num_rows;

       if ($total > 0) {
    
       echo "<select name='schoolYear'>";
        // output data of each row

       while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['school_year'] . "'>" . $row['school_year'];  "</option>";
        }
      echo "</select>";
      } 
       ?>

        <button type="submit" class="btn btn-primary">search</button>
    </form>

    

    <a href="add.php" class="btn btn-primary">Add New</a>
    <a href="reserve.php" class="btn btn-info">View Reserve</a>
    </div>
    </div>
 

  
  <div class="container">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
               
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>GENDER</th>
                <th>GRADE</th>
                <th>School Year</th>
                <th>Image</th>
                <th>Actions</th>
                
            </tr>
        </thead>
                         <!-- PAGINATION -->
                         <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center " style="margin:20px 0">
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
              $image = $stud['image_name'];
              $image_src = "uploads/".$image;
            ?>
            <tr>
                  
                    <td><?php echo $stud['firstName']; ?></td>
                    <td><?php echo $stud['lastName']; ?></td>
                    <td><?php echo $stud['gender']; ?></td>
                    <td><?php echo $stud['grade']; ?></td>
                    <td><?php echo $stud['school_year']; ?></td>
                    <td> <img src='<?php echo $image_src; ?>' class="img-fluid" height="30px" width="30px";> </td>
                    <td><a href="details.php?ID=<?php echo $stud['id']; ?>">VIEW</a></td> <!--GET PARAMETER AS ID -->
            
            </tr>
            
          <?php  } ?>
        
        </tbody>
    </table>


    </div>
                            <!-- PAGINATION -->
    <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center" style="margin:20px 0">
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



          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>