<?php
 require_once 'adminheader.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-firestore.js"></script>

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
  </head>
  <body>
    <div class="container-fluid">
      <div class="col-md-6">
        <h4 class="page-header">Edit First Aid Manual</h4>
        <form class="" id="firstaidedit" action="" role="form" method="post">
          <fieldset>
            <legend>ENTER FIRSTAID DETAILS</legend>
            <div class="form-group">
              <label for="issue">TITLE:</label>
              <select class="" name="issue" value="" id="issue">
                <option>Airway</option>
                <option>Breathing</option>
                <option>Circulation</option>
                <option>Disability</option>
                <option>Exposure</option>
              </select>
            </div>
            <div class="form-group">
              <label for="subissue">SUB-TITLE:</label>
               <select class="" name="subissue" value="" id="subissue">
                 <option>Assessment</option>
                 <option>Management</option>
               </select>
            </div>
            <div class="form-group">
              <label for="details">DETAILS</label>
              <textarea name="details" rows="8" id="details"value="" cols="80"></textarea>
            </div>
            <button  type="submit" class="btn btn-secondary form-btn" name="fambtn" id="fambtn">Add Details</button>
          </fieldset>
        </form>
      </div>
      <div class="col-md-6">
        <h4 class="page-header">Preview</h4>
           <p>nothing to display for now!!</p>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->


<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
  // Your web app's Firebase configuration
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
         const db = firebase.firestore();
         // db.settings({ timestampsInSnapshots: true});
</script>
    <script type="text/javascript">

     db.collection('Manual').get().then((snapshot)=>
      {
        console.log(snapshot.docs);
      })

    //getting data from the first aid edip panel

    document.getElementById('firstaidedit').addEventListener('submit', makeChange);

    function makeChange(e){
    e.preventDefault();

    var title = getInputVal('issue');
    var subtitle = getInputVal('subissue');
    var detail = getInputVal('details');

    console.log(title, subtitle, detail);
     //getting data to save
      saveData(title,subtitle, detail);
    //clear feedform
    document.getElementById('firstaidedit').reset();
    }
    //function to get form values

    function getInputVal(id){
    return document.getElementById(id).value;
    }

    //saving databaseURL
    function saveData(title,subtitle,detail){
      var newEdit = db.collection(Manual).add(newEdit);
       newEdit= set({
        Title: title,
        SubTitle: subtitle,
        Detail: detail
      })
      .then(function() {
      console.log("Document successfully written!");
      })
      .catch(function(error) {
          console.error("Error writing document: ", error);
      });
    }


    </script>
  </body>
</html>
