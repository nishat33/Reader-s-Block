<?php 
    session_start();
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbName="webproject";
    $conn= mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
?>
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
  <title>Add a Book</title>
</head>
<body class="bg-light">

 
  <div class="Sign_in container-fluid text-center pt-3 mb-4">
    <h2>Add Description</h2>
  </div>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" name="add" method="post" enctype="multipart/form-data">
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-6">
          <input type="text" id="title" class="form-control"  name="title">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">ISBN</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="isbn" name="isbn">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Author</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="author" name="author">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Language</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="language" name="language">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Publication</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="publication" name="publication">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Genre</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="genre" name="genre">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Pages</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" id="page" name="page">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Rating</label>
        <div class="col-sm-6">
          <input type="number" min="0" value="0" step="0.01" class="form-control" id="rating" name="rating">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Description:</label>
        <div class="col-sm-6">
          <textarea rows="10" cols="50" class="form-control" id="desc" name="desc"></textarea>
        </div>
      </div>
         
      <div class="row mb-3 mx-5 pl-5 img">
        <label for="img" class="col-sm-2 col-form-label">Select image</label>
        <div class="col-sm-6">
          <input type="file" id="imagefile" name="imagefile">
        </div>
      </div>

      <div class="text-center pt-2">
       <input type="submit" class="btn btn-lg btn-success text-center" id="submit" name="submit">
      <div class="text-center pt-3">
        <a href="http://localhost/NEW%20FOLDER/admin_home.php">Return to admin pannel.</a>
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

    

    if (isset($_POST["submit"])) {
       $title= $_POST['title'];
    $isbn=$_POST['isbn'];
    $author=$_POST['author'];
    $language=$_POST['language'];
    $publication=$_POST['publication'];
    $genre=$_POST['genre'];
    $page=$_POST['page'];
    $rating=$_POST['rating'];
    $description=$_POST['desc'];

      if (getimagesize($_FILES['imagefile']['tmp_name']) == false) {
      echo "<br />Please Select An Image.";
      } 
      else {
      $name = $_FILES['imagefile']['tmp_name'];
      $image = $_FILES['imagefile']['name'];
      $image_folder='uploaded/'.$image;
      $sql="INSERT INTO books (ISBN,Title,Author,Lang,Publication,pages,Genre,Descript,Rating,Photo) VALUES ('$isbn','$title','$author','$language','$publication','$page','$genre','$description','$rating','$image')";
      if (mysqli_query($conn, $sql))
      {
          // echo " shob hoise";
          move_uploaded_file($name,$image_folder);
          header('location:http://localhost/NEW%20FOLDER/update_delete.php');
      } 
      else {
        // die("kisu hoynai ".mysqli_connect_error());
         echo "<br />Failed to upload.<br />";
         echo mysqli_connect_error();
      }
  }


}
  else
  {
    echo '<div class="alert alert-danger alert-dismissible" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Upload Unsuccessfull <?php echo $name; ?></strong> 
  </div>';
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