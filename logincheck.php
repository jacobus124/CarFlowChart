<?php
mysqli_select_db($riddelsql, $database_riddelsql);
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_COOKIE['Username']))
{
	$name=$_COOKIE['Username'];
	$permissionkrysql=sprintf("SELECT Permission FROM loginkar WHERE Username='$name'");
	$loginpermission = mysqli_query($riddelsql, $permissionkrysql) or die(mysqli_error($riddelsql));
    $per=mysqli_fetch_array($loginpermission);
    $sesIDsql=sprintf("SELECT SesID FROM loginkar WHERE Username='$name'");
	$loginses = mysqli_query($riddelsql, $sesIDsql) or die(mysqli_error($riddelsql));
    $ses=mysqli_fetch_array($loginses);
    if($_COOKIE['SESID']==$ses[0])
    {
        $comanyNamesql=sprintf("SELECT Company FROM loginkar WHERE Username='$name'");
	    $companyName = mysqli_query($riddelsql, $comanyNamesql) or die(mysqli_error($riddelsql));
        $Companycode=mysqli_fetch_array($companyName);
        if($per[0]=='Admin')
        {
            $_SESSION['permission']=$per[0];
            $_SESSION['MM_Username']=$_COOKIE['Username'];
            $_SESSION['MM_UserGroup']="";
            $_SESSION['Company']=$Companycode[0];
        }
        else
        {
            //setcookie("SESID", "", time() - 3600); 
            //setcookie("Username", "", time() - 3600); 
            //unset($_SESSION['MM_Username']);
        }
    }
    else
    {
            //setcookie("SESID", "", time() - 3600); 
            //setcookie("Username", "", time() - 3600); 
           // unset($_SESSION['MM_Username']);
    }
	
}
?>