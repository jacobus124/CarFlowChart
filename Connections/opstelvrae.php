<?php require_once('Connections/riddelsql.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}?>
<?php
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "loadnuwe")) 
	{
  		$insertSQL = sprintf("INSERT INTO vraeklas(Klas, Vraag, Antw, Opsie1, Opsie2, Opsie3, Opsie4) VALUES (%s, %s, %s, %s, %s, %s, %s)",
			GetSQLValueString($_POST['klas'], "text"),
			GetSQLValueString($_POST['vraag'], "text"),
			GetSQLValueString($_POST['sel'], "text"),
			GetSQLValueString($_POST['opsie1'], "text"),
			GetSQLValueString($_POST['opsie2'], "text"),
			GetSQLValueString($_POST['opsie3'], "text"),
			GetSQLValueString($_POST['opsie4'], "text"));
  			mysql_select_db($database_riddelsql, $riddelsql);
  			$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
  		$insertGoTo = "opstel.php";
  		if (isset($_SERVER['QUERY_STRING'])) 
			{
    				$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    				$insertGoTo .= $_SERVER['QUERY_STRING'];
  			}
  		header(sprintf("Location: %s", $insertGoTo));
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
<script>
	function tryhide()
	{
		var check1  = document.getElementById("vraaghide");
		var vraaghide = document.getElementById("vraagmoethidden");
		if(check1.checked==true)
			{
				vraaghide.style.display = "block";
			}
		else 
			{
				vraaghide.style.display ="none";
			}
	}
</script>
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
<body style="text-transform:uppercase; font-size: 22px"> 	
	<form action="<?php echo $editFormAction; ?>" method="POST" name="loadnuwe" id="formtoets" onsubmit="return required()">
		Subject:</br><input id="klas" name="klas" type="text" class="rq"/></br>
	<label class="container">Display question to students:<input type="checkbox" onChange="tryhide()" id="vraaghide"></br>
	<span class="checkmark"></span>
</label>
	<div id="vraagmoethidden" style="display: none">
	Question:</br><textarea name="vraag" type="text" id="vraag" class="rq" cols="35" rows="5"></textarea></br></div>
Option 1:</br><textarea id="opsie1" name="opsie1" type="text" onkeyup="inputfunction1()" value="" class="rq" cols="35" rows="5"></textarea></br>
		Option 2:</br><textarea id="opsie2" name="opsie2" type="text" onkeyup="inputfunction2()" value="" class="rq" cols="35" rows="5"></textarea></br>
		Option 3:</br><textarea id="opsie3" name="opsie3" type="text" onkeyup="inputfunction3()" value="" class="rq" cols="35" rows="5"></textarea></br>
		Option 4:</br><textarea id="opsie4" name="opsie4" type="text" onkeyup="inputfunction4()" value="" class="rq" cols="35" rows="5"></textarea></br>
Answer :<select id="sel" name="sel" style="width: 190px">
				<option></option>
				<option></option>
				<option></option>
				<option></option>
</select>

				<script>
					function inputfunction1() 
						{
							var x = document.getElementById("opsie1").value;
  							document.getElementsByName('sel')[0].options[0].innerHTML = x;
							document.getElementsByName('sel')[0].options[0].value = x;
						}
					function inputfunction2() 
						{
  							var x = document.getElementById("opsie2").value;
  							document.getElementsByName('sel')[0].options[1].innerHTML = x;
							document.getElementsByName('sel')[0].options[1].value = x;
						}
					function inputfunction3() 
						{
  							var x = document.getElementById("opsie3").value;
  							document.getElementsByName('sel')[0].options[2].innerHTML = x;
							document.getElementsByName('sel')[0].options[2].value = x;
						}
					function inputfunction4() 
						{
  							var x = document.getElementById("opsie4").value;
  							document.getElementsByName('sel')[0].options[3].innerHTML = x;
							document.getElementsByName('sel')[0].options[3].value = x;
						}
					function required()
						{
							var toets=0;
							var empt = document.forms["loadnuwe"]["klas"].value;
							if (empt == "")
								{
									document.getElementById("vraag").style.border = "solid red";
									return false;
								}
							else 
								{
									toets=toets+1; 
								}
							var op1 = document.forms["loadnuwe"]["opsie1"].value;
							if (op1 == "")
								{
									document.getElementById("opsie1").style.border = "solid red";
									return false;
								}
							else 
								{
									toets=toets+1; 
								}
							var op2 = document.forms["loadnuwe"]["opsie2"].value;
							if (op2 == "")
								{
									document.getElementById("opsie2").style.border = "solid red";
									return false;
								}
							else 
								{
									toets=toets+1; 
								}
							var op3 = document.forms["loadnuwe"]["opsie3"].value;
							if (op3 == "")
								{
									document.getElementById("opsie3").style.border = "solid red";
									return false;
								}
							else 
								{
									toets=toets+1; 
								}
							var op4 = document.forms["loadnuwe"]["opsie4"].value;
							if (op4 == "")
								{
									document.getElementById("opsie4").style.border = "solid red";
									return false;
								}
							else 
								{
									toets=toets+1; 
								}
							var se = document.forms["loadnuwe"]["sel"].value;
							if (se == "")
								{
									document.getElementById("sel").style.border = "solid red";
									return false;
								}
							else 
								{
									toets=toets+1; 
								}
							if(toets==6)
								{
									return true;
								}
						}
</script></br></br></br></br></br></br></br>
		<input name="submit" type="submit" value="Submit"/>
		<input type="hidden" name="MM_update" value="loadnuwe" />
	</form>
</body>
</html>