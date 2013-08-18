<?php
session_start();
include 'connection.php';




?>
<a href="sg.php"><input type="submit" value="Back"></a>
<form action="" method="POST">
    <table border="1">
        <tr>
            <td>
                Enter new password:
                <br>
                <input type="password" name="password">
                <br>
                Repeat password:
                <br>
                <input type="password" name="password2">
                <br>
                Submit:
                <br>
                <input type="submit" name="submit" value="Change">
                
            </td>
        </tr>
    </table>
</form>

<?php



$secret = $_SESSION['secret'];
$newpass= filter_input(INPUT_POST, 'password');
$checkpass= filter_input(INPUT_POST, 'password2');
if($newpass==$checkpass) {
    

if (strlen ($newpass)>25 || strlen ($newpass)<6)
            {
            echo "Password must be between 6 and 25 characters";
            }
            else{
                
            

if($newpass){
    
 $query = "UPDATE users
          SET password = MD5('$newpass')
          WHERE secret =  '$secret'  ";

$result = mysqli_query($con, $query);
echo 'Password changed successfully!';
//header("Location: registration.php");
?>
<META http-equiv="refresh" content="3;URL=registration.php">

<?php
}
}
} else echo "Your passwords do not match";