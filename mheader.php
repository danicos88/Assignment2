<!--
Assignment 2
CST8285_332
mheader.php
Completed By: Danielle Cossette
A file to edit a recipe if selected
Created: March 28, 2025
Updated: March 29, 2025
-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="author" content="Danielle Cossette">
    <meta name="description" content="Members Only">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member's Only</title>
    <link rel = "stylesheet" type = "text/css"  href = "style.css">
</head>
<body>
    <header>
        <div class="navbar">
          <h1 class="web-title">The Carousel</h1>
            <nav>
                <a href="<?php echo 'index.php'; ?>">home</a>
                <a href="<?php echo 'logout.php'; ?>">logout</a>
                <a href="<?php echo 'show_favorite.php'; ?>">FavoriteRecipe</a>
                <form onsubmit="window.location.href = 'search_recipe.php?search=' + document.querySelector('input[name=search]').value; return false;">
                         <input type="text" name="search" placeholder="search"/>
                         <button type="submit">Search</button>
                </form>
            </nav>
        </div>
    </header>
</body>
</html>
  

    