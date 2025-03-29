<!--
Assignment 2
CST8285_332
add_favorite.php
Completed By: Danielle Cossette
A file to handle when a user adds a favorite recipe
Created: March 29, 2025
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Danielle Cossette">
    <meta name="description" content="Add to Favorites">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Favorite</title>
    <link rel = "stylesheet" type = "text/css"  href = "syle.css">
</head>
<body>

<?php 
require_once('credentials.php'); // includes the credentials.php - if already exists will not include again - if not found a fatal error will occur and halts the script
require_once('recipe_database.php');// includes the recipe_database.php - if already exists will not include again - if not found a fatal error will occur and halts the script
include 'mheader.php'; //includes the mheader.php - will not throw a fatal error but a warning 
$db = db_connect();//declaring variable called db and assigning it the value of the function db_connect() from recipe_database
?>

<?php
// get UserID and RecipeID from GET request and assign their values into their designated variables
$UserID = $_GET['UserID'];
$RecipeID = $_GET['RecipeID'];

//check if the user already has a favorite recipe
$sql_checkFavorite = "SELECT * FROM `Favorite_Recipe` WHERE `UserID` = $UserID";
$check_results = mysqli_query($db, $sql_checkFavorite); 

//if the user has a favorite, update it with the new RecipeID
if (mysqli_num_rows($check_results) > 0) {
    
    $sql_updateFavorite = "UPDATE `Favorite_Recipe` SET `RecipeID` = $RecipeID WHERE `UserID` = $UserID AND `RecipeID` != $RecipeID";
    $update_result = mysqli_query($db, $sql_updateFavorite);
 // If the update is successful let the user know 
    if ($update_result) {
        
        echo "Your favorite recipe has been updated!";
        echo ' <a href="view_recipe.php?RecipeID=' . $RecipeID . '">View Recipe</a>';
    } else {
 // If there was an error updating let the user know 
        echo "Error updating your favorite recipe.";
    }
} else {
 //if the user does not have a favorite then insert a new favorite 
    $sql_insertFavorite = "INSERT INTO `Favorite_Recipe` (`UserID`, `RecipeID`) VALUES ($UserID, $RecipeID)";
    $insert_result = mysqli_query($db, $sql_insertFavorite);
    
    if ($insert_result) {
 // if the insert is successful let the user know 
        echo "Recipe added to your favorites!";
        echo ' <a href="view_recipe.php?RecipeID=' . $RecipeID . '">View Recipe</a>';
    } else {
 // if there was an error inserting let the user know 
        echo "Error adding recipe to favorites.";
    }
}
?>
<footer>
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>