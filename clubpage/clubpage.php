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
<table border="1" width="25%" cellpadding="4" cellspacing="3">
   <th colspan="2">
        <h3><br>Club Name: <?php echo "$clubname"; ?></h3>
   </th>
   <tr>
       <td>Meeting Day(s)</td>
       <td><?php echo "$weekday"; ?></td>
   </tr>
   <tr>
       <td>Location</td>
       <td><?php echo "$location"; ?></td>
   </tr>
</table>

<?php
session_start();

if (!isset($_SESSION['myusername'])) {
    echo "Want to bookmark this club? Login or signup for a new account.<br/>";
}
else
{
    echo "<br/>";

    echo "<a href=http://rclubs.me/myclubs/add_club.php?club=".$get['urlname']." class=add_club>";
    echo "ADD this Club<br/>";
    echo "</a>";

    echo "<br/>";

    echo "<a href=http://rclubs.me/myclubs/delete_club.php?club=".$get['urlname']." class=delete_club>";
    echo "DELETE this Club<br/>";
    echo "</a>";       
}                     
?>