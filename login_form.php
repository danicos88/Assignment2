<!DOCTYPE html>
<html lang="en">
<?php require_once('credentials.php');
require_once('recipe_database.php');
include 'header.php'; 
$db = db_connect();

session_start();

if (isset($_POST['UserName']) && isset($_POST['Password'])) {
    // Sanitize user input using mysqli_real_escape_string
    $username = mysqli_real_escape_string($db, $_POST['UserName']);
    $password = mysqli_real_escape_string($db, $_POST['Password']);
    
    // Create SQL query with sanitized inputs
    $sql = "SELECT * FROM USER WHERE UserName = '$username' AND Password = '$password'";

    // Run the query
    $result = mysqli_query($db, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if a matching user is found
        if (mysqli_num_rows($result) > 0) {
          
            $row = mysqli_fetch_assoc($result);
            $_SESSION['valid_user_id'] = $row['UserID'];
            $_SESSION['valid_user_name'] = $username;
            header("Location: index.php"); // Redirect to members-only page
            exit;
        } else {
            // Invalid login credentials
            echo "<p>Invalid username or password.</p>";
        }
    } else {
        echo "Error: " . mysqli_error($db);
    }
    
    // Close the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($db);
?>
    <!-- Alter so if logged in hides form to log in  -->

    <!-- provide form to log in -->
<form action="login_form.php" method="post">
        <fieldset>
            <legend>Login Now!</legend>
            <p><label for="UserName">User Name:</label>
                <input type="text" name="UserName" id="UserName" size="30" />
            </p>
            <p><label for="Password">Password:</label>
                <input type="Password" name="Password" id="Password" size="30" />
            </p>
        </fieldset>
        <button type="submit" name="login">Login</button>

<!-- TO DO. Make it so this form shows, already logged in if logged in. adapt auth.php to use the database made recipes.sql. searching through table USER for username and password -->
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>