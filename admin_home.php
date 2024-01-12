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
  <title>Admin Home</title>
  <?php

session_start();
  

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword ="";
$dbName="webproject";
$conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

$name=$_SESSION['name'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else
{
    //echo 'Connected successfully'.'<br>';
}

$sqluser="SELECT * FROM `user`";
$sqlbooks="SELECT * FROM `books`";
$sqlreviews="SELECT * FROM `review`";

$resultuser=mysqli_query($conn,$sqluser);
$resultbooks=mysqli_query($conn,$sqlbooks);
$resultreviews=mysqli_query($conn,$sqlreviews);

$countuser=mysqli_num_rows($resultuser);
$countbooks=mysqli_num_rows($resultbooks);
$countreviews=mysqli_num_rows($resultreviews);



?>

</head>

<body class="bg-light">

<div class="alert alert-success alert-dismissible" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Welcome To The Admin Panel, Admin <?php echo $name; ?></strong> 
</div>

<div class="dashboard container-fluid pt-5 pb-5" style="background-color:#CFD2CF;">
    <p class="display-5 mx-3" style="color:#4C3A51;"><strong>Dashboard:</strong></p>
    <div class="d-flex flex-row justify-content-around">
        <div class="pt-5  container user bg-danger mx-4 text-center" >
            <img class="float-left ml-4" src="img/question.png" alt="user" width="100px" height="100px">
            <div class="detail float-right text-center mr-4">
                <p class="display-6"> <strong>Total user</strong></p>
                <p class="display-6"> <strong><?php echo $countuser; ?></strong></p>
            </div>
        </div>
        <div class="pt-5 container user bg-warning mx-4 text-center" >
            <img class="float-left ml-4" src="img/book.png" alt="user" width="100px" height="100px">
            <div class="detail float-right text-center mr-4">
                <p class="display-6"> <strong>Total book</strong></p>
                <p class="display-6"> <strong><?php echo $countbooks; ?></strong></p>
            </div>
        </div>
        <div class="pt-5 container user bg-primary mx-4 text-center" >
            <img class="float-left ml-4" src="img/review.png" alt="user" width="100px" height="100px">
            <div class="detail float-right text-center mr-4">
                <p class="display-6"> <strong>Total review</strong></p>
                <p class="display-6"> <strong><?php echo $countreviews; ?></strong></p>
            </div>
        </div>

    </div>
</div>

<hr class="p-1" style="background-color:#D61C4E;">



<div class="product">
    
   <p class="display-5 mx-3" style="color:#4C3A51;"><strong>Product Control:</strong></p>
    <div class="buttons d-flex justify-content-center">
        <div class="text-center d-flex justify-content-center pb-5 pt-5 mx-3">
            <a href="http://localhost/NEW%20FOLDER/Add_Book.php" class="btn btn-primary px-5">
                <p class="display-6"><strong>Add Content</strong> </p> <img class="mx-5"src="img/add1.png" alt="" width="75px" height="75px"> 
            </a>
            
        </div>
        <div class="text-center d-flex justify-content-center pb-5 pt-5 mx-3">
            <a href="http://localhost/NEW%20FOLDER/update_delete.php" class="btn btn-primary px-5">
                <img class="mx-5"src="img/pencil.png" alt="" width="75px" height="75px"> <p class="display-6"><strong>Delete & Update</strong></p>
            </a>
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