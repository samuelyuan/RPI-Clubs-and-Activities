<?php
session_start();
if (!isset($_SESSION['myusername'])) {
    header("location: http://rclubs.me");
}

$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="MyClubs"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$myusername = $_SESSION['myusername'];

//search for user id
$sql = "SELECT * FROM Users WHERE username='$myusername'";
$result = mysql_query($sql);
$db_field = mysql_fetch_assoc($result);
$myuserid = $db_field['userid'];

echo "Username: ". $myusername . "<br/><br/>";
echo "Clubs added: <br/>";

$check = mysql_query("SELECT clubid FROM MyClubs WHERE userid='$myuserid'");
if(mysql_num_rows($check) == 0)
{
    exit("No clubs saved.<br/>");
}

while ($row = mysql_fetch_assoc($check)) 
{
    $myclubid = $row['clubid'];

    //search for club name 
    $sql = "SELECT * FROM Clubs WHERE clubid='$myclubid'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    $myclubname = $db_field['name'];

    //print each club found
     echo $myclubname . "<br/>";
}
?>