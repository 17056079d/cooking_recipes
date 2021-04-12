<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Recipes</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<style>
	table {
		border-collapse: collapse;
    }
    tr {
    	text-align: center;
    	border-bottom: 1px solid #000;
	}
	td {
		text-align: center;
	}
	</style>
</head>
<?php
include("config.php");
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$test=similar_text('Honey Garlic Chicken with Rosemary', 'Keto Lemon-Garlic Chicken Thighs in the Air Fryer',$p);
$rid=$_GET["id"];
$array=array();
$sql="SELECT RID FROM recipes WHERE RID!='$rid'";
$result = mysqli_query($db, $sql);
Function printrecipe($result){
				while($rows = $result->fetch_assoc()){
					echo("<tr>");
				echo("<td>");
				?> <form method="post" action="display.php"> 
					<input type="hidden" name="rid" value="<?= $rows['RID'] ?>">
					<input type='image' src='../../<?php echo($rows['Imagename']);?>'alt='Submit' width='200pt' height='200pt'>
					</form>
				<?php
				echo("</td>");
				echo("<td>");
				echo($rows['RName']);
				echo("</td>");
				echo("<td>");
				echo($rows['Category']);
				echo("</td>");
				echo("<td>");
				echo($rows['Cuisine']);
				echo("</td>");
				echo("<td>");
				echo($rows['Introduction']);
				echo("</td>");
				echo("<td>");
				$rid=$rows['RID'];
				echo("<form id='addfav' method='post' action='addfavourite.php?id=".$rid."'>");
				echo("<h5><button onclick='remind()'>Favourite</button></h5>");
				echo("</form>");
				echo("</td>");
				echo("</tr>");
				}
				
}
Function printformat(){
	echo("<form method='post' action=''>");
			echo("<table class='center'>");
					echo("<td><input type='text' name='search'></td>");
					echo("<td><h6><input type='submit' value='search' name='submit'></h6></td>");
			echo("</table>");
		echo("</form>");
		echo("<br>");
			echo("<table border='0' width='60%' class='center'>");
				echo("<tr>");
				echo("<td width='20%'>Image</td>");
				echo("<td width='10%'>Name</td>");
				echo("<td width='10%'>Category</td>");
				echo("<td width='10%'>Cuisine</td>");
				echo("<td width='20%'>Introduction</td>");
				echo("<td width='10%'>Favourite</td>");
				echo("</tr>");
}
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$array[$row["RID"]]=0;
	}
}
if(isset($_POST["Introduction"])){
	$sql="SELECT RID,Introduction FROM recipes WHERE RID='$rid'";
	$result = mysqli_query($db, $sql);
	if($row = $result->fetch_assoc()){
		$introduction=$row["Introduction"];
	}
	$sql="SELECT RID,Introduction FROM recipes WHERE RID!='$rid'";
	$result = mysqli_query($db, $sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$tmp=similar_text($row["Introduction"],$introduction,$p);
			$array[$row["RID"]]+=$p;
		}
	}
}
if(isset($_POST["Step"])){
	$Step="";
	$method=array();
	$sql="SELECT RID,Method FROM step WHERE RID='$rid'";
	$result = mysqli_query($db, $sql);
	while($row = $result->fetch_assoc()){
		$Step=$Step.$row["Method"];
	}
	$sql="SELECT RID,Method FROM step WHERE RID!='$rid'";
	$result = mysqli_query($db, $sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if(isset($method[$row["RID"]])){
				$method[$row["RID"]]=$method[$row["RID"]].$row["Method"];
			}
			else{
				$method[$row["RID"]]=$row["Method"];
			}
		}
	}
	foreach ($method as $key => $value) {
		$tmp=similar_text($value,$Step,$p);
		$array[$key]+=$p;
	}
}
if(isset($_POST["Ingredients"])){
	$Ingredients="";
	$InName=array();
	$sql="SELECT RID,InName FROM ingredients WHERE RID='$rid'";
	$result = mysqli_query($db, $sql);
	while($row = $result->fetch_assoc()){
		$Ingredients=$Ingredients.$row["InName"];
	}
	$sql="SELECT RID,InName FROM ingredients WHERE RID!='$rid'";
	$result = mysqli_query($db, $sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if(isset($InName[$row["RID"]])){
				$InName[$row["RID"]]=$InName[$row["RID"]].$row["InName"];
			}
			else{
				$InName[$row["RID"]]=$row["InName"];
			}
		}
	}
	foreach ($InName as $key => $value) {
		$tmp=similar_text($value,$Ingredients,$p);
		$array[$key]+=$p;
	}
}
if(isset($_POST["RName"])){
	$sql="SELECT RID,RName FROM recipes WHERE RID='$rid'";
	$result = mysqli_query($db, $sql);
	if($row = $result->fetch_assoc()){
		$RName=$row["RName"];
	}
	$sql="SELECT RID,RName FROM recipes WHERE RID!='$rid'";
	$result = mysqli_query($db, $sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$tmp=similar_text($row["RName"],$RName,$p);
			$array[$row["RID"]]+=$p;
		}
	}
}
if(isset($_POST["Category"])){
	$sql="SELECT Category FROM recipes WHERE RID='$rid'";
	$result = mysqli_query($db, $sql);
	if($row = $result->fetch_assoc()){
		$Category=$row["Category"];
	}
	foreach ($array as $key => $value) {
		$sql="SELECT * FROM recipes WHERE Category='$Category' and RID='$key'";
		$result = mysqli_query($db, $sql);
		if ($result->num_rows == 0) {
			unset($array[$key]);
		}
	}
}
if(isset($_POST["Cuisine"])){
	$sql="SELECT Cuisine FROM recipes WHERE RID='$rid'";
	$result = mysqli_query($db, $sql);
	if($row = $result->fetch_assoc()){
		$Cuisine=$row["Cuisine"];
	}
	foreach ($array as $key => $value) {
		$sql="SELECT * FROM recipes WHERE Cuisine='$Cuisine' and RID='$key'";
		$result = mysqli_query($db, $sql);
		if ($result->num_rows == 0) {
			unset($array[$key]);
		}
	}
}
asort($array);
$final=array();
$stop=0;
echo("<h2><center>Similar Recipes</center></h2>");
printformat();
while($stop<5){
	$ridd=array_key_last($array);
	$sql="SELECT * FROM recipes WHERE RID='$ridd'";
	$result = mysqli_query($db, $sql);
	if ($result->num_rows > 0){
		printrecipe($result);
	}
	else{
		echo("<h2><center>No similar recipes</center></h2>");
	}
	array_pop($array);
	$stop++;
}
echo("</table>");
?>