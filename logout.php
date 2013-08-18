<?php

include 'connection.php';

if($_POST['logout']){
    
    session_start();
session_destroy();
    header('Location: registration.php');
}
else {
    header('Location: sg.php');
}
?>
