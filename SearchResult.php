<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>SearchResult</title>
    <?php
    session_start();
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

    if(!isset($_COOKIE['user']))
    {
    session_destroy();
    header('location:http://localhost/NEW%20FOLDER/index.php');
   }


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else{
      //echo "Connection Succeeded";
    }

    if(isset($_GET['genre']))
    {
      $id = $_GET['genre'];
      // echo $id;
      $sql="SELECT * FROM `books` WHERE `Genre` LIKE '%$id%' ORDER BY rating DESC";
      $result = mysqli_query($conn, $sql);
      $count=mysqli_num_rows($result);
      // echo $count;
      while($record = mysqli_fetch_assoc($result))
        {
          $records[]=$record;
        }
    }
    elseif(isset($_GET['all']))
    {
      $sql="SELECT * FROM `books` ORDER BY rating DESC";
      $result = mysqli_query($conn, $sql);
      $count=mysqli_num_rows($result);
      // echo $count;
      while($record = mysqli_fetch_assoc($result))
        {
          $records[]=$record;
        }
    }
    else
    {
      if (isset($_GET["submit"])) {
        if(isset($_GET['exampleRadios']))
        {
        $radio_option=$_GET['exampleRadios'];
        $query=$_GET['query'];
        $searchsql="SELECT * FROM `books` WHERE `$radio_option` LIKE '%$query%' ORDER BY rating DESC ";
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
          $searchsql="SELECT * FROM `books` WHERE Title like '%$query%' or Genre like '%$query%' or Author like '%$query%' ORDER BY rating DESC";
          $result = mysqli_query($conn, $searchsql);
          $count=mysqli_num_rows($result);
          while($record = mysqli_fetch_assoc($result))
        {
          $records[]=$record;
        }
        }
      
      
      }
      elseif($_POST['search'])
      {
        $searchbar=$_POST['search'];
  
        //echo $_POST['search'];
  
        $sql="SELECT * FROM `books` WHERE `Title` LIKE '%$searchbar%' ORDER BY rating DESC";
        $result = mysqli_query($conn, $sql);
        $count=mysqli_num_rows($result);
        while($record = mysqli_fetch_assoc($result))
        {
          $records[]=$record;
        }
      
      }
      else
      {
        $count=0;
      }
    }

    
  // if (isset($_POST["submit"])) {
  //  $_SESSION['isbn']=$_POST['isbn'];
  //  }

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
    <!-- <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-4">
          <a class="navbar-brand" href="home.html"><img src="img/Logo_yellow.png" width="75%" alt="logo to be inserted"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="home.html">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bookshelf.html">BookShelf</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Catagories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action and Adventure</a>
                  <a class="dropdown-item" href="#"> Classic</a>
                  <a class="dropdown-item" href="#"> Non-Fiction</a>
                  <a class="dropdown-item" href="#"> Suspense and Thriller</a>
                  <a class="dropdown-item" href="#"> Comic and Graphic Novel</a>
                  <a class="dropdown-item" href="#"> Fantasy</a>
                  <a class="dropdown-item" href="#"> Science Fiction</a>
                  <a class="dropdown-item" href="#"> Drama</a>
                  <a class="dropdown-item" href="#"> Horror</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="catagories.html">All Genre</a>
                </div>
              </li>
    
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-warning my-2 my-sm-0" type="submit">Search</button>
            </form>
    
            <ul class="nav navbar-nav navbar-right mx-2">
              <li class="mx-2"><a href="friendlist.html"><span><img src="" alt="Friends"></span></a></li>
              <li class="mx-2"><a href="user.html"><span></span><img src="" alt="My-Profile"></a></li>
            </ul>
    
    
          </div>
        </nav>
    </div> -->

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
            echo $row;
            ?>
          <img src="uploaded/<?php echo $row['photo'];?>" class="rounded-circle"  alt="USERNAME" width="70px">
        
        </a></li>
        </ul>


      </div>
     </nav>
<!-- </div> -->

     <div class="d-flex flex-column bd-highlight mb-3 pt-4">

      <form method="get" class="search" id="theForm">
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
      


      <div class="container pt-4">
      
      <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php if($count){
        // while($record = mysqli_fetch_assoc($result))
        // {
        //   $records[]=$record;
        // }
        ?>
        <?php foreach ($records as $row): ?>
        <div class="col">
          <div class="card bg-light" style="width: 18rem;">
            <img src="uploaded/<?php echo $row['Photo'];?>" class="mx-5" width="200px" height="250px">
            <div class="card-body bg-light">
              <h5 class="card-title"> <?=$row['Title']?> </h5> 
              <p class=" fs-5 card-text">by <small class="text-muted"><?=$row['Author']?></small></p>
              
              <p class="card-text"><small class="text-muted"><?=$row['Genre']?></small> </p>
              <p class="card-text"><small class="text-muted"><?=$row['Rating']?></small> </p>

            </div>
            
            <div class="card-body d-flex justify-content-around text-center">
              <!-- <form action="http://localhost/NEW%20FOLDER/book.php"method="post">
                <input type="hidden" id="isbn" name="isbn" value="<?php echo $row['ISBN']; ?>">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">
                  See Details</button>
              </form> -->
              <a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $row['ISBN']; ?>">
              <button class="btn btn-primary">Details</button></a>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>