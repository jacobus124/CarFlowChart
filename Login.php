<?php
  require_once('Connections/riddelsql.php');
  require_once('GetSql.php');

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "Dashboard.php";
  $MM_redirectLoginFailed = "Login.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($riddelsql, $database_riddelsql);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM loginkar WHERE Username=%s AND Password=%s",
    GetSQLValueString($riddelsql, $loginUsername, "text"), GetSQLValueString($riddelsql, $password, "text")); 
   
  $LoginRS = mysqli_query($riddelsql, $LoginRS__query) or die(mysqli_error($riddelsql));
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$cookie_name = "Username";
	$cookie_value = $_SESSION['MM_Username'];
	setcookie($cookie_name, $cookie_value, time() + (60*60*24*30));
	//$krysqlper="SELECT Permission FROM loginkar WHERE Username='$loginUsername'";
	//$kryper=mysqli_query($riddelsql,$krysqlper) or die(mysqli_error($riddelsql));
  //$per=mysqli_fetch_array($kryper);
	//$_SESSION['permission']=$per[0];
	//  if($per[0]=='Admin')
	//  {
      $MM_redirectLoginSuccess="Dashboard.php";
      $ses=rand(0,99999);
      $updatesesIDsql="UPDATE loginkar SET SesID='$ses' WHERE Username='$loginUsername'";
      $updatesesID=mysqli_query($riddelsql, $updatesesIDsql) or die(mysqli_error($riddelsql));
      $cookie_name = "SESID";
	    setcookie($cookie_name, $ses, time() + (60*60*24*30));
	//  }
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    ?>
  <script>
    location.href="Dashboard.php";
  </script>
  <?php
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--<script>
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 window.location= "http://www.riddel.co.za/Loginmobile.php";
}@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);
</script>-->
<style>


body {
  background: #E4E8EC;
  font-family: 'Open Sans', sans-serif;
}

.login {
  width: 22%;
	min-width: 400px;
  margin: 16px auto;
  font-size: 16px;
	top:20%;
	left: 37%;
	position:absolute; 
}

.login-header,
.login p {
  margin-top: 0;
  margin-bottom: 0;
}

.login-triangle {
  width: 0;
  margin-right: auto;
  margin-left: auto;
  border: 12px solid transparent;
  border-bottom-color: #28d;
}

.login-header {
  background: #28d;
  padding: 20px;
  font-size: 1.4em;
  font-weight: normal;
  text-align: center;
  text-transform: uppercase;
  color: #fff;
}

.login-container {
  background: #ebebeb;
  padding: 12px;
}

.login p {
  padding: 12px;
}

.login input {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border-width: 1px;
  border-style: solid;
  padding: 16px;
  outline: 0;
  font-family: inherit;
  font-size: 0.95em;
}

.login input[type="text"],
.login input[type="password"] {
  background: #fff;
  border-color: #bbb;
  color: #555;
}

.login input[type="text"]:focus,
.login input[type="password"]:focus {
  border-color: #888;
}

.login input[type="submit"] {
  background: #28d;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
}

.login input[type="submit"]:hover {
  background: #17c;
}

.login input[type="submit"]:focus {
  border-color: #05a;
}
	
</style>
<title>Login</title>
</head>

<body>
      
<div class="login">
  <h2 class="login-header">Log in</h2>
  <form class="login-container" action="<?php echo $loginFormAction; ?>" method="POST" name="login">
    <p><input type="text" placeholder="Username" name="username" id="username"></p>
    <p><input type="password" placeholder="Password" name="password" id="password"></p>
    <p><input type="submit" value="Log in"></p>
  </form>
</div>
  </div>
  
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
