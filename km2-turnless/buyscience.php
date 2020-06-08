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
    if(isset($_POST['submit']))
    {
         
        $scipts=$_POST['scipts'];
        $scipts=strip_tags($scipts);
        $totalcost=$scipts*35; 
        print "<center>";
        print "<table class='maintable'>";
        print "<tr class='headline'><td><center>Buy Science</center></td></tr>";
        print "<tr class='mainrow'><td>";
        if($scipts<0)
        {
           print "You cannot buy negative science. Back to <A href='index.php'>Main</a>";
        }
        else if($totalcost>$userstats3[gold])
        {
           die("You do not have enough gold. Please go back to <A href='index.php'>Main</a>");
        }
        else if($totalcost<=$userstats3[gold])
        {
            $updatestats="update km_users set science=science+'$scipts', gold=gold-'$totalcost' where ID='$userstats3[ID]'";
            mysql_query($updatestats) or die("Could not update stats");
            print "You have bought $scipts science points. Back to <A href='index.php'>Main Page</a>";


        }
        print "</td></tr></table>";



    }
  }
else
  {
    print "Sorry, not logged in  please <A href='login.php'>Login</a><br>";
  
  }

?>

