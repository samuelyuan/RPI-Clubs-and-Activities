<?php
require_once("club_functions.php");
connectToDatabase();

$mysearch = $_POST['mysearch'];

//if we got something through $_POST
if (isset($mysearch)) 
{
    $word = mysql_real_escape_string($mysearch);
    $word = htmlentities($word);

    header("location: http://rclubs.me/clubpage/" . searchClubUrl($word)); 	
}
?>                                

<html>
<style>
  a {
    text-decoration:none;	  
  }
	
</style>                            
</html>