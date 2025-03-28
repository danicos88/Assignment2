<!DOCTYPE html>
<html lang="en">
<?php
// ALTER THIS
session_start();
$users = array("Grace", "Mia", "Orange"); //use datbase
$pass = array("xxxx", "yyyy", "zzzz");
if (isset($_POST['userid']) && isset($_POST['password'])) {
    // if the user has just tried to log in
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    //validate existance of the user and passward here(lookin for index), you can use datanase query here
    $key_u = array_search($userid, $users); //you can use query here
    $key_p = array_search($password, $pass);//returen the key 
    if ($key_u > -1 && $key_p > -1) { //if exist in the array
        $_SESSION['valid_user'] = $userid; //create session variable
        $_SESSION['valid_pass'] = $password; //create another session variable
        header("Location: membersOnly.php"); //redirect the user to the main page
    }
}

?> 
<!-- ALTER THIS SHIZ -->


<head>
    <link rel="stylesheet" media="all" href="style.css"/>
    <title>Login</title>
</head>
<body>
<?php require_once('credentials.php');
require_once('recipe_database.php');
include 'header.php'; 
$db = db_connect();?>

<?php
    if (isset($_SESSION['valid_user'])) {
        echo '<p>You are logged in as: ' . $_SESSION['valid_user'] . ' <br />';
        echo "<br>";
        echo "<br>";

        echo "session ID is " . session_id();
        echo "<br>";
        echo "<br>";
        echo '<a href="logout.php">Log out</a></p>';
    } else {
        if (isset($userid)) {
            // if they've tried and failed to log in
            echo '<p>Could not log you in.</p>';
        } else {
            // they have not tried to log in yet or have logged out
            echo '<p>You are not logged in.</p>';
            
        }
    } ?>
    <!-- Alter so if logged in hides form to log in  -->

    <!-- provide form to log in -->
<form action="login_form.php" method="post">
        <fieldset>
            <legend>Login Now!</legend>
            <p><label for="userid">UserID:</label>
                <input type="text" name="userid" id="userid" size="30" />
            </p>
            <p><label for="password">Password:</label>
                <input type="password" name="password" id="password" size="30" />
            </p>
        </fieldset>
        <button type="submit" name="login">Login</button>

<!-- TO DO. Make it so this form shows, already logged in if logged in. adapt auth.php to use the database made recipes.sql. searching through table USER for username and password -->
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>