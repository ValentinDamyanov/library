<?php
include 'connection.php';

?>
<a href="registration.php"><input type="submit" value="Back"></a>
<form action="check.php" method="POST">
    <table border="1">
        <tr>
            <td>
    E-mail:
    <br>
    <input type="text" name="email">
    <br>
    Secret question:
    <br>
    <input type="text" name="secret">
    <br>
    <input type="submit" name="lostpass">
            </td>
    </tr>
    </table>
</form>