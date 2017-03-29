<?php
// Start the session
session_start();

require_once('db.php');
$conn = getDatabaseConnection();
$name = "";

function displayInfo()
{
    global $conn;
    $sql = "SELECT * FROM `movie` 
            INNER JOIN movie_information 
            ON movie.movieID=movie_information.movieID 
            INNER JOIN genre 
            ON movie_information.genreID=genre.genreID";
            
    $stmt = $conn -> prepare ($sql);
    $stmt -> execute();
    $row = $stmt->fetch();
    $movieID = $row["movieID"];
    while($movieID != $_POST["info"])
    {
        $row = $stmt->fetch();
        $movieID = $row["movieID"];
    }
    
    global $name;
    $name = $row["name"];
    $description = $row["description"];
    $genre = $row["genre"];
    $price = $row["price"];
    $image = "../pic/". $movieID . ".jpeg";
    $trailer = $row["trailer"];
    echo "
    <span class='pair'>
        <span id='image'>
            <img src='{$image}' width='225px' height='300px'>
        </span>
        <span id='description'>
            <h2> {$name}</h2>
            <strong>Genre:</strong> {$genre}<br/>
            <strong>Price:</strong> \${$price}<br/>
            <br/>
            {$description} {$trailer}<br/>
            <br/>
            <form method='post' action='../index.php'>
                <button style='width:100px;' name='home'>Keep shopping</button>
            </form>
            <form action='addcart.php' method='post'>
                <button style='width:100px'; name='add' value='{$movieID}'>add to cart</button>
            </form>
        </span>
    </span>
    ";

}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Details - Movie Center</title>
        <link rel="stylesheet" href="../css/styles.css" type="text/css">
    </head>
    
<main>
    <div class="back">
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
        <body class="lolol"><br/>
            <div class="inner">
                <?php
                    displayInfo();
                ?>
            </div>
        </body>
        <footer>
            
        </footer>
    </div>
</main>

</html>
