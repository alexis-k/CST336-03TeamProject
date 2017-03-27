<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>video site?</title>
        <link rel="stylesheet" href="styles.css" type="text/css">
    </head>
    
<main>
    
    <div class="center">
        
        <header class="logo">
            Video site??
        </header>
        
        <span class="menu">
            <span class="home">
                <a href='main.php'>Home</a>  
            </span>
            <span class="cart">
                <?= "<a href='cart.php'>cart(" . count($_SESSION["cart"]) .")</a>" ?>
            </span>
        </span>
 
        
        <body><br/>
            
            <div class="inner">
        

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
