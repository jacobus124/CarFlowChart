function CarRecords() 
  {
	  window.parent.history.pushState({},"Dashboard.php" , "#InProgress");
	  document.getElementById("mainiframe").src = "InProgress.php";
  }
  function Completed() 
  {
	  window.parent.history.pushState({},"Dashboard.php" , "#Completed");
	  document.getElementById("mainiframe").src = "Completed.php";
  }
  function IndiCar(i) 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#CarDetails?q="+i);
    window.parent.document.getElementById("mainiframe").src = "IndiCar.php?q="+i;
  }
  
  function nuwerecords() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#NewRecord");
  	window.parent.document.getElementById("mainiframe").src = "NewEntry.php";
  }
  function SiteManager() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#SiteManager");
    
  }
  function UserManager() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#UserManager");
  }
  function AddUser() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#AddUser");
  }
  function EditUser() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#EditUser");
  }
  function NewAppointment() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#NewAppointment");
  }
  function Appointment() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#Appointment");
  }
  function LocationManager() 
  {
  	window.parent.history.pushState({},"Dashboard.php" , "#LocationManager");
  }
  $("document").ready(function()
{
  $(".ManageToggle").click(function(){
    $("#UserHover").toggle();
    $("#AppointmentHover").hide();
    $("#RecordsHover").hide();
  })
  $("#newRecord").click(function(){
    $("#UserHover").hide();
    $("#AppointmentHover").hide();
    $("#RecordsHover").hide();
  })
  $(".RecordsToggle").click(function(){
    $("#RecordsHover").toggle();
    $("#AppointmentHover").hide();
    $("#UserHover").hide();
  })
  $(".AppointmentToggle").click(function(){
    $("#AppointmentHover").toggle();
    $("#UserHover").hide();
    $("#RecordsHover").hide();
  })
  $(".mainiframe").click(function(){
    $("#AppointmentHover").hide();
    $("#UserHover").hide();
    $("#RecordsHover").hide();
  })
  
})
