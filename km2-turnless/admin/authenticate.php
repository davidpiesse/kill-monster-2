<?php

include "connect.php";

if (isset($_POST['submit'])) // name of submit button
{
    $isadmin=$_POST['isadmin'];
    $password=$_POST['password'];
    $password=md5($password);
    $query = "select * from km_admins where username='$isadmin' and password='$password'"; 
    $result = mysql_query($query) ;
    
    $isAuth = false; //set to false originally
    
    while($row = mysql_fetch_array($result))
    {
        if($row['username'] === $isadmin) 
        {
           
            $isadmin="IAMADMIN";
            $isAuth = true;
            session_start();
            $_SESSION['isadmin']=$isadmin; 

        }  
    }  
    
    if($isAuth)
    {
                print "logged in successfully<br><br>";
                print "<A href='index.php'>Go to Admin Panel</a>";
}
else
{
print "Wrong username or password";
}
}

?>