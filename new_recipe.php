<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php 
require_once('credentials.php');
require_once('recipe_database.php');
 include 'header.php'; 
 $db = db_connect();
 ?>

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
        <dd><textarea name="Instructions" rows = "15"  col = "100"> </textarea></dd>
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
              <option value = "LF" > Lactose Free </option>
              <option value = "Vegan" > Vegan </option>
              <option value = "Gluten Free" > Gluten Free </option>
              <option value = "Vegetarian" > Vegetarian </option>
              <option value = "No Preference" >Not Applicable </option>
            </select>
        </dd>
      </dl>
      
      <?php
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
            $name = $_POST['name'];
            $description = $_POST['recipedescription'];
            $instructions = $_POST['Instructions'];    
            $cuisineName = $_POST['CuisineType'];
            $dietaryType = $_POST['dietarytype'];
            $dateCreated = date('Y-m-d');
    
         if (!empty($cuisineName)) {
          
        $cuisineQuery = "SELECT CuisineID FROM Cuisine WHERE Description = '$cuisineName'";
        $cuisineResult = mysqli_query($db, $cuisineQuery);  
        if ($cuisineRow = mysqli_fetch_assoc($cuisineResult)) {
          $cuisineID = $cuisineRow['CuisineID'];  
      }     
        }
        if (!empty($dietaryType)){
          $dietaryQuery = "SELECT PreferenceID from Dietary_Preference where PreferenceName = '$dietaryType'";
          $dietaryResult = mysqli_query($db,$dietaryQuery);
          if ($dietaryRow = mysqli_fetch_assoc($dietaryResult)) {
            $dietaryID = $dietaryRow['PreferenceID'];  
        } 
        }

       $sql = "INSERT INTO Recipe (name, Description, Instructions, DateCreated, UserID, PreferenceID, CuisineID) 
            VALUES ('$name', '$description', '$instructions', '$dateCreated' , 1 , '$dietaryID', '$cuisineID' )";
      $result = mysqli_query($db, $sql);

      $id = mysqli_insert_id($db);
      
      
      header("Location: view_recipe.php?RecipeID=  $id");


}
?>     

          <div >
        <input type="submit" value="Create Recipe" />
      </div>
    </form>

  </div>

</div>

<?php include 'footer.php'; ?>
