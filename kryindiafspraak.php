<?php require_once('Connections/riddelsql.php');
      require_once('GetSql.php');
    $id = $_GET['q'];
    //$nuwe[];
    $soekdata="SELECT * FROM appointment WHERE ID='$id'";
    $klaarsql=mysqli_query($riddelsql,$soekdata)or die(mysqli_error($riddelsql));
    $i=0;
    while($gebruik=mysqli_fetch_array($klaarsql))
    {
        $nuwe[$i]=json_encode($gebruik);
        $i++;
    }
    for($k=0;$k<$i;$k++)
    {
        echo "<pre>";
        print($nuwe[$k]);
        echo "</pre>";
    }
    
    
    /*
    $toets=array("name");
    while($gebruik=mysql_fetch_array($klaarsql))
    {
        array_push($toets,$gebruik);
    }
     $nuwe = json_encode($toets, JSON_PRETTY_PRINT);
    echo "<pre>";
        print($nuwe);
    echo "</pre>";*/
    
?>