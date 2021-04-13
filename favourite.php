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
        <table><tr><td align="left">
		<?php
		$URL="/Function/Search/search.php?login=true&uid=$Uid";
		echo("<script>function back(){location.href='$URL'}</script>");
		echo("<input type='button' value='Back' name='back' onclick='back();' />");
	?>
        </td></tr></table>
        <?php
        
        $result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM favourite WHERE UID='$Uid')");
    if ($result->num_rows > 0){


    echo("<table border='0' width='60%' class='center'>");
    
    
    echo("<th colspan='6'>Favourite</th>");
    echo("<tr>");
    echo("<td width='20%'>Image</td>");
    echo("<td width='20%'>Name</td>");
    echo("<td width='10%'>Category</td>");
    echo("<td width='10%'>Cuisine</td>");
    echo("<td width='20%'>Introduction</td>");
    echo("<td width='10%'>Favourite</td>");
    echo("</tr>");
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
				echo("<form id='delfav' method='post' action='delfavourite.php?rid=".$rid."&uid=".$Uid."'>");
				echo("<h5><button onclick='remind()'>UnFavourite</button></h5>");
				echo("</form>");
				echo("</td>");
				echo("</tr>");
				}
                echo("</table>");
}
                


                        ?>
                        
                </body>
</html>