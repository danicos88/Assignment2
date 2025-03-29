<!--
Assignment 2
CST8285_332
edit_recipe.php
Completed By: Danielle Cossette
A file to edit a recipe if selected
Created: March 22, 2025
Updated: March 29, 2025
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Danielle Cossette">
    <meta name="description" content="Edit Recipes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel = "stylesheet" type = "text/css"  href = "style.css">
</head>
<body>
  <?php
    require_once('credentials.php');// includes the credentials.php - if already exists will not include again - if not found a fatal error will occur and halts the script
    require_once('recipe_database.php');// includes the recipe_database.php - if already exists will not include again - if not found a fatal error will occur and halts the script
    $db = db_connect();//establishes connection to the database
    include 'header.php';

//if the RecipeID is not set in the url redirect back to the index.php
    if(!isset($_GET['RecipeID'])) {
        header("Location:  index.php");
    }   
//if the http request to the server is POST 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id = $_GET['RecipeID'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $instructions = $_POST['instructions'];    
        $ingredients = $_POST['ingredients'];
        $sql="UPDATE Recipe set name = '$name' , description = '$description', Instructions = '$instructions', Ingredients = '$ingredients'
            where RecipeID = '$id' ";
        $result = mysqli_query($db, $sql);
//redirect to view Recipe page
        header("Location: view_recipe.php?RecipeID=  $id");
    }else {
        $id = $_GET['RecipeID'];
        $sql = " SELECT * FROM Recipe WHERE RecipeID= '$id' ";
        
        $result_set = mysqli_query($db, $sql);
        
        $result = mysqli_fetch_assoc($result_set);
      }
?>
<div class="container">

  <div class="edit-recipe">
    <h1>Edit Recipes</h1>

    <form form action="<?php echo 'edit_recipe.php?RecipeID=' . $result['RecipeID']; ?>"  method="post">
      <dl>
        <dt> ID</dt>
        <dd><input type="text" name="id" value="<?php echo $result['RecipeID']; ?>" /></dd>
        </dd>
      </dl>
      <dl>
        <dt>Name</dt>
        <dd><input type="text" name="name" value="<?php echo $result['Name']; ?>" /></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><input type="text" name="description" value="<?php echo $result['Description']; ?>" /></dd>
        </dd>
      </dl>
      <dl>
        <dt>Instructions</dt>
        <dd><input type="text" name="instructions" value="<?php echo $result['Instructions']; ?>" /></dd>
        </dd>
      </dl>        
      <dl>
        <dt>Ingredients</dt>
        <dd><input type="text" name="ingredients" value="<?php echo $result['Ingredients']; ?>" /></dd>
        </dd>
      </dl>  
      <div class="edit-button">
        <input type="submit" value="Edit Recipe" />
      </div>
    </form>

  </div>

</div>
<div class="back-button">
  <a  href="<?php echo 'index.php'; ?>">Back to Recipes</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
