<!doctype html>
<?php
require 'db.php';
?>
<html>
<head>
<meta charset="UTF-8">
<title>Recipes</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<style>
    ol{text-align:left}
    ul{text-align:left}
	table {
		border-collapse: collapse;
    }
    tr {
    	text-align: center;
    	border: 0px solid #000;
	}
	td {
		text-align: center;
	}
	</style>
</head>
<body>
<?php
Function printfullrecommendation($result){
	echo("<br><br><h3><center>Recommendation</center></h3>");
	echo("<table border='0' width='80%' class='center'>");
	echo("<tr>");
	printrecommendation($result);
	echo("</tr>");
	echo("</table><br>");
}
Function printrecommendation($result){
	$stop=0;
	while($rows = $result->fetch_assoc() and $stop!=4){
	echo("<td>");
$RID=$rows['RID'];
$Image=$rows['Imagename'];
$RName=$rows['RName'];
echo("<form method='post' action='display.php'> ");
echo("<input type='hidden' name='rid' value='$RID'>");
echo("<input type='image' src='../../$Image'alt='Submit' width='200pt' height='200pt'>");
echo("</form>");
echo($RName);
echo("</td>");
$stop++;
}
}
if(isset($_COOKIE["userid"])&$_COOKIE["userid"]!="undefined"){
	$Uid=$_COOKIE["userid"];
	$URL="/Function/Search/search.php?login=true&uid=$Uid";
}
else{
	$URL="/Function/Search/search.php";
}

echo("<script>function back(){location.href='$URL'}</script>");
echo("<input type='button' value='Back' name='back' onclick='back();' />");
if(isset($_POST['rid'])){
	$rid = $_POST['rid'];
}
if(empty($rid)){
	$rid = $_GET['id'];
}
$recipe = $conn->query("SELECT * FROM recipes where RID = '$rid'");
$ingredients = $conn->query("SELECT * from ingredients where RID = '$rid' ");
$step = $conn->query("SELECT * FROM step where RID = '$rid' order by SID ASC");
$re = $recipe->fetch_assoc();
$Category=$re['Category'];
$Cuisine=$re['Cuisine'];	
if(isset($_POST['rid'])){
	$new=$re['Clickrate']+1;
	$conn->query("update recipes SET Clickrate='$new' WHERE RID = '$rid'");
}

?>
<div style="text-align: center;">
<h3>Search for similar recipe by: </h3>
<?php echo("<form method='post' action='/Function/Compare/compare.php?id=$rid'>")?>
				<input type="checkbox" id="Introduction" name="Introduction" value="Introduction">
				<label for="Introduction">Introduction</label>&nbsp;
				<input type="checkbox" id="Category" name="Category" value="Category">
				<label for="Category">Category</label>&nbsp;
				<input type="checkbox" id="Cuisine" name="Cuisine" value="Cuisine">
				<label for="Cuisine">Cuisine</label>&nbsp;
				<input type="checkbox" id="Ingredients" name="Ingredients" value="Ingredients">
				<label for="Ingredients">Ingredients</label>&nbsp;
				<input type="checkbox" id="RName" name="RName" value="RName">
				<label for="RName">Recipe Name</label>
				<input type="checkbox" id="Step" name="Step" value="Step">
				<label style="padding-right: 20px;"for="Step">Step</label>
				<button>Find</button>
			</form>
			</div>
<center><h2><?php echo($re["RName"]); ?></h2></center>
<table width="60%" class="center">
			
    <tr>
        <td width="30%" rowspan="5"><?php echo("<img src='../../".$re['Imagename']."'"."width='300pt' height='300pt'");?></td>
            <td valign="top" style="text-align:left"> &nbsp;&nbsp;Author:&nbsp;&nbsp;<a href="list.php?Author=<?=$re["Author"]?>"><?php ECHO($re["Author"]);?></a></td>
            
        </td>
</tr>
<tr>
	<td style="text-align:left">
	&nbsp;&nbsp;Cuisine:&nbsp;&nbsp;<a href="list.php?Cuisine=<?=$Cuisine?>"><?php ECHO($Cuisine);?></a>
</td>
</tr>
<tr>
	<td style="text-align:left">
	&nbsp;&nbsp;Category:&nbsp;&nbsp;<a href="list.php?Category=<?=$Category?>"><?php ECHO($Category);?></a>
	
				
</td>
</tr>
<tr>
	<td>
<?php echo("<form method='post' action='addfavourite.php?id=$rid&display=true'>")?>
					<input type="hidden" name="rid" value="<?= $rid ?>"></input>
					<h5><button>Favourite</button></h5>
				</form></td></tr>
<tr><td height="50%" valign="bottom"><h3>Steps</h3></td></tr>
<tr>
    <td valign="top">
        <h4>Ingredients</h4>
    <?php echo("<ul>");
	while($in = $ingredients->fetch_assoc()){
				
                echo("<li>".$in['InName'].' '.$in['Amount']."</li><br>");
				
				} echo("</ul>");
                ?>
</td>
      
<td>
    <?php echo("<ol>");
	while($st = $step->fetch_assoc()){
				
                echo("<li>".$st['Method']."</li><br>");
				
				} echo("</ol>");
                ?>
</tr>
			</table>
<?php

$result=$conn->query("SELECT RID,RName,Imagename FROM recipes WHERE (Category='$Category' or Cuisine='$Cuisine') and RID!='$rid' Order By Clickrate DESC");
printfullrecommendation($result);
?>

    </body>
        
</html>