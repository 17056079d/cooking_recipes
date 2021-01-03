<?php
include("config.php");

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$RNameError = $IntroductionError = "";
if (empty($_POST["rname"])) {
        $RNameError = "Recipe name is required";
    }
else{
	$RName=$_POST["rname"];
	if (strlen($RName) > 50) {
            $RNameError = "Rceipe name length cannot exceed 50";
        }
}
$Category=$_POST["category"];
$Cuisine=$_POST["cuisine"];
$Introduction=$_POST["introduction"];
if (strlen($Introduction) > 150) {
            $$IntroductionError = "Introduction cannot exceed 150 words";
}
$imagename=$_FILES["myimage"]["name"];
if (empty($_POST["rname"])) {
	$imagepath="";
}
else{
	$imagepath="/xampp/htdocs/";
}
if ($RNameError == "" && $IntroductionError == "") {

$sql="INSERT INTO recipes (RName,Introduction,Imagepath,Category,Imagename,Cuisine)VALUES('$RName','$Introduction','$imagepath','$Category','$imagename','$Cuisine')";

if (mysqli_query($db, $sql) or die(mysqli_error($db))) {
            $message = "Recipe upload successfully";
        }
else {
            $message = "Fail to upload the recipe";
        }
		move_uploaded_file($_FILES["myimage"]["tmp_name"], "$imagepath".$_FILES["myimage"]["name"]);
}

else {
        if ($RNameError != "") $message = $RNameError;
        else if ($IntroductionError != "") $message = $IntroductionError;
    }
	mysqli_close($db);

    // the response to android mobile
    echo($message);
?>