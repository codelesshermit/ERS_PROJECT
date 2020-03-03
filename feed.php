<?php
 require "header.php";
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
  </head>
  <body>
<div class="container-fluid">
  <div class="col-md-9  col-md-offset-1">
     <!--getting the data to display-->
     <?php
       require "dbconfig.php";
       $limit = 5;
       //querying database
       $query =  "SELECT * FROM feed ORDER BY dateposted DESC LIMIT $limit";
       //getting the result
       $result = mysqli_query($conn,$query);
       //fetch database
       $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
       //var_dump($posts);
       //free results
       mysqli_free_result($result);

     ?>
      <h4 class="page-header">Whats Happening Now</h4>
       <?php foreach ($posts as $post):?>
         <h3><?php echo $post['title'];?></h3>
         <small>At <?php echo $post['location'];?>, On <?php echo $post['occcurencedate'];?> </small>
         <p>Details:<br>
           <?php echo $post['details'];?>
         </p>
         Feed by:<?php echo $post['author']?>, on <?php echo $post['dateposted']; ?>
       <?php endforeach; ?>
  </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
   <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
   <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-database.js"></script>

  </script>
  </body>
</html>
