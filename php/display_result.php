<?php
$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="Clubs"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$mysearch = $_POST['mysearch'];

//if we got something through $_POST
if (isset($mysearch)) 
{
    $word = mysql_real_escape_string($mysearch);
    $word = htmlentities($word);

    //echo $word . "<br/>";

    $query = "SELECT * FROM $tbl_name"; 
    $result = mysql_query($query) or die(mysql_error());

    while($row = mysql_fetch_array($result)){
    	if (strpos(strtolower($row['name']),strtolower($word)) !== false) {
    		/*echo "<a href=http://rclubs.me/clubpage/".$row['urlname'].">";	
    		echo $row['name'] . "<br/>";
         	echo "Day(s) of the week: " . $row['weekday'] . "<br/>";
         	echo "Time: " . $row['time'] . "<br/>";
         	echo "Location: " . $row['location'] . "<br/>";
         	echo "</a>";*/
            header("location: http://rclubs.me/clubpage/" . $row['urlname']);
        	
	}
	//echo "<br />";
    }
    
}
?>                                

<html>
<style>
  a {
    text-decoration:none;	  
  }
	
</style>                            
</html>