<?
parse_str("$QUERY_STRING");

$db = mysql_connect("localhost", "username", "password") or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db("database_name",$db))
 	die("No database selected.");
if(!get_magic_quotes_gpc())
{
  $_GET = array_map('mysql_real_escape_string', $_GET); 
  $_POST = array_map('mysql_real_escape_string', $_POST); 
  $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
}
else
{  
   $_GET = array_map('stripslashes', $_GET); 
   $_POST = array_map('stripslashes', $_POST); 
   $_COOKIE = array_map('stripslashes', $_COOKIE);
   $_GET = array_map('mysql_real_escape_string', $_GET); 
   $_POST = array_map('mysql_real_escape_string', $_POST); 
   $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
}

?>