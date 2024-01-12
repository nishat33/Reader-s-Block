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
  <title>BookShelf</title>
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
  $sql1="SELECT * from toread natural join books where username like '$user'";
  $sql2="SELECT * from currently_reading natural join books where username like '$user'";
  $sql3="SELECT * from favorite natural join books where  username  like '$user'";

  $result1=mysqli_query($conn,$sql1);
  $result2=mysqli_query($conn,$sql2);
  $result3=mysqli_query($conn,$sql3);

  $count1=mysqli_num_rows($result1);
  $count2=mysqli_num_rows($result2);
  $count3=mysqli_num_rows($result3);

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

  <div class="container-fluid pt-1">
    <div class="d-flex bd-highlight mb-3  pt-5">
      <div class="container w-25 me-auto p-1 bd-highlight">
        <p class="headline fw-bold text-decoration-underline"> BookShelf</p>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <a href="http://localhost/NEW%20FOLDER/bookshelf.php?toread" class="text-decoration-none link-dark"> To Be Read
              <span class="mx-3 badge bg-primary rounded-pill"><?php echo $count1; ?></span>
            </a>
          </li>
          <li class="list-group-item"><a href="http://localhost/NEW%20FOLDER/bookshelf.php?curr" class="text-decoration-none link-dark"> Currently Reading
              <span class="mx-3 badge bg-primary rounded-pill"><?php echo $count2; ?></span>
            </a></li>
          <li class="list-group-item"><a href="http://localhost/NEW%20FOLDER/bookshelf.php?fav" class="text-decoration-none link-dark"> Favorite
              <span class="mx-3 badge bg-primary rounded-pill"><?php echo $count3; ?></span> </a></li>
        </ul>
  </div>

      <div class="p-2 bd-highlight flex-grow-1 mx-3">
        <div class=" row row-cols-1 row-cols-md-3 g-4">
          <?php if(isset($_GET['toread'])){
            if($count1){
              while($record1 = mysqli_fetch_assoc($result1)){
                $records1[]=$record1;
                 }?>
              <?php foreach ($records1 as $row1): ?>
                <div class="col ">
                     <div class="card" style="width: 13rem;">
                     <a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $row1['ISBN']; ?>">
                         <img src="uploaded/<?php echo $row1['Photo'];?>" class="card-img-top w-100">
                     </a>    
                         <div class="card-body">
                           <p class="card-text"><b>Title: <?php echo $row1['Title'];?></b></p>
                           <p><small class="text fw-bold">Author: <?php echo $row1['Author'];?></small></p>
                         </div>
                     </div>
                </div>
              <?php endforeach; ?>
              <?php }

              else {?>
                <div class="msg">
                  <p class="strong">Currently you don't have any book in you TBR </p>
                </div>
              <?php } ?>

          <?php } ?>

          <?php if(isset($_GET['curr'])){
            if($count2){
              while($record2 = mysqli_fetch_assoc($result2)){
                $records2[]=$record2;
                 }?>
              <?php foreach ($records2 as $row2): ?>
                <div class="col ">
                <div class="card" style="width: 13rem;">
                <a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $row2['ISBN']; ?>">
                         <img src="uploaded/<?php echo $row2['Photo'];?>" class="card-img-top w-100">
                     </a>
                         <div class="card-body">
                           <p class="card-text"><b>Title: <?php echo $row2['Title'];?></b></p>
                           <p><small class="text fw-bold">Author: <?php echo $row2['Author'];?></small></p>
                         </div>
                     </div>
                </div>
              <?php endforeach; ?>
              <?php }

              else {?>
                <div class="msg">
                  <p class="strong">Currently you don't have any book in you TBR </p>
                </div>
              <?php } ?>

          <?php } ?>

          <?php if(isset($_GET['fav'])){
            if($count3){
              while($record3 = mysqli_fetch_assoc($result3)){
                $records3[]=$record3;
                 }?>
              <?php foreach ($records3 as $row3): ?>
                <div class="col ">
                <div class="card" style="width: 13rem;">
                <a href="http://localhost/NEW%20FOLDER/book.php?review=<?php echo $row3['ISBN']; ?>">
                         <img src="uploaded/<?php echo $row3['Photo'];?>" class="card-img-top w-100">
                     </a>
                         <div class="card-body">
                           <p class="card-text"><b>Title: <?php echo $row3['Title'];?></b></p>
                           <p><small class="text fw-bold">Author: <?php echo $row3['Author'];?></small></p>
                         </div>
                     </div>
                </div>
              <?php endforeach; ?>
              <?php }

              else {?>
                <div class="msg">
                  <p class="strong">Currently you don't have any book in you TBR </p>
                </div>
              <?php } ?>

          <?php } ?>
      
          
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