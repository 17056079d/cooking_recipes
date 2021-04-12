<?php
include("config.php");
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$Uid=$_COOKIE["userid"];
$Rid=$_GET['id'];
if(isset($_GET['display'])){
	$display=$_GET['display'];
};
if($Uid!="undefined"){
	$sql="INSERT INTO favourite (RID,UID)VALUES('$Rid','$Uid')";
	mysqli_query($db, $sql);
	if($display!=true){
		$URL="/Function/Search/search.php?id=".$Rid;
	echo("<script type='text/javascript'>alert('Successfully added to Favourite!');location.href='$URL'</script>");

	}
	else{
		$URL="/Function/Search/display.php?id=".$Rid;
	echo("<script type='text/javascript'>alert('Successfully added to Favourite!');location.href='$URL'</script>");
}
	}
	
else if($display==true){
	$URL="/Function/Search/display.php?id=".$Rid;
	echo("<script type='text/javascript'>alert('Please login to add this recipes to favourite');location.href='$URL'</script>");
}
else{
	$URL="/Function/Search/search.php";
	echo("<script type='text/javascript'>alert('Please login to add this recipes to favourite');location.href='$URL'</script>");
}
?>