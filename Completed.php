<?php
    session_start();
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    require_once('GetCompany.php');
    $user=$_SESSION['MM_Username'];
    $kryAdminSQL=sprintf("SELECT * FROM loginkar WHERE Username='$user' AND Company='$com'");
    $kryAdmin=mysqli_query($riddelsql,$kryAdminSQL)or die(mysqli_error($riddelsql));
    while($admin=mysqli_fetch_array($kryAdmin))
    {
        $waar=$admin['Permission'];
    }
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="CarAjax.js?0.03"></script>
<script>
function IndiSelect(ID)
{
    window.parent.history.pushState({},"Dashboard.php" , "#CarDetails");
    window.parent.document.getElementById("mainiframe").src = "IndiCar.php?q="+ID;
}
</script>
<link href="amadevcss.css?0.11" rel="stylesheet" type="text/css"/>
<style>
body{
    font-family:sans-serif;
    
}
    ul
    {
        list-style:none;
    }
    li
    {
        margin:5px;
    }
    h3
    {
        margin:0px;
        cursor: pointer;
    }
    h4
    {
        cursor: pointer;
        font-size:20px;
        font-weight:1;
        border-bottom:solid black 1px;
        padding:10px;
        margin:0;
    }
    h4:hover{
        color:rgb(21, 32, 43);
    }
    #mainentry
	{
        margin:5px;
        top:0px;
        position:relative;
		display: flex;
  		justify-content: left;
  		flex-wrap: wrap;
  		padding: 20px 0 0 0;
		color:white;
	}
.mynav ul 
	{
  		display: flex;
  		top:0;
  		right:0px;
  		justify-content: center;
  		flex-wrap: wrap;
  		list-style-type: none;
  		padding: 0;
        margin:5px;
	}
.autolist li
{
    margin:0 0 15px 20px;
}
.autolist 
	{
		margin:0;
  		display: flex;
  		top:0;
  		flex-wrap: wrap;
  		list-style-type: none;
  		padding: 0;
	}
#mainentry p
{
    font-weight:0;
    font-size:20px;
}
#mainentry p{
    margin:0 5px 0 0;
}
.autolist label
{
    font-size:18px;
    font-weight:1;
}
.SubmitAllClass
{
    margin:10px;
}
a
{
	text-decoration:none;	
	color:white;
}
a:visited
{
	color:white;
}
a:hover
{
	color:white;
}

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(86, 169, 206); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(86, 169, 206); 
}
table {
  text-align: left;
  position: relative;
  border-collapse: collapse; 
  width:100%;
}
th, td {
  padding: 0.25rem;
  border:solid 1px white;
  height:30px;
}
tr.red th {

}
tbody tr
{
    cursor:pointer;
}
th {
  position: sticky;
  top: 0; 
  font-weight:lighter;
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
</style>
</head>
<body>
<table>
    <thead>
        <tr class="red">
            <th>#</th>
            <th>Stock #</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year Model</th>
            <th>Colour</th>
            <?php
                $krycatSQL=sprintf("SELECT * FROM categories WHERE Company='$com'");
                $krycat=mysqli_query($riddelsql,$krycatSQL)or die(mysqli_error($riddelsql));
                while($cats=mysqli_fetch_array($krycat))
                {
                    echo '<th>'.$cats['Name'].'</th>';
                }
            
            ?>
            
        </tr>
    </thead>
    <tbody>
<?php
$i=0;
    $krykarreSQL=sprintf("SELECT * FROM cars WHERE Company='$com'");
    $krykarre=mysqli_query($riddelsql,$krykarreSQL)or die(mysqli_error($riddelsql));
    while($kar=mysqli_fetch_array($krykarre))
    {
        $stock=$kar['StockNom'];
        $ToetsVirViableSQL=sprintf("SELECT * FROM entries WHERE StockNom='$stock' AND Company='$com' AND (Status='Pending' OR Status='Priority' OR Status='Busy')");
        $ToetsVirViable=mysqli_query($riddelsql,$ToetsVirViableSQL)or die(mysqli_error($riddelsql));
        $Viable=mysqli_num_rows($ToetsVirViable);
        if($Viable==0)
        {
            $i++;
            $laaste=0;
            echo '<tr onClick="IndiCar('.$kar['ID'].')" id="tr'.$kar['ID'].'"><td>'.$i.'<td>'.$kar['StockNom'].'</td>';
            echo '<td>'.$kar['Make'].'</td>';
            echo '<td>'.$kar['Model'].'</td>';
            echo '<td>'.$kar['Year'].'</td>';
            echo '<td>'.$kar['Color'].'</td>';
            $krycatSQL=sprintf("SELECT * FROM categories WHERE Company='$com'");
            $krycat=mysqli_query($riddelsql,$krycatSQL)or die(mysqli_error($riddelsql));
            $wys=0;
            while($cats=mysqli_fetch_array($krycat))
            {
                $category=$cats['ID'];
                $pen=0;
                $done=0;
                $busy=0;
                $prio=0;
                $color="";
                $krysubSQL=sprintf("SELECT * FROM subcategories WHERE Category='$category'");
                $krysub=mysqli_query($riddelsql,$krysubSQL)or die(mysqli_error($riddelsql));
                if($waar=="Admin")
                {
                    $toets=1;
                }
                else{
                    $toets=0;
                }
                while($sub=mysqli_fetch_array($krysub))
                {
                    $subid=$sub['ID'];
                    $kryEntriesSQL=sprintf("SELECT * FROM entries WHERE NameID='$subid' AND StockNom='$stock' AND Company='$com'");
                    $kryEntries=mysqli_query($riddelsql,$kryEntriesSQL)or die(mysqli_error($riddelsql));
                    while($entries=mysqli_fetch_array($kryEntries))
                    {
                        $item=$entries['NameID'];
                        $kryPermissionSQL=sprintf("SELECT * FROM permissions WHERE Company='$com' AND Username='$user' AND Items='$item'");
                        $kryPermission=mysqli_query($riddelsql,$kryPermissionSQL)or die(mysqli_error($riddelsql));
                        $Permission=mysqli_num_rows($kryPermission);
                        if($Permission>0 && $entries['Status']!="Done")
                        {
                            $toets++;
                        }
                        //echo $com.' '.$user.' '.$item.' '.$Permission.'</br>';
                        switch($entries['Status'])
                        {
                            case "Pending":
                                $pen++;
                                break;
                            case "Done":
                                $done++;
                                break;
                            case "Busy":
                                $busy++;
                                break;
                            case "Priority":
                                $prio++;
                                break;
                        }
                    }
                }
                if($busy>0)
                {
                    $status="Busy";$color="#3683c2";
                    $wys++;
                }
                elseif($prio>0)
                {
                    $status="Priority";$color="#c23636";
                    $wys++;
                }
                elseif($pen>0)
                {
                    $status="Pending";$color="#424242";
                    $wys++;
                }
                elseif($done>0)
                {
                    $status="Done";$color="#36c257";
                }
                else{
                    $status="N/A";$color="#36c257";
                }
                if($toets>0 && ($status!="Done" || $status!="N/A"))
                {
                    $laaste++;
                }
                echo '<td style="background-color:'.$color.'">'.$status.'</td>';
            }
            echo '</tr>';
        }
    }
?>
</tbody>
</table>

</body>
</html>