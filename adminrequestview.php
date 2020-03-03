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
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php
      require 'dbconfig.php';

      $sql= "SELECT * FROM ambulance";
      $result = mysqli_query($conn, $sql);
     ?>
    <div class="container-fluid">
      <div class="col-md-offset-1">
      <table  class="table table-bordered">
        <caption>View Of Ambulance Requests</caption>
          <thead>
              <th>Location Picked</th>
              <th>Hospial Chosen</th>
              <th>Phone Number</th>
              <th>Action</th>
          </thead>
          <tbody>
            <?php
             while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                      <td> <?php echo $row['locationpicked']; ?> </td>
                      <td> <?php echo $row['hospitalchosen']; ?> </td>
                      <td> <?php echo $row['phonenumber']; ?> </td>
                      <td><button type="button" name="button">Respond to the Request</button></td>
                    </tr>


            <?php }?>

          </tbody>
      </table>
    </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
