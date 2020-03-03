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
    <div class="container-fluid">
      <div class="col-md-offset-1">
      <table id="alerttable" class="table table-bordered">
          <thead>
              <th>Location</th>
              <th>Nature of Emergency</th>
              <th>No.Of people involved</th>
              <th>Phone Number</th>
              <th>Is Medical Assistance Required</th>
              <th>Action</th>
          </thead>
          <tbody id="alertdata">

          </tbody>
      </table>
    </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
    <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
     <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-database.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    //firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyBjcucPft3E6_IPJLEVwpjHL7zKo2Zzgus",
    authDomain: "erescue-a026b.firebaseapp.com",
    databaseURL: "https://erescue-a026b.firebaseio.com",
    projectId: "erescue-a026b",
    storageBucket: "erescue-a026b.appspot.com",
    messagingSenderId: "704412270131",
    appId: "1:704412270131:web:50353a247a137a5b1b2d46"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

var alertsList = firebase.database().ref('alerts');

//geting alerts from database to emergency alert table

var alertsMade = firebase.database().ref().child('alerts');

    alertsMade.on("child_added", snap=>{
        var location = snap.child("location").val();
        var nature = snap.child("nature").val();
        var number = snap.child("number").val();
        var phone = snap.child("phone").val();
        var medic = snap.child("medic").val();



        $("#alertdata").append("<tr><td>"+location +"</td><td>"+ nature +"</td><td>"+number+"</td><td>"+phone+"</td><td>"+medic+"</td><td><form action='adminalertview.php' method='post'><input type='number' class='form-control' name='phone' value='' placeholder='+2547XXXXXXXX'></br><button class='btn btn-default' name='feedback'>Send Feedback</button></form></td>")
    })

    </script>

    <?php
if(isset($_POST['feedback'])){
$tophonenumber = $_POST['phone'];
$Key = "FuIA4eZj7yRgX1kOR1lBP7NLhGRhlefMCiNLJ048L4DOkIeU4D";
$senderId= "SMARTLINK";
$username = "codelesshermit";
$finalmessage="Emergency Alert System.  Your Alert has been received. You might be Called for more enquiries";
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
  </body>
</html>
