<?php
/*required field code goes here****/
$usrnameErr = $pswordErr = $emailErr = $fnameErr = $lnameErr = "";
$usrname = $psword = $email = $fname = $lname = "";
if($_SERVER['REQUEST_METHOD']=="POST") {
  if(empty($_POST['usrname'])) {
     $usrnameErr = "User name is required"; } else {
     $usrname = $_POST['usrname'];
  }
  if(empty($_POST['psword'])) {
    $pswordErr = "Pass word is required";} else {
    $psword = $_POST['psword'];
  }
  if(empty($_POST['fname'])) {
    $fnameErr = "First name is required";} else {
    $fname = $_POST['fname'];
  }
  if(empty($_POST['lname'])) {
    $lnameErr = "Last name is required";} else {
    $lname = $_POST['lname'];
  }
  if(empty($_POST['email'])) {
    $emailErr = "Email is required"; } else {
    $email = $_POST['email'];
  }
}

$conn = mysqli_connect("localhost", "root", "*****", "webapp");
if($conn === false) {
  die("Error: Could not connect.");
}
if ($usrname && $email && $psword) {
  $ndata = "INSERT INTO registration (usrname, psword, email) VALUES ('$usrname', 'psword','$email')";
  echo $ndata;
  $nresult=mysqli_query($conn, $ndata);} else {
  echo "Please fill all of the requried fields";
}
$conn->close();

?>
