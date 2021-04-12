<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<html lang="en">
<script>
var username=sessionStorage["UN"];
console.log(username);
var stepcount =4;
var Ingcount=4;
function deleteIng(){
	if(Ingcount>=3){
		document.getElementById("ingredients").deleteRow(Ingcount-1);
		Ingcount--;
	}
	else{
		alert("There should be at least one ingredient");
	}
}
function deleteStep(){
	if(Ingcount>=3){
		document.getElementById("step").deleteRow(stepcount-1);
		stepcount--;
	}
	else{
		alert("There should be at least one step");
	}
}
function addIng(){
	var IngName="ingredients"+Ingcount;
	var Amount="amount"+Ingcount;
	document.getElementById('ingredients').insertAdjacentHTML('beforeend', '<tr><th>'+Ingcount+'</th><th><textarea name="'+IngName+'" cols="40" rows="2"></textarea></th><th><textarea name="'+Amount+'" cols="10" ></textarea></th></tr>');
	Ingcount ++;
}
function addStep(){
	var stepName="step"+stepcount;
	var step = document.getElementById('step').insertAdjacentHTML('beforeend', '<tr><th>'+stepcount+'</th><th><textarea name="'+stepName+'" maxlength="950" cols="40" rows="7"></textarea></th></tr>');
	stepcount ++;
}
function handin(){
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
createCookie("stepcount", stepcount, "10");
createCookie("ingcount", Ingcount, "10");
createCookie("username", username, "10");
}
</script>

<head>
  <title>Recipes Uploads</title>
  <link rel="stylesheet" href="formstyle.css" type="text/css">
</head>
<body class="body">
  <center><h1>Uploads</h1></center>
    <form action="store_image.php" method="POST" enctype="multipart/form-data" id="upload">
    <table  class="center">
<tr>
<td colspan="2">
	Recipes Name: <input type="text" name="rname" /><br />
</td>
</tr>
<tr>
<td colspan="2">
	Category: <select name="category">
    <option value="drink">drink</option>
    <option value="vegetarian">vegetarian</option>
    <option value="dishes">dishes</option>
	<option value="soup">soup</option>
    <option value="baking">baking</option>
  </select><br />
</td>
</tr>
<tr>
<td colspan="2">
	Cuisine: <select name="cuisine">
    <option value="Chinese">Chinese</option>
    <option value="Thai">Thai</option>
    <option value="Spanish">Spanish</option>
    <option value="Swedish">Swedish</option>
	<option value="Indian">Indian</option>
	<option value="German">German</option>
	<option value="Japanese">Japanese</option>
	<option value="ltalian">ltalian</option>
	<option value="Mexican">Mexican</option>
	<option value="Global">Global</option>
  </select><br />
</td>
</tr>
<tr>
<td colspan="2">
	Introduction: <br /><textarea maxlength="1450" name="introduction" cols="40" rows="5"></textarea><br />
</td>
</tr>
<tr>
<td colspan="2">
	image: <input type="file" name="myimage" id="myimage"/><br />
	  
</td>
</tr>
<tr>
<td colspan="2">
	 Ingredients:
	  <table class="center" id = "ingredients">
	  <tr>
	  <th>Item</th>
	  <th>Name</th>
	  <th>Amount</th>
	  </tr>
	  <tr>
	  <th>1</th>
	  <th><textarea name="ingredients1" cols="40" rows="2"></textarea></th><th><textarea name="amount1" cols="10" ></textarea></th>
	  </tr>
	  <tr>
	  <th>2</th>
	  <th><textarea name="ingredients2" cols="40" rows="2"></textarea></th><th><textarea name="amount2" cols="10" ></textarea></th>
	  </tr>
	  <tr>
	  <th>3</th>
	  <th><textarea name="ingredients3" cols="40" rows="2"></textarea></th><th><textarea name="amount3" cols="10" ></textarea></th>
	  </tr>
	  </table>
	  <input style="height: 1.5em;border-radius: 10px;line-height: 2em;" type="button" class="Ing" value="+" onclick="addIng()"/>
	  <input style="height: 1.5em;border-radius: 10px;line-height: 2em;" type="button" class="Ing" value="-" onclick="deleteIng()"/><br>
	  
</td>
</tr>
<tr>
<td colspan="2">
	Step:
	  <table id = "step">
	  <tr>
	  <th>Step</th>
	  <th>instruction</th>
	  </tr>
	  <tr>
	  <th>1</th>
	  <th><textarea name="step1" maxlength="950" cols="40" rows="7"></textarea></th>
	  </tr>
	  <tr>
	  <th>2</th>
	  <th><textarea name="step2" maxlength="950" cols="40" rows="7"></textarea></th>
	  </tr>
	  <tr>
	  <th>3</th>
	  <th><textarea name="step3" maxlength="950" cols="40" rows="7"></textarea></th>
	  </tr>
	  </table>
	  <input style="height: 1.5em;border-radius: 10px;line-height: 2em;" type="button" value="+" class="step" onclick="addStep()"/>
	  <input style="height: 1.5em;border-radius: 10px;line-height: 2em;" type="button" value="-" class="step" onclick="deleteStep()"/><br>
      
</td>
</tr>
<tr>
<td align="left">
	<input type="submit" value="Upload" onclick="handin()"/>
</td>
<td align="right">
          <input type="button" value="Back" name="back" onclick="javascript:location.href='/Function/Search/search.php'" />
        </td>
</tr>     
</table>
    </form>
</body>
</html>

