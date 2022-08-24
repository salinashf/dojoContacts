<?php
    $db_host = "localhost";
    $db_user = "dojocontacts";
    $db_pass = "123456";
    $db_name = "dojocontacts";
    //Connect to MySQL
    $conn = mysqli_connect($db_host, $db_user, $db_pass,$db_name);
    //Select database mysqli_select_db($db_name, $conn);
    // Check connection
    if ($conn -> connect_errno) {
      echo "Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }
?>