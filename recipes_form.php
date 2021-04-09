<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<html lang="en">
<script>
var userid=sessionStorage["userid"]
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
	var step = document.getElementById('step').insertAdjacentHTML('beforeend', '<tr><th>'+stepcount+'</th><th><textarea name="'+stepName+'" cols="40" rows="2"></textarea></th></tr>');
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
createCookie("userid", userid, "10");
}
</script>

<head>
  <title>Recipes Uploads</title>
</head>
<body>
  <h1>Uploads</h1>
    <form action="store_image.php" method="POST" enctype="multipart/form-data" id="upload">
      Recipes Name: <input type="text" name="rname" /><br />
      Category: <select name="category">
    <option value="drink">drink</option>
    <option value="vegetarian">vegetarian</option>
    <option value="dishes">dishes</option>
    <option value="baking">baking</option>
  </select><br />
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
      Introduction: <br /><textarea maxlength="300" name="introduction" cols="40" rows="5"></textarea><br />
      image: <input type="file" name="myimage" id="myimage"/><br />
	  Ingredients:
	  <table id = "ingredients">
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
	  <input type="button" class="Ing" value="+" onclick="addIng()"/>
	  <input type="button" class="Ing" value="-" onclick="deleteIng()"/><br>
	  Step:
	  <table id = "step">
	  <tr>
	  <th>Step</th>
	  <th>instruction</th>
	  </tr>
	  <tr>
	  <th>1</th>
	  <th><textarea name="step1" cols="40" rows="2"></textarea></th>
	  </tr>
	  <tr>
	  <th>2</th>
	  <th><textarea name="step2" cols="40" rows="2"></textarea></th>
	  </tr>
	  <tr>
	  <th>3</th>
	  <th><textarea name="step3" cols="40" rows="2"></textarea></th>
	  </tr>
	  </table>
	  <input type="button" value="+" class="step" onclick="addStep()"/>
	  <input type="button" value="-" class="step" onclick="deleteStep()"/><br>
      <input type="submit" value="Upload" onclick="handin()"/>
    </form>
</body>
</html>

