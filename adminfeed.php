<?php
 require_once 'adminheader.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin View</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
      #feedform{
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
    require_once 'dbconfig.php';

     if(isset($_POST['submit'])){
       $title = $_POST['ftitle'];
       $occurencedate = $_POST['date'];
       $location = $_POST['location'];
       $details =$_POST['fdetails'];
       $author = $_POST['author'];

       $sql =" INSERT INTO feed(title, occcurencedate, location, details, author)VALUES('$title', '$occurencedate', '$location', '$details', '$author');";
       $result = mysqli_query($conn,$sql);
       if(!$result){
         echo "check the database and code. feed not updated";
       }
       else{
         echo "<div class='success'>feed added successfully</div>";
       }
     }
     ?>
    <div class="container-fluid">
      <div class="">
        <h4 class="page-header">Edit Feed</h4>
        <form class="" id="feedform" action="adminfeed.php" method="post">
          <div class="form-group">
            <label for="ftitle">Feed Title</label>
            <input type="text"  class="form-control" name="ftitle" id="ftitle" value="">
          </div>
          <div class="form-group">
            <label for="date">Date Of Occurence</label>
            <input type="datetime"  class="form-control" name="date" id="date" value="">
          </div>
          <div class="form-group">
            <label for="location">Location Of Occurence</label>
            <input type="text"  class="form-control" name="location" id="location" value="">
          </div>
          <div class="form-group">
            <label for="fdetails">Feed Details</label>
            <textarea name="fdetails" id="fdetails" rows="5" value=" " class="form-control" cols="80"></textarea>
          </div>
          <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" value=" " class="form-control">
          </div>
          <button type="submit" class="btn btn-secondary form-btn" name="submit" id="feedbtn">Add Feed</button>
        </form>
      </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
