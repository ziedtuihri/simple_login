<?php
require "DB.php";
if(isset($_POST["name"])){
  $name = $_POST["name"];

  $tab=array();

  $sql2 = "SELECT tel FROM `contact` where nom = '$name'";
  $result2 = mysqli_query($con,$sql2);

  $data = array();
  while ($row = mysqli_fetch_object($result2))
  {
      array_push($data, $row);
  }




  //header('Content-Type: application/json');
  echo json_encode($data);
  exit();
}

?>
