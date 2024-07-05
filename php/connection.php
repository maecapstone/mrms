<?php
  $SERVER_NAME = "localhost";
  $SERVER_USER = "root";
  $SERVER_PASS = "";
  $SERVER_DB = "mariemae_mrms";

  try{
      $conn = mysqli_connect($SERVER_NAME, $SERVER_USER, $SERVER_PASS, $SERVER_DB);
  }
  catch(Exception $e){
      echo "Connection failed!";
  }
?>