
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="all" href="style.css"/>
    <title>The Carousel</title>
</head>
<body>
  

<?php
require_once('credentials.php');
require_once('recipe_database.php');

$db = db_connect();
session_start();


    
if (isset($_SESSION['valid_user_id'])) {
    include "mheader.php" ;
    $UserID = $_SESSION['valid_user_id'];
    
    // Query to fetch user's favorite recipes
    $sql = "SELECT * from Favorite_recipe WHERE UserID = $UserID";
    $results = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($results) > 0) {
        // If there are results, loop through and fetch each RecipeID
        while ($row = mysqli_fetch_assoc($results)) {
            $RecipeID = $row['RecipeID']; // Get the RecipeID from the row
            // Redirect to view_recipe.php with the RecipeID as a query parameter
            header("Location: view_recipe.php?RecipeID=$RecipeID");
            exit(); // It's important to call exit after header redirection
        }
    } else {
        echo "You have no favorite recipes.";
    }
} 

?>
</body>
</html>
