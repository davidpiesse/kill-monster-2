<?php //slaying monster module
include 'connect.php';
session_start();
if (isset($_SESSION['player'])) 
   {
    if(isset($_POST['submit']))
    {
     $player=$_SESSION['player'];
     $playerstats1="SELECT * from km_users where playername='$player'";
     $playerstats2=mysql_query($playerstats1) or die ("Could not find player");
     $playerstats3=mysql_fetch_array($playerstats2);
     if($playerstats3[numturns]<1)
     {
        print "You need at least 1 turn to kill a monster, please go back to <A href='index.php'>Main</a>.";
     }
     else
     {
       if($playerstats3[justattacked]==0)
       {
         $monstername=$_POST['monstername'];
         $monstername=strip_tags($monstername);
         $selmonster="SELECT * from km_monsters where name='$monstername'";
         $selmonster2=mysql_query($selmonster) or die ("Cannot select Monster");
         $selmonster3=mysql_fetch_array($selmonster2);
         if (!$selmonster3)
         {
           print "There is not a monster of that name";
         }
         else
         {
           $totalskill=$playerstats3[skillpts]+$selmonster3[skill];
           $randomnumber=rand(1,$totalskill);
           if($randomnumber<=$playerstats3[skillpts])
           {
             $gained=$selmonster3[pointsifkilled];
             $gold=$selmonster3[goldworth];
             $updateplayerstats="Update km_users set skillpts=skillpts+'$gained', gold=gold+'$gold' where playername='$player'";
             mysql_query($updateplayerstats) or die("Could not update player stats");
             print "<center><img src='images/knight.gif'></center>";
             print "You slay the $selmonster3[name] is glorius combat and gained $gained skillpts";
             print "<center><A href='index.php'>Kill more monsters</a></center>";
           }
           else
           {
             print "<center><img src='images/defeat.gif'></center>";
             print "The $selmonster3[name] laughs as you run away from the battle like a chicken<br><br>";
             print "<A href='index.php'>Kill more monsters</a>";
           }

          }
          $updaterefresh="update km_users set justattacked=1, numturns=numturns-1 where ID='$playerstats3[ID]'";
          mysql_query($updaterefresh) or die("It just died");
       }
       else
       {
         print "No refreshing is allowed, please go back to <A href='index.php'>Main page</a>";
       }
     }
   }
}
else //not logged in
   {

    print "You are not logged in, please <A href='login.php'>Login</a>";

   }
?>
