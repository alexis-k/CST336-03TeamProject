<?php
// Start the session
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <name>Confirm - name Center</name>
        <link rel="stylesheet" href="../css/styles.css" type="text/css">
    </head>
    
<main>
    <div class="center">
        <header class="logo">
            name Center
        </header>
        <span class="menu">
            <span class="home">
                <a href='../index.php'>Home</a>  
            </span>
        </span>
        <body><br/>
            <div class="inner">
                <?php
                    if(empty($_POST['first']) || empty($_POST['last']) || empty($_POST['email']) || empty($_POST['credit']))
                    {
                        echo "<h1>Missing Information....</h1><br/>Please try <a href='checkout.php'>again</a>";
                    }
                    else 
                    {
                        echo "<h1>Enjoy your movie !</h1>";
                        $_SESSION = array();
                        session_destroy();
                    }
                ?>
            </div>
        </body>
        <footer>
            
        </footer>
    </div>
    <div id="foot">
        <a href="#">Go to top</a>
    </div>
</main>

</html>
