<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Book</title>
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

    if(isset($_GET['review']))
    {
      $_SESSION['isbn']=$_GET['review'];
    }
    $isbn=$_SESSION['isbn'];
    // elseif(isset($_POST['isbn'])){
    //   $_SESSION['isbn']=$_POST['isbn'];
    // }
    // else
    // {
    //   $isbn=$_SESSION['isbn'];
    // }

    // $isbn=$_SESSION['isbn'];
    // echo $isbn; 
    $user=$_SESSION['user'];
    // echo $user;
    $sql="SELECT * FROM `books` WHERE `ISBN` LIKE '%$isbn%'";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);

    if(isset($_GET['radio']))
    {
     
      $radio_option=$_GET['radio'];
      if(!exist_in_currently_reading($isbn) && !exist_in_tbr($isbn))
      {
        $sql2="INSERT INTO `$radio_option`(`ISBN`, `username`) VALUES ('$isbn','$user')";
        $result2=mysqli_query($conn,$sql2);
      }
      else if(!exist_in_tbr($isbn) and exist_in_currently_reading($isbn))
      {
        $sql2="DELETE FROM currently_reading where ISBN like '$isbn'";
        $result2=mysqli_query($conn,$sql2);
        $sql2="INSERT INTO toread (`ISBN`, `username`) VALUES ('$isbn','$user')";
        $result2=mysqli_query($conn,$sql2);
      }
      else if(!exist_in_currently_reading($isbn) and exist_in_tbr($isbn))
      {
        $sql2="DELETE FROM toread where ISBN like '$isbn'";
        $result2=mysqli_query($conn,$sql2);
        $sql2="INSERT INTO `currently_reading`(`ISBN`, `username`) VALUES ('$isbn','$user')";
        $result2=mysqli_query($conn,$sql2);
      }
      
      
      
    }

  function exists($isbn)
 {
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
    $user=$_SESSION['user'];
    $sql="SELECT * FROM `favorite` where ISBN like '$isbn' and username like '$user'";
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

    if(isset($_GET['add'])){
      
      if(exists($isbn))
      {
        $sql="DELETE from favorite where ISBN ='$isbn' and username='$user'";
        mysqli_query($conn, $sql);
        //header('location:http://localhost/NEW%20FOLDER/Follow.php');
        header('Location: '.$_SERVER["HTTP_REFERER"] );
      }
      else
      {
        $sql="INSERT into favorite (`ISBN`, `username`) VALUES ('$isbn','$user')";
        mysqli_query($conn, $sql);
        header('Location: '.$_SERVER["HTTP_REFERER"] );
      }
    }

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

    function exist_in_currently_reading($id)
    {
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword ="";
        $dbName="webproject";
        $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
        $login=$_SESSION['user'];
        $sql="SELECT * FROM currently_reading where ISBN like '$id' and username like '$login'";
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

    function exist_in_tbr($id)
    {
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword ="";
        $dbName="webproject";
        $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
        $login=$_SESSION['user'];
        $sql="SELECT * FROM toread where ISBN like '$id' and username like '$login'";
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
    <script>
    function autoSubmit()
    {
        var formObject = document.forms['theForm'];
        formObject.submit();
        
    }
    </script>

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
            <img src="uploaded/<?php echo $record['Photo'];?>" class="mx-5" width="200px" height="250px">
            <p class="pt-3 fs-6 text-center text-muted"><?php echo $record['Title']; ?></p>
          
          <div class="container">
          
           <small class="fs-6 text-muted">Add to shelf </small>

            <form method="get" id="theForm" name="review">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" id="flexRadioDefault1"
                value="toread" <?php 

    if(exist_in_tbr($isbn)){?> 
    checked 
    <?php } ?>
                onChange="autoSubmit()  ;"> To be Read
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" id="flexRadioDefault2" 
                value="currently_reading" <?php 

if(exist_in_currently_reading($isbn)){?> 
checked 
<?php } ?> onChange="autoSubmit();"> Currently-Reading
              </div>
            </form>
          </div>


           <a href="http://localhost/NEW%20FOLDER/book.php?add" class="pt-2">
            <?php 
                  if(exists($isbn))
                  {?>
                    <button class="btn btn-danger mt-5 mx-5"> Added to Favorite </button>
                  <?php
                  } 
                  else
                  {
                  ?>
                    <button class="btn btn-outline-danger mt-5 mx-5"> Add to Favorite </button>
                  <?php }
              ?>
            
           </a>
            


          <!-- Wishlist -->
          
        </div>
    
        <div class="d-flex flex-column mr-5">
    
          <p class="pt-3 display-6"><a href="#" class="text-decoration-none link-dark "><?php echo $record['Title']; ?></a></p>
          <text>by <text class="fs-5"><?php echo $record['Author']; ?></text></text>
          <p><?php echo "Rating: ".$record['Rating']; ?></p>
          <div class="description container justify-content-center mr-5 text-aling-center border border-primary">
            <p>
            <?php echo $record['Descript']; ?>
            </p>
          </div>
          <div class="container pt-5">
            <ul class="list-group list-group-flush">
              <li class="list-group-item bg-light"><?php echo $record['ISBN']; ?></li>
              <li class="list-group-item bg-light"><?php echo "Pages: ".$record['pages']; ?></li>
              <li class="list-group-item bg-light"><?php echo "Publication: ".$record['Publication']; ?></li>
              <li class="list-group-item bg-light"><?php echo "Genre: ".$record['Genre']; ?></li>
              <li class="list-group-item bg-light"><?php echo "Language: ".$record['Lang']; ?></li>
            </ul>
          </div> 
          <div class="container text-center pt-5">
            <!-- <form method="get">
              <input type="hidden" id="isbn" name="isbn" value="<?php echo $record['ISBN']; ?>">
               <button class="btn btn-warning"><a href="http://localhost/NEW%20FOLDER/review-form.php">
                Review?</a></button>
            </form> -->
            <a href="http://localhost/NEW%20FOLDER/review-form.php?update=<?php echo $record['ISBN']; ?>">
            <button class="btn btn-info">Review the book?</button></a>
          </div>
        </div>
        
      </div>
      <div>
        <p class="fs-6 fw-bolder mx-5 pt-5"> FREIENDs' UPDATE</p>
              <hr>
      </div>
      <?php
      $follower=$_SESSION['user'];
      $reviewsql="SELECT * from review Natural Join user where isbn LIKE '$isbn' AND username in (SELECT followed from relation where follower LIKE '$follower')";
      $reviewresult=mysqli_query($conn,$reviewsql);
      $count=mysqli_num_rows($reviewresult);
      // echo $count;
      ?>

      
      <div class="container reviews mx-5" width="400px">
        <?php if($count){
          while($record = mysqli_fetch_assoc($reviewresult))
          {
            $records[]=$record;
          }
         ?>
         <?php foreach ($records as $row): ?>
        <div class="container-fluid mx-5">
            <div class="img float-left mr-5">
              <a href="">
                 <img src="uploaded/<?php echo $row['photo'];?>"class="rounded-circle" alt="profile-photo" width="100px" height="100px">
              </a>
            </div>
    
            <div class="friend mx-5 ">
              <p class="fs-5 name mx-5"><a href="#" class="text-decoration-none link-dark"><?=$row['username']?></a> <small class="fs-6">rated the book: </small>
              <small class="fs-6"><?=$row['rating']?></small>
              </p> 
      
            </div>
            <div class="review mx-5 pb-5">
              <p class="review"><?=$row['review']?></p>
                
              <!-- <div class="mx-5">
                
                <button type="button" class="float-left btn btn-outline-secondary btn-sm  mx-3">agree?</button>
                <p class="text-muted mx-5">number of people agree with this</p>
              </div> -->
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
        <?php } 
        else { ?>
          <div class="msg">
            <strong>unfortunately none of your friends have reviews the book!</strong>
          </div>
        <?php } ?>
      </div>

    <br>
    <div>
      <p class="fs-6 fw-bolder mx-5 pt-5"> See More Reviews: </p>
            <hr>
    </div>
  <div>

      <!-- <div class="container reviews mx-5" width="400px"  >
        <div class="container  mx-5">
    
            <div class="img float-left mr-5">
              <a href="">
                 <img src="img/i5.jpg" class="rounded-circle" alt="profile-photo" width="100px" height="100px">
              </a>
            </div>
    
            <div class="friend mx-5 ">
              <p class="fs-5 name mx-5"><a href="#" class="text-decoration-none link-dark">User name</a> <small class="fs-6">rated the book: </small>
              <small class="fs-6">number</small>
              </p> 
              
            </div>
            <div class="review mx-5">
              <p class="review"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque nostrum at exercitationem blanditiis quod similique deserunt fugiat assumenda quibusdam corporis?</p>
                
              <div class="mx-5">
                
                <button type="button" class="float-left btn btn-outline-secondary btn-sm  mx-3">agree?</button>
                <p class="text-muted mx-5">number of people agree with this</p>
              </div>
               
            </div>
            <hr>
    
        </div>
      </div>  -->
      <?php
      $logged=$_SESSION['user'];
      $follower=$_SESSION['user'];
      $reviewsql2="SELECT * from review Natural Join user where isbn LIKE '$isbn' AND username not in (SELECT followed 
      from relation where follower LIKE '$follower') and username not like '$follower'";
      $reviewresult2=mysqli_query($conn,$reviewsql2);
      $count2=mysqli_num_rows($reviewresult2);
      // echo $count2;
      ?>
      
      <div class="container reviews mx-5" width="400px">
        <?php if($count2){
          while($record2 = mysqli_fetch_assoc($reviewresult2))
          {
            $records2[]=$record2;
          }
         ?>
         <?php foreach ($records2 as $row2): ?>
        <div class="container-fluid mx-5">
            <div class="img float-left mr-5">
              <a href="">
                 <img src="uploaded/<?php echo $row2['photo'];?>"class="rounded-circle" alt="profile-photo" width="100px" height="100px">
              </a>
            </div>
    
            <div class="friend mx-5 ">
              <p class="fs-5 name mx-5"><a href="http://localhost/NEW%20FOLDER/Follow.php?details=<?php echo $row2['username']; ?>" class="text-decoration-none link-dark"><?=$row2['username']?></a> <small class="fs-6">rated the book: </small>
              <small class="fs-6"><?=$row2['rating']?></small>
              </p> 
      
            </div>
            <div class="review mx-5 pb-5">
              <p class="review"><?=$row2['review']?></p>
                
              <!-- <div class="mx-5">
                
                <button type="button" class="float-left btn btn-outline-secondary btn-sm  mx-3">agree?</button>
                <p class="text-muted mx-5">number of people agree with this</p>
              </div> -->
            </div>

            <a href="http://localhost/NEW%20FOLDER/home.php?like=<?php echo $row2['review_id']; ?>" >
            <button class="btn no-border"><?php 
                $r=$row2['review_id'];
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
              $r_id=$row2['review_id'];
              $total="SELECT COUNT(username) as total from likes where review_id like '$r_id'";
              $totresult=mysqli_query($conn,$total);
              $res=mysqli_fetch_assoc($totresult);
              echo $res['total']." person liked the review.";
          ?>
        </p>
            <hr>
        </div>
        <?php endforeach; ?>
        <?php } 
        else { ?>
          <div class="msg">
            <strong>unfortunately nobody else have reviewed the book yet!</strong>
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