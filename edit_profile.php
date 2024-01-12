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
  <title>Sign-Up</title>

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
// echo 'Connected successfully'.'<br>';
if(!isset($_COOKIE['user']))
    {
    session_destroy();
    header('location:http://localhost/NEW%20FOLDER/index.php');
   }

$user=$_SESSION['user'];  
// echo $user;
$sql="SELECT * FROM user where username LIKE '$user'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);


//echo $img;

//$sql="INSERT INTO user (username, firstname, lastname, email, pass, joining_date) VALUES ('$username','$firstname','$lastname','$email', '$pass','$date')";


if (isset($_POST["update"])) {
    $firstname=$_POST['fname'];
    $lastname=$_POST['lname'];
    $email=$_POST['email'];
    $name = $_FILES['imagefile']['tmp_name'];
    $image = $_FILES['imagefile']['name'];
    $image_folder='uploaded/'.$image;
    
    
    $update_data = "UPDATE user SET firstname='$firstname',
    lastname='$lastname', email='$email',photo='$image' WHERE username = '$user'";
    $upload = mysqli_query($conn, $update_data);

    if(isset($_GET['edit'])){
        $pass=$_POST['password'];
        $cpass=$_POST['cpassword'];

        if($pass==$cpass)
        {
            $update_data="UPDATE user SET pass=$pass where username='$user'";
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible" >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>enter the passwords correctly</strong> 
            </div>';
        }
    }

    if ($upload)
    {
        move_uploaded_file($name,$image_folder);
        header('location:http://localhost/NEW%20FOLDER/user.php');
        // echo "hoise";
    } 
    else {
   
        echo "Please fill out all";
        echo "<br />Failed to upload.<br />";
    }
}
else{
  echo '<div class="alert alert-info  alert-dismissible" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Update Unsuccessful, Please Try Again!</strong> 
    </div>';
}

?>



</head>

<body class="bg-light">
  <!-- <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-4">
      <a class="navbar-brand" href="home.html"><img src="img/Logo_yellow.png" width="75%" alt="logo to be inserted"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
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

 
  <div class="Sign_in container-fluid text-center pt-3 ">
    <h2>Edit Form</h2>
  </div>
  <
    <form name="signup" method="post" enctype="multipart/form-data" >
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-6">
          <input type="text" id="username" class="form-control" placeholder="Must atleast be 6 character long" name="username" value="<?php echo $row['username']; ?>">
        </div>
      </div>
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-3">
          <input type="text" id="firstname" class="form-control" placeholder="First name" aria-label="First name" name="fname" value="<?php echo $row['firstname']; ?>">
        </div>
        <div class="col-sm-3">
          <input type="text" id="lastname" class="form-control" placeholder="Last name" aria-label="Last name" name="lname" value="<?php echo $row['lastname']; ?>">
        </div>
      </div> 

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Bio</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="bio" name="bio" value="<?php echo $row['bio']; ?>">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
        </div>
      </div>

      
        <div class="row mb-3 mx-5 pl-5">
        <a href="http://localhost/NEW%20FOLDER/edit_profile.php?edit">Change password?</a>
        </div>
        <?php 
        if(isset($_GET['edit'])){?>

          <div class="row mb-3 mx-5 pl-5">
          <label for="" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-6">
          <input type="password" class="form-control" id="password" placeholder="8 to 20 characters" name="password">
          </div>
          </div>

         <div class="row mb-3 mx-5 pl-5">
         <label for="" class="col-sm-2 col-form-label">Confirm Password</label>
          <div class="col-sm-6">
          <input type="password" class="form-control" id="cpassword" name="cpassword">
         </div>
        </div>

        <?php }?>
      

      <div class="row mb-3 mx-5 pl-5 img">
        <label for="img" class="col-sm-2 col-form-label">Select image</label>
        <div class="col-sm-6">
          <input type="file" id="imagefile" name="imagefile">
        </div>
      </div>

      <div class="text-center pt-2">
       <input type="submit" class="btn btn-lg btn-success text-center " name="update" id="update">
      <div class="text-center pt-3">
        <a href="http://localhost/NEW%20FOLDER/user.php">Back?</a>
      </div>
    </form>





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