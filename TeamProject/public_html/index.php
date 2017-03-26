<?php
// CST336 Team Project
// Date: 11/9/2016
// Team: Dustin D'Avignon, Kyle Butler-Fish, and Spencer Ortega 
// Git Repo: https://github.com/SpencerOrtegaTW/catalog-checkout.git
// Trello: https://trello.com/b/LjvJ40KW/cst336-team-project


// Start the session
session_start();
require_once('../protected/db.php');

$conn = getDatabaseConnection();

function displayProducts() 
{
    global $conn;
    $sql = "SELECT * FROM film
            INNER JOIN film_genre 
            ON film.filmID=film_genre.filmID 
            INNER JOIN genre 
            ON film_genre.genreID=genre.genreID"; // select all columns
    
    $filterBy = "";
    $sort = "";
    
    // Set filter and sort

    if(!isset($_POST['button']) || $_POST['filter'] == "title" || $_POST['filter'] == "null") // entered title
    {
        echo "<strong>Filter</strong>: Title";
        $filterBy .= 'title';
    }
    else if($_POST['filter'] == "price") // entered price
    {
        echo "<strong>Filter</strong>: Price";
        $filterBy .= 'price';
    }
    else if($_POST['filter'] == "genre") // entered genre
    {
        echo "<strong>Filter</strong>: Genre";
        $filterBy .= 'genre_name';
    }
    echo "<br/>";
    // Checks sort  
    if(!isset($_POST['button']) || $_POST['sort'] == "asc" || $_POST['sort'] == "null") // entered title
    {
        echo "<strong>Sort</strong>: Low to high";
        $sort = "ASC";
    }
    else if($_POST['sort'] == "desc") // entered genre
    {
        echo "<strong>Sort</strong>: High to low";
        $sort = "DESC";
    }
    echo "<br/>";
           
    // Query results        
    $sql = $sql . " ORDER BY " . $filterBy . " " . $sort;
    $stmt = $conn -> prepare ($sql);
    $stmt -> execute();
    
    // fetch results
    while($row = $stmt->fetch())  // while there is data left in table
    {
        $filmID = $row["filmID"];
        $image = "pic/". $filmID . ".jpeg";
        $genre = $row["genre_name"];
        $title = $row["title"];
        $description = $row["short_desc"];
        $price = $row["price"];
            
        echo "
        <span class='pair'>
            <span id='image'>
                <img src='" . $image . "' width='225px' height='300px'>
            </span>
            <span id='description'>
                <h2><strong>" . $title . "</strong></h2>" . $description . "
                <br/><br/>
                <strong>Genre:</strong> " . $genre ."<br/>
                <strong>Price:</strong> $" . $price ."<br/><br/>
                <form action='../protected/info.php' method='post'>
                    <button style='width:100px;' name='info' value='" . $filmID . "'>details</button>
                </form>
                <form action='../protected/addcart.php' method='post'>
                    <button style='width:100px'; name='add' value='" . $filmID . "'>add to cart</button>
                </form>
            </span>
        </span><br/><br/>
         ";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home - Movie Center</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css">

    </head>
    <main>
        <div class="center">
            <header class="logo">
                Movie Center
            </header>
            <span class="menu">
                <span class="home">
                    <a href='index.php'>Home</a>  
                </span>
                <span class="cart">
                    <?= "<a href='../protected/cart.php'>cart(" . count($_SESSION["cart"]) .")</a>" ?>
                </span>
            </span>
            <body><br/>
                <div class="inner">
                    <!--filter and sort forms-->
                    <div style="float: right; padding-bottom: 15px;">
                        <form method="post" action="index.php">
                            <select name="filter">
                                <option value="null">--Filter--</option>
                                <option value="title">Title</option>
                                <option value="price">Price</option>
                                <option value="genre">Genre</option>
                            </select>
                            <select name="sort">
                                <option value="null">--Sort--</option>
                                <option value="asc">Low to high</option>
                                <option value="desc">High to low</option>
                            </select>
                            <input type="submit" name="button">
                        </form> <br/><br/>
                    </div>
                    <?php
                    displayProducts();
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
