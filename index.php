<?php

$username = htmlspecialchars($_POST["username"]);
$password = md5(htmlspecialchars($_POST["password"]));
$logout = htmlspecialchars($_POST["logout"]);

session_start();

$config = include('config.php');

if( !empty($username) && !empty($password) ) {

    if( $config['user'] == $username && $config['password'] == $password ) {
        header("Location: view.php");
        
        $_SESSION["user"] = $config['user'];
    } else {
        echo "Login unsuccess";
    }
} else if( $_SESSION["user"] == $config['user'] ) {
    if( !empty($logout) ) {
        echo "Logout successful";

        session_destroy();
    } else {
        echo "User logged in";
        echo "<form action=\"index.php\" method=\"POST\"><input type=\"hidden\" name=\"logout\" value=\"true\" /><br><input type=\"submit\" value=\"Logout\" /><br/></table>";    
    }
} else {
    echo "<form action=\"index.php\" method=\"POST\">Username: <input type=\"text\" name=\"username\" /><br>Password: <input type=\"password\" name=\"password\" /><br><input type=\"submit\" value=\"Login\" /><br/></table>";
}

?>
