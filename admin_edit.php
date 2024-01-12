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
  <title>Update Book</title>

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
  $id = $_GET['update'];
  // echo $id;
  $sql="SELECT * from books WHERE ISBN like '$id'";
  $result=mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);

    
  if(isset($_POST['update']))
  {
    
      $title= $_POST['title'];
      //$isbn=$id;
      $author=$_POST['author'];
      $language=$_POST['language'];
      $publication=$_POST['publication'];
      $genre=$_POST['genre'];
      $page=$_POST['page'];
      $description=$_POST['desc'];
      $name = $_FILES['imagefile']['tmp_name'];
      $image = $_FILES['imagefile']['name'];
      $image_folder='uploaded/'.$image;

      if(empty($title) || empty($author) || empty($language) || empty($publication) || empty($genre) || empty($page)){
        $message[] = 'please fill out all!';  
      }  
      else{
        $update_data = "UPDATE books SET Title='$title', Author='$author',
        Lang='$language', Publication='$publication', pages='$page',Genre='$genre',Descript='$description', Photo='$image' WHERE ISBN = '$id'";
        $upload = mysqli_query($conn, $update_data);
        if($upload){
           move_uploaded_file($name,$image_folder);
           header('location:http://localhost/NEW%20FOLDER/update_delete.php');
        }
        else{
            echo "Please fill out all";
        }
  
     }
     

}

?>

</head>
<body class="bg-light">

 
  <div class="Sign_in container-fluid text-center pt-3 mb-4">
    <h2>Update the product</h2>
    <form name="add" method="post" enctype="multipart/form-data">
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-6">
          <input type="text" id="title" class="form-control"  name="title" value="<?php echo $row['Title']; ?>">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Author</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['Author']; ?>">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Publication</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="publication" name="publication" value="<?php echo $row['Publication']; ?>">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Language</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="language" name="language" value="<?php echo $row['Lang']; ?>">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Genre</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="genre" name="genre" value="<?php echo $row['Genre']; ?>">
        </div>
      </div>

      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Pages</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" id="page" name="page" value="<?php echo $row['pages']; ?>">
        </div>
      </div>
      <div class="row mb-3 mx-5 pl-5">
        <label for="" class="col-sm-2 col-form-label">Description:</label>
        <div class="col-sm-6">
          <textarea rows="5" class="form-control" id="desc" name="desc" value="<?php echo $row['Descript']; ?>">
          <?php echo $row['Descript']; ?>
        </textarea>
        </div>
      </div>
         
      <div class="row mb-3 mx-5 pl-5 img">
        <label for="img" class="col-sm-2 col-form-label">Select image</label>
        <div class="col-sm-6">
          <input type="file" id="imagefile" name="imagefile"> 
          
        </div>
      </div>

      <div class="text-center pt-2">
       <input type="submit" class="btn btn-lg btn-success text-center" id="update" name="update">
        <div class="text-center pt-3">
        <a href="http://localhost/NEW%20FOLDER/update_delete.php">Return to admin pannel.</a>
       </div>
     </form>

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