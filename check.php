<!doctype html>
<?php

include 'connection.php';


$email=$_POST['email'];
$secret=$_POST['secret'];

session_start();

$_SESSION['secret'] = $secret;


$query = "SELECT email, secret
          FROM users
          WHERE email = '$email'
          AND secret = '$secret' ";

$result = mysqli_query($con, $query) or die("Query Failed: $query " . mysqli_error());  

if(mysqli_num_rows($result) > 0)
{

while ($row = mysqli_fetch_assoc($result)) {
    
 if($row['email']==$email && $row['secret']==$secret){
     header("Location: changepass.php");
 }
   
}
}else{
    ?>
<br>
<META http-equiv="refresh" content="2;URL=lostpass.php">


<?php
     echo 'Wrong E-mail or Secret Question!';
 }