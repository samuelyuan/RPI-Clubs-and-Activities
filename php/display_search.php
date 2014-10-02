<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/main.css"/>
        <title>rClubs</title>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/autocomplete.js"></script>
    </head>
    
    <body>
        <div class="heading">
            <a href="http://rclubs.me"><img class="homebutton" src="../images/rClubs.png"></a>
            <ul>
            </ul>
        </div>
        
        <div id="search" class="ui-widget">
            <form method="post" action="../php/do_search.php">
                <input name="mysearch" id="searchbar" placeholder="Search for Clubs"/>
            </form>
        </div>
        <a href="#"><div id="about" class="button">About</div></a>
        <a href="http://rclubs.me/feedback.html"><div id="contact" class="button">Contact</div></a>
        <a href="http://rclubs.me/login"><div id="login" class="button">Login</div></a>
        <a href="http://rclubs.me/signup"><div id="signup" class="button">Signup</div></a>
        <center>
             <p id="font_clubinfo"><?php include 'do_search.php'; ?></p>
           
        </center>
    </body>
</html>      