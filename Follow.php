<?php
    session_start();
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
?>
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
  <title>follow</title>

  <?php
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
   }
  else{
  //echo "Connection Succeeded";
  }

  if(!isset($_COOKIE['user']))
    {
    session_destroy();
    header('location:http://localhost/NEW%20FOLDER/index.php');
   }
  $_SESSION['follow']="Follow";
  $_SESSION['following']='Following';

    //$_SESSION['search_user']= $_POST["username"];
    

  if(isset($_GET['details']))
  {

    $search_user=$_GET['details'];
    $_SESSION['search']=$search_user;
    //echo "from follow".$search_user;
    $sql="SELECT * FROM user where username like '%$search_user%'";
    $result=mysqli_query($conn,$sql);
    $record=mysqli_fetch_assoc($result);
  }
  else
  {
    $search_user=$_SESSION['search'];
    //echo $search_user;
    $sql="SELECT * FROM user where username like '%$search_user%'";
    $result=mysqli_query($conn,$sql);
    $record=mysqli_fetch_assoc($result);
  }
  
  if(isset($_GET['follow'])){
    $id = $_GET['follow'];
    //$id = $search_user;
    $user= $_SESSION['user'];
    echo "id is ".$id;
    $search_user=$id;
    if(exists($id))
    {
        $sql="DELETE from relation where followed ='$id' and follower='$user'";
        mysqli_query($conn, $sql);
        header('location:http://localhost/NEW%20FOLDER/Follow.php');
        header('Location: '.$_SERVER["HTTP_REFERER"] );
    }
    else
    {
        $sql="INSERT INTO relation (followed,follower) VALUES ('$id','$user')";
        mysqli_query($conn, $sql);
        header('location:http://localhost/NEW%20FOLDER/Follow.php');
        header('Location: '.$_SERVER["HTTP_REFERER"] );
    }
    
 };

 function exists($user)
 {
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
    $login=$_SESSION['user'];
    $sql="SELECT * FROM relation where followed like '$user' and follower like '$login'";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
    if($count)
    {
        return true;
    }
    else
    {
        return false;
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

  <div class="pt-3 d-flex book_details justify-content-center mx-5  ">

    <div class="img float-left mx-5">
    <img src="uploaded/<?php echo $record['photo'];?>" class="rounded-circle" width="250px" height="250px">
      <div class="container text-center pt-5">
        <!-- <button class="btn btn-danger">Follow</button> -->
        <a href="http://localhost/NEW%20FOLDER/Follow.php?follow=<?php echo $record['username']; ?>">
            <button class="btn btn-success"><?php 
                $r=$record['username'];
                  if(exists($r)){
                  echo $_SESSION['following'];
                  }
                  else
                  {
                    echo $_SESSION['follow'];
                  }
              ?>
            </button>
        </a>
      </div>

    </div>

    <div class="d-flex flex-column mr-5 flex-grow-1">
      <div class="d-flex flex-column">
        <p class="pt-3 display-6">User Details</p>
        <p class="fw-bold">
          <?php
          $r=$record['username'];
          $num="SELECT COUNT(review_id) as total from review where username like '$r'";
          $resultnum=mysqli_query($conn,$num);
          $res=mysqli_fetch_assoc($resultnum)

          ?>
          <a href="http://localhost/NEW%20FOLDER/RR.php?rr=<?php echo $record['username'];?>" class="text-decoration-none link-dark fw-bold mx-2" >Reviews</a><small class="fw-bold">(<?php echo $res['total']; ?>)</small>.
          <a href="http://localhost/NEW%20FOLDER/RR.php?rr=<?php echo $record['username'];?>" class="text-decoration-none link-dark  mx-2" >Rating</a><small class="fw-bold">(<?php echo $res['total']; ?>)</small>.
        </p>
      </div>
      <hr>
      <div class="container pt-2">
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-light"><?php echo "Username: ".$record['username'] ?></li>
          <li class="list-group-item bg-light"><?php echo "First Name: ".$record['firstname'] ?></li>
          <li class="list-group-item bg-light"><?php echo "Last Name: ".$record['lastname'] ?></li>
          <li class="list-group-item bg-light"><?php echo $record['bio'] ?></li>
        </ul>
      </div>

    </div>

  </div>

  <div class="d-flex justify-content-around">
    <div class="d-flex flex-fill  flex-column mx-5 books pt-3 ">
      <p class="display-6">Favorites:</p>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
          $userinfo=$record['username'];
          $sql="SELECT * FROM books where ISBN in (SELECT isbn from favorite where username like '$userinfo');
          ";
          $resultsql=mysqli_query($conn,$sql);
          $count=mysqli_num_rows($resultsql);
        
          if($count){
            while($record = mysqli_fetch_assoc($resultsql))
          {
            $records2[]=$record;
          }
          ?>
          <?php foreach ($records2 as $row2): ?>
         <div class="col">
          <div class="card bg-light" style="width: 14rem;">
            <img src="uploaded/<?php echo $row2['Photo'];?>" class="card-img-top " width="150px" height="250px">
            <div class="card-body">
              <h5 class="card-title">Book Title: <?php echo $row2['Title'];?></h5>
              <p class="card-text"><small>Author Name: <?=$row2['Author']?></small></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php }
      
        else { ?>
        <div class="msg">
          <p class="strong">The User Doesn't Have Any Favorite Book Yet!.</p>
        </div>

      <?php } ?> 
      </div>
    </div>

    <div class="d-flex pt-3">
      <div class="vr"></div>
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