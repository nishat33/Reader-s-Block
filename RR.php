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
    <link rel="stylesheet" href="RR.css">
    <title>Review and Rating</title>

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

    $rr=$_GET['rr'];
    // echo $rr;

    $sql="SELECT * FROM `review` join books where review.ISBN=books.ISBN and username like '$rr';";
    $result=mysqli_query($conn,$sql);

    if(isset($_GET['like'])){
        $id = $_GET['like'];
        //$id = $search_user;
        $user= $_SESSION['user'];
        //echo "id is ".$id;
        $search_user=$id;
        if(exist($id))
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
      
      function exist($id)
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

        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-4">
            <a class="navbar-brand" href="home.html"><img src="img/Logo_yellow.png" width="75%"
                    alt="logo to be inserted"></a>
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        </nav> -->
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
            $result2 = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result2);
            ?>
          <img src="uploaded/<?php echo $row['photo'];?>" class="rounded-circle"  alt="USERNAME" width="70px">
        
        </a></li>
        </ul>


      </div>
     </nav>


    <div class="container d-flex flex-column">

        <p class="display-5 fw-italic"><a href="http://localhost/NEW%20FOLDER/Follow.php?details=<?php echo $rr;?>" class="text-decoration-none link-dark"><?php echo $rr;?></a> >
            <a href="" class="text-decoration-none link-secondary pe-none text-muted">Review and Rating</a>
        </p>
    </div>

    <div class="d-flex pt-5 flex-column align-items-center">
        <?php
        $count=mysqli_num_rows($result);
        // echo $count;
        if($count){
          while($record = mysqli_fetch_assoc($result))
          {
            $records[]=$record;
          }
          foreach ($records as $row): ?>
         <div class="flex-fill bg-light mb-3 pt-2 divi" style="max-width: 800px; max-height:500px; ">
            <div class="container">
                <img src="uploaded/<?php echo $row['Photo'];?>" class="mr-3 float-left" alt="" width="150px" height="200px">
            </div>
            <div class="container review">
                <p class="fs-4"><a href="http://localhost/NEW%20FOLDER/Follow.php?review=<?php echo $row['username'];?>" class="text-decoration-none link-dark mr-3"><?php echo $rr; ?>
                </a>reviewed<a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $row['ISBN'];?>"class="ml-3 text-decoration-none link-dark">
                <?php echo $row['title'];?></a><br>
                <small class="fs-6"><strong>Rated:</strong></small> <?php echo $row['rating'];?></p>
            </div>      
            

            <div class="review " style="max-width: 800px; max-height:500px;"><strong>Review:</strong>
                <?php echo $row['review'];?>
            </div>
            
            <a href="http://localhost/NEW%20FOLDER/home.php?like=<?php echo $row['review_id']; ?>" >
            <button class="btn no-border"><?php 
                $r=$row['review_id'];
                  if(exist($r)){
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
                $r_id=$row['review_id'];
                $total="SELECT COUNT(username) as total from likes where review_id like '$r_id'";
                 $totresult=mysqli_query($conn,$total);
              
  
                 $res=mysqli_fetch_assoc($totresult);
                 echo $res['total']." person liked the review.";
                ?>
            </p>
        <hr>
     </div>
     <?php endforeach; ?>
    <?php 
    }
    else { ?>
    <div class="msg">
        <p class="strong">Your Follower Haven't Posted Any Reviews Yet.</p>
    </div>

      <?php } ?> 


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