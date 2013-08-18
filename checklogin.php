<?php

include 'connection.php';


$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');




$query = "SELECT email FROM users WHERE email='" . mysqli_real_escape_string($con, $email) . "' AND password= '".md5($password)."'";
   $result = mysqli_query($con, $query);
   
   

   
   if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      
      $name = $row['email'];

      
      session_start();
      
      $_SESSION['userlogin'] = $name;
      header("Location: sg.php");
   }
   else {
      echo "The combination of the login and password do not match";
   }
 ?>
<a href="registration.php"><input type="submit" value="Back"></a>