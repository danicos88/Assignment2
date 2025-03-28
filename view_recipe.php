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
include "header.php" ;
$db = db_connect();
//access URL parameter
$id = $_GET['RecipeID'] ;


$sql = "SELECT * FROM Recipe WHERE RecipeID = '$id' ";
    
$result_set = mysqli_query($db, $sql);
    
$result = mysqli_fetch_assoc($result_set);

?>

<div class= "recipe-container">
    <h1> <?php echo $result['Name']; ?></h1>
  <div>
    <dl>
      <dt>Recipe Name</dt>
      <dd><?php echo $result['Name']; ?></dd>
    </dl>
        <dl>
          <dt>Recipe Description</dt>
          <dd><?php echo $result['Description']; ?></dd>
        </dl>
        <dl>
          <dt>Recipe Instructions</dt>
          <dd><?php echo $result['Instructions']; ?></dd>
        </dl>
  </div>
  </div>
<div class="back-button">
  <a  href="<?php echo 'index.php'; ?>">Back to Recipes</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
