<html lang="en">
<head>
  <title>User Login</title>
  <link rel="stylesheet" href="formstyle.css" type="text/css">
</head>
<body class="body" >
  <center><h1>Login</h1></center>
    <form action="login.php" method="POST">
      <table class="center">
        <tr>
          <td colspan="2">
      Username: <input type="text" name="username" /><br />
</td>
</tr>
<tr>
<td colspan="2">
      Password: <input type="text" name="password" /><br />
</td>
</tr>
<tr>
<td align="left">
      
      <input type="submit" name="submit" value="Login">
</td>
<td align="right">
          <input type="button" value="Back" name="back" onclick="javascript:location.href='/Function/Search/search.php'" />
        </td>
</tr>
</table>
    </form>
</body>
</html>