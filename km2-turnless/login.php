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
<b><font color='red'>Kill Monster undergoing some works, the download works fine but the test game here may be down at times due to updating.</font><br>
<b><font color="red">Kill Monster game reset 4/13/2004 , the winner of the last round was Noam</b></font>



</form>
</html>
