<?php
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    //require_once('logincheck.php');
    $array=explode("||",$_GET['q']);
    $SoekDubbelsSql=sprintf("SELECT * FROM cars WHERE Company='$array[0]' AND StockNom='$array[1]'");
    $SoekDubbels=mysqli_query($riddelsql,$SoekDubbelsSql)or die(mysqli_error($riddelsql));
    $Gevind=mysqli_num_rows($SoekDubbels);
    if($Gevind==0 && strlen($array[1])>0)
    {
        $LeesInCategorySQL=sprintf("INSERT INTO cars(Company,StockNom,Make,Model,Year,Color) VALUES ('$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]')");
        $LeesInCategory=mysqli_query($riddelsql,$LeesInCategorySQL)or die(mysqli_error($riddelsql));
        echo "Category Added";
    }
?>