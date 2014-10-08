                                                                <?php
$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="Reset"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

//send an email
$myemail=$_POST['myemail'];

//anti-injection
$myemail = mysql_real_escape_string($myemail);

//generate key
$mykey = $myemail . date('mY'); //Key
$mykey = md5($mykey); //Hash the key

echo "A link to reset your password has been sent to " . $myemail . "<br/>";

$query = "INSERT INTO $tbl_name (resetkey, email) VALUES ('$mykey','$myemail')";
$data = mysql_query($query)or die(mysql_error());

if ($data)
{
    //Send reset email
    $mail_body = "Your reset key is " . $mykey . "<br/> Click on this link to reset your password: <a>http://rclubs.me/reset_form.php</a>";
    mail($myemail,"rClubs: Reset Password Link", $mail_body); 
}
?>
                            
                            
                            