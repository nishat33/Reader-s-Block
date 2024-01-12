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
</head>

<body class="bg-light">

 
  <div class="Sign_in container-fluid text-center pt-3 ">
    <h2>Sign-Up</h2>
  </div>
  <
    <form name="signup" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-6">
          <input type="text" id="username" class="form-control" placeholder="Must atleast be 6 character long" name="username">
        </div>
      </div>
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-3">
          <input type="text" id="firstname" class="form-control" placeholder="First name" aria-label="First name" name="fname">
        </div>
        <div class="col-sm-3">
          <input type="text" id="lastname" class="form-control" placeholder="Last name" aria-label="Last name" name="lname">
        </div>
      </div> 
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Bio</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="bio" name="bio" placeholder="add a short bio">
        </div>
      </div>
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="email" name="email">
        </div>
      </div>
      
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

      <div class="row mb-3 mx-5 pl-5 img">
        <label for="img" class="col-sm-2 col-form-label">Select image</label>
        <div class="col-sm-6">
          <input type="file" id="imagefile" name="imagefile">
        </div>
      </div>

      <div class="text-center pt-2">
       <button type="submit" class="btn btn-lg btn-success text-center " name="submit">Sign Up</button>
      </div>
      <div class="text-center pt-3">
        <a href="http://localhost/NEW%20FOLDER/index.php">Already have an account?</a>
      </div>
    </form>



  <?php 

    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // echo 'Connected successfully'.'<br>';
    

    
    // echo $pass;
    // echo $cpass;
    //echo $img;

    //$sql="INSERT INTO user (username, firstname, lastname, email, pass, joining_date) VALUES ('$username','$firstname','$lastname','$email', '$pass','$date')";


    if (isset($_POST["submit"])) {
    $username=$_POST['username'];
    $firstname=$_POST['fname'];
    $lastname=$_POST['lname'];
    $bio=$_POST['bio'];
    $email=$_POST['email'];
    
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
   

      if (getimagesize($_FILES['imagefile']['tmp_name']) == false) {
      echo "<br />Please Select An Image.";
      } 
      else {
      // echo "failed<br>";
      $name = $_FILES['imagefile']['tmp_name'];
      $image = $_FILES['imagefile']['name'];
      $image_folder='uploaded/'.$image;
      $sql="INSERT INTO user (username, firstname, lastname, email, pass, bio, photo) VALUES ('$username','$firstname','$lastname','$email', '$pass','$bio','$image')";

      if (mysqli_query($conn, $sql))
      {
        move_uploaded_file($name,$image_folder);
        session_start();
         $_SESSION['signup']='successfull';
         header('location:http://localhost/NEW%20FOLDER/index.php');
      } 
      else {
        header('location:http://localhost/NEW%20FOLDER/signup.php');
        
      }
  }

}
  
    
?>



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