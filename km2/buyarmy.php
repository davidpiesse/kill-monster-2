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
        $off=$_POST['off'];          
        $dff=$_POST['dff'];
        $off=strip_tags($off);
        $dff=strip_tags($dff);
        $totalcost=($off+$dff)*75;
        $totalunits=$off+$dff+$userstats3[offarmy]+$userstats3[dffarmy];
        $landhold=$userstats3[land]*10;
        $threshold=date("U")-3600*6;    
        $thetime=date("U");  
        print "<center>";
        print "<table class='maintable'>";
        print "<tr class='headline'><td><center>Buy Land</center></td></tr>";
        print "<tr class='mainrow'><td>";
        if($off<0||$dff<0)
        {
           die("You may not buy negative units");
        }
        else if($userstats3[numturns]<1)
        {
           die("You must have at least 1 turn to buy units. Go back to <A href='index.php'>Main</a>");
        }
        else if($totalcost>$userstats3[gold])
        {
          die("You do not have that much gold, go back to <A href='index.php'>Main page</a>");
        }
        else if($totalunits>$landhold)
        {
          die("You do not have enough land to support that many units, go back to <A href='index.php'>Main</a>");
        }
        else if($userstats3[lastaction]>$threshold)
        {
          die("You have to wait six hours after an attack to buy troops, go back to <A href='index.php'>Main</a>.");
        }
        else if($totalunits<=$landhold)
        {
           $getarmy="update km_users set gold=gold-'$totalcost', offarmy=offarmy+'$off', dffarmy=dffarmy+'$dff', numturns=numturns-1 where ID='$userstats3[ID]'";
           mysql_query($getarmy) or die("Can't get army");
           print "Troops aquired. go back to <A href='index.php'>Main</a>.";
        }
        print "</td></tr></table>";



    }
  }
else
  {
    print "Sorry, not logged in  please <A href='login.php'>Login</a><br>";
  
  }

?>

