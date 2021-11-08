<?php
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    $array=explode("||",$_GET['q']);
    $LeesInSubCategorySql=sprintf("DELETE FROM permissions WHERE Username='$array[1]' AND Company='$array[0]'");
    $LeesInSubCategory=mysqli_query($riddelsql,$LeesInSubCategorySql)or die(mysqli_error($riddelsql));
?>