<!doctype html>
<html>
    <?php
 session_start();
    if(isset($_SESSION['userlogin'])){
       
  header("Location: sg.php");
}
    ?>
<head>
    <link rel="stylesheet" href="regform.css" type="text/css">
    <title>Reg form</title>
</head>
<body>
    <form action="" method='POST'>
        <table id='regtable' border='1'>     
            <th>Registration form</th>
            <tr>
                <td>
            Names:
            <br> 
            <input type='text' name='names'> 
            <br>  
            Password:
            <br> 
            <input type='password' name='password'>
            <br>
           Repeat password: 
           <br> 
           <input type='password' name='password2'>
           <br>
           E-mail: 
           <br> 
           <input type='text' name='email'> 
           <br>
           Secret question:
           <br> 
           <input type="text" name="secret"> <br>
           <input type='submit' value='Register' name="submit">
           </td>
            </tr> 
        </table>
        </form>
  <?php
$con=mysqli_connect("localhost", "root", "", "library");


    $names = filter_input(INPUT_POST, 'names');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $repeatpassword = filter_input(INPUT_POST, 'password2');
    $secretQ = filter_input(INPUT_POST, 'secret');
    
    
       if($names&&$email&&$password&&$repeatpassword&&$secretQ)
       {
      

    if ($password==$repeatpassword)
    {
   
        if (strlen($names)>64)
        {
        echo "username or full name is too long!";
        }
        else
        {
        
       
        
            if (strlen ($password)>25 || strlen ($password)<6)
            {
            echo "Password must be between 6 and 25 characters";
            }
            
            
            else
            {
            
                $registration = "INSERT INTO users VALUES ('', '$names', '".md5($password)."', '$email', '', '$secretQ')";
  
              mysqli_query($con, $registration);
              $error = mysqli_errno($con);
            echo  mysqli_error($con);
            
            
              
          
              if (!$error){
                 echo 'Registration is successuful!'; 
                 session_start();
               $_SESSION['userlogin'] = $email;
                header("Location: sg.php");
              }
              
            }
    
        }

    }
    else echo "Your passwords do not match";

}

else echo "*Please fill in <b>all</b> fields!";



?>
    <!--login form -->
    <form id="loginForm" action="checklogin.php" method="POST">
        <table border="1">
            <th>Login</th>
            <tr>
                <td>
      Email: 
      <br>  
      <input type="text" name="email">
      <br>
      Password: 
      <br>
      <input type="password" name="password">
      <br>
      <a href="lostpass.php">Lost password?</a>
      <br>
        <input type="submit" name="loginB">
        
        
        </table>
    </form>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js.js"></script>
    </body>
  

</html>