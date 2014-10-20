<?php
//This file contains commonly used functions for managing clubs

function connectToDatabase()
{
    //MySQL database information
    $host="localhost"; 
    $username="rclubsme_user";
    $password="rpi123"; 
    $db_name="rclubsme_users"; 

    //Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");
}

function searchClubUrl($word)
{
    $query = "SELECT * FROM Clubs"; 
    $result = mysql_query($query) or die(mysql_error());

    while($row = mysql_fetch_array($result)){
    	if (strpos(strtolower($row['name']),strtolower($word)) !== false) {
            return $row['urlname'];
	   }
    }
    
    return "";
}

function getUserAndClubId($username, $clubname)
{
    //search for user id
    $sql = "SELECT * FROM Users WHERE username='$username'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    $myuserid = $db_field['userid'];

    //search for club id
    $sql = "SELECT * FROM Clubs WHERE urlname='$clubname'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    $myclubid = $db_field['clubid'];

    return array($myuserid, $myclubid);
}


function isClubAdded($myuserid, $myclubid)
{
    //Checks to see if the user already added the club to the MyClubs list
    $sql = "SELECT * FROM MyClubs WHERE userid='$myuserid' and clubid='$myclubid'";
    $result = mysql_query($sql);
    return (mysql_num_rows($result) != 0); 
}

function addClub($userid, $clubid)
{
    //Add a new entry in the MyClubs table that maps the user id to the club id
    $query = "INSERT INTO MyClubs (userid, clubid) VALUES ('$userid','$clubid')";
    $data = mysql_query($query)or die(mysql_error());
    if($data)
    {
        echo "Club successfully added to the MyClubs list<br/>";
    }
}

function deleteClub($userid, $clubid)
{
    //Delete this entry in the MyClubs table
    $query = "DELETE From MyClubs WHERE userid='$userid' AND clubid='$clubid'";
    $data = mysql_query($query)or die(mysql_error());
    if($data)
    {
        echo "Club successfully removed from your MyClubs list.<br/>";
    }
}

function getDaytimeHours($day_time)
{
    //Stores the days, start times, and ent times as arrays.
    $days = array();
    $start_times = array();
    $end_times = array();
    $length = strlen($day_time);

    //parse the string in the database (dayofweek_starttime_endtime)
    for($i = 0; $i < $length;) 
    {
        $temp = "";
        for($j = 0; $i + $j < $length; $j++) 
        {
            if ($day_time[$i+$j] != '_')
                $temp .= $day_time[$i+$j];
            else 
            {
                $i += $j + 1;
                break;
            }
        }
        array_push($days, $temp);

        $temp = "";
        for($j = 0; $i + $j < $length; $j++) 
        {
            if ($day_time[$i+$j] != '_')
                $temp .= $day_time[$i+$j];
            else 
            {
                $i += $j + 1;
                break;
            }
        }
        array_push($start_times, $temp);

        $temp = "";
        for($j = 0; $i + $j < $length; $j++) 
        {
            if ($day_time[$i+$j] != ';')
            {
                $temp .= $day_time[$i+$j];
            }
            else 
            {
                $i += $j + 1;
                break;
            }
            if ($i+$j == $length - 1)
                $i += $j + 1;
        }
        array_push($end_times, $temp);
    }
    
    //generate print string
    $size = count($days);	
    $str = "";
    for ($i = 0; $i < $size; $i++) 
    {
        $str .= $days[$i] . " " . $start_times[$i] . "-" . $end_times[$i];
        if ($i != $size - 1)
            $str .= ", ";
    }
    
    return $str;
}

?>