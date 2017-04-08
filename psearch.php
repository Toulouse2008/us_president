<?php
$inputErr = “”;
$No = $FirstName = $LastName = “”;
// check if "POST"
if ($_SERVER["REQUEST_METHOD"]=="POST"){
  // make sure either no or full name is submitted
  if (empty($_POST["no"]) && (empty($_POST["last_name"]) || empty($_POST["first_name"]))){
    echo 'Presidency No, First Name or Last Name at least one is required';
} else if (!empty($_POST["no"]) &&  !empty($_POST["first_name"]) && !empty($_POST["last_name"])){
    echo "Presidency No or Last Name, only one is required!";
  }
}
// connect to MySQL or die
$conn = mysqli_connect("localhost", "root", "******", "webapp");
if($conn ->connect_error) {
    echo "Not connected";
  die("Connection failed: " . $conn->connet_error);
}

if (!empty($_POST["no"])) {
  // get presidency no
  $No = $_POST["no"];
  // MySQL select statement
  $sql = "SELECT last_name, first_name, suffix FROM president WHERE number=$No";
  $result = $conn->query($sql);
  // if there are hits in database, print records
  if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<p>The $No(th) of US president is</p> \n First Name: " .$row["first_name"]. ", \nLast name: ". $row["last_name"]. " ".$row["suffix"]. "<br \>\n";
      }
  } else { // print 0 record found
      echo "0 record found!";
  }
} else {  // search by first_name and last_name
    // get value for first_name and last_name
    $FirstName = $_POST["first_name"];
    $LastName = $_POST["last_name"];
    // select sql statement
    $sql = "SELECT number, suffix FROM president WHERE last_name='$LastName' and first_name='$FirstName' ";
    // get the search result
    $result = $conn->query($sql);
    // if there are hits, print all records
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "The " .$row["number"]."(th) of US president is: \n" .$FirstName. ", ". $LastName. " ".$row["suffix"]. "<br \>\n";
        }
    } else { // no hit, print 0 record
        echo "0 record found!";
    }
}

// close database connection
$conn->close();
?>
