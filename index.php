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
    <style type="text/css">
    /*#alertform{
      width: 60%;
      margin-left:auto;
      margin-right: auto;
      display: inline-block;
      padding-left:30%;
    }*/
    </style>
  </head>
  <body>
<div class="container-fluid">
  <aside class="col-md-5">
    <h4 class="page-header">Make Alert</h4>
    <form  id="alertform" name="alertform" onsubmit="return validate()">
      <fieldset>
      <div class="form-group">
        <label for="location">Enter your Location</label>
        <input type="text" name="location" class="form-control" id="location" value="" require>
      </div>
      <div class="form-group">
        <label for="nature">Nature of Emergency</label>
        <select id="nature" onchange="showTextBox()" name="nature" require>
          <option value="select">--select--</option>
          <option value="Road Accident">Road Accident</option>
          <option value="Fire Emergency">Fire Emergency</option>
          <option value="Household Accident">Household Accident</option>
          <option value="Health Related Emergency">Health Related Emergency</option>
          <option value="other Kind Of Emergency" >Other Kind Of Emergency</option>
        </select>
      </div>
     <div class=" sr-only form-group" id="other">
        <label for="other">Enter More Details</label>
        <textarea name="other" id="other" value rows="3" cols="65"></textarea>
      </div>
      <script type="text/javascript" >
      function showTextBox(){
    if( document.getElementById('nature').value !=="other Kind Of Emergency"){
        document.getElementById('other').style.display="block";
    }
    else{
        document.getElementById('other').style.display="none";
    }
};

      </script>
      <div class="form-group">
        <label for="number">Approximate Number of People Involved</label>
        <input type="number" name="number" class="form-control" id="number" min="1" value="" require>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number(accepted format: +2547XXXXXXXX)</label>
        <input type="text" name="phone" class="form-control" id="phone" value="" require>
      </div>
      <div class="form-group">
        <label for="medic">Does the situation require Ambulance/ Professional Medical Assistance?</label>
        <select class="" name="medic" id="medic" require>
          <option value="select">--select--</option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
      </div>
      <!--<div>
        <label class="checkbox-inline" for="red">
        <input type="checkbox" name="reportto" id="red" value="Red Cross Ambulance">Red Cross Ambulance</label>
        <label class="checkbox-inline" for="john">
        <input type="checkbox" name="reportto" id="john" value="St. John Ambulance">St. John Ambulance</label>
        <label class="checkbox-inline" for="aar">
        <input type="checkbox" name="reportto"  id="aar" value="AAR Rescue Service">AAR Rescue Services</label>
        <label class="checkbox-inline" for="otheragency">
        <input type="checkbox" name="reportto" id="otheragency" value="Other Agency">Other Agency</label>
      </div>
        <div class="form-group">
        <label for="other">Enter More Details</label>
        <textarea name="other" id="other" class="form-control" rows="5" cols="65"></textarea>
      </div>-->
      <button type="submit" class="btn btn-danger form-btn btn-block" value="submit">Make Report</button>
    </fieldset>
    </form>
  </aside>
 <script type="text/javascript">

  function validate(){
    var x = document.forms['alertform']['location'].value;
    if( x == ""){
      alert(" location Cannot be empty");
      return false;
    }
    var y = document.forms['alertform']['number'].value;
    if( y == ""){
      alert("Approxiate number of people cannnot be empty");
      return false;
    }
    var z = document.forms['alertform']['phone'].value;
    if( z == ""){
      alert("Phone Number cannot be empty");
      return false;
    }
    else if ( z.length !== 13) {
      alert("kindly use the format given for phone number");
      return false;
    }
    var b = document.forms['alertform']['nature'].value;
    if( b == "select"){
      alert(" Kindly make another selection on emergency nature");
      return false;
    }
    var c = document.forms['alertform']['medic'].value;
    if( c == "select"){
      alert(" Kindly make another selection medical requirement");
      return false;
    }
  }

 </script>
  <div class="col-md-7">
     <!--getting the data to display-->
     <?php
       require "dbconfig.php";
       //querying database
       $limit = 3;
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
  <script type="text/javascript">
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



//adding events to the form
document.getElementById("alertform").addEventListener("submit", report);
      function report(e){
          e.preventDefault();

          //adding values
          var location = getInputVal("location");
          var nature = getInputVal("nature");
          var number = getInputVal("number");
          var phone = getInputVal("phone");
          var medic = getInputVal("medic");


        saveAlert(location, nature, number,phone, medic)

          document.getElementById('alertform').reset();
      }

        // function for getting the values

        function getInputVal(id){
           return document.getElementById(id).value;
        }
        //saving the new alert to database
function saveAlert(location, nature, number, phone, medic){
    var newAlert = alertsList.push();
     newAlert.set({
         location : location,
         nature : nature,
         number : number,
         phone : phone,
         medic : medic
     });
}
  </script>
  </body>
</html>
