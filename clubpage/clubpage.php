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
        $clubname = mysql_real_escape_string($_GET['c']);   //Store club name in variable
        
        //Check if club is valid and in database, then get information about the club
        if(ctype_alnum($clubname)){
            $check = mysql_query("SELECT urlname, weekday, location FROM Clubs WHERE urlname = '$clubname'");
            if(mysql_num_rows($check)==1){
                $get = mysql_fetch_assoc($check);
                $clubname = $get['urlname'];
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

                            
                            
                            