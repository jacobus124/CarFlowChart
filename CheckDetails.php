<?php
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    //require_once('logincheck.php');
    $array=explode("||",$_GET['q']);
    $SoekDubbelsSql=sprintf("SELECT * FROM loginkar WHERE Company='$array[0]' AND Username='$array[1]'");
    $SoekDubbels=mysqli_query($riddelsql,$SoekDubbelsSql)or die(mysqli_error($riddelsql));
    $Gevind=mysqli_num_rows($SoekDubbels);
    if($Gevind==0 && strlen($array[1])>0)
    {
        $LeesInCategorySQL=sprintf("INSERT INTO loginkar(Company,Username,Password,Permission) VALUES ('$array[0]','$array[1]','$array[2]','$array[3]')");
        $LeesInCategory=mysqli_query($riddelsql,$LeesInCategorySQL)or die(mysqli_error($riddelsql));
        echo "User Added";
    }
    else
    {
        echo "Update";
    }
?>