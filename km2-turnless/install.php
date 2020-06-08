<?php
include "connect.php";
$installadmins="CREATE TABLE km_admins (
  ID int(11) NOT NULL auto_increment,
  username varchar(255) NOT NULL default '',
  password varchar(255) NOT NULL default '',
  PRIMARY KEY  (ID)
)";
mysql_query($installadmins) or die("Could not install Admins");
$installbattles="CREATE TABLE km_battlerecords (
  ID bigint(20) NOT NULL auto_increment,
  attid bigint(20) NOT NULL default '0',
  attname varchar(255) NOT NULL default '',
  result tinytext NOT NULL,
  landlost bigint(20) NOT NULL default '0',
  victimid bigint(20) NOT NULL default '0',
  PRIMARY KEY  (ID)
)";
mysql_query($installbattles) or die("Could not install battles");
$installmonster="CREATE TABLE km_monsters (
  ID bigint(20) NOT NULL auto_increment,
  name varchar(255) NOT NULL default '',
  skill bigint(20) NOT NULL default '0',
  pointsifkilled bigint(255) NOT NULL default '0',
  goldworth bigint(20) NOT NULL default '0',
  PRIMARY KEY  (ID)
)";
mysql_query($installmonster) or die("Could not install monsters");
$installusers="CREATE TABLE km_users (
  ID bigint(21) NOT NULL auto_increment,
  playername varchar(15) NOT NULL default '',
  password varchar(255) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  skillpts bigint(21) NOT NULL default '0',
  dead varchar(255) NOT NULL default '',
  killer varchar(255) NOT NULL default '',
  numberattck bigint(20) NOT NULL default '0',
  justattacked int(4) NOT NULL default '0',
  honor int(11) NOT NULL default '0',
  lastaction bigint(20) NOT NULL default '0',
  gold bigint(20) NOT NULL default '0',
  land bigint(20) NOT NULL default '0',
  offarmy bigint(20) NOT NULL default '0',
  dffarmy bigint(6) NOT NULL default '0',
  science bigint(20) NOT NULL default '0',
  validated int(11) NOT NULL default '0',
  validkey varchar(255) NOT NULL default '',
  PRIMARY KEY  (ID)
)";
mysql_query($installusers) or die("Could not install users");
print "Game installed, please delete install.php";
?>