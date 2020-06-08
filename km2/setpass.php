<?php
//change passwords module for killmonster
include "connect.php";
session_start();
?>
<?php
if(isset($_SESSION['player']))
{
  $player=$_SESSION['player'];
  if(isset($_POST['submit'])||isset($_POST['password']))
  {
    $password=$_POST['password'];
    if(strlen($password)<1)
    {
      print "You need to enter a password";
    }
    else
    {
     
      $password=md5($password);
      $updatepass="update km_users set password='$password' where playername='$player'";
      mysql_query($updatepass) or die("Could not change password");
      print "Password change, please <A href='login.php'>Login</a>";
    }
   
  }
  else
  {
     print "Change your password:";
     print "<form action='setpass.php' method='post'>";
     print "Type new password: <input type='password' name='password' size='15'><br>";
     print "<input type='submit' name='submit' value='submit'></form>";

  }
}
else
{
  print "You are not logged in";
}
?>
