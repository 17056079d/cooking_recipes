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
Function printformat(){
	echo("<form method='post' action=''>");
			echo("<table class='center'>");
					echo("<td><input type='text' name='search'></td>");
					echo("<td><h6><input type='submit' value='search' name='submit'></h6></td>");
			echo("</table>");
		echo("</form>");
		echo("<br>");
			echo("<table border='0' width='80%' class='center'>");
				echo("<tr>");
				echo("<td width='20%'>Image</td>");
				echo("<td width='10%'>Name</td>");
				echo("<td width='10%'>Category</td>");
				echo("<td width='10%'>Cuisine</td>");
				echo("<td width='20%'>Introduction</td>");
				echo("<td width='10%'>Author</td>");
				echo("<td width='10%'>Clickrate</td>");
				echo("<td width='10%'>Favourite</td>");
				echo("</tr>");
}
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
				$Category=$rows['Category'];
				echo("<a href='list.php?Category=$Category'>".$Category."</a>");
				echo("</td>");
				echo("<td>");
				$Cuisine=$rows['Cuisine'];
				echo("<a href='list.php?Cuisine=$Cuisine'>".$Cuisine."</a>");
				echo("</td>");
				echo("<td>");
				echo($rows['Introduction']);
				echo("</td>");
				echo("<td>");
				$Author=$rows['Author'];
				echo("<a href='list.php?Author=$Author'>".$Author."</a>");
				echo("</td>");
				echo("<td>");
				echo($rows['Clickrate']);
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
include("config.php");
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
if(isset($_GET["Category"])){
	$Category=$_GET["Category"];
	echo("<h2><center>Category-".$Category."</center></h2>");
	printformat();
	$sql="SELECT * FROM recipes WHERE Category='$Category'";
	$result = mysqli_query($db, $sql);
	printrecipe($result);
}
else if(isset($_GET["Cuisine"])){
	$Cuisine=$_GET["Cuisine"];
	echo("<h2><center>Cuisine-".$Cuisine."</center></h2>");
	printformat();
	$sql="SELECT * FROM recipes WHERE Cuisine='$Cuisine'";
	$result = mysqli_query($db, $sql);
	printrecipe($result);
}
else if(isset($_GET["Author"])){
	$Author=$_GET["Author"];
	echo("<h2><center>Author-".$Author."</center></h2>");
	printformat();
	$sql="SELECT * FROM recipes WHERE Author='$Author'";
	$result = mysqli_query($db, $sql);
	printrecipe($result);
}
?>