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
  <title>Sign In</title>

  <?php

  session_start();

  
    if(isset($_SESSION['signup']))
    {
      echo '<div class="alert alert-success  alert-dismissible" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Signup successful, Please log in with new email and password</strong> 
    </div>';
     
    }
    else if(!isset($_SESSION['user']))
    {
    echo '<div class="alert alert-danger  alert-dismissible" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>You are not logged in, please log in</strong> 
    </div>';
    }
    else
    {
      echo '<div class="alert alert-danger  alert-dismissible" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Signup Failed, Please Try Again!</strong> 
    </div>';
    }

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword ="";
$dbName="webproject";
$conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo 'Connected successfully'.'<br>';


       
       if(isset($_POST['submit']))
      {
          $email= $_POST['inputEmail'];
          $password= $_POST['inputPassword'];
      
          $sql="SELECT pass, username FROM user WHERE email='$email'";
          $result = mysqli_query($conn, $sql);
      
          if(mysqli_num_rows($result)> 0)
          {
             $row = mysqli_fetch_assoc($result);
            if($password==$row['pass'])
            {
              $_SESSION['user']=$row['username'];
              $cookie_name="user";
              $cookie_value=$row['username'];
              setcookie($cookie_name, $cookie_value, time()+(30*60));
              header("Location: http://localhost/NEW%20FOLDER/home.php"); 
              exit();
            }
          else{
            echo '<div class="alert alert-danger  alert-dismissible" >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Enter correct email and password</strong> 
            </div>';
            }
            
          }
      }

?>

 
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
  <div class="bg-light">
    <div class="d-flex justify-content-around">
      <div class="container pt-5">
        <div class="d-flex justify-content-center pt-3">
          <a href="#.html" class="dark">
            <img src="img/Logo3.png" alt="">
          </a>

        </div>

        <form class="form-signin pt-5" method="post">
          <div class="container text-center">
            <a href="home.html">
              <img class="w-50" src="img/Logo_Black.png" alt="logo">
            </a>

          </div>
          <div class="form-stuffs pt-5">
            <h1 class="h3 mx-5 mb-3 font-weight-normal ">Please sign in</h1>
            <div class="mx-5 email pt-3">
              <label for="inputEmail" class="sr-only">Email</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required=""
                autofocus="" name="inputEmail">
            </div>
            <div class="mx-5 pass pt-3">

              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" autofocus="" name="inputPassword">
            
            </div>

            <div class="d-flex justify-content-center pt-4">
              <button class="btn btn-lg btn-primary btn-block w-25" type="submit" id="submit" name="submit">Sign in</button>
            </div>
          </div>

        </form>
        <p class="pt-3 strong mx-5"> Don't have an account?<a href="http://localhost/NEW%20FOLDER/signup.php" class="signup text-decoration-none strong">Click here</a></p>
        
      </div>

      <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner mx-5 px-5 ">
            <div class="carousel-item active">
              <img src="img/i5.jpg" class="d-block" alt="..." width="700" height="625">
              <div class="carousel-caption d-none d-md-block position-absolute top-50 mx-5">
                <h5>Reader's Block</h5>
                <p>Connect with your friends, see what they're reading.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/i6.jpg" class="d-block" alt="..." width="700" height="625">
              <div class="carousel-caption d-none d-md-block position-absolute top-50 mx-5">
                <h5>Reader's Block</h5>
                <p>Find books that matches your taste</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/i7.jpg" class="d-block" alt="..." width="700" height="625">
              <div class="carousel-caption d-none d-md-block position-absolute top-50 mx-5">
                <h5>Reader's Block</h5>
                <p>Rate and Review books, let others know you better.</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>


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