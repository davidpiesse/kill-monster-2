<center>
<!-- FASTCLICK.COM 468x60 v1.4 for chipmunk-scripts.com -->
<script language="Javascript"><!--
var i=j=p=t=u=x=z=dc='';var id=f=0;var f=Math.floor(Math.random()*7777);
id=12045; dc=document;u='ht'+'tp://media.fastclick.net/w'; x='/get.media?t=n';
z=' width=468 height=60 border=0 ';t=z+'marginheight=0 marginwidth=';
i=u+x+'&sid='+id+'&m=1&f=b&v=1.4&c='+f+'&r='+escape(dc.referrer);
u='<a  hr'+'ef="'+u+'/click.here?sid='+id+'&m=1&c='+f+'"  target="_blank">';
dc.writeln('<ifr'+'ame src="'+i+'&d=f"'+t+'0 hspace=0 vspace=0 frameborder=0 scrolling=no>');
if(navigator.appName.indexOf('Mic')<=0){dc.writeln(u+'<img src="'+i+'&d=n"'+z+'></a>');}
dc.writeln('</iframe>'); // --></script><noscript>
<a href="http://media.fastclick.net/w/click.here?sid=12045&m=1&c=1"  target="_blank">
<img src="http://media.fastclick.net/w/get.media?sid=12045&m=1&d=s&c=1&f=b&v=1.4"
width=468 height=60 border=1></a></noscript>
<!-- FASTCLICK.COM 468x60 v1.4 for chipmunk-scripts.com -->
</center><br><br>

<?php //module to display the top users
  include "connect.php";
  if(!isset($start))
  {
    $start=0;
  }
  $order="SELECT * from km_users";
  $order2=mysql_query($order);
  $d=0;
  $f=0;
  $g=1;
  print "<center>Page: ";
  while($order3=mysql_fetch_array($order2))
  {
    if($f%20==0)
    {
      print "<A href='tophonor.php?start=$d'>$g</a> ";
      $g++;
    }
    $d=$d+1;
    $f++;
  }
  print "</center><center>Players by Rank<br>";
  print "<table border='1'><tr><td>ID#</td><td>Player</td><td>Honor</td></tr>";
  $topplayers="SELECT * from km_users order by honor DESC Limit $start, 20";
  $topplayers2=mysql_query($topplayers) or die("Could not query players");
  while($topplayer3=mysql_fetch_array($topplayers2))
  {
    $topplayer3[playername]=strip_tags($topplayer3[playername]);
    print "<tr><td>$topplayer3[ID]</td><td>$topplayer3[playername]</td><td>$topplayer3[honor]</td></tr>";
  }
  print "</table>";
?>

<br><br><font size='1'>Script Produced by © <A href="http://www.chipmunk-scripts.com">Chipmunk Scripts</a></font>
