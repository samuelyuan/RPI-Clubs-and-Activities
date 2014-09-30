<?php
    session_start();
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
        <a href="#"><div id="contact" class="button">Contact</div></a>
        <a href="http://rclubs.me/login"><div id="login" class="button">Login</div></a>
        <a href="http://rclubs.me/signup"><div id="signup" class="button">Signup</div></a>
        <center>
            <div id="bodi">
                <div class="talk">
                    <p id=slogan class="body-text">rClubs</p>
                    <p id="descr" class="body-text">Manage your clubs more easily with our very useful features</p>
                </div>
                <div class="boxes">
                    <form method="post" action="checklogin.php">
                        <input name="myusername" id="fbox" type="text" placeholder="username">
                        <input name="mypassword" id="fbox" type="password" placeholder="password">
                        
                        <input id="register" type="submit" value="LOGIN">
                    </form>
                </div>
            </div>
            
            <div class="bottom">
                <p id="why" class="bottom-text">Why should you use rClubs?</p>
            </div>
        </center>
    
        
    </body>
</html>
                            
                            