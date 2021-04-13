<?php
require 'db.php';
// Start the session
$Uid=$_GET['uid'];

?>
<!DOCTYPE html>
<html>
	<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
	table {
		border-collapse: collapse;
    }
    th{
        text-align: center;
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
	<body class="body">
        
		<?php
		$URL="/Function/Search/search.php?login=true&uid=$Uid";
		echo("<script>function back(){location.href='$URL'}</script>");
		echo("<input type='button' value='Back' name='back' onclick='back();' />");
	?>

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
        $result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM favourite WHERE UID='$Uid')");
		echo("<h2><center>Favourite</center></h2>");
		printformat();
		if ($result->num_rows > 0){
			printrecipe($result);
			echo("</table>");
		}
?>
                        
                </body>
</html>