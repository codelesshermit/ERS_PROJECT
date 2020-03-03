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

      $sql= "SELECT * FROM reporting ORDER BY daterec DESC";
      $result = mysqli_query($conn, $sql);
     ?>
    <div class="container-fluid">
      <div class="col-md-offset-1">
      <table  class="table table-bordered">
        <caption>View Of police reporting Made</caption>
          <thead>
              <th>Location</th>
              <th>PoliceStation Choosen</th>
              <th>Phone Number</th>
              <th>Is police presence required</th>
              <th>Action</th>
          </thead>
          <tbody>
            <?php
             while($row = mysqli_fetch_assoc($result)) { ?>
               <?php  //$tophonenumber= $row['phonenumber'];
                $station = $row['stationchosen'];?>
                    <tr>
                      <td> <?php echo $row['location']; ?> </td>
                      <td> <?php echo $row['stationchosen']; ?> </td>
                      <td> <?php echo $row['phonenumber']; ?> </td>
                      <td> <?php echo $row['policepresence']; ?> </td>
                      <td><?php echo "<form action='adminreportview.php' method='post'><input type='number' class='form-control' name='phone' value='' placeholder='+2547XXXXXXXX'></br><button class='btn btn-default' name='feedback'>Send Feedback</button></form>";?></td>
                    </tr>


            <?php }?>

          </tbody>
      </table>
    </div>
    </div>
    <?php
if(isset($_POST['feedback'])){
$tophonenumber = $_POST['phone'];
$Key = "FuIA4eZj7yRgX1kOR1lBP7NLhGRhlefMCiNLJ048L4DOkIeU4D";
$senderId= "SMARTLINK";
$username = "codelesshermit";
$finalmessage="Emergency Alert System.  Your report has been received. You will be contacted for further enquiry.";
$msgtype=5;
$dlr=0;
$url ="https://sms.movesms.co.ke/api/compose?username[]=&api_key[]=&sender=[]&to=[]&message=[]&msgtype=[]&dlr=[]";

  CURLOPT_URL; "https://sms.movesms.co.ke/api/compose?username[]=&api_key[]=&sender=[]&to=[]&message=[]&msgtype=[]&dlr=[]";
  $postData = array(
                    'action' => 'compose',
                    'username' => $username,
                    'api_key' => $Key,
                    'sender' => $senderId,
                    'to' => $tophonenumber,
                    'message' => $finalmessage,
                    'msgtype' => $msgtype,
                    'dlr' => $dlr,
                );


                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url ,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData

                ));

                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $output = curl_exec($ch);

                if (curl_errno($ch)) {
                    // echo 'error:' . curl_error($ch);
                    $output = curl_error($ch);
                }
                else{
                  echo "<div class='success'> successfully sent</div>";
                }

                curl_close($ch);
 }
	?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
