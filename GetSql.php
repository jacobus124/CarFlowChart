<?php
if (!isset($_SESSION)) {
  session_start();
}
function GetSQLValueString($conn_vote, $theValue, $theType,   $theDefinedValue = "", $theNotDefinedValue = "")   
{  
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) :   $theValue;  

  $theValue = function_exists("mysqli_real_escape_string") ?   mysqli_real_escape_string($conn_vote, $theValue) :  
mysqli_escape_string($conn_vote, $theValue);

  switch ($theType) {  
    case "text":  
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";  
      break;      
    case "long":  
    case "int":  
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";    
      break;    
    case "double":    
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";  
      break;  
    case "date":  
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;  
    case "defined":  
      $theValue = ($theValue != "") ? $theDefinedValue :
$theNotDefinedValue;
break;
}
return $theValue;
}
mysqli_select_db($riddelsql,$database_riddelsql);
$query_Recordset1 = "SELECT * FROM loginkar";
$Recordset1 = mysqli_query($riddelsql, $query_Recordset1) or die(mysqli_error($riddelsql));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>