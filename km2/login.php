<?php
session_start();
if(isset($_SESSION['player']))
{
  session_destroy();
}
?>
<html>
<form method="POST" action="authenticate.php">
Type Username Here: <input type="text" name="player" size="15"><br>
Type Password Here: <input type="password" name="password" size="15" mask="x"><br>
<input type="submit" value="submit" name="submit"><br><br>
Not registered? Please <A href='register.php'>Register</a><br><br>
Forgot password? <A href="getpass.php">Get Password</a><br><br>
Be sure to actually hit the "login" button when you login, hitting enter on the keyboard will not work, sorry.<br><br>
<li>Kill Monster has been reset on 5/1/2005. I have now implemented turns, please test and post on the forum about your thoughts.<br><br>
**************************************************************
Now actions require turns:<br>
Kill a Monster= 1 turn<br>
Challenge a player= 2 turns<br>
Attack someone land = 3 turns<br>
Buy anything = 1 turn<br><br>
You start with 30 turns and there are 15 turns per hour(added on the hour not every 4 minutes)


</form>
</html>

