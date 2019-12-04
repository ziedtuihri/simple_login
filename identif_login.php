<?php

ob_start();
session_start();


require 'DB.php';
require 'Util.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $errors_ = null;

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors_ .= Util::displayAlertV1("Please enter a valid email address", "warning");
    }
    if (empty($_POST["password"])) {
        $errors_ .= Util::displayAlertV1("Password is required.", "warning");
    }
    if (!empty($errors_)) {
        echo $errors_;
    } else {

      $email = $_POST["email"];
      $password = $_POST["password"];

      $sql = "SELECT * FROM `user` WHERE login = '$email' and password = '$password' ";
       $result = mysqli_query($con,$sql);
        $rows1 = mysqli_num_rows($result);

       if($rows1 == 1){
            $_SESSION["username"] = $email;
            $_SESSION["authenticated"] = 1;
            $_SESSION["password"] = $_POST["password"];
            echo $_SESSION["authenticated"];

       }else {
         echo Util::displayAlertV1("Incorrect password or email ", "warning");
       }
    }
}
