<?php
// Start the session
session_start();
require_once('db.php');

$conn = getDatabaseConnection();
$filmID = $_POST["add"];
$inCart = 0;

if($_SESSION["cart"] == NULL)
{
    $_SESSION["cart"] = array($filmID);
}
else if(in_array($filmID,$_SESSION["cart"]))
{
    $inCart = 1;
}
else
{
    array_push($_SESSION["cart"], $filmID);
}

function displayAdd()
{
    global $conn, $filmID, $inCart;

    // Query results  
    $sql = "SELECT * FROM `film` WHERE filmID=" . $filmID; // select all columns
    $stmt = $conn -> prepare ($sql);
    $stmt -> execute();
    
    
    $row = $stmt->fetch();
    $title = $row["title"];
    $image = "../public_html/pic/". $filmID . ".jpeg";
    

    if($inCart == 0)
    {
        echo"
        <ul style='font-size:20px'><li>Succesfully added <strong>" . $title . "</strong> to cart!</li></ul>
        <div>
            <div>
                <img src='" . $image . "' width='112.5px' height='150px'>
            </div>
        </div><br/><br/>
         ";
    }
    else
    {
        echo"
        <ul style='font-size:20px'><li><strong>" . $title . "</strong> is already in cart!</li></ul>
        <ul style='list-style-type: none;'>Sorry about that :( we have plenty more where that came from!</ul><br/>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add to cart - Movie Center</title>
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
            <span class="cart">
                <?= "<a href='cart.php'>cart(" . count($_SESSION["cart"]) .")</a>" ?>
            </span>
        </span>
        <body><br/>
            <div class="inner">
                <?php
                    displayAdd();
                ?>
                <form method="post" action="../public_html/index.php">
                    <button style="width:100px;" name='home'>Keep shopping</button>
                </form>
                <form method="post" action="checkout.php">
                    <button style="width:100px;" name='checkout'>Checkout</button>
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
