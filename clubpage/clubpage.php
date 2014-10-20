<?php 
    include ( "../clubpage/header.php" ); 
    require_once('../php/club_functions.php');
?>

<?php
  
    connectToDatabase();

    if(isset($_GET['c'])) {   //Get club name from link
        $myurl = mysql_real_escape_string($_GET['c']);   //Store club name in variable
        
        //Check if club is valid and in database, then get information about the club
        if(preg_match("/^[a-zA-Z0-9_\-]+$/", $myurl)){
            $check = mysql_query("SELECT urlname, name, weekday, location, day_time FROM Clubs WHERE urlname = '$myurl'");
            if(mysql_num_rows($check)==1){
                $get = mysql_fetch_assoc($check);
                $clubname = $get['name'];
                $weekday = $get['weekday'];
                $location = $get['location'];
                $day_time = $get['day_time'];

		//Stores the days, start times, and ent times as arrays.
		$days = array();
		$start_times = array();
		$end_times = array();
		$length = strlen($day_time);

		for($i = 0; $i < $length;) {
			$temp = "";
			for($j = 0; $i + $j < $length; $j++) {
				if ($day_time[$i+$j] != '_')
					$temp .= $day_time[$i+$j];
				else {
					$i += $j + 1;
					break;
				}
			}
			array_push($days, $temp);
			
			$temp = "";
			for($j = 0; $i + $j < $length; $j++) {
				if ($day_time[$i+$j] != '_')
					$temp .= $day_time[$i+$j];
				else {
					$i += $j + 1;
					break;
				}
			}
			array_push($start_times, $temp);
			
			$temp = "";
			for($j = 0; $i + $j < $length; $j++) {
				if ($day_time[$i+$j] != ';'){
					$temp .= $day_time[$i+$j];
				}
				else {
					$i += $j + 1;
					break;
				}
				if ($i+$j == $length - 1)
					$i += $j + 1;
			}
			array_push($end_times, $temp);
			
		}
                
            }else{
                echo "<strong>Club does not exist!</strong>";
                exit();
            }
        }
    }
?>

<div class="clubbar">
<?php
session_start();

if (!isset($_SESSION['myusername'])) {
    echo "Want to bookmark this club? Login or signup for a new account.<br/>";
}
else
{
    echo "<br/>";

    //Display either an "add" or "delete" button, but not both

    //Get data
    $myusername = $_SESSION['myusername'];

   //Get the user and club id
   list($myuserid, $myclubid) = getUserAndClubId($myusername, $myurl);

    //Checks to see if the user already added the club to the MyClubs list
    if (!isClubAdded($myuserid, $myclubid)) {
       echo "<a href=http://rclubs.me/myclubs/add_club.php?club=".$get['urlname']." class=add_club>";
       echo "Add Club";
       echo "</a>";

       //echo "<br/>";
    }
    else
    {
        echo "<a href=http://rclubs.me/myclubs/delete_club.php?club=".$get['urlname']." class=delete_club>";
        echo "Delete Club";
        echo "</a>";       
    }

}                     
?>
</div>

<div class="clubbanner"><p><?php echo "$clubname"; ?></p></div>

<div class="container">
    <div id="navcontainer" class="clubnav" style="background: #99ccff;"> 
    <ul>
        <li><a href="#">About</a></li>
        <li><a href="#">Posts</a></li>
        <li><a href="#">Members</a></li>
        <li><a href="#">Photos</a></li>
    </ul>
    <br style="clear:right"/>
    </div>
</div>

<!--Print club information from database-->  
<div class="clubabout">
    <table id="clubtable" border="1" width="25%" cellpadding="4" cellspacing="3">
    <th colspan="2">
        <h3><br><?php echo "Club Info"; ?></h3>
    </th>
    <tr>
        <td>Meeting Day(s)</td>
        <td><?php 	
        	$size = count($days);	
        	for ($i = 0; $i < $size; $i++) {
        		echo ($days[$i] . " " . $start_times[$i] . "-" . $end_times[$i]);
        		if ($i != $size - 1)
        			echo( ", ");
        	}
        	?>
        </td>
    </tr>
    <tr>
        <td>Location</td>
        <td><?php echo "$location"; ?></td>
    </tr>
    </table>
</div>