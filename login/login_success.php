<?php
    session_start();

    //make sure user is signed in
    if (!isset($_SESSION['myusername']))
    {
        header("location: index.php");
    }
?>

<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/main.css"/>
        <title>rClubs</title>
    </head>
    
    <body>
        <div class="heading">
            <a href="http://rclubs.me"><img class="homebutton" src="../images/rClubs.png"></a>
            <ul>
            </ul>
        </div>
        
        <div id="search" class="ui-widget">
            <form>
                <input id="searchbar" placeholder="Search for Clubs"/>
            </form>
        </div>
        <a href="#"><div id="about" class="button">About</div></a>
        <a href="http://rclubs.me/feedback.php"><div id="contact" class="button">Feedback</div></a>
        <a href="#"><div id="myclubs" class="button">MyClubs</div></a>
        <a href="logout.php"><div id="logout" class="button">Logout</div></a>
        <center>
            <div id="bodi">
                <div class="talk">
                    <p id=slogan class="body-text">Welcome to rClubs!</p>
                    <p id="descr" class="body-text">Search for some clubs that interest you. Like a club? Add it to your MyClubs list.</p>
                </div>
            </div>
            
            <div class="bottom">
                <p id="why" class="bottom-text">Why should you use rClubs?</p>
            </div>
        </center>
    
        
    </body>
</html>