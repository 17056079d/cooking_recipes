<?php
	include("config.php");
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
	
	$UserName = $Password = $Email = "";
    $UserNameError = $EmailError = $PasswordError = $ConfirmError = "";
	// Validation
    if (empty($_POST["username"])) {
        $UserNameError = "User name is required";
    }
    else {
        $UserName = $_POST["username"];
        $result = mysqli_query($db, "SELECT * FROM User WHERE UserName = '$UserName'");
        $count = mysqli_num_rows($result);
        if (strlen($UserName) > 10) {
            $UserNameError = "User name length cannot exceed 10";
        }
        else if ($count == 1){
            $UserNameError = "This user name already exists";
        }
    }
	if (empty($_POST["password"])) {
		$PasswordError = "Password is required";
	}
	else {
		$Password = $_POST["password"];
	}
	if (empty($_POST["password_confirm"])) {
		$ConfirmError = "Confirm password is required";
	}
	
	if ($_POST['password'] !== $_POST['password_confirm']) {
		$ConfirmError = "Confirm password is not the same as password";
	}
    if (empty($_POST["email"])) {
        $EmailError = "Email is required";
    }
    else {
        $Email = $_POST["email"];
        $result = mysqli_query($db, "SELECT * FROM User WHERE Email = '$Email'");
        $count = mysqli_num_rows($result);
        if (strlen($Email) > 50){
            $EmailError = "Email cannot be exceed 50 characters";
        }
        else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $EmailError = "Invalid format and please re-enter valid email";
        }
        else if ($count == 1){
            $UserNameError = "This email already exists";
        }
    }

    // Insert records to database if the data is validated
    if ($UserNameError == "" && $EmailError == "" && $PasswordError == "" && $ConfirmError == "") {

        // Insert a record to table User
        $sql = "INSERT INTO User (UserName, Password, Email) VALUES ('$UserName', '$Password', '$Email')";
        if (mysqli_query($db, $sql) or die(mysqli_error($db))) {
            $message = "A new account created successfully";
        }
        else {
            $message = "Fail to create a new account";
        }
    }
    else {
        if ($UserNameError != "") $message = $UserNameError;
        else if ($EmailError != "") $message = $EmailError;
		else if ($PasswordError != "") $message = $PasswordError;
		else if ($ConfirmError != "") $message = $ConfirmError;
    }
    
    mysqli_close($db);

    // the response to android mobile
	if($message=="A new account created successfully"){
		$URL="/Function/Login/login_form.php";
	}
	else{
		$URL="/Function/Register/register_form.php";
	}
    echo("<script type='text/javascript'>alert('$message');location.href='$URL'</script>");
?>