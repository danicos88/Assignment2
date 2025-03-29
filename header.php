<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="style.css"/>
    <title>The Carousel</title>
</head>
<body>
    <header>
        <div class="navbar">
          <h1 class="web-title">The Carousel</h1>
            <nav>
                <a href="<?php echo 'index.php'; ?>">home</a>
                <a href="<?php echo 'view_recipe.php'; ?>"></a>
                <a href="<?php echo 'login_form.php'; ?>">login</a>
                <a href="<?php echo 'registrationform.php'; ?>">registration</a>
                <form onsubmit="window.location.href = 'search_recipe.php?search=' + document.querySelector('input[name=search]').value; return false;">
                         <input type="text" name="search" placeholder="search"/>
                         <button type="submit">Search</button>
                </form>
            </nav>
        </div>
    </header>
  

    