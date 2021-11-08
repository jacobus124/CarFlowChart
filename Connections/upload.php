<?php require_once('Connections/riddelsql.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$toetsidvv=$_SESSION['TVVID'];
function kryalf($i)
{
	switch ($i) {
    case 1:
        $alf="a";
        break;
    case 2:
        $alf="b";
        break;
    case 3:
        $alf="c";
        break;
	case 4:
        $alf="d";
        break;
    case 5:
        $alf="e";
        break;
    case 6:
        $alf="f";
        break;
	case 7:
        $alf="g";
        break;
    case 8:
        $alf="h";
        break;
    case 9:
        $alf="i";
        break;
	case 10:
        $alf="j";
        break;
    case 11:
        $alf="k";
        break;
    case 12:
        $alf="l";
        break;
	case 13:
        $alf="m";
        break;
    case 14:
        $alf="n";
        break;
    case 15:
        $alf="o";
        break;
	case 16:
        $alf="p";
        break;
    case 17:
        $alf="q";
        break;
    case 18:
        $alf="r";
        break;
	case 19:
        $alf="s";
        break;
    case 20:
        $alf="t";
        break;
    case 21:
        $alf="u";
        break;
	case 22:
        $alf="v";
        break;
    case 23:
        $alf="w";
        break;
    case 24:
        $alf="x";
        break;
	case 25:
        $alf="y";
        break;
    case 26:
        $alf="z";
        break;
    default:
        $alf="a";;
}
	return $alf;
}
function foto($is)
{
	$target_file="";
	$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['fileToUpload' . $is]["name"]);
	if($target_file=="uploads/")
	{
		return 0;
	}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES['fileToUpload'. $is]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
//}
// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}
// Check file size
if ($_FILES['fileToUpload' . $is]["size"] > 5000000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
// if everything is ok, try to upload file
} else {
	$toetsj=date("y");
	$toetsm=date("m");
	$toetsd=date("d");
	$toets=date("h:i:s");
	$krynog=rand(1,26);
	$a=kryalf($krynog);
	$krynog=rand(1,26);
	$b=kryalf($krynog);
	$krynog=rand(1,26);
	$c=kryalf($krynog);
	$krynog=rand(1,26);
	$d=kryalf($krynog);
	$krynog=rand(1,26);
	$e=kryalf($krynog);
	$krynog=rand(1,26);
	$f=kryalf($krynog);
	$datearray=explode(":",$toets);
	$naamfile=$toetsj . $a . $toetsm . $b . $toetsd . $c . $datearray[0] . $d . $datearray[1] . $e . $datearray[2] . $f;
	
	$target_file = $target_dir . $naamfile . "." . $imageFileType;
    if (move_uploaded_file($_FILES['fileToUpload' . $is]["tmp_name"], $target_file)) {
    } else {
    }
}
	return($target_file);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
/*$naam=$_SESSION["Jaidnaam"];
			$kryvaksql = "SELECT Subject FROM loginklas WHERE Username='$naam'";
mysql_select_db($database_riddelsql, $riddelsql);
			$kryvak = mysql_query($kryvaksql, $riddelsql) or die(mysql_error());
			$vak = mysql_fetch_array($kryvak);*/

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "loadnuwe")) 
{
	$toetstoetsidsql="SELECT * FROM toetsidlys WHERE (toetsid='$toetsidvv')";
	mysql_select_db($database_riddelsql, $riddelsql);
	$toetstoetsid=mysql_query($toetstoetsidsql, $riddelsql) or die(mysql_error());
	$toetantal=mysql_num_rows($toetstoetsid);
	if($toetantal==0)
	{
				$insertSQL1 = sprintf("INSERT INTO toetsidlys(subject, Toetsnaam, toetsid) VALUES ('HIST111',%s,'$toetsidvv')",
									  GetSQLValueString($_POST['toetnaam'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result12 = mysql_query($insertSQL1, $riddelsql) or die(mysql_error());
	}else
	{
		$fetoets=mysql_fetch_array($toetstoetsid);
		if($_POST['toetnaam']!=$fetoets['Toetsnaam'])
		{
				$updateSQL1 = sprintf("UPDATE toetsidlys SET Toetsnaam=%s WHERE toetsid='$toetsidvv'",
									  GetSQLValueString($_POST['toetnaam'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Resultup = mysql_query($updateSQL1, $riddelsql) or die(mysql_error());
		}
	}
	if($_POST["verskil"]=='terug')
{
		
		if($_SESSION["nomvraag"]!=0)
			{
				$_SESSION["nomvraag"]=$_SESSION["nomvraag"]-1;
		}
		$vragnom=$_POST['q1v']-1;
		
		$toetsvraagidsql="SELECT * FROM vraeklas WHERE vraagnom='$vragnom'";
		
		mysql_select_db($database_riddelsql, $riddelsql);
		$toetsvraagid=mysql_query($toetsvraagidsql, $riddelsql) or die(mysql_error());
		$toetsvraagantal=mysql_num_rows($toetsvraagid);
		
		if($toetsvraagantal==0)
		{
			if($_POST["sel1"]!="" || $_POST["sel1"]!=null)
			{
			$fotopath=foto(1);
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, Opsie1, Opsie2, Opsie3, Opsie4, Opsie5, vraagnom, photo) VALUES ('$toetsidvv','HIST111', %s, %s, %s, %s, %s, %s, %s,'$vragnom','$fotopath')",
					GetSQLValueString($_POST['vraag'], "text"),
					GetSQLValueString($_POST['sel1'], "text"),
					GetSQLValueString($_POST['1opsie1'], "text"),
					GetSQLValueString($_POST['1opsie2'], "text"),
					GetSQLValueString($_POST['1opsie3'], "text"),
					GetSQLValueString($_POST['1opsie4'], "text"),
					GetSQLValueString($_POST['1opsie5'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
			}
		}
		else
		{
			if($_POST["sel1"]!="" || $_POST["sel1"]!=null)
			{
			$insertSQL = sprintf("UPDATE vraeklas SET Vraag=%s,Antw=%s,Opsie1=%s,Opsie2=%s,Opsie3=%s,Opsie4=%s,Opsie5=%s WHERE vraagnom='$vragnom' AND toetsid='$toetsidvv'",
					GetSQLValueString($_POST['vraag'], "text"),
					GetSQLValueString($_POST['sel1'], "text"),
					GetSQLValueString($_POST['1opsie1'], "text"),
					GetSQLValueString($_POST['1opsie2'], "text"),
					GetSQLValueString($_POST['1opsie3'], "text"),
					GetSQLValueString($_POST['1opsie4'], "text"),
					GetSQLValueString($_POST['1opsie5'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());

			}
				
		}
		
		
		
		
		$vragnom=$_POST['q2v']-1;
		$toetsvraagidsql="SELECT * FROM vraeklas WHERE vraagnom='$vragnom'";
		mysql_select_db($database_riddelsql, $riddelsql);
		$toetsvraagid=mysql_query($toetsvraagidsql, $riddelsql) or die(mysql_error());
		$toetsvraagantal=mysql_num_rows($toetsvraagid);
		
		if($toetsvraagantal==0)
		{
			if($_POST["sel2"]!="" || $_POST["sel2"]!=null)
			{
			$fotopath=foto(2);
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, Opsie1, Opsie2, Opsie3, Opsie4, Opsie5, vraagnom, photo) VALUES ('$toetsidvv','HIST111', %s, %s, %s, %s, %s, %s, %s,'$vragnom','$fotopath')",
					GetSQLValueString($_POST['vraag2'], "text"),
					GetSQLValueString($_POST['sel2'], "text"),
					GetSQLValueString($_POST['2opsie1'], "text"),
					GetSQLValueString($_POST['2opsie2'], "text"),
					GetSQLValueString($_POST['2opsie3'], "text"),
					GetSQLValueString($_POST['2opsie4'], "text"),
					GetSQLValueString($_POST['2opsie5'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
				
			}
		}
		else
		{
			if($_POST["sel2"]!="" || $_POST["sel2"]!=null)
			{
			$insertSQL = sprintf("UPDATE vraeklas SET Vraag=%s,Antw=%s,Opsie1=%s,Opsie2=%s,Opsie3=%s,Opsie4=%s,Opsie5=%s WHERE vraagnom='$vragnom' AND toetsid='$toetsidvv'",
					GetSQLValueString($_POST['vraag'], "text"),
					GetSQLValueString($_POST['sel2'], "text"),
					GetSQLValueString($_POST['2opsie1'], "text"),
					GetSQLValueString($_POST['2opsie2'], "text"),
					GetSQLValueString($_POST['2opsie3'], "text"),
					GetSQLValueString($_POST['2opsie4'], "text"),
					GetSQLValueString($_POST['2opsie5'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
				
			}
				
		}
}
	
else
{
	$vragnom=$_POST['q1v']-1;
		
		$toetsvraagidsql="SELECT * FROM vraeklas WHERE vraagnom='$vragnom'";
		
		mysql_select_db($database_riddelsql, $riddelsql);
		$toetsvraagid=mysql_query($toetsvraagidsql, $riddelsql) or die(mysql_error());
		$toetsvraagantal=mysql_num_rows($toetsvraagid);
		if($toetsvraagantal==0)
		{
	if($_POST["sel1"]!="" || $_POST["sel1"]!=null)
		{
		
		$fotopath=foto(1);
		$vrag=$_SESSION['nomvraag'];
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, Opsie1, Opsie2, Opsie3, Opsie4, Opsie5, vraagnom, photo) VALUES ('$toetsidvv','HIST111', %s, %s, %s, %s, %s, %s, %s,'$vrag','$fotopath')",
					GetSQLValueString($_POST['vraag'], "text"),
					GetSQLValueString($_POST['sel1'], "text"),
					GetSQLValueString($_POST['1opsie1'], "text"),
					GetSQLValueString($_POST['1opsie2'], "text"),
					GetSQLValueString($_POST['1opsie3'], "text"),
					GetSQLValueString($_POST['1opsie4'], "text"),
					GetSQLValueString($_POST['1opsie5'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
				$_SESSION['nomvraag']++;
	}
	else if($_POST["answ1"]!=NULL || $_POST["answ1"]!="")
		{
		$fotopath=foto(1);
		$vrag=$_SESSION['nomvraag'];
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, vraagnom, photo) VALUES ('$toetsidvv','HIST111', %s, %s,'$vrag','$fotopath')",
					GetSQLValueString($_POST['vraag'], "text"),
					GetSQLValueString($_POST['answ1'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
				$_SESSION['nomvraag']++;
	}
		}
	else
	{
		if($_POST["sel1"]!="" || $_POST["sel1"]!=null)
		{
		
		$fotopath=foto(1);
		$vrag=$_SESSION['nomvraag'];
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, Opsie1, Opsie2, Opsie3, Opsie4, Opsie5, vraagnom, photo) VALUES ('$toetsidvv','HIST111', %s, %s, %s, %s, %s, %s, %s,'$vrag','$fotopath')",
					GetSQLValueString($_POST['vraag'], "text"),
					GetSQLValueString($_POST['sel1'], "text"),
					GetSQLValueString($_POST['1opsie1'], "text"),
					GetSQLValueString($_POST['1opsie2'], "text"),
					GetSQLValueString($_POST['1opsie3'], "text"),
					GetSQLValueString($_POST['1opsie4'], "text"),
					GetSQLValueString($_POST['1opsie5'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
				$_SESSION['nomvraag']++;
	}
	}

}
	
		if(($_POST["sel2"]!="" || $_POST["sel2"]!=null) && $_POST["verskil"]!='terug')
		{
		$vrag=$_SESSION['nomvraag'];
		$fotopath=foto(2);
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, Opsie1, Opsie2, Opsie3, Opsie4, Opsie5, vraagnom, photo) VALUES ('$toetsidvv','HIST111', %s, %s, %s, %s, %s, %s, %s,'$vrag','$fotopath')",
					GetSQLValueString($_POST['vraag2'], "text"),
					GetSQLValueString($_POST['sel2'], "text"),
					GetSQLValueString($_POST['2opsie1'], "text"),
					GetSQLValueString($_POST['2opsie2'], "text"),
					GetSQLValueString($_POST['2opsie3'], "text"),
					GetSQLValueString($_POST['2opsie4'], "text"),
					GetSQLValueString($_POST['2opsie5'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
				$_SESSION['nomvraag']++;
				
			}
	else if(($_POST["answ2"]!=NULL || $_POST["answ2"]!="") && $_POST["verskil"]=='terug')
	{
		$fotopath=foto(2);
		$vrag=$_SESSION['nomvraag'];
		$insertSQL = sprintf("INSERT INTO vraeklas(toetsid, Vak, Vraag, Antw, vraagnom, photo) VALUES ('$toetsidvv','HIST111', %s, %s,'$vrag','$fotopath')",
					GetSQLValueString($_POST['vraag'], "text"),
					GetSQLValueString($_POST['answ2'], "text"));
  				mysql_select_db($database_riddelsql, $riddelsql);
  				$Result1 = mysql_query($insertSQL, $riddelsql) or die(mysql_error());
				$_SESSION['nomvraag']++;
	}
	$insertGoTo="opstel.php";
  	header(sprintf("Location: %s", $insertGoTo));
}

if($_POST["verskil"]=='klaar')
{
	$_SESSION["nomvraag"]=NULL;
	$_SESSION["TVVID"]=NULL;
	echo "klaar";
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>