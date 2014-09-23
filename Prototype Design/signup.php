<?php
$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="Users"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
$repassword=$_POST['repassword'];
$myemail=$_POST['myemail'];

//make sure user entered a username
if (empty($myusername))
{
    exit("You didn't enter a username.");
}

//make sure passwords match
if ($mypassword != $repassword)
{
    exit("Entered passwords don't match.");
}

//Make sure the email is an RPI email
$test = '@rpi.edu';
if(strlen($myemail) < strlen($test) || substr_compare($myemail, $test, -strlen($test), strlen($test)) != 0)
{
    exit("You didn't enter an RPI email.");
}

//Register the user
$query = "INSERT INTO $tbl_name (username, password, email) VALUES ('$myusername','$mypassword', '$myemail')";

$data = mysql_query($query)or die(mysql_error());
if($data)
{
    echo "Registration Complete!";
}
?>