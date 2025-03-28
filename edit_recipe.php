<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="all" href="style.css"/>
    <title>The Carousel</title>
</head>

<?php
    require_once('credentials.php');
    require_once('recipe_database.php');
    $db = db_connect();


    if(!isset($_GET['RecipeID'])) {
        header("Location:  index.php");
    }
    $id = $_GET['RecipeID'];

    $page_title = 'Edit Recipe'; 
    // Handle form values sent by new.php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //access the recipe information
        $name = $_POST['name'];
        $description = $_POST['description'];
        // $instructions = $_POST['instructions'];
        // $datecreated = $_POST['datecreated'];
        // $userid = $_POST['userid'];

    //update the table with new information
        $sql="UPDATE Recipe set name = '$name' , description = '$description' where RecipeID = '$id' ";
        // $sql="UPDATE Recipe set name = '$name' , description = '$description' , instructions = '$instructions' ,
        // datecreated = '$datecreated' , userid = '$userid' where RecipeID = '$id' ";
        $result = mysqli_query($db, $sql);
    //redirect to view Recipe page
        header("Location: view_recipe.php?RecipeID= $id");
    }
 
    else {
        $sql = " SELECT * FROM Recipe WHERE RecipeID= '$id' ";
        
        $result_set = mysqli_query($db, $sql);
        
        $result = mysqli_fetch_assoc($result_set);
    }

?>

<?php include 'header.php' ?>;

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
