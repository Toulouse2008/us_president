<?php
/* User name and pass word can not be empty! */
$usrname = $psword = "";
$usrnameErr = $pswordErr = "";
if($_SERVER["REQUEST_METHOD"]=="POST") {
  if(empty($_POST["usrname"]) && empty($_POST["psword"])) {
    Echo "Please fill all of the required fields!";
  }
  else {
      $usrname = $_POST["usrname"];
      $psword = $_POST["psword"];
      $conn = mysqli_connect("localhost", "root", "******", "webapp");
      if($conn ->connect_error) {
          echo "Serve is not available!";
        die("Connection failed: " . $conn->connet_error);
      }

      $sql = "SELECT usrname, psword FROM registration WHERE usrname = $usrname";
      // get the search result
      $result = $conn->query($sql);
      // if there are hits, print all records
      if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              if($psword == $row["psword"] && $usrname == $row["usrname"])
                  echo $row["usrname"];
                  echo "Welcome " .$row["usrname"]."<br \>\n";
          }
      } else { // no hit, print 0 record
          echo "You are not registered! Please register first!";
      }
      $conn ->close();
  }
}

?>
