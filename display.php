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

?>
<center><h2><?php echo($re["RName"]); ?></h2></center>
<table width="60%" class="center">
    <tr>
        <td width="30%" rowspan="3"><?php echo("<img src='../../".$re['Imagename']."'"."width='300pt' height='300pt'");?></td>
            <td valign="top" style="text-align:left"> &nbsp;&nbsp;By <?php echo($re["Author"]); ?></td>
            
        </td>
</tr>
<tr><td>
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
				
                echo("<li>".$in['InName'].' '.$in['Amount']."</li>");
				
				} echo("</ul>");
                ?>
</td>
      
<td>
    <?php echo("<ol>");
	while($st = $step->fetch_assoc()){
				
                echo("<li>".$st['Method']."</li>");
				
				} echo("</ol>");
                ?>
</tr>
			</table>
			<table width="60%" class="center" >
<tr>
    <td colspan="2"><h3>Search for similar recipe by: </h3> </td>
</tr>
<td>
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
				<label for="Step">Step</label>
				<br><br>
				<button>Find</button>
			</form>
			</td>

</table>


    </body>
        
</html>