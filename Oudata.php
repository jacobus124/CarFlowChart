<?php
    session_start();
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    $kryOuDataSQL=sprintf("SELECT * FROM karre");
    $kryOuData=mysqli_query($riddelsql,$kryOuDataSQL)or die(mysqli_error($riddelsql));
    while($OuData=mysqli_fetch_array($kryOuData))
    {
        $stock=$OuData['stocknom'];
        $model=$OuData['model'];
        $year=$OuData['yearmodel'];
        $color=$OuData['color'];
        $kryDataSQL=sprintf("SELECT * FROM cars WHERE StockNom='$stock'");
        $kryData=mysqli_query($riddelsql,$kryDataSQL)or die(mysqli_error($riddelsql));
        $nom=mysqli_num_rows($kryData);
        if($nom==0)
        {
            $leesInDataSQL=sprintf("INSERT INTO cars(StockNom,Model,Year,Color,Company) VALUES ('$stock','$model','$year','$color','1')");
            $leesInData=mysqli_query($riddelsql,$leesInDataSQL)or die(mysqli_error($riddelsql));
        }
    }
    /*$kryOuDataSQL=sprintf("SELECT * FROM cars");
    $kryOuData=mysqli_query($riddelsql,$kryOuDataSQL)or die(mysqli_error($riddelsql));
    while($OuData=mysqli_fetch_array($kryOuData))
    {
        $stock=$OuData['StockNom'];
        $model=$OuData['Model'];
        $array=explode(" ",$model);
        $nuwemodel="";
        if(isset($array[1]))
        {
            $nuwemodel=$nuwemodel ." ".$array[1];
            if(isset($array[2]))
            {
                $nuwemodel=$nuwemodel ." ".$array[2];
                if(isset($array[3]))
                {
                    $nuwemodel=$nuwemodel ." ".$array[3];
                    if(isset($array[4]))
                    {
                        $nuwemodel=$nuwemodel ." ".$array[4];
                        if(isset($array[5]))
                        {
                            $nuwemodel=$nuwemodel ." ".$array[5];
                            if(isset($array[6]))
                        {
                            $nuwemodel=$nuwemodel ." ".$array[6];
                            if(isset($array[7]))
                        {
                            $nuwemodel=$nuwemodel ." ".$array[7];
                        }
                        }
                        }
                    }
                }
            }
            
        }
        if($array[0]=="LAND ROVER")
        {//$array[0]
            $naam=strtoupper($array[0]);
            //$naam="MERCEDES-BENZ";
            $kryDataSQL=sprintf("UPDATE cars SET Make='$naam',Model='$nuwemodel' WHERE StockNom='$stock'");
            $kryData=mysqli_query($riddelsql,$kryDataSQL)or die(mysqli_error($riddelsql));
        }
    }*/
?>