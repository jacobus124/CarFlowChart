<?php
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    //require_once('logincheck.php');
    $array=explode("||",$_GET['q']);
    $SoekDubbelsSql=sprintf("SELECT * FROM loginkar WHERE Company='$array[0]' AND Username='$array[1]'");
    $SoekDubbels=mysqli_query($riddelsql,$SoekDubbelsSql)or die(mysqli_error($riddelsql));
    while($data=mysqli_fetch_array($SoekDubbels))
    {
        $id2=$data["ID"];
        $LeesInCategorySQL=sprintf("UPDATE loginkar SET Username='$array[1]',Company='$array[0]',Permission='$array[2]' WHERE ID='$id2'");
        $LeesInCategory=mysqli_query($riddelsql,$LeesInCategorySQL)or die(mysqli_error($riddelsql));
        echo "User Updated"; 
    }
?>