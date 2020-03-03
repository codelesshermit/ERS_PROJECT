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
    <title>Emergency Rescue System</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css" media="screen">
    #hosform{
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
 require 'dbconfig.php';

 if(isset($_POST['submit'])){
   $report =$_POST['report'];
   $location = $_POST['loctn'];
   $chosen = $_POST['chosen'];
   $phonenumber = $_POST['phnnmbr'];
   $payment =$_POST['payment'];


   $sql="INSERT INTO booking(reporting, location, hospitalchosen, phonenumber, paymentmethod)VALUES('$report', '$location', '$chosen','$phonenumber','$payment');";
   $result = mysqli_query($conn,$sql);

   if(!$result){
     echo "booking unsuccessful,try again";
   }
   else{
     echo "booking Successful";
     header("location: feed.php");
   }
 }

 ?>

    <div class="container-fluid">
      <form class="form" id="hosform" name="hosform" onsubmit="return validateForm()" action="bookhospital.php" method="post">
        <fieldset>
          <legend>Hospital Booking</legend>
          <div class="form group">
            <label for="">Reporting For</label>
            <select class="" id="report" onchange="breport1()" name="report">
              <option value="select">--select--</option>
              <option value="oneself">oneself(reporting as victim)</option>
              <option value="someone else">Someone Else</option>
            </select>
          </div>
          <script type="text/javascript">
          function breport1(){
            if(document.getElementById('report').value =="someone else"){
              document.getElementById('payment').style.display ="none";
            }
          }

          </script>
          <div class="form-group">
            <label for="loctn">Location</label>
            <input type="text" name="loctn" class="form-control" value="">
          </div>
          <div class="form-group">
           <label for="chosen">Hospital Chosen</label>
           <input type="text" name="chosen"  class="form-control"id ="chosen"value="">
          </div>
          <div class="form-group">
            <label for="phnnmbr">PhoneNumber</label>
            <input type="number" name="phnnmbr" class="form-control" value="" placeholder="+2547XXXXXXXX">
          </div>
          <div id="payment">
          <label for="">Payment Method</label>
          <select class="" name="payment" id="payment">
            <option value="select">--Select--</option>
            <option value="cash">Cash/Mobile Transfer</option>
            <option value="bank">Bank deposit</option>
            <option value="insurance">Insurance Cover</option>
          </select>
        </div>
    <!--<div id="pdetails">
        <label for="paymethod">payment details</label>
        <label for="cash">
        <input type="radio" name="paymethod" id="cash" value="Will Pay deposit on Arrival">Pay Deposit on Arrival
        </label>
        <label for="card">
        <input type="radio" name="paymethod"  id="card" value="Enter Card Details ">Enter Card details
      </label>

    </div>-->
      <button class="btn btn-tertiary form btn" name="submit" type="Submit"> Make the Booking</button>
      <button class="btn btn-tertiary form btn" id="ui"><a href="imageupload.php">Upload Images</a></button>
        </fieldset>
      </form>
    </div>
      </div>


      <script type="text/javascript">

        function validateForm() {
          var h = document.forms["hosform"]["report"].value;
          if (h == "select") {
            alert("Make Appropriate Selection on the first  field");
            return false;
          }
        var x = document.forms["hosform"]["loctn"].value;
        if (x == "") {
          alert("Kindly indicate your location");
          return false;
        }
        var y = document.forms["hosform"]["chosen"].value;
        if (y == "") {
          alert("Police Station Chosen Cannot Be Empty");
          return false;
        }
        var z = document.forms["hosform"]["phnnmbr"].value;
        if (z == "") {
          alert("Kindly fill in the phone number");
          return false;
        }
        else if (z.length !== 12) {
          alert("kindly follow the recommended format");
          return false;
        }
        var w = document.forms["hosform"]["payment"].value;
        if (w == "select") {
          alert("Make Appropriate Selection on the last field");
          return false;
        }
      }

      </script>

<!--<script type="text/javascript">

function showGetLocBtn(){
  document.getElementById(getloc).style.display = "block";
}
function getLocation(e){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    else{
        console.log("geoposition not supported");
    }
}
function showPosition(position){
    var lat = position.coords.latitude;
    var long = position.coords.longitude;

    console.log(lat, long);
}
</script>-->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-database.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
