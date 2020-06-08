<?php
//killmonster amin index
include 'connect.php';
session_start();
?>
<center>

<iframe marginwidth="0" marginheight="0" width="468" height="60" scrolling="no" frameborder="0" src="http://rcm.amazon.com/e/cm?t=arcadeportal&p=13&o=1&l=bn1&browse=1000&mode=books&f=ifr">


<MAP NAME="boxmap-p13"><AREA SHAPE="RECT" COORDS="379, 50, 460, 57" HREF="http://rcm.amazon.com/e/cm/privacy-policy.html?o=1" ><AREA COORDS="0,0,10000,10000" HREF="http://www.amazon.com/exec/obidos/redirect-home/arcadeportal" ></MAP><img src="http://rcm-images.amazon.com/images/G/01/rcm/468x60.gif" width="468" height="60" border="0" usemap="#boxmap-p13" alt="Shop at Amazon.com">


</iframe>

</center><br><br>
<link rel="stylesheet" href="style.css" type="text/css">
<?php
if (isset($_SESSION['player'])) 
  {
    $player=$_SESSION['player'];
    $userstats="SELECT * from km_users where playername='$player'";
    $userstats2=mysql_query($userstats) or die("Could not get user stats");
    $userstats3=mysql_fetch_array($userstats2);
    $victimid=$_POST['victimid'];
    $victimid=strip_tags($victimid);
    $victimselect="SELECT * from km_users where ID='$victimid'";
    $victimselect2=mysql_query($victimselect) or die("Could not select Victim");
    $victimselect3=mysql_fetch_array($victimselect2);
    $minlim=2*$victimselect3[land];
    $thetime=date("U");
    $timelimit=$thetime-3600*6;
    $attacklimit="SELECT COUNT(*) as attname from km_battlerecords where ID='$vicitimselect3[ID]'";
    $attacklimit2=mysql_query($attacklimit) or die("Could not get limit");
    $attacklimit3=mysql_result($attacklimit2,0);

    if(isset($_POST['submit']))
    {
      
        print "<center>";
        print "<table class='maintable'>";
        print "<tr class='headline'><td><center>Buy Land</center></td></tr>";
        print "<tr class='mainrow'><td>";
        if($userstats3[land]>$minlim)
        {
            die("You cannot attack someone with less than half your land. Go back to <A href='index.php'>Main</a>.");
        }
        else if($userstats3[lastaction]>$timelimit)
        {
            die("You have  attacked  within the last 6 hours, you can only take one of these actions in each 6-hour period. <A href='index.php'>Back to Main</a>.");
        }
        else if($userstats3[ID]==$victimselect3[ID])
        {
            die("Of Course, you cannot attack yourself, <A href='index.php'>Back to Main</a>.");
        }
        else if($attacklimit3>=5)
        {
            die("That person has already been attacked 5 times since his last logon,  you may not attack him. Back to <A href='index.php'>Main</a>");
        }
        else if($victimselect3[land]<=0)
        {
            die("You cannot attack someone that has no land, back to <A href='index.php'>Main</a>");
        }
        else if($userstats3[land]<1)
        {
          die("You cannot attack someone if you have no land to attack from, back to <A href='index.php'>Main</a>");
        }
        else
        {
           $updateactions="Update km_users set lastaction='$thetime' where ID='$userstats3[ID]'";
           mysql_query($updateactions) or die("Could not update actions");
           $attscimod=$userstats3[science]/($userstats3[land]*10)+1;
           $dffscimod=$victimselect3[science]/($victimselect3[land]*10)+1;
           if($userstats3[honor]>50)
           {
               $ahonormod=1.5;
           }
           else if($userstats3[honor]>25)
           {
               $ahonormod=1.3;
           }
           else  if($userstats3[honor]>10)
           {
               $ahonormod=1.1;
           }
           else
           {
               $ahonormod=1;
           }
           if($victimselect3[honor]>50)
           {
               $dhonormod=1.5;
           }
           else if($victimselect3[honor]>25)
           {
               $dhonormod=1.3;
           }
           else if($victimselect3[honor]>10)
           {
               $dhonormod=1.1;
           }
           else
           {
               $dhonormod=1;
           }
           $attstrength=$userstats3[offarmy]*5*$attscimod*$ahonormod;
           $dffstrength=$victimselect3[dffarmy]*5*$dffscimod*$dhonormod;
           $attloss=round($dffstrength/30);
           $dffloss=round($attstrength/40);
           if($attloss>=$userstats3[offarmy])
           {
              $attloss=$userstats3[offarmy];
           }
           if($dffloss>=$victimselect3[dffarmy])
           {
              $dffloss=$victimselect3[dffarmy];
           }
           if($attstrength>$dffstrength)
           {
              $wonland=$victimselect3[land]/10;
              $wonland=round($wonland);
              $battlerecord="INSERT into km_battlerecords (victimid,attid,attname,result,landlost) values('$victimselect3[ID]','$userstats3[ID]','$userstats3[playername]','lost','$wonland')";
              mysql_query($battlerecord) or die("Could not update records");
              $updatestats1="update km_users set offarmy=offarmy-'$attloss', land=land+'$wonland' where ID='$userstats3[ID]'";
              mysql_query($updatestats1) or die("Could not gain land");
              $updatestats2="update km_users set dffarmy=dffarmy-'$dffloss', land=land-'$wonland' where ID='$victimselect3[ID]'";
              mysql_query($updatestats2) or die("Could not lose land");
              print "You have won the battle and killed $dffloss of the enemy's troops while losing $attloss troops and gained $wonland acres of land. <A href='index.php'>Back to Main</a><br>.";
           }
           else
           {
              
              $updatestats1="update km_users set offarmy=offarmy-'$attloss' where ID='$userstats3[ID]'";
              mysql_query($updatestats1) or die("Could not gain land");
              $updatestats2="update km_users set dffarmy=dffarmy-'$dffloss' where ID='$victimselect3[ID]'";
              mysql_query($updatestats2) or die(mysql_error());
              $battlerecord="INSERT into km_battlerecords (victimid,attid,attname,result,landlost) values('$victimselect3[ID]','$userstats3[ID]','$userstats3[playername]','won','0')";
              mysql_query($battlerecord) or die(mysql_error());
              print "Your attack was unsuccessful and you lost $attloss while killing $dffloss of the enemy troops, back to <A href='index.php'>Main</a><br>";
           }
          
        }

           



        print "</td></tr></table>";



    }
  }
else
  {
    print "Sorry, not logged in  please <A href='login.php'>Login</a><br>";
  
  }

?>

