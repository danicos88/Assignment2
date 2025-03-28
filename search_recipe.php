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


<form action='search_recipe.php' method="POST">
 <input type="text" name = "search" placeholder="search" >;
 </form>

 <?php

    $search = $_POST['search'];
   $searchResult = array();
   


    if (!empty($search)){
        $sql = "SELECT 'RecipeID' from Recipe where name like '%$search%'";
        $searchResult = mysqli_query($db, $sql);         
        $id = mysqli_insert_id($db);

        header("Location: view_recipe.php?RecipeID= $id");


    }

?> <table>
<tr>
    <th>RecipeID</th>
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
            <a href="<?php echo"search_recipe.php?RecipeID=" . $results['RecipeID']; ?>">Search</a>

        </td> 
    </tr>   
<?php } ?> 
</table>
