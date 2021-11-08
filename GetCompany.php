<?php
    $com=$_SESSION['Company'];
    $krycomnaamsql=sprintf("SELECT Name FROM Companies WHERE ID='$com'");
    $krycomnaam=mysqli_query($riddelsql,$krycomnaamsql) or die(mysqli_error($riddelsql));
    $com1=mysqli_fetch_array($krycomnaam);
    $comnaam=$com1[0];
?>