<?php
require_once('Connections/riddelsql.php');
require_once('GetSql.php');
$q=explode("||",$_GET['q']);
$loc1=explode("(",$q[2]);
$loc=explode(")",$loc1[1]);
$latlng=explode(",",$loc[0]);
$leesindatasql=sprintf("UPDATE loginkar SET Lat=%s , Lng=%s WHERE Username=%s AND Company=%s",
GetSQLValueString($riddelsql,$latlng[0], "text"),
GetSQLValueString($riddelsql,$latlng[1], "text"),
GetSQLValueString($riddelsql,$q[1], "text"),
GetSQLValueString($riddelsql,$q[0], "text"));
$leesindata=mysqli_query($riddelsql,$leesindatasql)or die(mysqli_error($riddelsql));
?>