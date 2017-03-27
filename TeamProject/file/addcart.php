<?php
// Start the session
session_start();
require_once('db.php');

$conn = getDatabaseConnection();
$movieID = $_POST["add"];
$inCart = 0;

if($_SESSION["cart"] == NULL)
{
    $_SESSION["cart"] = array($movieID);
}
else if(in_array($movieID,$_SESSION["cart"]))
{
    $inCart = 1;
}
else
{
    array_push($_SESSION["cart"], $movieID);
}

function displayAdd()
{
    global $conn, $movieID, $inCart;

    // Query results  
    $sql = "SELECT * FROM `movie` WHERE movieID=" . $movieID; // select all columns
    $stmt = $conn -> prepare ($sql);
    $stmt -> execute();
    
    
    $row = $stmt->fetch();
    $name = $row["name"];
    $image = "../pic/". $movieID . ".jpeg";
    

    if($inCart == 0)
    {
        echo"
        <ul style='font-size:20px'><li>Succesfully added <strong>" . $name . "</strong> to cart!</li></ul>
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
        <ul style='font-size:20px'><li><strong>" . $name . "</strong> is already in cart!</li></ul>
        <ul style='list-style-type: none;'>Please chose another movie or proceed checkout.</ul><br/>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <name>Add to cart - Movie Center</name>
        <link rel="stylesheet" href="../css/styles.css" type="text/css">
    </head>
<main>
    <div class="center">
        <header class="logo">
            Movie Center
        </header>
        <span class="menu">
            <span class="home">
                <a href='../index.php'>Home</a>  
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
                <form method="post" action="../index.php">
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
