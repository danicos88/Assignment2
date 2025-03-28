<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="all" href="style.css"/>
    <title>Register</title>
</head>
<body>
<?php require_once('credentials.php');
require_once('recipe_database.php');
include 'header.php'; 
$db = db_connect();
?>

<form action="registrationform.php" method="post">
        <fieldset>
            <legend>Register</legend>
            <p><label for="FirstName">First Name:</label>
                <input type="text" name="FirstName" id="FirstName" size="30" />
            </p>
            <p><label for="LastName">Last Name:</label>
                <input type="text" name="LastName" id="LastName" size="30" />
            </p>
            <p><label for="Email">Email:</label>
                <input type="text" name="Email" id="Email" size="30" />
            </p>
            <p><label for="UserName">Username:</label>
                <input type="text" name="UserName" id="UserName" size="30" />
            </p>
            <p><label for="Password">Password:</label>
                <input type="text" name="Password" id="Password" size="30" />
            </p>
        </fieldset>
        <button type="submit" name="register">Register</button>
<?php       

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $Fname = $_POST['FirstName'];
    $LName = $_POST['LastName'];
    $Email = $_POST['Email'];    
    $Username = $_POST['UserName'];
    $Password = $_POST['Password'];
    $RegistrationDate = date('Y-m-d');


$sql = "INSERT INTO USER (FirstName, LastName, Email, UserName, RegistrationDate, Password)
VALUES ('$Fname', '$LName', '$Email', '$Username' , '$RegistrationDate' , '$Password')";
$result = mysqli_query($db, $sql);

$id = mysqli_insert_id($db);

header("Location: login_form.php?UserID=  $id");
}
?>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>