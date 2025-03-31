<!--
Assignment 2
CST8285_332
new_recipe.php
Completed By: Danielle Cossette
A file to create a new recipe if selected
Created: March 29, 2025
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Danielle Cossette">
  <meta name="description" content="Create Recipes">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Recipe</title>
  <link rel = "stylesheet" type = "text/css"  href = "style.css">
</head>
<body>
  <main>
    <?php 
      session_start();
      require_once('credentials.php');// includes the credentials.php - if already exists will not include again - if not found a fatal error will occur and halts the script
      require_once('recipe_database.php');// includes the recipe_database.php - if already exists will not include again - if not found a fatal error will occur and halts the script
      include "header.php" ;//includes the header.php - will not throw a fatal error but a warning 
      $db = db_connect();//declaring variable called db and assigning it the value of the function db_connect() from recipe_database
  //if user is not logged in or "set" then redirect back to the header
      if (!isset($_SESSION['valid_user_id'])) {
        header('Location: login.php');
      } 
    ?>  
  <!--Displays a form to be filled out for the required fields to enter a new recipe into the database-->
    <div>
      <a  href="<?php echo 'index.php'; ?>"> Back to Recipes</a>
      <div>
        <h1>Add New Recipe</h1>
        <form action='new_recipe.php' method="POST">    
          <dl>
            <dt>Recipe Name</dt>
            <dd><input type="text" name="name" /></dd>
          </dl>
          <dl>
            <dt>Recipe Description</dt>
            <dd><input type="text" name="recipedescription"  /></dd>            
          </dl>
          <dl>
            <dt>Recipe Instructions</dt>
            <dd><textarea name="Instructions" rows = "15"  cols = "100"> </textarea></dd>
            </dd>
          </dl>
          <dl>
            <dt>Recipe Ingredients</dt>
            <dd><textarea name="Ingredients" rows = "15"  cols = "100"> </textarea></dd>
            </dd>
          </dl>
          <dl>
            <dt>Cuisine </dt>
            <dd><select name = "CuisineType" id = "CuisineType">
                  <option value = "" disabled selected > Select a Cuisine</option>
                  <option value = "American" > American </option>
                  <option value = "Canadian" > Canadian </option>
                  <option value = "Mexican" > Mexican </option>
                  <option value = "Italian" > Italian </option>
                  <option value = "Viatnamese" > Viatnamese </option>
                  <option value = "Frence" > French </option>
                  <option value = "Dessert" > Dessert </option>
                </select>
            </dd>
          </dl>
          <dl>
            <dt>Dietary Type</dt>
            <dd><select name = "dietarytype" id = "dietarytype">
                  <option value = "" disabled selected > Select a Dietary Type</option>
                  <option value = "Lactose Free" > Lactose Free </option>
                  <option value = "Vegan" > Vegan </option>
                  <option value = "Gluten Free" > Gluten Free </option>
                  <option value = "Vegetarian" > Vegetarian </option>
                  <option value = "No Preference" >Not Applicable </option>
                </select>
            </dd>
          </dl>
        <?php
  //if the method is POST
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {

              $UserID = $_SESSION['valid_user_id'];//getting the UserID from the session 
              $name = $_POST['name'];
              $description = mysqli_real_escape_string($db, $_POST['recipedescription']);//handling in the event the user inputs a special character
              $instructions = mysqli_real_escape_string($db, $_POST['Instructions']);
              $ingredients = mysqli_real_escape_string($db, $_POST['Ingredients']);
              $cuisineName = $_POST['CuisineType'];
              $dietaryType = $_POST['dietarytype'];
              $dateCreated = date('Y-m-d');//getting the current date 

              if (!empty($cuisineName)) { //selecting the CuisineID based on the option from the user input and setting to null if user did not make a selection
                  $cuisineQuery = "SELECT CuisineID FROM Cuisine WHERE Description = '$cuisineName'";
                  $cuisineResult = mysqli_query($db, $cuisineQuery);
                  if ($cuisineRow = mysqli_fetch_assoc($cuisineResult)) {
                      $cuisineID = $cuisineRow['CuisineID'];
                  } else {
                      $cuisineID = null;  
                  }
              }

              if (!empty($dietaryType)) {//selecting the PreferenceID based on the option from the user input and setting to null if user did not make a selection
                  $dietaryQuery = "SELECT PreferenceID FROM Dietary_Preference WHERE PreferenceName = '$dietaryType'";
                  $dietaryResult = mysqli_query($db, $dietaryQuery);
                  if ($dietaryRow = mysqli_fetch_assoc($dietaryResult)) {
                      $dietaryID = $dietaryRow['PreferenceID'];
                  } else {
                      $dietaryID = null;  
                  }
              }

              $sql = "INSERT INTO `Recipe` (`Name`, `Description`, `Instructions`, `Ingredients`, `DateCreated`, `UserID`, `PreferenceID`, `CuisineID`)
                      VALUES ('$name', '$description', '$instructions', '$ingredients', '$dateCreated', $UserID, '$dietaryID', '$cuisineID')";

              $result = mysqli_query($db, $sql);
  //if the query ($result) was successfull
              if ($result) {
                  $id = mysqli_insert_id($db); //gets the primary key of the Recipe table 
                  header("Location: view_recipe.php?RecipeID=$id"); //redirects to the view_recipe and passing it the RecipeID that had been inserted
                  exit();
              } 
          }  
        ?>     
          <div >
            <input type="submit" value="Create Recipe" />
          </div>
        </form>
      </div>
    </div>
  </main>
  <footer>
    <?php include 'footer.php'; ?>
  </footer>
</body>
</html>
