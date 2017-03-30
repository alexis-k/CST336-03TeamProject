<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
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
                <h2>Confirm Order</h2>
                <form action="confirm.php" method="post">
                    <span>
                        <span class="form">
                            Name:
                        </span><br/>
                        <span >
                            <input class="text_field" type="text" name="first"/><br/><br/>
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
                <form action='../index.php' method='post'>
                    <button style='width:100px'; name='cancel' value='cancel'>cancel</button>
                </form>
            </div>
        </body>
        <footer>
            
        </footer>
    </div>
</main>

</html>
