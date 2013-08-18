<?php
session_start();
if(!$_SESSION['userlogin']){
header("location:registration.php");
}

?>
<!doctype html>

<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
        <title>Select Genres</title>
        <link rel="stylesheet" href="sg.css" type="text/css">
    </head> 
    <body>
        <form action="logout.php" method="POST">
            
            <input type="submit" name="logout" value="Logout">
        </form>
         <a href="profile.php"><input type="submit" name="editProfile" value="Profile"></a>
       <form action="db.php" method="POST">
<div align="center"><br>  
    <table id='table1' cellspacing="0">
        <th id="selectGenre">     
        Select genre:
        </th>
  <?php
$con = mysqli_connect("localhost", "root", "", "library");

$get_genres_sql = 
        
 "SELECT id, name
     FROM genres
     ORDER BY name";

$genresResult = mysqli_query($con, $get_genres_sql);

      while($row = mysqli_fetch_assoc($genresResult)):
?>    
    <tr>
    <td><input type="checkbox" value="<?=$row['id'] ?>"  name="genre[<?=$row['id'] ?>]"><?=$row['name'] ?>
    <br>
<?php endwhile; ?>        
</table>
       <input type="submit" name='button' id='buttonForm' value="Show">
       <input type="submit" name='export' id='export' value="Download">
      </div>
        </form>
        
        
        
</body>
</html>