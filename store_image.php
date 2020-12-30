<?php
include("config.php");

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$RName=$_POST["rname"];
$Category=$_POST["category"];
$Introduction=$_POST["introduction"];
$imagename=$_FILES["myimage"]["name"];

$imagepath="/xampp/htdocs/";

move_uploaded_file($_FILES["myimage"]["tmp_name"], "$imagepath".$_FILES["myimage"]["name"]);

$insert_path="INSERT INTO recipes (RName,Introduction,Imagepath,Category,Imagename)VALUES('$RName','$Introduction','$imagepath','$Category','$imagename')";

$var=mysqli_query($db,$insert_path);
?>