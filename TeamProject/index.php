<?php
session_start();
require_once('file/db.php');

$conn = getDatabaseConnection();

function applyFilter() 
{
    global $conn;
    $sql = "SELECT * FROM movie
            INNER JOIN movie_information
            ON movie.movieID=movie_information.movieID 
            INNER JOIN genre 
            ON 	movie_information.genreID=genre.genreID"; // select all columns
    
    $filterBy = "";
    $sort = "";

    if(!isset($_POST['button']) || $_POST['filter'] == "name" || $_POST['filter'] == "null") // entered name
    {
        echo "<strong>Filter</strong>: name";
        $filterBy .= 'name';
    }
    else if($_POST['filter'] == "price") // entered price
    {
        echo "<strong>Filter</strong>: Price";
        $filterBy .= 'price';
    }
    else if($_POST['filter'] == "genre") // entered genre
    {
        echo "<strong>Filter</strong>: Genre";
        $filterBy .= 'genre';
    }
    else if($_POST['filter'] == "rating") // entered genre
    {
        echo "<strong>Filter</strong>: Rating";
        $filterBy .= 'rating';
    }
    else if($_POST['filter'] == "director") // entered genre
    {
        echo "<strong>Filter</strong>: Director";
        $filterBy .= 'director';
    }
    echo "<br/>";
    // Checks sort  
    if(!isset($_POST['button']) || $_POST['sort'] == "asc" || $_POST['sort'] == "null") // entered name
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
        $movieID = $row["movieID"];
        $image = "pic/". $movieID . ".jpeg";
        $genre = $row["genre"];
        $name = $row["name"];
        $rating = $row["rating"];
        $director = $row['director'];
        $price = $row["price"];
            
        echo "
        <span class='pair'>
            <span id='image'>
                <img src='" . $image . "' width='225px' height='300px'>
            </span>
            <span id='description'>
                <h2><strong>" . $name . "</strong></h2>"."
                <br/><br/>
                <strong>Rating:</strong> " . $rating . "/10 <br/>
                <strong>Genre:</strong> " . $genre ."<br/>
                <strong>Director:</strong> " . $director ."<br/>
                <strong>Price:</strong> $" . $price ."<br/><br/>
                <form action='file/info.php' method='post'>
                    <button style='width:100px;' name='info' value='" . $movieID . "'>details</button>
                </form>
                <form action='file/addcart.php' method='post'>
                    <button style='width:100px'; name='add' value='" . $movieID . "'>add to cart</button>
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
        <name>Home - Movie Center</name>
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
                    <?= "<a href='file/cart.php'>cart(" . count($_SESSION["cart"]) .")</a>" ?>
                </span>
            </span>
            <body><br/>
                <div class="inner">
                    <!--filter and sort forms-->
                    <div style="float: right; padding-bottom: 15px;">
                        <form method="post" action="index.php">
                            <select name="filter">
                                <option value="null">--Filter--</option>
                                <option value="name">name</option>
                                <option value="price">Price</option>
                                <option value="genre">Genre</option>
                                <option value="rating">Rating</option>
                                <option value="director">Director</option>
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
                    applyFilter();
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
