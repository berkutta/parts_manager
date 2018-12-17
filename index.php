<?php
session_start();

$username = htmlspecialchars($_POST["username"]);
$password = md5(htmlspecialchars($_POST["password"]));
$logout = htmlspecialchars($_POST["logout"]);

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

<style>
        body {
                font-family:Calibri;
        }
        tr:nth-of-type(even) {
                background:#efefef;
        }
        tr td {
                padding: 10px;
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
        }
        tr:first-of-type {
                font-weight:bold;
        }
        a, input[type="submit"] {
                display:inline-block;
                margin:5px;
                padding:5px 10px;
                background:darkgrey;
                color:#fff;
                text-decoration:none;
                border:none;
        }
        input, select {
                padding: 5px 10px;
                margin:5px;
                border:none;
                border-bottom:1px solid lightgrey;
                outline:none;
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
        }
</style>
