<DOCTYPE html>
  <html>
  <head>
    <script src="select.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
<?php

ob_start();
session_start();


require 'DB.php';
require 'Util.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) ) {
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

            $sql2 = "SELECT nom FROM `contact` ";
            $result2 = mysqli_query($con,$sql2);

            echo '
            <br><br><br>
            <center>
            <div>
              <h3>Name : </h3>
              <select style="width: 15%;" id="selectName">
              <option>select your name</option>
              ';
            while ($row2 = mysqli_fetch_array($result2)){

              echo "
              <option value='".$row2["nom"]."'>".$row2["nom"]."</option>";
          }
          echo '
          </select>
        </div>
        <h3>Téléphone : </h3>
        <div id="tel"></div>
        </center>

        ';

       }else {
         echo Util::displayAlertV1("Incorrect password or email ", "warning");
       }

}

}

?>

<body>

<script>
var list =document.getElementById("selectName");


list.addEventListener('change', function() {

  fn1();


});

</script>
</body>
</htm>
