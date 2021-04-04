<?php
include("config.php");
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, "cooking_recipes");
$RNameError = $IntroductionError = "";
if (empty($_POST["rname"])) {
        $RNameError = "Recipe name is required";
    }
else{
	$RName=$_POST["rname"];
	if (strlen($RName) > 50) {
            $RNameError = "Rceipe name length cannot exceed 50";
        }
}
$Category=$_POST["category"];
$Cuisine=$_POST["cuisine"];
$Introduction=$_POST["introduction"];
if (strlen($Introduction) > 150) {
            $$IntroductionError = "Introduction cannot exceed 150 words";
}
$imagename=$_FILES["myimage"]["name"];
if (empty($_POST["rname"])) {
	$imagepath="";
}
else{
	$imagepath="/xampp/htdocs/";
}

if ($RNameError == "" && $IntroductionError == "") {

$sql="INSERT INTO recipes (RName,Introduction,Imagepath,Category,Imagename,Cuisine)VALUES('$RName','$Introduction','$imagepath','$Category','$imagename','$Cuisine')";

if (mysqli_query($db, $sql) or die(mysqli_error($db))) {
	$message = "Recipe upload successfully";
	$sql="SELECT RID FROM recipes WHERE RName='$RName' AND Introduction='$Introduction' AND Category='$Category'";
	$result = mysqli_query($db, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$id= $row["RID"];
		}
	}
	for ($i=1;$i<=$_COOKIE["ingcount"]-1;$i++){
		$a = "ingredients";
		$b = "amount";
		$ing=$_POST[$a.$i];
		$amo=$_POST[$b.$i];
		$sql="INSERT INTO ingredients (RID,InName,Amount)VALUES('$id','$ing','$amo')";
		mysqli_query($db, $sql);
	}
	for ($j=1;$j<=$_COOKIE["stepcount"]-1;$j++){
		$c = "step";
		$step=$_POST[$c.$j];
		//echo($step);
		$sql="INSERT INTO step (RID,Method)VALUES('$id','$step')";
		mysqli_query($db, $sql);
	}
	mysqli_close($db);
			
}
else {
            $message = "Fail to upload the recipe";
        }
		move_uploaded_file($_FILES["myimage"]["tmp_name"], "$imagepath".$_FILES["myimage"]["name"]);
}

else {
        if ($RNameError != "") $message = $RNameError;
        else if ($IntroductionError != "") $message = $IntroductionError;
}

    // the response to android mobile
	//echo ($_COOKIE["stepcount"]);
	//$a = "ingredients";
	//$b="1";
	//echo ($_POST[$a.$b]);
    echo($message);
?>