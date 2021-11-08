<?php 
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Appointments</title>
    <style>
        .mainmiddel{
          position:absolute;
          height:90%;
          width:100%;
          left:0;
          top:10%;
          background-color:grey;
        }
        #iframemiddel{
          width:50%;
          height:99%;
          border:solid black 1px;
        }
        .topmenuitem{
          float:left;
          margin:5px;
          padding:10px;

        }
        #topmenu{
          list-style-type:none;
          margin:0;
        }
        .topmenucontainer{
        }
    </style>
  </head>
  <body>
  <div class="topmenucontainer">
        <ul id="topmenu">
          <li class="topmenuitem"><a href="Mapsactivity.php">Add Appointment</a></li>
          <li class="topmenuitem">listItem2</li>
          <li class="topmenuitem">listItem3</li>
          <li class="topmenuitem">listItem4</li>
        </ul>
  </div>
    <div class="mainmiddel">
      <iframe id="iframemiddel"></iframe>
    </div>

  </body>
</html>