<?php
  require 'header.php';
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css" >
    #imgform{
      width: 60%;
      margin-left:auto;
      margin-right: auto;
      display: inline-block;
      padding-left:30%;
    }
    </style>
  </head>
  <body>
    <?php
    $msg= "";
      if(isset($_POST['upload'])){
        $target = "images/".basename($_FILES['file']['name']);
         //connect to // DEBUG:
         require 'dbconfig.php';

         //get submitted data from the form
         $location = $_POST['locale'];
         $image = $_FILES['file']['name'];
         $description = $_POST['description'];

         $sql = "INSERT INTO gallery(image, location, description) VALUES('$image', '$location', '$description');";
         mysqli_query($conn,$sql);

         //moving uploaded images to folder images
        if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
          echo "image uploaded successfully";
          header("location: imageupload.php/#alerts");
        }
        else{
          $msg = "image not uploaded";
        }
      }
     ?>

    <div class="container-fluid">
      <form class="form" id="imgform" role="navigation" action="imageupload.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <caption class="danger" style="backgound-color:red;">Kindly, resisit from uploading Sensitive Content</caption>
        <fieldset>
          <legend>Uploading Images</legend>
          <div class="">
            <label for="locale">Location</label>
            <input type="text" name="locale" id="locale" class="form-control" placeholder="Indicate the location where the images were uploaded from" value="">
          </div>
          <div class="">
            <label for="image">Image to Upload</label>
            <input type="file" name="file" id="image" value="">
          </div>
          <div class="form-group">
            <label for="description">Scenario Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="give description of the situation here" value="">
          </div>
          <div class="">
            <button type="submit" name="upload">Upload Image</button>
          </div>
        </fieldset>

      </form>
      <div id="alerts" class="row">
        <h3 class="page-header">Image Alerts as Uploaded by people on the scene</h3>
        <?php
          require_once 'dbconfig.php';
            $query = "SELECT * FROM gallery";
            $result =mysqli_query($conn, $query);

            while($row = mysqli_fetch_array($result)){
              echo "<div class='col-md-3'>";
              echo "<div class='thumbnail'>";
              echo "the images of the incident at <p>".$row['location']."</p>";
              echo "<img src='images/".$row['image']."'>";
              echo "</div>";
              echo "<div class='Caption'>";
              echo "<p>".$row['description']."</p>";
              echo "</div>";
              echo "</div>";
            }
         ?>
      </div>

    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
