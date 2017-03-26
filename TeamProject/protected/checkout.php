<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Check out - Movie Center</title>
        <link rel="stylesheet" href="../public_html/css/styles.css" type="text/css">
    </head>
    
<main>
    <div class="center">
        <header class="logo">
            Movie Center
        </header>
        <span class="menu">
            <span class="home">
                <a href='../public_html/index.php'>Home</a>  
            </span>
        </span>
        <body><br/>
            <div class="inner">
                <h2>Confirm Order</h2>
                <form action="confirm.php" method="post">
                    <span>
                        <span class="form">
                            First Name:
                        </span><br/>
                        <span >
                            <input class="text_field" type="text" name="first"/><br/><br/>
                        </span><br/>
                        <span class="form">
                            Last Name:
                        </span></br>
                        <span>
                            <input class="text_field" type="text" name="last"/><br/><br/>
                        </span><br/>
                        <span class="form">
                            Email:
                        </span></br>
                        <span>
                            <input class="text_field" type="text" name="email"/><br/><br/>
                        </span><br/>
                        <span class="form">
                            Credit Card:
                        </span></br>
                        <span>
                            <input class="text_field" type="text" name="credit"/><br/><br/>
                        </span>
                        <button style='width:100px'; name='finish' value='finish'>finish</button>
                     </span>
                </form>
                <form action='../public_html/index.php' method='post'>
                    <button style='width:100px'; name='cancel' value='cancel'>cancel</button>
                </form>
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
