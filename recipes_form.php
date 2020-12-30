<html lang="en">
<head>
  <title>Recipes Uploads</title>
</head>
<body>
  <h1>Uploads</h1>
    <form action="store_image.php" method="POST" enctype="multipart/form-data">
      Recipes Name: <input type="text" name="rname" /><br />
      Category: <select name="category">
    <option value="drink">drink</option>
    <option value="vegetarian">vegetarian</option>
    <option value="dishes">dishes</option>
    <option value="baking">baking</option>
  </select><br />
      Introduction: <br /><input type="text" rows="10" cols="30" name="introduction" /><br />
      image: <input type="file" name="myimage" id="myimage"/><br />
      <input type="submit" value="Upload" />
    </form>
</body>
</html>

