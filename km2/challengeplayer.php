<?php
//killmonster amin index
include 'connect.php';
session_start();
?>

<?
if (isset($_SESSION['player'])) 
{
  if(isset($_POST['submit2']))
  {
    $datenow=date("U");
    $datenow=$datenow%100000;
    srand($datenow);
    $yourstats="SELECT * from km_users where playername='$player'";
    $yourstats2=mysql_query($yourstats) or die("Could not get your stats");
    $yourstats3=mysql_fetch_array($yourstats2);
    $playerID=$_POST['playerID'];
    $playerID=strip_tags($playerID);
    $oppstats="SELECT * from km_users where ID='$playerID'";
    $oppstats2=mysql_query($oppstats) or die("Could not get opponent's stats");
    $oppstats3=mysql_fetch_array($oppstats2);
    $statst=2*$oppstats3[skillpts];
    if($yourstats3[numturns]<2)
    {
       die("You need at least 2 turns to challenge someone else. Please go back to <A href='index.php'>.");
    }
    else if($yourstats3[ID]===$oppstats3[ID])
    {
       die("You may not challenge yourself, go back to <A href='index.php'>main page</a>.");
    }
    else if($yourstats3[skillpts]>=$statst)
    {
       die("You may not kill opponents who have less than half your skill points. Please go back to <A href='index.php'>Main page</a>.");
    }
    else if(!$oppstats3||$oppstats3[dead]=='Yes')
    {
      print "There is no such player or the player is already dead, please go back to <A href='index.php'>Main game page</a>";
    }
    else
    {
      $totalstats=$oppstats3[skillpts]+$yourstats3[skillpts];
      $randomnumber=rand(1, $totalstats);
      if($randomnumber<=$yourstats3[skillpts])
      {
        $ptsgained=$oppstats3[skillpts]/10;
        $ptslost=$oppstats3[skillpts]/3;
        print "<b>Congradulations, You have slain $oppstats3[playername] and have gained $ptsgained skill points.<br>";
        $updateyourstats="update km_users set skillpts=skillpts+'$ptsgained',honor=honor+1,numturns=numturns-2 where playername='$player'";
        mysql_query($updateyourstats) or die("Could not update your stats");
        $updateopp="update km_users set skillpts=skillpts-'$ptslost',dead='Yes',killer='$player',numberattck='0', honor=honor-1 where ID='$playerID'";
        mysql_query($updateopp) or die(mysql_error());
        print "Back to <A href='index.php'>Main game page</a>.";
      }
      else if($randomnumber>$yourstats3[skillpts])
      {
        $ptsgained=$yourstats3[skillpts]/10;
        $ptslost=$yourstats3[skillpts]/3;
        print "You have lost the battle and have been slain, you will need to go to the <A href='index.php'>Main game page</a> and revive yourself.<br>";
        $killyou="update km_users set skillpts=skillpts-'$ptslost',dead='Yes', killer='$oppstats3[playername]', honor=honor-1,numturns=numturns-2 where playername='$player'";
        mysql_query($killyou) or die("Could not kill you");
        $foestats="update km_users set skillpts=skillpts+'$ptsgained', numberattck=numberattck+'1', honor=honor+1 where ID='$playerID'";
        mysql_query($foestats) or die("Could not dishonor you by updating opponent's stats");
      }

   }
  }
  
}

else
{
  print "You are not logged in, please <A href='login.php'>Login</a>";
}

?>