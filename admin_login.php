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

  if(isset($_SESSION['name']))
  {
    header("Location: http://localhost/NEW%20FOLDER/admin_home.php"); 
    exit();
  }


$dbServername = "localhost";
$dbUsername = "root";
$dbPassword ="";
$dbName="webproject";
$conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo 'Connected successfully'.'<br>';
if(isset($_POST['inputEmail']))
{
  $email= $_POST['inputEmail'];
  $password= $_POST['inputPassword'];


  $sql="SELECT * FROM admin_table WHERE email='$email'";
  $result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)> 0)
{
  $row = mysqli_fetch_assoc($result);
  if($password==$row['pass'])
  {
   $_SESSION['user']=$row['username'];
   $_SESSION['name']=$row['admin_name'];
   header("Location: http://localhost/NEW%20FOLDER/admin_home.php"); 
   exit();
  }
  else{
    echo '<div class="alert alert-danger" role="alert">
    Login Failed;
    </div>';
  }
  
}
}
?>

  </head>

  <body class="bg-light">
  <form class="form-signin pt-5" method="post">
    <div class="d-flex justify-content-center align-items-center pt-5">
    
      <div class="form-stuffs pt-5 w-75">
        <div class="admin text-center">
            <h1 class="h3 mx-5 mb-3 font-weight-normal ">Admin Login</h1>
        </div>
        <div class="mx-5 email pt-3">
          <label for="inputEmail" >Email:</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required=""
            autofocus="" name="inputEmail">
        </div>
        <div class="mx-5 pass pt-3">
          <label for="inputPassword">Password:</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" autofocus="" name="inputPassword">
          <div class="checkbox mb-3 pt-2">
          </div>
        </div>

        <div class=" container text-center">
          <button class="btn btn-lg btn-primary btn-block w-75" type="submit">Sign in</button>
        </div>
      </div>
     
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