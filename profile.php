<!doctype html>
<html>
    <a href='sg.php'><input type='button' value='Back'></a>
    <?php
    session_start();
if(!$_SESSION['userlogin']){
header("location:registration.php");
}

    include 'connection.php';
    $userMail= $_SESSION['userlogin'];
   
    
    
    $query ="SELECT names
             FROM users
             WHERE email='$userMail'
        ";
    $result=mysqli_query($con, $query);
    $userName=mysqli_fetch_assoc($result);
    echo 'Welcome '.$userName['names'].'!';
    ?>
    
<form action="update.php" method="POST">
<table  border="1">
    <tr>
        <td>
Change name:
<br>
<input type="text" name="namechange" placeholder="Change name" />
<input type="submit" name="pic" value="Update">

       </td>
    </tr>
       </form>
    
    <?php
    
    if(isset($_POST['upload'])) {

       
$allowed_filetypes = array('.jpg','.jpeg','.png','.gif');
$max_filesize = 10485760;
$upload_path = 'uploads/';


$filename = $_FILES['userfile']['name'];
$fileExtension=strrchr($filename, '.' );




$ext = substr($filename, strpos($filename,'.'));

if(!in_array($ext,$allowed_filetypes)){
 echo 'The file you attempted to upload is not allowed.';
 ?> <meta http-equiv='refresh' content="1;URL=profile.php">  <?php
exit();
}
 
 
if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize){
  echo 'The file you attempted to upload is too large.';
  ?> <meta http-equiv='refresh' content="2;URL=profile.php">  <?php
exit();
}
if(!is_writable($upload_path)){
  echo 'You cannot upload to the specified directory, please CHMOD it to 777.';
  ?> <meta http-equiv='refresh' content="2;URL=profile.php">  <?php
exit();
}
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path  . $userMail . $fileExtension)) {
   $query = "INSERT INTO uploads (user_email, filename) VALUES ('$userMail', '$userMail$fileExtension')
             ON DUPLICATE KEY UPDATE
             filename='$userMail$fileExtension'"; 
  $result= mysqli_query($con, $query);

echo 'Your file upload was successful!<br>';
?> <meta http-equiv='refresh' content="1;URL=profile.php"><?php

}else{
     echo 'There was an error during the file upload.  Please try again.';
}
}

    ?>
    <br>
    <table border='1' id='pic' width='250' height='250'>
        Profile pic
        <tr>
            
            <td>
        
        
       <?php 
       if($_SESSION['userlogin']){
                
                $query = "SELECT filename
                          FROM uploads
                          WHERE user_email='$userMail'";   
                $result=mysqli_query($con, $query);
                $num_results=mysqli_num_rows($result);
                $result= mysqli_fetch_assoc($result);
                
                
                    if($num_results >0){    
                $ProfilePic=$result['filename'];
                
              
                
                echo "<img src=uploads/$ProfilePic width='250' height='250'>";
                  
                    } 
       else{
                   echo "<img src=uploads/nopic.jpg width='250' height='250'>";
       }
       }
       ?>
            </td>
        </tr>
    </table>
    <br>
    <form action="" method="POST" enctype="multipart/form-data">
        <table border="1">
        <tr>
       <td>
<br>

Upload profile pic:
<br>
<input type="file" name="userfile">
<input type="submit" name="upload">
 </td>
    </tr>
</table>
</form>
    
   
</html>