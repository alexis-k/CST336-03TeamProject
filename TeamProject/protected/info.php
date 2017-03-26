<?php
// Start the session
session_start();

require_once('db.php');
$conn = getDatabaseConnection();
$title = "";

function displayInfo()
{
    global $conn;
    $sql = "SELECT * FROM `film` 
            INNER JOIN film_genre 
            ON film.filmID=film_genre.filmID 
            INNER JOIN genre 
            ON film_genre.genreID=genre.genreID";
            
    $stmt = $conn -> prepare ($sql);
    $stmt -> execute();
    $row = $stmt->fetch();
    $filmID = $row["filmID"];
    while($filmID != $_POST["info"])
    {
        $row = $stmt->fetch();
        $filmID = $row["filmID"];
    }
    
    global $title;
    $title = $row["title"];
    
    $description = $row["description"];
    $genre = $row["genre_name"];
    $price = $row["price"];
    $image = "../public_html/pic/". $filmID . ".jpeg";
    echo "
    <span class='pair'>
        <span id='image'>
            <img src='{$image}' width='225px' height='300px'>
        </span>
        <span id='description'>
            <h2> {$title}</h2>
            <strong>Genre:</strong> {$genre}<br/>
            <strong>Price:</strong> \${$price}<br/><br/>

            {$description}<br/><br/>
            <form method='post' action='../public_html/index.php'>
                <button style='width:100px;' name='home'>Keep shopping</button>
            </form>
            <form action='addcart.php' method='post'>
                <button style='width:100px'; name='add' value='{$filmID}'>add to cart</button>
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
                    displayInfo();
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
