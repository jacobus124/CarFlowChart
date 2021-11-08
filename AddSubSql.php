<?php
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    $array=explode("||",$_GET['q']);
    $SoekDubbelsSql=sprintf("SELECT * FROM subcategories WHERE Company='$array[0]' AND Category='$array[1]' AND Name='$array[2]'");
    $SoekDubbels=mysqli_query($riddelsql,$SoekDubbelsSql)or die(mysqli_error($riddelsql));
    $Gevind=mysqli_num_rows($SoekDubbels);
    if($Gevind==0)
    {
        $LeesInSubCategorySql=sprintf("INSERT INTO subcategories(Company, Category, Name) VALUES ('$array[0]','$array[1]','$array[2]')");
        $LeesInSubCategory=mysqli_query($riddelsql,$LeesInSubCategorySql)or die(mysqli_error($riddelsql));
        echo "Item Added";
    }
    else
    {
        echo "Item Already Exists";
    }
?>