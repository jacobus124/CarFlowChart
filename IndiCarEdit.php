<?php
    session_start();
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    require_once('GetCompany.php');
    $id=$_GET['q'];
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
        text-decoration:underline;
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
    #mainentry li
    {
        padding:10px;
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
    margin:0 5px 0 0;
    padding:5px;
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
</style>
</head>
<body>
<?php
    $stock="";
    $kryStockNomSQL=sprintf("SELECT * FROM cars WHERE ID='$id'");
    $kryStockNom=mysqli_query($riddelsql, $kryStockNomSQL)or die(mysqli_error($riddelsql));
    while($StockInfo=mysqli_fetch_array($kryStockNom))
    {
        $stock=$StockInfo['StockNom']
        ?>
        <ul id="mainentry">
            <li>Stock #<p><?php echo $StockInfo['StockNom']?></p></li>
            <li>Make<p><?php echo $StockInfo['Make']?></p></li>
            <li>Model<p><?php echo $StockInfo['Model']?></p></li>
            <li>Year Model<p><?php echo $StockInfo['Year']?></p></li>
            <li>Colour<p><?php echo $StockInfo['Color']?></p></li>            
        </ul>
    <?php
    }
    ?>
    <div style="color:white">
    <?php
    $i=0;
        $KryCategoriesSQL=sprintf("SELECT * FROM Categories WHERE Company='$com'");
        $KryCategories=mysqli_query($riddelsql,$KryCategoriesSQL)or die(mysqli_error($riddelsql));
        $count=0;
        $div=0;
        while($cat=mysqli_fetch_array($KryCategories))
        {
            $aantal=0;
            ?>
                <div id="div<?php echo $div?>" style="width:98%;background-color:#b81d15;margin:10px;">
                    <?php
                        echo '<h4 onClick="Open'.$i.'()">'.$cat['Name'].'</h4>';
                        echo '<div id="sub'.$i.'" style=" height:auto; display:none">';
                        $Catid=$cat['ID'];
                        $KryItemsSQL=sprintf("SELECT * FROM subcategories WHERE Category='$Catid'");
                        $KryItems=mysqli_query($riddelsql,$KryItemsSQL) or die(mysqli_error($riddelsql));
                        $j=0;
                        if($waar=="Admin")
                        {
                            $toets=1;
                        }
                        else{
                            $toets=0;
                        }
                        while($sub=mysqli_fetch_array($KryItems))
                        {
                            
                            if($j==0)
                            {
                                echo '<ul class="autolist"';
                            }
                            $NameID=$sub['ID'];
                            echo '<li><label class="container1"><p>'.$sub['Name'].'</p>';
                            $aantal++;
                            $selectcolor="";
                            $Status="N/A";
                            $CarID="";
                            $GetItemStatusSQL=sprintf("SELECT * FROM entries WHERE NameID='$NameID' AND StockNom='$stock' AND Company='$com'");
                            $GetItemStatus=mysqli_query($riddelsql,$GetItemStatusSQL)or die(mysqli_error($riddelsql));
                            while($GetStatus=mysqli_fetch_array($GetItemStatus))
                            {
                                if(strlen($GetStatus['Status'])>0)
                                    $Status=$GetStatus['Status'];
                                    $CarID=$GetStatus['ID'];
                                    
                            }
                                ?>
                                    <select id="select<?php echo $count?>" style="color:black">
                                        <option value="<?php echo $Status?>" hidden><?php echo $Status?></option>
                                        <option value="Pending">Pending</option>
                                        <option value="Priority">Priority</option>
                                        <option value="Busy">Busy</option>
                                        <option value="Done">Done</option>
                                        <option value="N/A">N/A</option>
                                    </select><input id="IDWaarde<?php echo $count?>" value="<?php if(strlen($CarID)>0){echo $CarID;}else{ echo "o".$NameID;}?>" hidden/>
                                    </label>
                                    </li>
                                <?php
                                
                                if($j==7)
                                {
                                    $j=0;
                                    echo "</ul>";
                                }
                                else
                                {
                                    $j++;
                                }
                                $count++;
                                }
                        if($j<7)
                                {
                                    echo "</ul>";
                                }
                        ?>
                    </div>
                    <?php
                    if($toets>0 && $aantal>0)
                            {
                                
                                ?>
                                    <script>
                                        document.getElementById("div<?php echo $div?>").style.display="block";
                                    </script>
                                <?php
                            }
                        $div++;
                    ?>
                </div>
                <script>
                    function Open<?php echo $i?>()
                    {
                        var toets=document.getElementById("sub<?php echo $i?>").style.display;
                        if(toets=="block")
                        {
                            document.getElementById("sub<?php echo $i?>").style.display = "none";
                        }
                        else
                        {
                            document.getElementById("sub<?php echo $i?>").style.display = "block";
                        }
                        
                    }
                </script>
            <?php
            $i++;
        }
    ?>
    <input type="submit" value="Submit" onClick="submitAll()" class="SubmitAllClass"/>
    <?php
        if($waar=="Admin")
        {
            ?>
                <input type="submit" value="Delete" onClick="Delete()" class="SubmitAllClass"/>
            <?php
        }
    ?>
    </div>
    <div id="blackout" onClick="hideError()">
        <div id="error" onClick="hideError()">
            <p id="message" style="top:30%;position:relative"></p>
        </div>
    </div>
<script>
    function submitAll()
    {
        for(var i=0;i<=<?php echo $count?>;i++)
        {
            var selectfor = "select"+i;
            var IDWaarde = "IDWaarde"+i;
            if(document.body.contains(document.getElementById(selectfor)) && document.body.contains(document.getElementById(IDWaarde)))
            {
                var SelData = document.getElementById(IDWaarde).value;
                var SelectData = document.getElementById(selectfor).value;
                var xmlhttp1 = new XMLHttpRequest();
                xmlhttp1.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("blackout").style.display = "block";
                        document.getElementById("message").innerHTML = "Updated";
                    }
                };
                //alert("UpdateCarEntry.php?q=<?php echo $com?>||" + SelectData + "||" + SelData + "||<?php echo $stock?>");
                xmlhttp1.open("GET", "UpdateCarEntry.php?q=<?php echo $com?>||" + SelectData + "||" + SelData + "||<?php echo $stock?>", true);
                xmlhttp1.send();
            }  
        }
    }
    function Edit()
    {
        window.parent.document.getElementById("mainiframe").src = "IndiCarEdit.php?q=<?php echo $id?>";
    }
    function hideError()
    {
        document.getElementById("blackout").style.display = "none";
        var text = document.getElementById("message").innerHTML;
        if(text!="Category Already Exists" || text!="Item Already Exists")
        {
            window.parent.history.pushState({},"Dashboard.php" , "#CarDetails?q=<?php echo $id?>");
            window.parent.document.getElementById("mainiframe").src = "IndiCar.php?q=<?php echo $id?>";
        }
    }
    function Delete()
    {
        alert("<?php echo $stock?>");
    }
    </script>
</body>
</html>