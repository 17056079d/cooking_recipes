<html lang="en">
<head>
  <title>User Registration</title>
  <link rel="stylesheet" href="formstyle.css" type="text/css">
</head>
<body class="body">
  <center><h1>Register</h1></center>
    <form action="signup.php" method="POST">
      <table class="center">
<tr>
  <td colspan="2">
    Username: <input type="text" name="username" /><br />
</td>
</tr>
<tr>
  <td colspan="2">
    Email: <input type="text" name="email" /><br />
</td>
</tr>
<tr>
  <td colspan="2">
    Password: <input type="text" name="password" /><br />
</td>
</tr>
<tr>
  <td colspan="2">
    Confirm password: <input type="text" name="password_confirm" /><br />
     
</td>
</tr>
<tr>
  <td align="left">
    <input type="submit" value="Register" />
</td>
<td align="right">
          <input type="button" value="Back" name="back" onclick="javascript:location.href='/Function/Search/search.php'" />
        </td>
</tr> 
    </form>
</table>
</body>
</html>