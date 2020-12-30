<?php
    include("config.php");

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");

    // Authentication
    $UserName = $_POST["username"];
    $Password = $_POST["password"];
    $sql = "SELECT * FROM user WHERE UserName = '$UserName' AND Password = '$Password'";
    $result = mysqli_query($db, $sql);
    $valid = mysqli_fetch_array($result);
    if(isset($valid)){$message = "login successfully";}
    else{$message = "Your user name or password is invalid";}

    mysqli_close($db);

    // the response to android mobile
    echo($message);
?>
