<?php
include("config.php");
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$Uid=$_COOKIE["userid"];
$Rid=$_GET['id'];
if($Uid!=0){
	$sql="INSERT INTO favourite (RID,UID)VALUES('$Rid','$Uid')";
	mysqli_query($db, $sql);
}
if(isset($Uid)){
	$login=true;
}
else{
	$login=false;
}
header("Location: search.php?login=$login&uid=$Uid");
?>