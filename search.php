<!doctype html>
<?php
require 'db.php';
$cat="";
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
function ipLookUp () {
  $.ajax('http://ip-api.com/json')
  .then(
      function success(response) {
          console.log('User\'s Location Data is ', response);
          console.log('User\'s Country', response.country);
      },

      function fail(data, status) {
          console.log('Request failed.  Returned status of',status);
      }
  );
}
function logut(){
	sessionStorage.clear();
	location.reload();
}
ipLookUp();
</script>
<body class="body">
<button id = "register" onclick="location.href = '/Function/Register/register_form.php';">Register</button>
<button id = "login" onclick="location.href = '/Function/Login/login_form.php';">Log in</button>
<button id = "upload" onclick="location.href = '/Function/Recipes_Upload/recipes_form.php';">Upload</button>
<button id = "logout" onclick="logut();">logout</button>
<?php	
    if (isset($_POST['search'])) {
		$target = $_POST['search'];
		$result = $conn->query("SELECT * FROM recipes WHERE RName like '%$target%' or Introduction like '%$target%' or Category like '%$target%' or Cuisine like '%$target%'");
		if ($result->num_rows > 0){ ?>
			<h2><center>Result</center></h2>
			<form method="post" action="">
			<table class="center">
					<td><input type="text" name="search"></td>
					<td><h6><input type="submit" value="search" name="submit"></h6></td>
			</table>
		</form>
		<br>
			
			<table border="0" width="60%" class="center">
				<tr>
				<td width="20%">Image</td>
				<td width="10%">Name</td>
				<td width="10%">Category</td>
				<td width="10%">Cuisine</td>
				<td width="20%">Introduction</td>
				<td width="10%">Favourite</td>
				
				</tr>
				<?php
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
				?>
				<form method="post" action="addfavourite.php">
					<input type="hidden" name="rid" value="<?= $rows['RID'] ?>"></input>
					<h5><button>Favourite</button></h5>
				</form>
				<?php
				echo("</td>");
				echo("</tr>");
				}
				?>
			</table>
			<?php
		}
		else{
		echo("<h2><center>Result</center></h2>");
		echo("<h3><center>No result</center></h3>");
		}
	}
	else {
		?>
		<h2><center>Recipes</center></h2>
		<form method="post" action="">
			<table class="center">
					<td><input type="text" name="search"></td>
					<td><h6><input type="submit" value="search" name="submit"></h6></td>
			</table>
		</form>
		<br>
		<?php
		$result = $conn->query("SELECT * FROM recipes ");

		if ($result->num_rows > 0){ ?>
		<table border="0" width="60%" class="center">
			<tr>
				<td width="20%">Image</td>
				<td width="10%">Name</td>
				<td width="10%">Category</td>
				<td width="10%">Cuisine</td>
				<td width="20%">Introduction</td>
				<td width="10%">Favourite</td>
				
			</tr>
			<?php
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
			?>
				<form method="post" action="addfavourite.php">
					<input type="hidden" name="rid" value="<?= $rows['RID'] ?>"></input>
					<h5><button>Favourite</button></h5>
				</form>
			<?php
				echo("</td>");
				echo("</tr>");
			}
			?>
			</table>
		<?php
		}
		else{
		echo("<h2><center>Result</center></h2>");
		echo("<h3><center>No result</center></h3>");
		}
		?>
		<?php
	}
	?>
	
</body>
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
</html>	