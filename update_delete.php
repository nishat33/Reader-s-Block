<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="javascript/signup.js"></script>
  <title>Edit Book</title>

  <?php
    session_start();
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else{
      //echo "Connection Succeeded";
    }


    
  if(isset($_GET['all'])){
    $sql="SELECT * FROM `books`";
    $result = mysqli_query($conn, $sql);
    $count=mysqli_num_rows($result);
    while($record = mysqli_fetch_assoc($result))
    {
        $records[]=$record;
    }
    
  }
  else{
     if (isset($_GET["submit"])) {
        if(isset($_GET['exampleRadios'])){
       $radio_option=$_GET['exampleRadios'];
       $query=$_GET['query'];
        $searchsql="SELECT * FROM `books` WHERE `$radio_option` LIKE '%$query%'";
        $result = mysqli_query($conn, $searchsql);
        $count=mysqli_num_rows($result);
        while($record = mysqli_fetch_assoc($result))
        {
          $records[]=$record;
       }
      }
      else
        {
          $query=$_GET['query'];
          $searchsql="SELECT * FROM `books` WHERE Title like '%$query%' or Genre like '%$query%' or Author like '%$query%'";
          $result = mysqli_query($conn, $searchsql);
          $count=mysqli_num_rows($result);
          while($record = mysqli_fetch_assoc($result))
        {
          $records[]=$record;
        }
        }
    }
    elseif (!isset($_GET['all'])) {
       $sql="SELECT * FROM `books`";
       $result = mysqli_query($conn, $sql);
       $count=mysqli_num_rows($result);
       while($record = mysqli_fetch_assoc($result))
       {
         $records[]=$record;
       }
       
    }

  }

    
  

  if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    echo $id;
        $sql="DELETE from books where ISBN LIKE '$id'";
        mysqli_query($conn, $sql);
        //header('location:http://localhost/NEW%20FOLDER/friendlist.php');
        header('Location: ' . $_SERVER["HTTP_REFERER"] );
  };

  
  ?>


</head>
<body class="bg-light">
<a href="http://localhost/NEW%20FOLDER/admin_home.php" class="float-right pt-3 mx-3">
              <button class="btn btn-info">Back</button></a>

  <div class="container">
      <div class="container-fluid pt-5">
        <form method="get" class="search mx-5">
          <div class="input-group mb-3 container">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="query" name="query">
            <button class="btn btn-success my-2 my-sm-0" type="submit" id="submit" name="submit">Search</button>
            </div>
            <div class="container">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Title" >
                <label class="form-check-label" for="exampleRadios1">
                  Book
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Author">
                <label class="form-check-label" for="exampleRadios2">
                  Author
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="Genre">
                <label class="form-check-label" for="exampleRadios3">
                  Genre
                </label>
              </div>
              
            </div>
      
        </form>
      </div>
      <div class="container mt-2 mx-5">
        <a href="http://localhost/NEW%20FOLDER/update_delete.php?all" class="">
        <button class="btn btn-info">Show All Results</button>
        </a>
      </div>
  
  </div>
    
    <div class="container pt-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php if($count){
        ?>
        <?php foreach ($records as $row): ?>
        <div class="col">
          <div class="card bg-light" style="width: 18rem;">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <img src="uploaded/<?php echo $row['Photo'];?>" class="mx-5" width="200px" height="250px">
            <div class="card-body bg-light">
              <h5 class="card-title"> <?=$row['Title']?> </h5> 
              <p class=" fs-5 card-text">by <small class="text-muted"><?=$row['Author']?></small></p>
              
              <p class="card-text"><small class="text-muted"><?=$row['Genre']?></small> </p>
              <p class="card-text"><small class="text-muted"><?=$row['Rating']?></small> </p>
            </div>
            <div class="card-body d-flex justify-content-around text-center">
            <a href="http://localhost/NEW%20FOLDER/admin_edit.php?update=<?php echo $row['ISBN']; ?>">
              <button class="btn btn-secondary">Update</button></a>
              <a href="http://localhost/NEW%20FOLDER/update_delete.php?delete=<?php echo $row['ISBN']; ?>">
              <button class="btn btn-danger">Delete</button></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?> 
        <?php }
      
        else { ?>
        <div class="msg">
          <p class="strong">No search result found.</p>
        </div>

      <?php } ?>    
      </div>
      
     </div>
    
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
  crossorigin="anonymous"></script>
</body>

</html>