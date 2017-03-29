<?php
// Start the session
session_start();
require_once('db.php');
$conn = getDatabaseConnection();

if($_POST["clear"] == "1")
{
    $_SESSION["cart"] = array();
}

function display()
{
    global $conn;
    if($_SESSION["cart"] == NULL)
    {
        echo "Cart is empty!";
    }
    else 
    {
        $sql = "SELECT * FROM `movie` WHERE ";
        
        $arr = $_SESSION["cart"];
        foreach($arr as &$id)
        {
            $sql = $sql . "movieID=" . $id . " OR ";
        }
        $sql = substr($sql,0,-3); // delete last " OR "

        $stmt = $conn -> prepare ($sql);
        $stmt -> execute();
        
        echo "<div style='padding-left:5%;'>";
        $totalprice=0;
        while($row = $stmt->fetch())  // while there is data left in table
        {
            $movieID = $row["movieID"];
            $image = "../pic/". $movieID . ".jpeg";
            $price = $row["price"];
            $name = $row["name"];
            $totalprice += $price;
            
            echo "
            <div>
                <img src='" . $image . "' width='112.5px' height='150px'>
            </div>
            <div>
                <strong>name: </strong>" . $name . "<br/>
                <strong>Price: </strong>$" . $price . "<br/>
            </div><br/>
            ";
        }
        
        echo "
        <br/><h3><strong>Cart total:</strong> $" . $totalprice . "</h3>
        </div><br/><br/>
        <form action='checkout.php' method='post'>
            <button style='width:75px;' name='checkout'>checkout</button>
        </form>
        <form action='cart.php' method='post'>
            <button style='width:75px'; name='clear' value='1'>clear cart</button>
        </form>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
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
                <h2>Your cart contains:</h2>
                <?php
                    display();
                ?>
            </div>
        </body>
        <footer>
            
        </footer>
    </div>
    
    
    
</main>

</html>
