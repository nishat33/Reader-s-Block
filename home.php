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
  <title>Home</title>

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

$userinfo=$_SESSION['user'];        
$sql="SELECT * FROM user WHERE username='$userinfo'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
  $_SESSION['searchbar']=$_POST['search'];
}

$review_sql="SELECT username, title, review,photo,rating,ISBN,review_id FROM review NATURAL JOIN user where username 
in (SELECT followed FROM relation where follower like '$userinfo') ORDER BY review_id DESC ";
$review_result= mysqli_query($conn, $review_sql);
$count =mysqli_num_rows($review_result);

$book_sql="SELECT * FROM books NATURAL JOIN currently_reading where username 
IN (select followed from relation where follower LIKE '$userinfo') ORDER BY id DESC";
$book_result= mysqli_query($conn, $book_sql);
$count2 =mysqli_num_rows($book_result);

// print_r($_COOKIE);
// print_r($_SESSION);

if(isset($_GET['like'])){
  $id = $_GET['like'];
  //$id = $search_user;
  $user= $_SESSION['user'];
  //echo "id is ".$id;
  $search_user=$id;
  if(exists($id))
  {
      $sql="DELETE from likes where review_id ='$id' and username='$user'";
      mysqli_query($conn, $sql);
      header('location:http://localhost/NEW%20FOLDER/Follow.php');
      header('Location: '.$_SERVER["HTTP_REFERER"] );
  }
  else
  {
      $sql="INSERT INTO likes (review_id,username) VALUES ('$id','$user')";
      mysqli_query($conn, $sql);
      header('location:http://localhost/NEW%20FOLDER/Follow.php');
      header('Location: '.$_SERVER["HTTP_REFERER"] );
  }
  
};

function exists($id)
{
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
    $login=$_SESSION['user'];
    $sql="SELECT * FROM likes where review_id like '$id' and username like '$login'";
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
          <img src="uploaded/<?php echo $row['photo'];?>" class="rounded-circle"  alt="USERNAME" width="70px">
        
        </a></li>
        </ul>


      </div>
    </nav>
  <!-- </div> -->
  <?php
  if(isset($_COOKIE['user']))
  {?>
    <div class="alert alert-primary  alert-dismissible" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Welcome <?php echo $_COOKIE['user']; ?></strong>
    <p>This website uses Cookies!</p> 
    </div>
  <?php
  }
  else{
    session_destroy();
    header('location:http://localhost/NEW%20FOLDER/index.php');
  }
?>

  <div class="d-flex pt-5 justify-content-center">
    <div class="currently-reading container bg-light ml-4">
      <div class="topper container-fluid">
        <p class="fs-4">Update from Friends</p>
        <hr width="200px">
    </div>
      
      <ul class="list-group list-group-flush w-75">
      <?php if($count2){
          while($record2 = mysqli_fetch_assoc($book_result))
          {
            $records2[]=$record2;
          }
         ?>
         <?php foreach ($records2 as $row2): ?>

        <li class="list-group-item bg-light border-end">
          <div class="user">
            <p><a href="http://localhost/NEW%20FOLDER/Follow.php?details=<?php echo $row2['username']; ?>" class="text-decoration-none link-dark fs-4 mr-2"><?php echo $row2['username'];?></a>is reading :</p>
            <a href="book.html"><img src="uploaded/<?php echo $row2['Photo'];?>" class="" width="100px" height="150px"></a> <br>
            <a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $row2['ISBN']; ?>" class="text-decoration-none link-dark fs-6 pt-1"><?php echo $row2['Title'];?></a>
          </div>
        </li>

        <?php endforeach; ?>
      <?php }
      
      else { ?>
        <div class="msg">
          <p class="strong">None of your friends are currently reading anything .</p>
        </div>

      <?php } ?>

      </ul>

    </div>
    <div class="flex-grow-1 bg-light mb-3 pt-2 mr-5 pr-5" width="400px">
    <?php if($count){
          while($record = mysqli_fetch_assoc($review_result))
          {
            $records[]=$record;
          }
         ?>
         <?php foreach ($records as $row1): ?>
      <div class="rev border no-border my-1 pr-5 mr-5">
        <div class="container">
         <img src="uploaded/<?php echo $row1['photo'];?>" class="rounded-circle" width="100px" height="100px">
        </div>
        <p class="fs-4 pt-2"><a href="http://localhost/NEW%20FOLDER/Follow.php?details=<?php echo $row1['username'];?>" class="text-decoration-none link-dark mr-3"><?php echo $row1['username'];?></a>reviewed
        <a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $row1['ISBN'];?>" 
            class="ml-3 text-decoration-none link-dark disabled"><?php echo $row1['title'];?></a><br>
          <small class="fs-6">rated:</small> <?php echo $row1['rating'];?>
        </p>
        <div class="review mb-3">Review: 
        <?php echo $row1['review'];?>
        </div>
        <!-- <a href="" class="mx-5 text-decoration-none link-info">like</a> -->
      
          <a href="http://localhost/NEW%20FOLDER/home.php?like=<?php echo $row1['review_id']; ?>" >
            <button class="btn no-border"><?php 
                $r=$row1['review_id'];
                  if(exists($r)){
                  echo '<img src="img/heart.png" width="20px" height="20px">';
                  }
                  else
                  {
                    echo '<img src="img/heart1.png" width="20px" height="20px">';
                  }
              ?>
            </button>
        </a>
        <p class="total-like">
          <?php
              $r_id=$row1['review_id'];
              $total="SELECT COUNT(username) as total from likes where review_id like '$r_id'";
              $totresult=mysqli_query($conn,$total);
              $res=mysqli_fetch_assoc($totresult);
              echo $res['total']." person liked the review.";
          ?>
        </p>
       
        
        </div>
        <hr>
        <?php endforeach; ?>
       <?php }
      
      else { ?>
        <div class="msg">
          <p class="strong">None of friends have reviewed any book yet.</p>
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