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
    if($userstats3[dead]=='Yes')
    {
      print "You have been slain by $userstats3[killer]<br>";
      print "<form action='revive.php' method='post'>";
      print "<input type='hidden' name='ID' value='$userstats3[ID]'>";
      print "<input type='submit' name='revives' value='revive'></form>";
    }
    else
    {
      $updaterefresh="update km_users set justattacked=0 where ID='$userstats3[ID]'";
      mysql_query($updaterefresh) or die("Died");
      print "<center><table class='maintable'>";
      print "<tr class='headline'><td>";   
      print "<center><b>Welcome warrior, $player. So you have come to rid the world of evil monsters, do not take on more than you can handle! Monsters are listed in order of increasing difficulty.</b></center>";
      print "</td></tr></table></center><br><br>";
      print "<center><table class='maintable'>";
      print "<tr><td valign='top'>";
      print "<table class='maintable'><tr class='headline'><td>Change Password</td></tr>";
      print "<tr class='mainrow'><td><b>Password change:</b><A href='setpass.php'>Change password</a></td></tr></table><br><br>";    
      print "<table class='maintable'><tr class='headline'><td><center>Ranks and Rules</center></td></tr>";
      print "<tr class='mainrow'><td><A href='top.php'>Players by rank</a></td></tr>";
      print "<tr class='mainrow'><td><A href='playerclose.php'>Players close to you</a></td></tr>";
      print "<tr class='mainrow'><td><A href='tophonor.php'>Players by Honor</a></td></tr>";
      print "<tr class='mainrow'><td><A href='topland.php'>Largest Fiefdoms(land)</a></td></tr>";
      print "<tr class='mainrow'><td><A href='forums/index.php'>Player Forums</a></td></tr>";
      print "<tr class='mainrow'><td><A href='challengeinfo.php'>Rules for Challenging Other players</a></td></tr>";
      print "</table><br><br>";
      print "<table class='maintable'><tr class='headline'><td><center>Buy Land</center></td></tr>";
      print "<tr class='mainrow'><td>Land Costs $500 per acre(very expensive).<br>";
      print "<form action='buyland.php?ID=$userstats3[ID]' method='post'>";
      print "Acres to buy:&nbsp;<input type='text' name='landacres' size='6'>&nbsp;";
      print "<input type='submit' name='submit' value='buy'></form></td></tr></table><br><br>";
      print "<table class='maintable'><tr class='headline'><td><center>Buy Army</center></td></tr>";
      print "<tr class='mainrow'><td>";
      print "Each troop Cost 75 gold and each acres can support a max of ten troops:<br>";
      print "<form action='buyarmy.php?ID=$userstats3[ID]' method='post'>";
      print "Offensive Units:&nbsp;<input type='text' name='off' size='6'><br>";
      print "Defensive Units:&nbsp;<input type='text' name='dff' size='6'><br>";
      print "<input type='submit' name='submit' value='Buy Army'></form>";
      print "</td></tr></table><br><br>";
      print "<table class='maintable'><tr class='headline'><td><center>Buy army Training Pts</center></td></tr>";
      print "<tr class='mainrow'><td>";
      print "Each science point Cost 35 gold.<br>";
      $max=$userstats3[land]*10;
      if($userstats3[land]<=0)
      {
         print "Science not applicable due to lack of land.";
      }
      else
      {
        $percent=$userstats3[science]/$max*100;
        print "You have: $userstats3[science] pts($percent %)";
      }
      print "<form action='buyscience.php?ID=$user3stats[ID]' method='post'>";
      print "<input type='text' name='scipts' size='6'><br>";
      print "<input type='submit' name='submit' value='submit'></form>";
      print "</td></tr></table>";
      print "</td>";
      print "<td valign='top'>";
      print "<table class='maintable'>";
      print "<tr class='headline'><td><center>Stats</center></td></tr>";
      print "<tr class='mainrow'><td><b>You have $userstats3[numturns] Turns</b></td></tr>";
      print "<tr class='mainrow'><td><b>Your skill pts: $userstats3[skillpts]</b></td></tr>";
      print "<tr class='mainrow'><td><b>Your Honor: $userstats3[honor]</b></td></tr>";
      print "<tr class='mainrow'><td><b>Your Gold: $userstats3[gold]</b></td></tr>";
      print "<tr class='mainrow'><td><b>Your Land: $userstats3[land]</b></td></tr>";
      print "<tr class='mainrow'><td><b>Your offensive army: $userstats3[offarmy]</b></td></tr>";
      print "<tr class='mainrow'><td><b>Your Defensive army: $userstats3[dffarmy]</b></td></tr>";
      print "<tr class='mainrow'><td><b>Army training pts: $userstats3[science]</b></td></tr>";
      print "</table><br>";
      print "<table class='maintable'>";
      print "<tr class='headline'><td><center>Select Monster to Slay</center></td></tr>";
      print "<tr class='mainrow'><td>";
      print "<form action='slaymonster.php' method='post'>";
      print "<select name='monstername' length='20'>";
      $monster1="SELECT * from km_monsters order by skill asc";
      $monster2=mysql_query($monster1) or die("Could not select Monster");
      while ($monster3=mysql_fetch_array($monster2))
      {
        print "<option>$monster3[name]</option>";
      }
      print "</select><br>";
      print "<input type='submit' name='submit' value='Kill Monster'></form>";
      print "</td></tr></table><br>";
      print "<table class='maintable'>";
      print "<tr class='headline'><td><center>Select Player to challenge</center></td></tr>";
      print "<tr class='mainrow'><td>";
      print "Type the ID# of the player you wish to challenge:<br>";
      print "<form action='challengeplayer.php' method='post'>";
      print "<input type='text' name='playerID' size='20'><br>";
      print "<input type='submit' name='submit2' value='challenge'></form>";
      print "</td></tr></table><br><br>";
      print "<table class='maintable'>";
      print "<tr class='headline'><td><center>Select player's land to attack</center></td></tr>";
      print "<tr class='mainrow'><td>";
      print "Type the ID# of the player whose land you wish to attack:<br>";
      print "<form action='attack.php' method='post'>";
      print "<input type='text' name='victimid' size='20'><br>";
      print "<input type='submit' name='submit' value='Attack'></form>";
      print "</td></tr></table><br><br>";
      print "</td></tr></table><br><br>";
      
      print "<table class='maintable'>";
      print "<tr class='headline'><td><center>Attacked!!</center></td></tr>";
      print "<tr class='mainrow'><td>";
      if($userstats3[numberattck]>0)
      {
        print "<font color='red'>You have survived $userstats3[numberattck] attacks since your last login.</font><br><br>";
        $resets="update km_users set numberattck='0' where playername='$player'";
        mysql_query($resets) or die("could not query");
      }
      print "</td></tr></table><br><br>";
      $getbattlerecords="SELECT * from km_battlerecords where victimid='$userstats3[ID]'";
      $getbattlerecords2=mysql_query($getbattlerecords) or die("Could not get battlerecords");
      print "<table class='maintable'>";
      print "<tr class='headline'><td colspan='4'><center>Battle records since last login</center></td></tr>";
      print "<tr class='mainrow'><td>Attacker ID</td><td>Attacker name</td><td>Result</td><td>Land lost</td></tr>";
      while($getbattlerecords3=mysql_fetch_array($getbattlerecords2))
      {
         print "<tr class='mainrow'><td>$getbattlerecords3[attid]</td><td>$getbattlerecords3[attname]</td><td>$getbattlerecords3[result]</td><td>$getbattlerecords3[landlost]</td></tr>";
      }
      print "</table><br><br>";
      $delrecords="Delete from km_battlerecords where victimid='$userstats3[ID]'";
      mysql_query($delrecords) or die("Could not delete battle records");
      print "<font size='1'>Script Produced by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Scripts</a></font>";
    }
  }
else
  {
    print "Sorry, not logged in  please <A href='login.php'>Login</a><br>";
  
  }

?>

<!-- Site Meter -->
<script type="text/javascript" src="http://s17.sitemeter.com/js/counter.js?site=s17chipmunk">
</script>
<noscript>
<a href="http://s17.sitemeter.com/stats.asp?site=s17chipmunk" target="_top">
<img src="http://s17.sitemeter.com/meter.asp?site=s17chipmunk" alt="Site Meter" border="0"/></a>
</noscript>
<!-- Copyright (c)2006 Site Meter -->

