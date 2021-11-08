<?php require_once('Connections/riddelsql.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$toetsy=date("d");
$toets=date("h:i:s");
$datearray=explode(":",$toets);
$toetsid=$toetsy . $datearray[0] . $datearray[1] . $datearray[2];
$_SESSION['TVVID']=$toetsid;
$_SESSION['nom']=NULL;
$toetsidvv=$_SESSION['TVVID'];
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
?>
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
$naam=$_SESSION["Jaidnaam"];
			$kryvaksql = "SELECT Subject FROM loginklas WHERE Username='$naam'";
mysql_select_db($database_riddelsql, $riddelsql);
			$kryvak = mysql_query($kryvaksql, $riddelsql) or die(mysql_error());
			$vak = mysql_fetch_array($kryvak);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "loadnuwe")) 
{
	$insertSQL1 = sprintf("INSERT INTO toetsidlys(subject, Toetsnaam, toetsid) VALUES ('$vak[0]',%s,'$toetsidvv')",
					GetSQLValueString($_POST['toetsnaam' ], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result12 = mysql_query($insertSQL1, $riddelsql) or die(mysql_error());
	for($l=0; $l<=100;$l++)
	{
		$antwtoets='antwintik' . $l;
		if($_POST[$antwtoets]!="" || $_POST[$antwtoets]!=null)
			{
				$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, vraagnom) VALUES ('$toetsidvv','$vak[0]', %s, %s,'$l')",
					GetSQLValueString($_POST['vraagl' . $l], "text"),
					GetSQLValueString($_POST['antwintik'. $l], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
  				$insertGoTo = "opstel.php";
  				if (isset($_SERVER['QUERY_STRING'])) 
					{
    					$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    					$insertGoTo .= $_SERVER['QUERY_STRING'];
  					}
			}
	}
	
for($l1=0; $l1<=100;$l1++)
{
	$seltoets='sel' . $l1;
	if($_POST[$seltoets]!="" || $_POST[$seltoets]!=null)
		{
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, Opsie1, Opsie2, Opsie3, Opsie4, Opsie5, vraagnom) VALUES ('$toetsidvv','$vak[0]', %s, %s, %s, %s, %s, %s, %s, '$l1')",
					GetSQLValueString($_POST['vraag' . $l1], "text"),
					GetSQLValueString($_POST['sel'. $l1], "text"),
					GetSQLValueString($_POST['opsie' . $l1 . '0'], "text"),
					GetSQLValueString($_POST['opsie' . $l1 . '1'], "text"),
					GetSQLValueString($_POST['opsie' . $l1 . '2'], "text"),
					GetSQLValueString($_POST['opsie' . $l1 . '3'], "text"),
					GetSQLValueString($_POST['opsie' . $l1 . '4'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
  				$insertGoTo = "opstel.php";
  				if (isset($_SERVER['QUERY_STRING'])) 
					{
    					$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    					$insertGoTo .= $_SERVER['QUERY_STRING'];
  					}
			$insertGoTo="Homeklas.php";
  		header(sprintf("Location: %s", $insertGoTo));
			
			}
	}
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
<script src="riddelajax.js?12"></script>
<title>Riddel</title>
</head>
<style>
	#menubar
{
	height:60px;
	width:100%;
	min-width:800px;
	margin:0;
	padding:0;
	top:0px;
	list-style:none;
	position:fixed;
	z-index:999;
	background-color:white;
	-webkit-box-shadow: 0 2px 6px 0 rgba(0,0,0,0.12), inset 0 -1px 0 0 #dadce0;
    box-shadow: 0 2px 6px 0 rgba(0,0,0,0.12), inset 0 -1px 0 0 #dadce0;
	-webkit-font-smoothing: antialiased;
    font-family: "Google Sans",Arial,sans-serif;
    font-weight: normal;
}
	#sidebar li
{
	line-height:60px;
	text-align:left;
	height:5%;
	font-size:17px;
	min-height:50px;
	cursor:pointer;
	list-style:none;
	margin-left:15px;
	background-color:white;
    -webkit-font-smoothing: antialiased;
    font-family: "Google Sans",Arial,sans-serif;
    font-weight: normal;
}
#smalllist li
{
	line-height:60px;
	text-align:center;
	height:5%;
	height:5%;
	font-size:20px;
	min-height:50px;
	cursor:pointer;
	background-color:white;
    -webkit-font-smoothing: antialiased;
    font-family: "Google Sans",Arial,sans-serif;
    font-weight: normal;
}
#menubar li:hover
{
	text-align:center;
	color:black;
}
#sidebar li:hover
{
	color:black;
}
#sidebar a:hover
{
	color:black;
}
#regsstuk
{
	position:fixed;
	width:100%;
	height:100%;
	top:60px;
	left:250px;
	background-color:black;
	opacity:0.5;
	z-index:60;
}
#menubar li
{
	line-height:60px;
	text-align:center;
	width:170px;
	height:5%;
	color:grey;
	font-size:20px;
	min-height:50px;
	cursor:pointer;
	float:left;
	background-color:white;
    -webkit-font-smoothing: antialiased;
    font-family: "Google Sans",Arial,sans-serif;
    font-weight: normal;
}
#menubar a
{
	text-decoration:none;
	color:grey;
}

#menubar a:visited
{
	color:grey;
}
#menubar a:hover
{
	color:black;
}
	ul li a:hover
	{
		color:black;
	}
	ul li a
	{
		color:grey;
	}
	#sidebar
{
	position:fixed;
	height:100%;
	top:60px;
	width:200px;
	left:0px;
	margin:0;
	padding:0;
	list-style:none;
	background-color:white;
    -webkit-font-smoothing: antialiased;
    font-family: "Google Sans",Arial,sans-serif;
    font-weight: normal;
	z-index:1;
}
textarea
{
	font-family:arial;
}
	#mainiframe
{
	border-style:none;
	position:absolute;
	top:70px;
	height:auto;
	/*min-height:797px;*/
	margin:0;
	padding:0;
	width:99%;
	marquee-style:none;
}
	::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
select.soflow, select.soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   overflow: hidden;
   padding: 5px 10px;
   width:266px;
   min-width:150px;
}

select.soflow-color {
   color: #fff;
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}

input[type=file] {
    padding:5px 15px; 
    background:#8c8c8c; 
    cursor:pointer;
	color:white;
	width:100px;
	height:40px;
	border-style:none;
    border-radius: 5px;
	opacity: 0;
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
  /*position: absolute;*/
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.containerfoto {
  display: block;
  /*position: absolute;*/
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
  /*position: absolute;*/
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}
.containerfoto input {
  /*position: absolute;*/
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  /*position: absolute;*/
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}
.fotospan {
  top: 0;
  left: 0;
  background-color: #eee;
}
/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}
.containerfoto:hover input ~ .fotospan {
background-color: #ccc;
}
textarea
{
	font-family:arial;
}
#middel
	{
		position:relative;
		width: 92%;
		min-width: 700px;
		left: 4%;
		right: 4%;
		height: auto;
		top:5%;
		border: solid #898989;
		padding: 10px;
	}
	#submitbutton
	{
    padding:5px 5px 5px 5px; 
    background:#E4E4E4; 
    cursor:pointer;
		position: -webkit-sticky;
		position: sticky;
		left:100%;
		top:20px;
	color:#505050; 
	width:120px;
	height:40px;
	border-style:none;
	border-radius:5px;
		font-size: 17px;
		font-family:  Arial, "sans-serif";
	}
	#submitbutton:hover
	{
		border:solid #D0D0D0 1px;
		box-shadow: 1px 1px 7px #616161;
		
	}
</style>

<body style="text-transform:uppercase; font-size: 22px">
	<div id="middel">
	<h3 style="margin-top: 0px"> Test ID: <?php echo $_SESSION['TVVID'];?></h3>
	<?php
			$naam=$_SESSION["Jaidnaam"];
			$kryvaksql = "SELECT Subject FROM loginklas WHERE Username='$naam'";
			mysql_select_db($database_riddelsql, $riddelsql);
			$kryvak = mysql_query($kryvaksql, $riddelsql) or die(mysql_error());
			$vak = mysql_fetch_array($kryvak);
		?>
		<form action="upload.php" method="POST" name="loadnuwe" id="formtoets" onsubmit="return required()" enctype="multipart/form-data">
			<div style=" text-align: center;"><p style="line-height: 40px,  margin-top:5px; margin-bottom: 5px;">Test Name: </p><input type="text" name='toetsnaam' id="toetsnaam" style="height:30; width:300px"/></div><br><input name="submit" type="submit" value="Submit" id="submitbutton"/>
			
		<?php
	
			for($x=0;$x<=100;$x++)
			{
				
				if($x==0)
					{
						?>
							<div id="hden<?php echo $x;?>" style="display: block" >
						<?php	
					}
				else
					{
						?>
							<div id="hden<?php echo $x;?>" style="display: none" >
						<?php
					}
					?>
								
				<label class="container">Type in Question:<input type="checkbox" onChange="wysintik<?php echo $x;?>()" id="vraaghideintik<?php echo $x;?>"></br>
					<span class="checkmark"></span>
				</label>
		<label class="containerfoto"><input type="file" name="fileToUpload<?php echo $x;?>" id="fileToUpload<?php echo $x;?>">
					<img class="fotospan" id="fotospan<?php echo $x;?>" style="height: 150px; width: 150px; background: url('addimage.png'); background-size: 150px 150px; background-repeat: no-repeat"/>
				</label>
				
<script>
	const frame<?php echo $x;?> = document.getElementById('fotospan<?php echo $x;?>');
	const file<?php echo $x;?> = document.getElementById('fileToUpload<?php echo $x;?>');
	const reader<?php echo $x;?> = new FileReader();
	reader<?php echo $x;?>.addEventListener("load", function () 
	{
  		frame<?php echo $x;?>.style.background = `url(${ reader<?php echo $x;?>.result })`;
  		frame<?php echo $x;?>.style.backgroundSize = '600px 400px';
		document.getElementById("fotospan<?php echo $x;?>").style.height = "400px";
		document.getElementById("fotospan<?php echo $x;?>").style.width = "600px";
  		frame<?php echo $x;?>.style.backgroundRepeat = 'no';
		
	}, false);
	file<?php echo $x;?>.addEventListener('change',function() {
  	const image<?php echo $x;?> = this.files[0];
  	if(image<?php echo $x;?>) reader<?php echo $x;?>.readAsDataURL(image<?php echo $x;?>);
	}, false)
</script>				
				<br>

				
					Question <?php echo $x+1;?>:</br><textarea name="vraag<?php echo $x;?>" type="text" id="vraag<?php echo $x;?>" class="rq" cols="60" rows="7"></textarea></br><br><br>
		<?php
				for($r=0;$r<=4;$r++)
				{
		?>
					<p>Option <?php echo $r+1;?>:</p><textarea id="opsie<?php echo $x , $r;?>" name="opsie<?php echo $x , $r;?>" type="text" onkeydown="inputfunction<?php echo $x , $r;?>()" onkeyup="inputfunction<?php echo $x , $r;?>()" value="" class="rq" cols="35" rows="5"></textarea></br>
		<?php
				} 
		?>
	<p>Answer :</p><select id="sel<?php echo $x ;?>" name="sel<?php echo $x;?>" class="soflow" onChange="wysAnder<?php echo $x;?>()">
				<?php
					for($v=0;$v<=4;$v++)
						{
				?>
						<option></option>
				<?php
						}
				?>
</select>
<script>
	function wysintik<?php echo $x; ?>()
	{
		document.getElementById("hdenintik<?php echo $x;?>").style.display = 'block';
		document.getElementById("vraaghideintik<?php echo $x;?>").checked = 'false';
		document.getElementById("hden<?php echo $x;?>").style.display = 'none';
	}
</script>
<?php
		for($q=0;$q<=4;$q++)
			{
?>
				<script>
					function inputfunction<?php echo $x , $q;?>() 
						{
							var x = document.getElementById("opsie<?php echo $x , $q;?>").value;
  							document.getElementsByName('sel<?php echo $x;?>')[0].options[<?php echo $q;?>].innerHTML = x;
							document.getElementsByName('sel<?php echo $x;?>')[0].options[<?php echo $q;?>].value = x;
							document.getElementById("hden<?php echo $x+1;?>").style.display = "block";
						}
</script>
<?php }?>
</br></br></br></br></br></br></br></div>
<script>	
	
	function vraaghidemul<?php echo $x; ?>()
	{
		document.getElementById("hden<?php echo $x;?>").style.display = "block";
	}
	function inputfunctionintik<?php echo $x;?>() 
						{
							document.getElementById("hdenintik<?php echo $x+1;?>").style.display = "block";
						}

	function wysmuli<?php echo $x; ?>()
	{
		document.getElementById("hdenintik<?php echo $x;?>").style.display = 'none';
		document.getElementById("hden<?php echo $x;?>").style.display = 'block';
		document.getElementById("wysmuli1<?php echo $x;?>").checked = false;
	}
</script>
<div id="hdenintik<?php echo $x;?>" style="display: none" >
				<label class="container">Multiple Choose Questions:<input type="checkbox" onChange="wysmuli<?php echo $x;?>()" id="wysmuli1<?php echo $x;?>"></br>
					<span class="checkmark"></span>
				</label>

					Question <?php echo $x+1;?>:</br><textarea name="vraagl<?php echo $x;?>" type="text" id="vraagl<?php echo $x;?>" class="rq" cols="60" rows="7"></textarea></br><br>
<br>
				Answer :<br>
<textarea id="antwintik<?php echo $x;?>" name="antwintik<?php echo $x ;?>" type="text" onkeyup="inputfunctionintik<?php echo $x;?>()" class="rq" cols="35" rows="5"></textarea>
</br>
</br></br></div>

				<?php
			}
	?>
		<input type="hidden" name="MM_update" value="loadnuwe" />
	</form></br>
	</div>
</body>
</html>