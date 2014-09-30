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

    echo $word . "<br/>";

    //search the clubs table for the club
    $sql = "SELECT * FROM $tbl_name WHERE name='$mysearch'";
    $result = mysql_query($sql);

    if (mysql_num_rows($result) != 0) 
    {
        echo "Club Information: <br/>";
        
        $weekday = mysql_result($result,0,"weekday");
        $time = mysql_result($result,0,"time"); 
        $location = mysql_result($result,0,"location"); 
        echo "Day(s) of the week: " . $weekday . "<br/>";
        echo "Time: " . $time . "<br/>";
        echo "Location: " . $location . "<br/>";
    }
    else
    {
        echo "Club not found in the database! Perhaps, you can helps us add it.<br/>";
    }
}
?>                                
                            
                            