<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="style.css"/>
    <title>The Carousel</title>
</head>
<body>

<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['valid_user_id'])) {
    // If logged in, include mheader.php
    include 'mheader.php';
} else {
    // If not logged in, include header.php
    include 'header.php';
}
?>

<?php
require_once('credentials.php');
require_once('recipe_database.php');

$db = db_connect(); 

?>

<?php 
$sql = "SELECT * FROM Recipe";
$result_set = mysqli_query($db, $sql);
?>

<?php
$num_rows = mysqli_num_rows($result_set);

?>

<div class="carousel">
        <input type="radio" name="carousel" id="slide-btn-1" class="slide-btn" onclick="setInt();" checked />
        <input type="radio" name="carousel" id="slide-btn-2" class="slide-btn" onclick="setInt();" />
        <input type="radio" name="carousel" id="slide-btn-3" class="slide-btn" onclick="setInt();" />
        <input type="radio" name="carousel" id="slide-btn-4" class="slide-btn" onclick="setInt();" />
        
        <div class="slide one">
            <h1>Recipe 1</h1>
        </div>
        <div class="slide two">
            <h1>Recipe 2</h1>
        </div>
        <div class="slide three">
            <h1>Recipe 3</h1>
        </div>
        <div class="slide four">
            <h1>Recipe 4</h1>
        </div>
    <div class="labels">
        <label for="slide-btn-1"></label>
        <label for="slide-btn-2"></label>
        <label for="slide-btn-3"></label>
        <label for="slide-btn-4"></label>
    </div>
</div>
        <div class="container">
            <div class="container-title">
              <h2>Recipes</h2>
            </div>
              <p class="general-paragraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto voluptas maxime libero neque iure dolor suscipit? Reiciendis, incidunt nihil, aliquid tempore debitis labore minus nemo vero, eos dignissimos quas dolor.</p>
              <table>
                <tr>
                    <th>Recipe #</th>
                    <th>Name</th>
                    <th>Description</th>    
                    <th>Options</th>    
                </tr>         
                <?php while($results = mysqli_fetch_assoc($result_set)) { ?>
                    <tr>
                        <td><?php echo $results['RecipeID']; ?></td>
                        <td><?php echo $results['Name']; ?></td>
                        <td><?php echo $results['Description']; ?></td>
                        <td>
                            <a href="<?php echo"view_recipe.php?RecipeID=" . $results['RecipeID']; ?>">View</a>
                            <a href="<?php echo"edit_recipe.php?RecipeID=" . $results['RecipeID']; ?>">Edit</a>
                            <a href="<?php echo"delete_recipe.php?RecipeID=" . $results['RecipeID']; ?>">Delete</a>
                            
                            <?php if (isset($_SESSION['valid_user_id'])) { ?>                  
                                <a href="add_favorite.php?RecipeID=<?php echo $results['RecipeID']; ?>&UserID=<?php echo $_SESSION['valid_user_id']; ?>">Add to Favorites</a>
                            <?php } ?>
                        </td> 
                    </tr>   
                <?php } ?> 
                </table>
                <?php if (isset($_SESSION['valid_user_id'])) { ?>   
                <div class="new"><a class="action" href="new_recipe.php">Create New Recipe</a></div> 
                <?php } ?> 
                </div>
            <div class="container">
                <article id="login">
                    <h2><a class="action" href="registrationform.php">login</a></h2>
                    <p><a class="action" href="login_form.php">log in</a> to view member exclusive content, save recipes, and customize your profile.</p>
                </article>
                <article id="registration">
                    <h2><a class="action" href="registrationform.php">registration</a></h2>
                    <p>not a member yet? click <a class="action" href="registrationform.php">here</a> to join and enjoy member-exclusive perks!</p>
                </article>
            </div>
                    
</div>

<?php include("footer.php"); ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
