<?php
include("config.php");
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$Uid=$_GET["uid"];
$Rid=$_GET['id'];

	$sql="DELETE from favourite where RID = '$Rid' and UID ='$Uid' ";
	mysqli_query($db, $sql);
	
		$URL="/Function/Search/favourite.php";
	echo("<script type='text/javascript'>alert('Successfully deleted to Favourite!');location.href='$URL'</script>");

	
	

?>