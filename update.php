<?php
session_start();
if(!$_SESSION['userlogin']){
header("location:registration.php");
}


    include 'connection.php';
    
if (isset($_POST['namechange'])){
    
    
    $name=$_POST['namechange'];
    if(strlen($name)>64 || strlen($name)<2){
        echo 'Please enter a valid name!';
        ?>
        <META http-equiv="refresh" content="3;URL=profile.php">
        <?php
    }else{
    $userEmail=$_SESSION['userlogin'];
    $query = "UPDATE library.users
              SET names = '$name'
              WHERE users.email = '$userEmail'";
    
    $result = mysqli_query($con, $query);
    echo 'Update success!';
    }
}
?>
    <META http-equiv="refresh" content="3;URL=profile.php">
    <?php
    
if(isset($_FILES['pic'])){
    echo 'pic heree';
}

