<?php
include "connect.php";
$path="http://www.chipmunk-scripts.com/killmonster";
$player=$_POST['player'];
$password=$_POST['password'];
$pass2=$_POST['pass2'];
$player=strip_tags($player);
$email=$_POST['email'];
$email=strip_tags($email);
if ($password==$pass2)
{
  
  $isplayer="SELECT * from km_users where playername='$player'";
  $isplayer2=mysql_query($isplayer) or die("Could not query players table");
  $isplayer3=mysql_fetch_array($isplayer2);
  if(!$_POST['password'] || !$_POST['pass2'])
  {
     print "You did not enter a password";
  }
  else if($isplayer3 || strlen($player)>15 || strlen($player)<1)
  {
     print "There is already a player of that name or the name you specified is over 15 letters or less than 1 letter";
  }
  else
  {
    $isaddress="SELECT * from km_users where email='$email'";
    $isaddress2=mysql_query($isaddress) or die("not able to query for password");
    $isaddress3=mysql_fetch_array($isaddress2);
    if($isaddress3)
    {
      print "There is already a player with that e-mail address";
    }
    else
    {
      $password=md5($password);
      $date=round(date("U")/1000);
      srand($date);
      $thekey=rand(1,100000000);
      $thekey=md5($thekey);
      $SQL = "INSERT into km_users(playername, password, skillpts, email, validated, validkey, numturns) VALUES ('$player','$password', '5', '$email','0','$thekey','30')"; 
      mysql_query($SQL) or die("could not register");
      mail("$email","Your Kill Monster Activation key","Paste the URL to activate your account.  $path/activate.php?player=$player&password=$password&keynode=$thekey");
      print "registration successful. You have been sent an activation key.<br>";
      print "Click here to <A href='login.php'>Login</a>";
    }
  }
}

else
{
  print "You suck, your passwords didn't match or you did not enter a password";
}
?>


