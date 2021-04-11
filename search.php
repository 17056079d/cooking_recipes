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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
function remind(){
	if (sessionStorage["userid"] == null){
		alert("Please login to add this recipes to favourite");
	}
}
var userid=sessionStorage["userid"];
function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}
createCookie("userid", userid, "10");
function logout(){
	sessionStorage.clear();
	location.href="/Function/Search/search.php";
}
</script>
<body class="body">
<button id = "register" onclick="location.href = '/Function/Register/register_form.php';">Register</button>
<button id = "login" onclick="location.href = '/Function/Login/login_form.php';">Log in</button>
<button id = "upload" onclick="location.href = '/Function/Recipes_Upload/recipes_form.php';">Upload</button>
<button id = "logout" onclick="logout();">logout</button>
<?php	
Function printrecipe($result){
				while($rows = $result->fetch_assoc()){
					echo("<tr>");
				echo("<td>");
				echo("<img src='../../".$rows['Imagename']."'");
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
$query = @unserialize(file_get_contents('http://ip-api.com/php/'));
if($query && $query['status'] == 'success') {
	$country=$query['country'];
}
$array = array(
    "Hong Kong" => "Chinese",
	"Japan" => "Japanese",
	"Italy" => "Italian",
	"Thailand" => "Thai",
	"Spain" => "Spanish",
	"Sweden" => "Swedish",
	"India" => "Indian",
	"Germany" => "German",
	"Mexico" => "Mexican",
);
if(isset($_GET['login'])){
	echo("<h2><center>Result</center></h2>");
	printformat();
	if ($_GET['login']==true){
		if (isset($_POST['search'])) {
		$target = $_POST['search'];
		$uid=$_GET['uid'];
		$cui =$conn->query("SELECT COUNT(*),Cuisine FROM favourite JOIN recipes ON favourite.RID=recipes.RID WHERE UID=1 GROUP BY Cuisine Order By COUNT(*) DESC");
		$cat =$conn->query("SELECT COUNT(*),Category FROM favourite JOIN recipes ON favourite.RID=recipes.RID WHERE UID=1 GROUP BY Category Order By COUNT(*) DESC");
		if ($cui->num_rows > 0 and $cat->num_rows > 0){ 
			if($rows = $cui->fetch_assoc() and $rows2 = $cat->fetch_assoc()){
				$countcui=$rows['COUNT(*)'];
				$maxcui=$rows['Cuisine'];
				//echo($rows['COUNT(*)']);
				//echo($rows['Cuisine']);
				$countcat=$rows2['COUNT(*)'];
				$maxcat=$rows2['Category'];
				//echo($rows2['COUNT(*)']);
				//echo($rows2['Category']);
				if($countcui==$countcat){
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Category='$maxcat' and Cuisine='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and (Category!='$maxcat' or Cuisine!='$maxcui')");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
				}
				else if ($countcui>$countcat){
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine!='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
				}
				else if ($countcui<$countcat){
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Category='$maxcat'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Category='$maxcat'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
				}
			}
		}
		echo("</table>");
	}
	else {
		$cuisine=$array[$country];
		$result = $conn->query("SELECT * FROM recipes WHERE Cuisine = '$cuisine' ");
		if ($result->num_rows > 0){ 	
				printrecipe($result);
				$result = $conn->query("SELECT * FROM recipes WHERE Cuisine != '$cuisine' ");
				printrecipe($result);
				echo("</table>");
		}
		else{
			$result = $conn->query("SELECT * FROM recipes WHERE Cuisine != '$cuisine' ");
			if ($result->num_rows > 0){ 
				printrecipe($result);
				echo("</table>");
			}
			else{
				echo("</table>");
				echo("<h3><center>No result</center></h3>");
			}
		}
	}
	}
}
else{
    if (isset($_POST['search'])) {
		$target = $_POST['search'];
		$result = $conn->query("SELECT * FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%'");
		if ($result->num_rows > 0){ 
			echo("<h2><center>Result</center></h2>");
				printformat();
				printrecipe($result);
				echo("</table>");
		}
		else{
			echo("<h2><center>Result</center></h2>");
			printformat();
			echo("</table>");
			
		}
	}
	else {
		$cuisine=$array[$country];
		$result = $conn->query("SELECT * FROM recipes WHERE Cuisine = '$cuisine' ");
		if ($result->num_rows > 0){ 
			echo("<h2><center>Recipes</center></h2>");
				printformat();
				printrecipe($result);
				$result = $conn->query("SELECT * FROM recipes WHERE Cuisine != '$cuisine' ");
				printrecipe($result);
				echo("</table>");
		}
		else{
			echo("<h2><center>Result</center></h2>");
			printformat();
			$result = $conn->query("SELECT * FROM recipes WHERE Cuisine != '$cuisine' ");
			if ($result->num_rows > 0){ 
				printrecipe($result);
				echo("</table>");
			}
			else{
				echo("</table>");
				
			}
		}
	}
}
?>
<script>
if (sessionStorage["userid"] == null){
    document.getElementById("upload").style.display = "none";
	document.getElementById("logout").style.display = "none";
	
}
if (sessionStorage["userid"] != null){
	document.getElementById("register").style.display = "none";
    document.getElementById("login").style.display = "none";
	document.getElementById("login").insertAdjacentHTML('afterend',"Welcome! "+sessionStorage["UN"]);
	
}

</script>
</body>

</html>	