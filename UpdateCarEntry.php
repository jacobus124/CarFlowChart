<?php
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    $array=explode("||",$_GET['q']);
    
    $SoekDubbelsSql=sprintf("SELECT * FROM entries WHERE Company='$array[0]' AND ID='$array[2]'");
    $SoekDubbels=mysqli_query($riddelsql,$SoekDubbelsSql)or die(mysqli_error($riddelsql));
    $CheckCount=mysqli_num_rows($SoekDubbels);
    if($CheckCount>0)
    {
        while($details=mysqli_fetch_array($SoekDubbels))
        {
            if($array[1]!=$details['Status'])
            {
                $LeesInSubCategorySql=sprintf("UPDATE entries SET Status='$array[1]' WHERE ID='$array[2]' AND Company='$array[0]'");
                $LeesInSubCategory=mysqli_query($riddelsql,$LeesInSubCategorySql)or die(mysqli_error($riddelsql));
                echo "Item Updated";
            }
        }
    }
    else
    {
        if($array[1]!="N/A")
        {
            $nuweId=explode("o",$array[2]);
            $LeesInSubCategorySql=sprintf("INSERT INTO entries(StockNom, NameID,Status,Company) VALUES ('$array[3]','$nuweId[1]','$array[1]','$array[0]')");
            $LeesInSubCategory=mysqli_query($riddelsql,$LeesInSubCategorySql)or die(mysqli_error($riddelsql));
            echo "Item Updated";
        }
        else
        {
            $LeesInSubCategorySql=sprintf("DELETE FROM entries WHERE Status='N/A'");
            $LeesInSubCategory=mysqli_query($riddelsql,$LeesInSubCategorySql)or die(mysqli_error($riddelsql));
            echo "Item Updated";
        }
    }

    $DeleteNASql=sprintf("DELETE FROM entries WHERE Status='N/A'");
    $DeleteNA=mysqli_query($riddelsql,$DeleteNASql)or die(mysqli_error($riddelsql));
?>