<?php
header("Location: search.php");
include("config.php");
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$Uid=$_COOKIE["userid"];
$Rid=$_GET['id'];
$sql="INSERT INTO favourite (RID,UID)VALUES('$Rid','$Uid')";
mysqli_query($db, $sql);
echo("<script type='text/javascript'>alert('test');</script>");
?>