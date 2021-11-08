<?php
    session_start();
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    require_once('GetCompany.php');
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
</style>
</head>
<body>
    <ul id="mainentry">
        <li><p>Stock Number</p>
        <input type="text" name="stocknumber" id="stocknumber" class="inputfield"/></li>
        <li><p>Car Make</p>
        <input type="text" name="carmake" id="carmake" class="inputfield"/></li>
        <li><p>Car Model</p>
        <input type="text" name="carmodel" id="carmodel" class="inputfield"/></li>
        <li><p>Year Model</p>
        <input type="text" name="yearmodel" id="yearmodel" class="inputfield"/></li>
        <li><p>Colour</p>
        <input type="text" name="colour" id="colour" class="inputfield"/></li>
    </ul>
    <div style="color:white">
    <?php
    $i=0;
        $KryCategoriesSQL=sprintf("SELECT * FROM Categories WHERE Company='$com'");
        $KryCategories=mysqli_query($riddelsql,$KryCategoriesSQL)or die(mysqli_error($riddelsql));
        $count=0;
        while($cat=mysqli_fetch_array($KryCategories))
        {
            ?>
                <div style="width:97%;background-color:#b81d15; margin:10px;">
                    <?php
                        echo '<h4 onClick="Open'.$i.'()">'.$cat['Name'].'</h4>';
                        echo '<div id="sub'.$i.'" style="display:none; height:auto">';
                        $id=$cat['ID'];
                        $KryItemsSQL=sprintf("SELECT * FROM subcategories WHERE Category='$id'");
                        $KryItems=mysqli_query($riddelsql,$KryItemsSQL) or die(mysqli_error($riddelsql));
                        $j=0;
                        
                        while($sub=mysqli_fetch_array($KryItems))
                        {
                            
                            if($j==0)
                            {
                                echo '<ul class="autolist">';
                            }
                            echo '<li><label class="container1">'.$sub['Name'].'<input type="checkbox" id="check'.$count.'" value="'.$sub['ID'].'"><span class="checkmark1"></span></label></li>';
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
                        if($j<4)
                        {
                            echo "</ul>";
                        }
                        
                    ?>
                    </div>
                    
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
    ?><input type="submit" value="Submit" onClick="submitAll()" class="SubmitAllClass"/>
    </div>
    <div id="blackout" onClick="hideError()">
        <div id="error" onClick="hideError()">
            <p id="message" style="top:30%;position:relative"></p>
        </div>
    </div>
<script>
    function submitAll()
    {
        var stock = document.getElementById("stocknumber").value;
        for(var i=0;i<=<?php echo $count?>;i++)
        {
            var checkfor = "check"+i;
            if(document.body.contains(document.getElementById(checkfor)))
            {
                if(document.getElementById(checkfor).checked)
                {
                    var SelData = document.getElementById(checkfor).value;
                    var xmlhttp1 = new XMLHttpRequest();
                    xmlhttp1.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("blackout").style.display = "block";
                            document.getElementById("message").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp1.open("GET", "AddCarEntry.php?q=<?php echo $com?>||" + SelData + "||" + stock, true);
                    xmlhttp1.send();
                }
            }  
        }
        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    document.getElementById("blackout").style.display = "block";
                    document.getElementById("message").innerHTML = this.responseText;
                }
            };
        var make=document.getElementById("carmake").value;
        var model=document.getElementById("carmodel").value;
        var year=document.getElementById("yearmodel").value;
        var color=document.getElementById("colour").value;
        xmlhttp2.open("GET", "AddCarDetails.php?q=<?php echo $com?>||" + stock + "||" + make + "||" + model + "||" + year + "||" + color, true);
        xmlhttp2.send();
    }
    function hideError()
    {
        document.getElementById("blackout").style.display = "none";
        var text = document.getElementById("message").innerHTML;
        if(text!="Category Already Exists" || text!="Item Already Exists")
        {
            location.reload();
        }
    }
    </script>
</body>
</html>