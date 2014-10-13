<?php include ( "../clubpage/header.php" ); ?>
<?php
    
    $host="localhost"; // Host name
    $username="rclubsme_user"; // Mysql username
    $password="rpi123"; // Mysql password
    $db_name="rclubsme_users"; // Database name
    $tbl_name="Clubs"; // Table name

    // Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");


    if(isset($_GET['c'])) {   //Get club name from link
        $myurl = mysql_real_escape_string($_GET['c']);   //Store club name in variable
        
        //Check if club is valid and in database, then get information about the club
        if(preg_match("/^[a-zA-Z0-9_\-]+$/", $myurl)){
            $check = mysql_query("SELECT urlname, name, weekday, location FROM Clubs WHERE urlname = '$myurl'");
            if(mysql_num_rows($check)==1){
                $get = mysql_fetch_assoc($check);
                $clubname = $get['name'];
                $weekday = $get['weekday'];
                $location = $get['location'];
            }else{
                echo "<strong>Club does not exist!</strong>";
                exit();
            }
        }
    }
?>

<!--Print club information from database-->
<h2>Club Name: <?php echo "$clubname"; ?></h2>
<h2>Day of Meeting: <?php echo "$weekday"; ?></h2>
<h2>Location: <?php echo "$location"; ?></h2>
<?php
session_start();

if (!isset($_SESSION['myusername'])) {
    echo "Want to bookmark this club? Login or signup for a new account.<br/>";
}
else
{
    echo "<a href=http://rclubs.me/myclubs/add_club.php?club=".$get['urlname'].">";
    echo "ADD this Club to your MyClubs list <br/>";
    echo "</a>";

    echo "<br/>";

    echo "<a href=http://rclubs.me/myclubs/delete_club.php?club=".$get['urlname'].">";
    echo "DELETE this club from your MyClubs list <br/>";
    echo "</a>";       
}                     
?>