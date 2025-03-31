<!--
Assignment 2
CST8285_332
delete_recipe.php
Completed By: Danielle Cossette
A file to delete a recipe if selected
Created: March 22, 2025
Updated: March 29, 2025
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Danielle Cossette">
    <meta name="description" content="Delete Recipes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Recipe</title>
    <link rel = "stylesheet" type = "text/css"  href = "style.css">
</head>
<body>
  <main>
    <?php
      require_once('credentials.php'); // includes the credentials.php - if already exists will not include again - if not found a fatal error will occur and halts the script
      require_once('recipe_database.php');// includes the recipe_database.php - if already exists will not include again - if not found a fatal error will occur and halts the script
      include "header.php" ;//includes the header.php - will not throw a fatal error but a warning 
      $db = db_connect();//declaring variable called db and assigning it the value of the function db_connect() from recipe_database
//if the RecipeID is not present then it will redirect to the index
      if(!isset($_GET['RecipeID'])) {

        header("Location:  index.php");
      }
//setting a variable called id to the value of the RecipeID from the URL
      $id = $_GET['RecipeID'];
//if the http request to the server is POST 
      if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $sql = "DELETE FROM Recipe WHERE RecipeID ='$id'";
        $result = mysqli_query($db, $sql);
//redirect to the index
        header("Location: index.php");
      } 
      else{
//if the http request to the server is not POST
        $sql = "SELECT * FROM Recipe WHERE RecipeID= '$id' ";        
        $result_set = mysqli_query($db, $sql);        
        $result = mysqli_fetch_assoc($result_set);        
      }
    ?>
    <div class="container">
      <div class="delete-recipe">
          <h1>Delete Recipe</h1>
          <p>Are you sure you want to delete this Recipe?</p>
          <p ><?php echo $result['Name']; ?></p>
          <form form action="<?php echo 'delete_recipe.php?RecipeID=' . $result['RecipeID']; ?>"  method="post">
            <div class="delete-button">
              <input type="submit" name="Delete" value="Delete Recipe" />
            </div>
          </form>
      </div>
    </div>
    <div class="back-button">
      <a  href="<?php echo 'index.php'; ?>">Back to Recipes</a>
    </div>
  </main>
  <footer>
    <?php include 'footer.php'; ?>
  </footer>
</body>
</html>