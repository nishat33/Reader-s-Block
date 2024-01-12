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
  <title>Write a Review</title>



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
      // echo "Connection successful. <br>";
    }

    if(!isset($_COOKIE['user']))
    {
    session_destroy();
    header('location:http://localhost/NEW%20FOLDER/index.php');
   }
    $user= $_SESSION['user'];
    if(isset($_GET['update']))
    {
         $isbn=$_GET['update'];
    }
 
    //echo $isbn;

    //echo $user."<br>".$isbn;

    
      $sql="SELECT * FROM `books` WHERE `ISBN` LIKE '%$isbn%'";
      $result = mysqli_query($conn, $sql);
      $record = mysqli_fetch_assoc($result);
      $title=$record['Title'];
      // echo $title;
  
    if(isset($_POST['submit'])){
      
      $quantity= $_POST['quantity'];
      $comment= $_POST['comment'];
      // echo $quantity;
      // echo $comment;
      $sql= $sql="INSERT INTO review (isbn,title, username, review, rating) VALUES ('$isbn','$title','$user','$comment','$quantity')";
      $result=mysqli_query($conn, $sql);
       if ($result)
       {

        echo '<div class="alert alert-success alert-dismissible" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Review uploaded Successfully<?php echo $name; ?></strong> 
        </div>';    
       } 
    else {
      echo '<div class="alert alert-danger alert-dismissible" >
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Failed to upload<?php echo $name; ?></strong> 
      </div>';
    }
  }
      

    

  ?>


</head>

<body class="bg-light">
<!-- <div class="container-fluid"> -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-4">
      <a class="navbar-brand" href="http://localhost/NEW%20FOLDER/home.php"><img src="img/Logo_yellow.png" width="75%" alt="logo to be inserted"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="http://localhost/NEW%20FOLDER/home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/NEW%20FOLDER/bookshelf.php">BookShelf</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">
              Catagories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre= <?php echo 'action';?>">Action and Adventure</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'classic';?>"> Classic</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'nonfic';?>"> Non-Fiction</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'suspence';?>"> Suspense and Thriller</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'comic';?>"> Comic and Graphic Novel</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'Fantasy';?>"> Fantasy</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'scifi';?>"> Science Fiction</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'drama';?>"> Drama</a>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?genre=<?php echo 'horror';?>"> Horror</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="http://localhost/NEW%20FOLDER/SearchResult.php?all">All Genre</a>
            </div>
          </li>

        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="http://localhost/NEW%20FOLDER/SearchResult.php">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search" name="search">
          <button class="btn btn-warning my-2 my-sm-0" type="submit" id="submit" name="submit">Search</button>
        </form>

        <ul class="nav navbar-nav navbar-right ml-5">
          <form action="http://localhost/NEW%20FOLDER/friendlist.php" method=post>
          <input type="hidden" id="hidden" name="hidden" value=0>
          <li class="mx-2"><button type="submit" class="btn no-border"> <img src="img/friends.png" alt="Friends" class="rounded-circle" width="70px"></button></li>
          </form>
          <li class="mx-2"><a href="http://localhost/NEW%20FOLDER/user.php">
            <?php
            $userinfo=$_SESSION['user'];        
            $sql="SELECT * FROM user WHERE username='$userinfo'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
          <img src="uploaded/<?php echo $row['photo'];?>" class="rounded-circle"  alt="USERNAME" width="70px">
        
        </a></li>
        </ul>


      </div>
     </nav>
    <!-- </div> -->
  <div class="d-flex flex-column justify-content-around">

    <div class="container-fluid">
      <p class="fs-4 mx-3">Bookname > Review</p>
    <a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $isbn; ?>" class="mx-5 float-right">
    <button class="btn btn-warning">Back</button></a>
    </div>
    

    <div class="container mx-4">
      <figure class="figure">
      <img src="uploaded/<?php echo $record['Photo'];?>" class="mx-5" width="150px" height="200px">
        <figcaption class="figure-caption text-center">
          <?php echo $record['Title']; ?>
        </figcaption>
      </figure>
    </div>

  </div>

  <div class="form">
    <form action="" class="rating" method="post">
      <div class="container-fluid d-flex my-rating float-inline">
        <label class="mx-2" for="quantity">My Rating :</label>
        <input type="number" id="quantity" name="quantity" min="1" max="5">
      </div>
      <div class="review container pt-3">
        <div class="d-flex form container-fluid justify-content-start">
          <label for="comment">What do you Think? Share with us:</label><br>
        </div>
        <div class="d-flex form-answer container justify-content-center">
          <textarea class="form-control" rows="10" id="comment" name="comment" placeholder="Write a review"></textarea>
        </div>
      </div>
     
      <div class="btn pt-3 container d-flex justify-content-center">
        <button type="submit" class="btn btn-success btn-lg rounded-pill" name="submit" id="submit">
          Submit
        </button>
      </div>
    </form>
        
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