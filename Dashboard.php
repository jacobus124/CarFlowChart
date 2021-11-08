<?php
    session_start();
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    require_once('GetCompany.php');
    $MM_authorizedUsers = "";
      $MM_donotCheckaccess = "true";
      
      // *** Restrict Access To Page: Grant or deny access to this page
      function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
        // For security, start by assuming the visitor is NOT authorized. 
        $isValid = False; 
      
        // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
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
      $MM_restrictGoTo = "Login.php";
      if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
        $MM_qsChar = "?";
        $MM_referrer = $_SERVER['PHP_SELF'];
        if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
        if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
        $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
        $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
        header("Location: ". $MM_restrictGoTo); 
        exit;
      }
      // ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  setcookie("Username", "", time() - (86400 * 30));
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="CarAjax.js?0.07"></script>
<link href="amadevcss.css?0.14" rel="stylesheet" type="text/css"/>
</head>
<body>
<ul id="menubar">
<?php 
  if(isset($per[0]) && $per[0]=="Admin")
  {
    ?>
      <li id="newRecord"><a href="NewEntry.php" target="mainiframe" onClick="nuwerecords()">New Record</a></li>
      <li id="progress" class="RecordsToggle">Records
        <ul id="RecordsHover" class="MenuExtraList" hidden>
          <li id="progress"><a href="InProgress.php" target="mainiframe" onClick="CarRecords()">In Progress</a></li>
          <li id="progress"><a href="Completed.php" target="mainiframe" onClick="Completed()">Completed</a></li>
        </ul>
      </li>      
      <li id="progress" class="ManageToggle">Management
          <ul id="UserHover" class="MenuExtraList" hidden>
                <li><a href="Users.php" target="mainiframe" onClick="AddUser()">Add User</a></li>
                <li><a href="Edit.php" target="mainiframe" onClick="EditUser()">Edit Users</a></li>
                <li><a href="Add.php" target="mainiframe" onClick="SiteManager()">Site Manager</a></li>
                <li><a href="LocationManager.php" target="mainiframe" onClick="LocationManager()">Location Manager</a></li>
          </ul>
      </li>
      <li id="progress" class="AppointmentToggle">Appointments
          <ul id="AppointmentHover" class="MenuAppointmentList" hidden>
                <li><a href="Mapsactivity.php" target="mainiframe" onClick="NewAppointment()">New Appointment</a></li>
                <li><a href="AppointmentList.php" target="mainiframe" onClick="Appointment()">Appointments</a></li>
                
          </ul>
      </li>
    <?php
  }
  else
  {
    ?>
      <li id="progress"><a href="InProgress.php" target="mainiframe" onClick="">In Progress</a></li>
    <?php
  }
  ?>
    <li id="progress"><a href="<?php echo $logoutAction?>">Sign Out</a></li>
</ul>
<iframe src="InProgress.php" id="mainiframe" name="mainiframe" style="z-index:1">

</iframe>
<script>
var naam = location.href;
	var i=0;
	var result="";
	var slyn=naam.length;
	var toets=0;
  var idtoets="";
for(i=0;i<slyn;i++)
	{
		if(naam[i]=='?')
		{
			i=slyn;
		}else
		{
			if(toets>0)
			{
				result+=naam[i];
			}
			if(naam[i]=='#')
			{
				toets=toets+1;
			}
		}
	}
  toets=0
  for(i=0;i<slyn;i++)
  {
    if(naam[i]=='?')
    {
      toets++;
    }
    if(toets>0)
    {
      idtoets+=naam[i];
    }
  }
	if(result=="InProgress")
	{
		document.getElementById("mainiframe").src = "InProgress.php";
	}
  else if(result=="AddUser")
	{
		document.getElementById("mainiframe").src = "Users.php";
	}
  else if(result=="EditUser")
	{
		document.getElementById("mainiframe").src = "Edit.php";
	}
  else if(result=="LocationManager")
	{
		document.getElementById("mainiframe").src = "LocationManager.php";
	}
  else if(result=="NewAppointment")
	{
		document.getElementById("mainiframe").src = "Mapsactivity.php";
	}
  else if(result=="Appointment")
	{
		document.getElementById("mainiframe").src = "AppointmentList.php";
	}
  else if(result=="Completed")
	{
		document.getElementById("mainiframe").src = "Completed.php";
	}
	else if(result=="CarDetails")
	{
		document.getElementById("mainiframe").src = "IndiCar.php"+idtoets;
	}
  else if(result=="EditCarDetails")
	{
		document.getElementById("mainiframe").src = "IndiCarEdit.php"+idtoets;
	}
	else if(result=="NewRecord")
	{
		document.getElementById("mainiframe").src = "NewEntry.php";
	}
  else if(result=="SiteManager")
	{
		document.getElementById("mainiframe").src = "Add.php";
	}
  else if(result=="UserManager")
	{
		document.getElementById("mainiframe").src = "Users.php";
	}
	else{
		window.parent.history.pushState({},"Dashboardmulto.php" , "#Inprogress");
		document.getElementById("mainiframe").src = "InProgress.php";
	}
addEventListener('popstate', function(event) {
	var naam = location.href;
	var i=0;
	var result="";
	var slyn=naam.length;
	var toets=0;
  var idtoets="";
	for(i=0;i<slyn;i++)
	{
		if(naam[i]=='?')
		{
      i=slyn;
		}else
		{
			if(toets>0)
			{
				result+=naam[i];
			}
			if(naam[i]=='#')
			{
				toets=toets+1;
			}
		}
	}
  toets=0
  for(i=0;i<slyn;i++)
  {
    if(naam[i]=='?')
    {
      toets++;
    }
    if(toets>0)
    {
      idtoets+=naam[i];
    }
  }
	if(result=="Inprogress")
	{
		document.getElementById("mainiframe").src = "InProgress.php";
	}
	else if(result=="CarDetails")
	{
		document.getElementById("mainiframe").src = "IndiCar.php"+idtoets;
	}
  else if(result=="EditCarDetails")
	{
		document.getElementById("mainiframe").src = "IndiCarEdit.php"+idtoets;
	}
	else if(result=="NewRecord")
	{
		document.getElementById("mainiframe").src = "NewEntry.php";
	}
	else if(result=="SiteManager")
	{
		document.getElementById("mainiframe").src = "Add.php";
	}
  else if(result=="UserManager")
	{
		document.getElementById("mainiframe").src = "Users.php";
	}
  else if(result=="AddUser")
	{
		document.getElementById("mainiframe").src = "Users.php";
	}
  else if(result=="EditUser")
	{
		document.getElementById("mainiframe").src = "Edit.php";
	}
  else if(result=="LocationManager")
	{
		document.getElementById("mainiframe").src = "LocationManager.php";
	}
  else if(result=="NewAppointment")
	{
		document.getElementById("mainiframe").src = "Mapsactivity.php";
	}
  else if(result=="Appointment")
	{
		document.getElementById("mainiframe").src = "AppointmentList.php";
	}
	else{
		document.getElementById("mainiframe").src = "InProgress.php";
	}});
</script>
</body>
</html>