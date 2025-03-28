<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
require_once('credentials.php');
require_once('recipe_database.php');
include "header.php" ;
$db = db_connect();

if(!isset($_GET['RecipeID'])) {
  header("Location:  index.php");
}
$id = $_GET['RecipeID'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $sql = "DELETE FROM Recipe WHERE RecipeID ='$id'";
    $result = mysqli_query($db, $sql);

  header("Location: index.php");


} 
else 
{
  $sql = "SELECT * FROM Recipe WHERE RecipeID= '$id' ";
    
$result_set = mysqli_query($db, $sql);
    
    $result = mysqli_fetch_assoc($result_set);
    
}

?>

<?php $page_title = 'Delete Recipe'; ?>


<div class="container">
  <div class="delete-recipe">
    <h1>Delete Recipe</h1>
    <p>Are you sure you want to delete this Recipe?</p>
    <p ><?php echo $result['Name']; ?></p>
    <form form action="<?php echo 'delete_recipe.php?RecipeID=' . $result['RecipeID']; ?>"  method="post">
      <div class="delete-button">
        <input type="submit" name="commit" value="Delete Recipe" />
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