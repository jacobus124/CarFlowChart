<?php
    session_start();
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('GetCompany.php');
    require_once('logincheck.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<link href="amadevcss.css?0.08" rel="stylesheet" type="text/css"/>
</head>
<title></title>
<script>
    var counter=1;
</script>
<body>
<h1><?php echo $comnaam?> Site Manager</h1>
    <ul style="list-style:none">
    <li>Category</li>
    <li><input type="text" name="Category" id="Category" class="dertig"/></li>
    <li></li>
    </ul>
    <ul style="list-style:none" id="SubCatLi">
    <li>Item</li>
    <li><input type="text" id="input0" name="input0" class="dertig"/></li>
    <li>
        <select id="sel0" name="CategorySelect">
            <?php
                $krycategoriessql=sprintf("SELECT * FROM Categories WHERE Company='$com'");
                $krycategories=mysqli_query($riddelsql,$krycategoriessql) or die(mysqli_error($riddelsql));
                while($categories=mysqli_fetch_array($krycategories))
                {
                    echo '<option value="'.$categories['ID'].'">'.$categories['Name'].'</option>';
                }
            ?>
        </select>
    </li>
    </ul>
    <img src="plus.png" style="height:25px;width:25px;cursor:pointer;margin:0 0 0 38px;" onClick="addInput()"/></br>
    <input type="submit" value="Submit" onClick="SubmitAll()"/>
    <div id="blackout" onClick="hideError()">
        <div id="error" onClick="hideError()">
            <p id="message" style="top:30%;position:relative"></p>
        </div>
    </div>
</body>
<script>
    function SubmitAll()
    {
        var Category = document.getElementById("Category").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById("blackout").style.display = "block";
                document.getElementById("message").innerHTML = xmlhttp.responseText;
            }
            
        };
        xmlhttp.open("GET", "AddCatSQL.php?q=<?php echo $com?>||" + Category, true);
        xmlhttp.send();
        for(var i=0;i<=counter;i++)
        {
            var infor = "input"+i;
            var selfor = "sel"+i;
            if(document.body.contains(document.getElementById(infor)) && document.getElementById(infor).value!=null && document.getElementById(infor).value!="")
            {
                var InputData = document.getElementById(infor).value;
                if(document.body.contains(document.getElementById(selfor)) && document.getElementById(selfor).value!=null && document.getElementById(selfor).value!="")
                {
                    var SelData = document.getElementById(selfor).value;
                    var xmlhttp1 = new XMLHttpRequest();
                    xmlhttp1.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("blackout").style.display = "block";
                            document.getElementById("message").innerHTML = this.responseText;
                        }
                        
                    };
                    xmlhttp1.open("GET", "AddSubSQL.php?q=<?php echo $com?>||" + SelData + "||" + InputData, true);
                    xmlhttp1.send();
                }
            }
        }
    }
    function addInput()
    {
        var Ul = document.getElementById("SubCatLi");
        var li1 = document.createElement("li");
        li1.id = "lia";
        Ul.appendChild(li1);
        var ItemText = document.createElement("p");
        ItemText.id = "p";
        li1.appendChild(ItemText);
        ItemText.innerHTML="Item";
        var li2 = document.createElement("li");
        li2.id = "lib";
        Ul.appendChild(li2);
        var input = document.createElement("input");
        input.id = "input"+counter;
        li2.appendChild(input);
        var li3 = document.createElement("li");
        li3.id = "lic"+counter;
        Ul.appendChild(li3);
        var select1 = document.createElement("select");
        select1.id = "sel"+counter;
        li3.appendChild(select1);
        <?php
                $krycategoriessql=sprintf("SELECT * FROM Categories WHERE Company='$com'");
                $krycategories=mysqli_query($riddelsql,$krycategoriessql) or die(mysqli_error($riddelsql));
                while($categories=mysqli_fetch_array($krycategories))
                {
                    echo '
                            var opt=document.createElement("option");
                            opt.appendChild(document.createTextNode("'.$categories['Name'].'"));
                            opt.value="'.$categories['ID'].'";
                            select1.appendChild(opt);
                         ';
                }
            ?>
        var css = 'input:hover{ border-color: #b81d15;box-shadow: 0 0 8px 0 #b81d15;} input{width: 30%;border: 2px solid #aaa;	border-radius: 3px;	margin: 8px 0;	outline: none;	padding: 10px;	box-sizing: border-box;	transition: 0.3s;}';
        var style = document.createElement('style');
        if (style.styleSheet) 
        {
            style.styleSheet.cssText = css;
        } 
        else 
        {
            style.appendChild(document.createTextNode(css));
        }
        document.getElementsByTagName('head')[0].appendChild(style);
        counter++;
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
</html>