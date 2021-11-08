<?php
      require_once('Connections/riddelsql.php');
      require_once('GetSql.php');
      $q=explode("||",$_GET['q']);
      $loc1=explode("(",$q[3]);
      $loc=explode(")",$loc1[1]);
      $latlng=explode(",",$loc[0]);
      if($q[3]==NULL)
      {
            $date="CURRENT_TIMESTAMP";
            $leesindatasql=sprintf("INSERT INTO appointment (Company, AppointmentName, Rep, Lat, Lng, Date) VALUES (%s, %s , %s , %s, %s, $date)",
            GetSQLValueString($riddelsql,$q[0], "text"),
            GetSQLValueString($riddelsql,$q[1], "text"),
            GetSQLValueString($riddelsql,$q[2], "text"),
            GetSQLValueString($riddelsql,$latlng[0], "text"),
            GetSQLValueString($riddelsql,$latlng[1], "text"));
      }
      else
      {
            $leesindatasql=sprintf("INSERT INTO appointment (Company, AppointmentName, Rep, Lat, Lng, Date) VALUES (%s,%s , %s , %s, %s, %s)",
            GetSQLValueString($riddelsql,$q[0], "text"),
            GetSQLValueString($riddelsql,$q[1], "text"),
            GetSQLValueString($riddelsql,$q[2], "text"),
            GetSQLValueString($riddelsql,$latlng[0], "text"),
            GetSQLValueString($riddelsql,$latlng[1], "text"),
            GetSQLValueString($riddelsql,$q[4], "text"));
      }
      $leesindata=mysqli_query($riddelsql,$leesindatasql)or die(mysqli_error($riddelsql));
?>