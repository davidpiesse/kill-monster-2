<?php
//killmonster amin index
include 'connect.php';
session_start();
?>

<link rel="stylesheet" href="style.css" type="text/css">
<?php
if (isset($_SESSION['player'])) 
  {
    $player=$_SESSION['player'];
    $userstats="SELECT * from km_users where playername='$player'";
    $userstats2=mysql_query($userstats) or die("Could not get user stats");
    $userstats3=mysql_fetch_array($userstats2);
    if(isset($_POST['submit']))
    {
       print "<center>";
       print "<table class='maintable'>";
       print "<tr class='headline'><td><center>Buy Land</center></td></tr>";
       print "<tr class='mainrow'><td>";
       $landacres=$_POST['landacres'];
       $landacres=strip_tags($landacres);
       $total=$landacres*500;
       if($landacres<0)
       {
          print "You cannot buy negative land. <A href='index.php'>Go back to main</a>.";
       }
       else if($userstats3[numturns]<1)
       {
          die("You must have at least 1 turn to buy land. Go back to <A href='index.php'>Main</a>");
       }
       else if($userstats3[gold]<$total)
       {
          print "You do not have enough cash to buy that many acres. <A href='index.php'>Go back to main</a>.";
       }
       else if($userstats3[gold]>=$total)
       {
          $getland="update km_users set gold=gold-'$total', land=land+'$landacres', numturns=numturns-1 where ID='$userstats3[ID]'";
          mysql_query($getland) or die("Could not buy land");
          print "You bought $landacres acres of land. <A href='index.php'>Go back to main</a>.";
       }
       print "</td></tr></table>";       
   
       print "<font size='1'>Script Produced by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Scripts</a></font>";
    }
  }
else
  {
    print "Sorry, not logged in  please <A href='login.php'>Login</a><br>";
  
  }

?>

