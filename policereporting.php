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
    #policeform{
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
       $location =$_POST['lction'];
       $chosen = $_POST['station'];
       $phonenumber = $_POST['phnnmbr'];
       $presence= $_POST['presence'];

       $sql="INSERT INTO reporting(location, stationchosen, phonenumber, policepresence)VALUES('$location', '$chosen','$phonenumber','$presence');";
       $result = mysqli_query($conn,$sql);

       if(!$result){
         echo "reporting unsuccessful,try again";
       }
       else{
         echo "<p class='success'>reporting Successful you will be redirected to feed page</p>";
         header("location: feed.php");
       }
     }

     ?>


      <div class="container-fluid">
        <div class="col-md-8">
      <form class="policereport" id="policeform" onsubmit="return validateForm()"name="policeform" action="policereporting.php" method="post">
          <fieldset>
            <legend>Police Reporting Form</legend>
            <div class="form-group">
              <label for="lction">Location</label>
              <input type="text" class="form-control" id="lction" name="lction" placeholder="enter your location name" value="">
            </div>
            <div class="form-group">
              <label for="station">Chosen Police Station</label>
              <input type="text" name="station" id="station" class="form-control" placeholder="indicate the choice" value="">
            </div>

            <div class="form-group">
              <label for="phnnmbr">PhoneNumber</label>
              <input type="Number" class="form-control" name="phnnmbr" id="phmbr" size="10" value="" placeholder="+2547XXXXXXXX">
            </div>
            <div class="form-group">
              <label for="presence">Do you require Police Presence</label>
              <select class="" name="presence" id="presence">
                <option value="select">--select--</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <button type="submit" class="btn btn-secondary form-btn" name="submit">Report to the police</button>
          </fieldset>
      </form>
    </div>

<script type="text/javascript">

  function validateForm() {
  var x = document.forms["policeform"]["lction"].value;
  if (x == "") {
    alert("Kindly indicate your location");
    return false;
  }
  var y = document.forms["policeform"]["station"].value;
  if (y == "") {
    alert("Police Station Chosen Cannot Be Empty");
    return false;
  }
  var z = document.forms["policeform"]["phnnmbr"].value;
  if (z == "") {
    alert("Kindly fill in the phone number");
    return false;
  }
  else if (z.length !== 12) {
    alert("kindly follow the recommended format");
    return false;
  }
  var w = document.forms["policeform"]["presence"].value;
  if (w == "select") {
    alert("Make Appropriate Selection on the Police presence requirement");
    return false;
  }
}

</script>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-database.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
