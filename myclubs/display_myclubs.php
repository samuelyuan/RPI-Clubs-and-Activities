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

//notify the user when there's a club meeting
$notifications = array();

//get the current day of the week
$currentday = date("l");

while ($row = mysql_fetch_assoc($check)) 
{
    $myclubid = $row['clubid'];

    //search for club name 
    $sql = "SELECT * FROM Clubs WHERE clubid='$myclubid'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    $myclubname = $db_field['name'];
    $meetingdays = $db_field['weekday'];

    //print each club found (provide a link to the clubpage)
    echo "<a href=http://rclubs.me/clubpage/" . $db_field['urlname'] . ">";
    echo $myclubname . "</a>";
    echo "<br/>";


    //notify the user if there is a meeting on this day (for example Friday)
    //make sure to mention the time
    if (strpos($meetingdays, $currentday) !== false)
    { 
        $notifications[] = $myclubname . " at " . date('H:i',strtotime($db_field['time'])) . "<br/>"; 
    }
}

echo "<br/><h3>Today is " . $currentday . "</h3>";

//Creates a notification message string
if (!empty($notifications)) {
    $message = "You have meetings for the following clubs:<br/>";
    foreach($notifications as $msg) {
        $message .=  $msg;
    }
    echo $message;
}
else
{
    echo "You have no club meetings today.<br/>";
}
?>