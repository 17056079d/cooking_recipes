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
	.menu__toggler {
  position: absolute;
  top: 20px;
  left: 20px;
  z-index: 999;
  height: 28px;
  width: 28px;
  outline: none;
  cursor: pointer;
  display: flex;
  align-items: center;
}
.menu__toggler span,
.menu__toggler span::before,
.menu__toggler span::after {
  position: absolute;
  content: '';
  width: 28px;
  height: 2.5px;
  background: #111;
  border-radius: 20px;
  transition: 500ms cubic-bezier(0.77, 0, 0.175, 1);
}
.menu__toggler span::before {
  top: -8px;
}
.menu__toggler span::after {
  top: 8px;
}


.menu {
  position: absolute;
  left: -30%;
  z-index: 998;
  width: 30%;
  height: 50%;
  padding-left: 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  transition: 300ms left cubic-bezier(0.77, 0, 0.175, 1);
}
@media only screen and (max-width: 600px) {
  .menu {
    width: 250px;
    left: -250px;
    padding: 50px;
  }
}
.menu.active {
  left: 0;
}
.menu p {
  font-size: 1.4rem;
  margin-bottom: 1rem;
}

/*
 * BASIC STYLES
 */
*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
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
	.main {
  margin-left: 5%;
	}
	</style>
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
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
function removeCookies() {
            var res = document.cookie;
            var multiple = res.split(";");
            for(var i = 0; i < multiple.length; i++) {
               var key = multiple[i].split("=");
               document.cookie = key[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC";
            }
         }
function logout(){
	sessionStorage.clear();
	location.href="/Function/Search/search.php";
	removeCookies();
}
</script>
<body>
<div class="menu">
  <p>Category</p>
  <p>Cuisine</p>
</div>
<div class="menu__toggler"><span></span></div>
  <script >
    const toggler = document.querySelector('.menu__toggler');
const menu = document.querySelector('.menu');

toggler.addEventListener('click', () => {
  toggler.classList.toggle('active');
  menu.classList.toggle('active');
});
</script>
<div class="main">
<button id = "register" onclick="location.href = '/Function/Register/register_form.php';">Register</button>
<button id = "login" onclick="location.href = '/Function/Login/login_form.php';">Log in</button>
<button id = "upload" onclick="location.href = '/Function/Recipes_Upload/recipes_form.php';">Upload</button>
<button id = "logout" onclick="logout();">logout</button>
<?php
if(isset($_GET['uid'])){
$uid=$_GET['uid'];
$URL="/Function/Search/favourite.php?uid=$uid";
echo("<script>function fav(){location.href='$URL'}</script>");
}

echo("<button id = 'favourite' onclick='fav();'>Favourite</button>");	
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
				echo($rows['Author']);
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
Function NoFavRec(){
	$result = $conn->query("SELECT RID,Imagename FROM recipes WHERE Cuisine = '$cuisine' Order By Clickrate DESC");
	if ($result->num_rows > 0){ 
		printfullrecommendation($result);
	}
	else{
		$result = $conn->query("SELECT RID,Imagename FROM recipes Order By Clickrate DESC");
		if ($result->num_rows > 0){ 
			printfullrecommendation($result);
		}
	}
}
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
$cuisine=$array[$country];
if(isset($_GET['login'])){//if loggined
	echo("<h2><center>Result</center></h2>");
	printformat();
	if ($_GET['login']==true){
		$countfav=$conn->query("SELECT COUNT(*) FROM favourite WHERE UID=$uid");
		$rows = $countfav->fetch_assoc();
		if ($rows['COUNT(*)'] > 0){//if there is any record in favourite of the loggined user
		if (isset($_POST['search'])) {//if the user search anything
		$target = $_POST['search'];
		$cui =$conn->query("SELECT COUNT(*),Cuisine FROM favourite JOIN recipes ON favourite.RID=recipes.RID WHERE UID=$uid GROUP BY Cuisine Order By COUNT(*) DESC");
		$cat =$conn->query("SELECT COUNT(*),Category FROM favourite JOIN recipes ON favourite.RID=recipes.RID WHERE UID=$uid GROUP BY Category Order By COUNT(*) DESC");
		if ($cui->num_rows > 0 and $cat->num_rows > 0){ //if there is record match the favourite of user
			if($rows = $cui->fetch_assoc() and $rows2 = $cat->fetch_assoc()){
				$countcui=$rows['COUNT(*)'];
				$maxcui=$rows['Cuisine'];
				$countcat=$rows2['COUNT(*)'];
				$maxcat=$rows2['Category'];
				if($countcui==$countcat){//if the max count of cuisine = category
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Category='$maxcat' and Cuisine='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and (Category!='$maxcat' or Cuisine!='$maxcui')");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					echo("</table>");
					$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Category='$maxcat' and Cuisine='$maxcui' Order By Clickrate DESC");
					if ($result->num_rows > 0){ 
						printfullrecommendation($result);
					}
					else{
						NoFavRec();
					}
				}
				else if ($countcui>$countcat){//if the max count of cuisine > category
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine!='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					echo("</table>");
					$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Cuisine='$maxcui' Order By Clickrate DESC");
					if ($result->num_rows > 0){ 
						printfullrecommendation($result);
					}
					else{
						NoFavRec();
					}
				}
				else if ($countcui<$countcat){//if the max count of cuisine < category
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Category='$maxcat'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Category!='$maxcat'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					echo("</table>");
					$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Category='$maxcat' Order By Clickrate DESC");
					if ($result->num_rows > 0){ 
						printfullrecommendation($result);
					}
					else{
						NoFavRec();
					}
				}
			}
		}
	}
	else {//the default page after login
		$uid=$_GET['uid'];
		$cui =$conn->query("SELECT COUNT(*),Cuisine FROM favourite JOIN recipes ON favourite.RID=recipes.RID WHERE UID=$uid GROUP BY Cuisine Order By COUNT(*) DESC");
		$cat =$conn->query("SELECT COUNT(*),Category FROM favourite JOIN recipes ON favourite.RID=recipes.RID WHERE UID=$uid GROUP BY Category Order By COUNT(*) DESC");
		if ($cui->num_rows > 0 and $cat->num_rows > 0){ 
			if($rows = $cui->fetch_assoc() and $rows2 = $cat->fetch_assoc()){
				$countcui=$rows['COUNT(*)'];
				$maxcui=$rows['Cuisine'];
				$countcat=$rows2['COUNT(*)'];
				$maxcat=$rows2['Category'];
				if($countcui==$countcat){
					$result = $conn->query("SELECT * FROM recipes WHERE Category='$maxcat' and Cuisine='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE Category!='$maxcat' or Cuisine!='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					echo("</table>");
					$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Category='$maxcat' and Cuisine='$maxcui' Order By Clickrate DESC");
					if ($result->num_rows > 0){ 
						printfullrecommendation($result);
					}
					else{
						NoFavRec();
					}
				}
				else if ($countcui>$countcat){
					$result = $conn->query("SELECT * FROM recipes WHERE Cuisine='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE Cuisine!='$maxcui'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					echo("</table>");
					$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Cuisine='$maxcui' Order By Clickrate DESC");
					if ($result->num_rows > 0){ 
						printfullrecommendation($result);
					}
					else{
						NoFavRec();
					}
				}
				else if ($countcui<$countcat){
					$result = $conn->query("SELECT * FROM recipes WHERE Category='$maxcat'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					$result = $conn->query("SELECT * FROM recipes WHERE Category!='$maxcat'");
					if ($result->num_rows > 0){
						printrecipe($result);
					}
					echo("</table>");
					$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Category='$maxcat' Order By Clickrate DESC");
					if ($result->num_rows > 0){ 
						printfullrecommendation($result);
					}
					else{
						NoFavRec();
					}
				}
				
			}
		}
		else{
			echo("fail");
		}
	}
	}
	else{//if the favourite is null
		
    if (isset($_POST['search'])) {
		$target = $_POST['search'];
		$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine = '$cuisine'");
		if ($result->num_rows > 0){ 
				printrecipe($result);
				$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine != '$cuisine'");
				printrecipe($result);
				echo("</table>");
		}
		else{
			$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine != '$cuisine'");
			if ($result->num_rows > 0){ 
				printrecipe($result);
				echo("</table>");
			}
		}
		$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Cuisine = '$cuisine' Order By Clickrate DESC");
		if ($result->num_rows > 0){ 
			printfullrecommendation($result);
		}
	}
	else {
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
		}
		$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Cuisine = '$cuisine' Order By Clickrate DESC");
		if ($result->num_rows > 0){ 
			printfullrecommendation($result);
		}
	}
	}
	}
}
else{//if the visitor not yet login
    if (isset($_POST['search'])) {//if visitor search anything
		echo("<h2><center>Result</center></h2>");
		printformat();
		$target = $_POST['search'];
		$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine = '$cuisine'");
		if ($result->num_rows > 0){ 
				printrecipe($result);
				$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine != '$cuisine'");
				printrecipe($result);
				echo("</table>");
				
		}
		else{
			$result = $conn->query("SELECT * FROM recipes WHERE RID IN(SELECT RID FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%') and Cuisine != '$cuisine'");
			if ($result->num_rows > 0){ 
				printrecipe($result);
				echo("</table>");
			}
				
		}
		$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Cuisine = '$cuisine' Order By Clickrate DESC");
		if ($result->num_rows > 0){ 
			printfullrecommendation($result);
		}
	}
	else {//default page when not logged in
		echo("<h2><center>Recipes</center></h2>");
		printformat();
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
		}
		$result = $conn->query("SELECT RID,RName,Imagename FROM recipes WHERE Cuisine = '$cuisine' Order By Clickrate DESC");
		if ($result->num_rows > 0){ 
		printfullrecommendation($result);
		}
	}
}
?>

</div>
<script>
if (sessionStorage["userid"] == null){
    document.getElementById("upload").style.display = "none";
	document.getElementById("logout").style.display = "none";
	document.getElementById("favourite").style.display = "none";
	
}
if (sessionStorage["userid"] != null){
	document.getElementById("register").style.display = "none";
    document.getElementById("login").style.display = "none";
	document.getElementById("login").insertAdjacentHTML('afterend',"Welcome! "+sessionStorage["UN"]);
	
}

</script>
</body>

</html>	