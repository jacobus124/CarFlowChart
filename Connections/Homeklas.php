<?php require_once('Connections/riddelsql.php'); ?>
<?php

if (!isset($_SESSION)) {
  session_start();
}

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable Jaidnaam set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}
$MM_restrictGoTo = "Loginklas.php";
if (!((isset($_SESSION['Jaidnaam'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['Jaidnaam'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

$naam=$_SESSION["Jaidnaam"];
			$kryvaksql = "SELECT Subject FROM loginklas WHERE Username='$naam'";
			mysql_select_db($database_riddelsql, $riddelsql);
			$kryvak = mysql_query($kryvaksql, $riddelsql) or die(mysql_error());
			$vak = mysql_fetch_array($kryvak);
			$krypersql = "SELECT Permission FROM loginklas WHERE Username='$naam'";
			mysql_select_db($database_riddelsql, $riddelsql);
			$kryper = mysql_query($krypersql, $riddelsql) or die(mysql_error());
			$per = mysql_fetch_array($kryper);
			if($per[0]!=2)
			{
				header("Location: ". $MM_restrictGoTo); 
  				exit;
			}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$toetsy=date("d");
$toets=date("h:i:s");
$datearray=explode(":",$toets);
	$toetsid=$toetsy . $datearray[0] . $datearray[1] . $datearray[2];
$_SESSION['TVVID']=$toetsid;
$naam=$_SESSION["Jaidnaam"];
			$kryvaksql = "SELECT Subject FROM loginklas WHERE Username='$naam'";
			mysql_select_db($database_riddelsql, $riddelsql);
			$kryvak = mysql_query($kryvaksql, $riddelsql) or die(mysql_error());
			$vak = mysql_fetch_array($kryvak);
$die=$vak[0];
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "loadnuwe")) 
	{
  		$insertSQL = sprintf("INSERT INTO toetsidlys (subject, toetsid) VALUES ('$die', '$toetsid')");

  			mysql_select_db($database_riddelsql, $riddelsql);
  			$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
	
  	$MM_redirectLoginSuccess = "opstel.php";
	header("Location: " . $MM_redirectLoginSuccess );
}	
mysql_select_db($database_riddelsql, $riddelsql);
$query_Recordset1 = "SELECT * FROM vraeklas";
$Recordset1 = mysql_query($query_Recordset1, $riddelsql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<title>Riddel</title>
</head>
	<script src="riddelajax.js?22"></script>
<style>
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   overflow: hidden;
   padding: 5px 10px;
   width:233px;
   min-width:120px;
}

select#soflow-color {
   color: #fff;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#779126, #779126 40%, #779126);
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}
input[type=submit] {
    padding:5px 15px; 
    background:#8c8c8c; 
    cursor:pointer;
	color:white;
	width:90px;
	height:50px;
	border-style:none;
    border-radius: 5px;
}
	input[type=button] {
    padding:5px 15px; 
    background:#8c8c8c; 
    cursor:pointer;
	color:white;
	width:90px;
	height:50px;
	border-style:none;
    border-radius: 5px;
}
button {
    padding:5px 15px; 
    background:#8c8c8c; 
    cursor:pointer;
	color:white;
	width:90px;
	height:50px;
	border-style:none;
    border-radius: 5px; 
}
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
textarea
{
	font-family:arial;
}
</style>
<body style="text-transform:uppercase; font-size: 22px"><div style="position:absolute; text-align: center; top:20%; width: 99%">
	<form action="<?php echo $editFormAction; ?>" method="POST" name="loadnuwe" id="formtoets">
		
		<input name="submit" type="submit" value="New Test" style="width: 50%; height: 80px; font-size: 30px"/>
		<input type="hidden" name="MM_update" value="loadnuwe" />
			
	</form>
	<input type="button" onClick="window.location.assign('Answers.php')" value="Answers" style="width: 50%; height: 80px; font-size: 30px"/>
	</div>
</body>
</html>