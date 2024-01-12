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
  <title>Profile</title>

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
      // echo "Connection Succeeded";
    }

    if(!isset($_COOKIE['user']))
    {
    session_destroy();
    header('location:http://localhost/NEW%20FOLDER/index.php');
   }
    $user=$_SESSION['user'];
    $sql="SELECT * FROM user where username LIKE '$user'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    if(isset($_GET['logout'])){
       
      session_destroy();
      header('location:http://localhost/NEW%20FOLDER/index.php');
          //header('Location: ' . $_SERVER["HTTP_REFERER"] );
    };

    if(isset($_GET['delete'])){
      $id = $_GET['delete'];
      // echo $id;
          $sqldel="DELETE from review where review_id LIKE '$id'";
          mysqli_query($conn, $sqldel);
          //header('location:http://localhost/NEW%20FOLDER/friendlist.php');
          header('Location: ' . $_SERVER["HTTP_REFERER"] );
    };

?>



</head>

<body class="bg-light">

<?php
  if(!$_SESSION['user'])
  {
    header("Location: http://localhost/NEW%20FOLDER/index.php"); 
    exit();
  }
   ?>

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

  <div class="pt-3 d-flex book_details justify-content-center mx-5  ">
    
    <div class="img float-left mx-5">
    <img src="uploaded/<?php echo $row['photo'];?>" class="mx-5 rounded-circle" width="250px" height="250px">
      <div class="container text-center pt-5">
      <a href="http://localhost/NEW%20FOLDER/edit_profile.php">
        <button class="btn btn-secondary">Edit Profile</button></a>
    </div>
    </div>

    <div class="d-flex flex-column mr-5 flex-grow-1">
      <div class="d-flex flex-column">
        <p class="pt-3 display-6">User Details</p>
      
      </div>
      <hr>
      <div class="container pt-2">
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-light">UserName: <?php echo $row['username'];?></li>
          <li class="list-group-item bg-light">First Name: <?php echo $row['firstname'];?></li>
          <li class="list-group-item bg-light">Last Name: <?php echo $row['lastname'];?></li>
          <li class="list-group-item bg-light">Email-id: <?php echo $row['email'];?></li>
          <li class="list-group-item bg-light">Bio : <?php echo $row['bio'];?></li> 
        </ul>
      </div>

    </div>

    <div class="class pt-2">
      <a href="http://localhost/NEW%20FOLDER/user.php?logout">
        <button class="btn btn-info">log out</button></a>
    </div>

  </div>

<div class="d-flex justify-content-around pt-5">

<div class="container mx-3 px-5">
  <p class="display-6">My Reviews</p>    
        <?php 
        $sql_rev="SELECT * from review JOIN books on review.ISBN= books.ISBN where review.username='$user'";
        $result_rev=mysqli_query($conn,$sql_rev);
        $count=mysqli_num_rows($result_rev);
        
        if($count){
          while($record2 = mysqli_fetch_assoc($result_rev))
          {
            $records2[]=$record2;
          }
         ?>
        <?php foreach ($records2 as $row2): ?>
      <div class="d-flex flex-column border border-dark mb-2"> 
               <div class="container">
               <a href="http://localhost/NEW%20FOLDER/user.php?delete=<?php echo $row2['review_id']; ?>" class="float-right pt-3">
                <button class="btn btn-danger">Delete</button></a>
                <img src="uploaded/<?php echo $row2['Photo'];?>" width="100px" height="150px" class="pt-3">
               </div>
              <div class="container">
               <p class="fs-4 pt-2"><a href="" class="text-decoration-none link-dark mr-3"><?php echo $row2['username'];?></a>reviewed<a href=""
               class="ml-3 text-decoration-none link-dark"><?php echo $row2['title'];?></a><br>
                <small class="fs-6">rated:</small> <?php echo $row2['rating'];?>
              </p>
           </div>
         <div class="review mx-5 mb-3">
           <?php echo $row2['review'];?>
         </div>
         <div class="mx-4 mb-1"><p class="text-muted">
          <?php
            $r_id=$row2['review_id'];
            $total="SELECT COUNT(username) as total from likes where review_id like '$r_id'";
            $totresult=mysqli_query($conn,$total);
            $res=mysqli_fetch_assoc($totresult);
            echo $res['total']." person liked the review.";
          ?>
         </p></div>
      </div>
      <?php endforeach; ?>
      <?php }
      
      else { ?>
        <div class="msg">
          <p class="strong">You haven't posted any review yet.</p>
        </div>
      <?php } ?>
   </div>


    <?php

    $following="SELECT * from user where username in (SELECT followed from relation where follower LIKE '$user')";
    $result=mysqli_query($conn,$following);
    $count =mysqli_num_rows($result);
    // echo $count;

    ?>

    <div class="d-flex flex-column mr-5 books pt-3 pr-5">
      <p class="display-6 pt-2">Following</p>

      <?php
      
      if($count){
          while($record = mysqli_fetch_assoc($result))
          {
            $records[]=$record;
          }
         ?>
         <?php foreach ($records as $row1): ?>
        <div class="user">
         <div class="card mb-3" style="max-width: 500px;">
          <div class="row g-0">
            <div class="col-md-4 bg-light ">
            <img src="uploaded/<?php echo $row1['photo'];?>" class="img-fluid rounded-circle" width="150px" height="150px">
              <!-- <img src="img/i1.jpg" class="img-fluid rounded-circle" alt="..." width="200px" height="200px"> -->
            </div>
            <div class="col-md-8 bg-light">
              <div class="card-body bg-light">
                <h5 class="card-title"><?php echo $row1['username'];?></h5>
                <!-- <h6 class="card-text">Total books: </h6> -->
                <a href="http://localhost/NEW%20FOLDER/Follow.php?details=<?php echo $row1['username']; ?>">
              <button class="btn btn-secondary">details</button></a>
                <!-- <button type="button" class="btn btn-primary btn-sm">Details</button> -->
              </div>
            </div>
          </div>
        </div>
        <hr>
      </div>
      <?php endforeach; ?>
      <?php } 
      else 
      { ?>
        <div class="msg">
          <p class="fs-3"><strong>"You don't follow anyone currently"</strong></p>
          <p class="find"><a href="http://localhost/NEW%20FOLDER/friendlist.php" class="text-decoration-none">Find people to follow</a></p>
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