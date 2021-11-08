<?php
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    $array=explode("||",$_GET['q']);
    $SoekDubbelsSql=sprintf("SELECT * FROM permissions WHERE Company='$array[0]' AND Items='$array[1]' AND Username='$array[2]'");
    $SoekDubbels=mysqli_query($riddelsql,$SoekDubbelsSql)or die(mysqli_error($riddelsql));
    $Gevind=mysqli_num_rows($SoekDubbels);
    if($Gevind==0)
    {
        $LeesInSubCategorySql=sprintf("INSERT INTO permissions(Company, Username, Items) VALUES ('$array[0]','$array[2]','$array[1]')");
        $LeesInSubCategory=mysqli_query($riddelsql,$LeesInSubCategorySql)or die(mysqli_error($riddelsql));
    }
    else
    {
    }
?>