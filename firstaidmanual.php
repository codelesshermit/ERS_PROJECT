<?php
 require_once 'header.php';
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
    <?php
    require "dbconfig.php";

    $limit = 2;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    //$start = ($page - 1) * $limit;
    //querying database
    $query =  "SELECT * FROM manual LIMIT  $limit";
    //getting the result
    $result = mysqli_query($conn,$query);
    //fetch database
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //var_dump($posts);
    //free results
    mysqli_free_result($result);

    $query1 = "SELECT count(id) AS id FROM manual";
    $result1 = mysqli_query($conn,$query1);
    $postscount = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    $total =$postscount[0]['id'];
    $pages = ceil($total / $limit );

    ?>

    <div></div>
    <div class="container-fluid">
      <div class="col-md-3">
        <h3>First Aid Tips</h3>
        <p>
         *<b>ALWAYS</b> maintain your safety first and <b>AVOID</b> contact with other fluids from the casualty by wearing rubber gloves.</br>
         *If the casualty is still consious and in a position to talk, <b>ALWAYS</b> request permision from them.</br>
         *Remove constraining clothingand jewerally from the casualty</br>
         *<b>RESPECT THE CASUALTY'S MODESTY AT ALL TIMES</b>.</br>
         *<b>PREVENT</b> hypothermia; remove wet colothings and dry patient thoroughly</br>
         *<b>STRICTLY ADHERE AND FOLLOW THE ABCDE OF FIRST AID</b>.


        </p>
      </div>
      <div class=" col-md-9">
        <?php foreach ($posts as $post):  ?>
        <div class="panel panel-default">
          <div class="panel-header">
            <h3 class="panel-heading"><?php echo $post['heading']; ?> </h3>
            <small><?php echo $post['subheading']; ?></small>
          </div>
          <div class="panel-body">
            <?php echo $post['body']; ?>
          </div>
          <div class="panel-footer">
          <button class="btn btn-default panel-btn" name="button">Read More</button>
          </div>
          </div>
        <?php endforeach; ?>

        <div class="pagination">
             <?php for($i=1; $i<=$pages; $i++):   ?>
               <li><a href="firstaidmanual.php?page=<? =$i; ?>"<? = $i; ?></a><li>

               <?php endfor;?>
        </div>

  </div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
