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

//Get data
$myclub=$_GET['club'];
$myusername = $_SESSION['myusername'];

//search for user id
$sql = "SELECT * FROM Users WHERE username='$myusername'";
$result = mysql_query($sql);
$db_field = mysql_fetch_assoc($result);
$myuserid = $db_field['userid'];

//search for club id
$sql = "SELECT * FROM Clubs WHERE urlname='$myclub'";
$result = mysql_query($sql);
$db_field = mysql_fetch_assoc($result);
$myclubid = $db_field['clubid'];

//Checks to see if the user already added the club to the MyClubs list
$sql = "SELECT * FROM MyClubs WHERE userid='$myuserid' and clubid='$myclubid'";
$result = mysql_query($sql);
if (mysql_num_rows($result) != 0) {
    exit("This club has already been added to your MyClubs list.<br/>");
}

//Add a new entry in the MyClubs table that maps the user id to the club id
$query = "INSERT INTO MyClubs (userid, clubid) VALUES ('$myuserid','$myclubid')";
$data = mysql_query($query)or die(mysql_error());
if($data)
{
    echo "Club successfully added to the MyClubs list<br/>";
}

//automatically redirect to the MyClubs page
echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";
?>