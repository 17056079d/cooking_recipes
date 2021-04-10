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
    ol.a {list-style-type: decimal;text-align:left}
    ol.b {list-style-type: inherit;text-align:left}
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
$rid = $_POST['rid'];
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
<tr><td><form method="post" action="addfavourite.php">
					<input type="hidden" name="rid" value="<?= $rid ?>"></input>
					<h5><button>Favourite</button></h5>
				</form></td></tr>
<tr><td height="50%" valign="bottom"><h3>Steps</h3></td></tr>
<tr>
    <td valign="top">
        <h4>Ingredients</h4>
    <?php while($in = $ingredients->fetch_assoc()){
				echo("<ol class='b'>");
                echo("<li>".$in['InName'].' '.$in['Amount']."</li>");
				echo("</ol>");
				} 
                ?>
</td>
      
<td>
    <?php while($st = $step->fetch_assoc()){
				echo("<ol class='a'>");
                echo("<li>".$st['Method']."</li>");
				echo("</ol>");
				} 
                ?>
</tr>
<tr>
    <td colspan="2"><h3>Suggestion</h3> </td>
</tr>

</table>


    </body>
        
</html>