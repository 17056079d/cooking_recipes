<?php
    include("config.php");

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");

    // Authentication
    $UserName = $_POST["username"];
    $Password = $_POST["password"];
    $sql = "SELECT UserID,UserName FROM user WHERE UserName = '$UserName' AND Password = '$Password'";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$id= $row["UserID"];
			$UN=$row["UserName"];
		}
		$message = "login successfully";
	}
    else{$message = "Your user name or password is invalid";}

    mysqli_close($db);

    // the response to android mobile
    if($message=="login successfully"){
		$URL="/Function/Search/search.php?login=true&uid=$id";
		echo("<script type='text/javascript'>alert('$message');sessionStorage.userid = '$id';sessionStorage.UN = '$UN';location.href='$URL'</script>");
	}
	else{
		$URL="/Function/Login/login_form.php";
		echo("<script type='text/javascript'>alert('$message');location.href='$URL'</script>");
	}
?>
