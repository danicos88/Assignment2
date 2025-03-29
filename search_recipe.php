<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" media="all" href="style.css"/>
</head>
<body>



<?php 
require_once('credentials.php');
require_once('recipe_database.php');
include 'header.php';  
 $db = db_connect();
?>
<?php


    $search = trim($_GET['search']);   
    //echo $search;
    if (!empty($search)) {
       
        $sql = " SELECT * FROM Recipe r 
                JOIN Cuisine c ON r.CuisineID = c.CuisineID
                JOIN Dietary_Preference dp ON r.PreferenceID = dp.PreferenceID
                WHERE r.Name LIKE '%$search%' 
                    OR r.Ingredients LIKE '%$search%'
                    OR c.Description LIKE '%$search%'
                    OR dp.PreferenceName LIKE '%$search%'
                   ";      
                
        $result_set = mysqli_query($db, $sql);

        if(mysqli_num_rows($result_set) > 0){
            while($row = mysqli_fetch_assoc($result_set)){
                echo $row['Name'] . ' <a href="view_recipe.php?RecipeID=' . $row['RecipeID'] . '">View Recipe</a>';
            };
        }else{
            echo "Recipe not Found";
        }
        
    }
    mysqli_close($db);
    ?>
    
    </body>
    </html>

    
   

