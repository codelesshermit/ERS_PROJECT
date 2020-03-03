<?php
  require "dbconfig.php";
 //$title=$date=$location=$details=$author="";

 if(isset("submit")){
   $title = $_POST['ftitle'];
   $date = $_POST['date'];
   $location = $_POST['location'];
   $details = $_POST['fdetails'];
   $author = $_POST['author'];




$sql = "INSERT INTO feed(title, occcurencedate, location, details, author) VALUES('$title', '$date', '$location', '$details', '$author');";

$result = mysqli_query($conn, $sql);
}
?>
