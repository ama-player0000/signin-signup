<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Created:ama.player0000">
    <meta name="Telegram:ama_player0000">
    <meta name="Instagram:ama.player0000">
    <meta name="GitHub:ama-player0000">
	<link href="formstyle.css" type="text/css" rel="stylesheet">
	<link rel="icon" type="image/png" href="ama.png"/>
    <title>S I G N I N</title>
</head>
<body>
<img src="pictures/ama.png">
	<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Username</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login">Log In</button>
</form>
<?php
 
include('config.php');
session_start();
 
if (isset($_POST['login'])) {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        if (password_verify($password, $result['PASSWORD'])) {
            $_SESSION['user_id'] = $result['ID'];
            echo '<p class="success">Congratulations, you are logged in!</p>';
        } else {
            echo '<p class="error">Username password combination is wrong!</p>';
        }
    }
}
 
?>

</body>
</html>