<?php
    session_start();
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    require_once('GetCompany.php');
    if($per[0]=="Admin")
    {
?>
<!DOCTYPE html>
<html>
<head>
<link href="amadevcss.css?0.12" rel="stylesheet" type="text/css"/>
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
    h3
    {
        cursor: default;
        font-size:22px;
        font-weight:1;
        padding:10px;
        margin:0;
    }
    h4:hover{
        text-decoration:underline
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

.container2 {
  /* display: block;*/
   position: absolute;
   left:95%;
   cursor: pointer;
   -webkit-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
 }
 
 /* Hide the browser's default checkbox */
 .container2 input {
   position: absolute;
   opacity: 0;
   cursor: pointer;
   height: 0;
   width: 0;
 }
 
 /* Create a custom checkbox */
 .checkmark2 {
   position: absolute;
   /*top: -23px;*/
   left: 0px;
   height: 25px;
   width: 25px;
   border-radius:20px;
   background-color: #eee;
 }
 
 /* On mouse-over, add a grey background color */
 .container2:hover input ~ .checkmark2 {
   background-color: #ccc;
 }
 
 /* When the checkbox is checked, add a blue background */
 .container2 input:checked ~ .checkmark2 {
   background-color: #8bd05a;
 }
 
 /* Create the checkmark/indicator (hidden when not checked) */
 .checkmark2:after {
   content: "";
   position: absolute;
   display: none;
 }
 
 /* Show the checkmark when checked */
 .container2 input:checked ~ .checkmark2:after {
   display: block;
 }
 
 /* Style the checkmark/indicator */
 .container2 .checkmark2:after {
   left: 9px;
   top: 5px;
   width: 5px;
   height: 10px;
   border: solid white;
   border-width: 0 3px 3px 0;
   -webkit-transform: rotate(45deg);
   -ms-transform: rotate(45deg);
   transform: rotate(45deg);
 }
#check1{
    left:95%;
    position:absolute;
}
</style>
</head>
<body>
    <ul id="mainentry">
        <li><p>Username</p>
        <input type="text" name="Username" id="Username" class="inputfield"/></li>
        <li><p>Password</p>
        <input type="text" name="Password" id="Password" class="inputfield"/></li>
    </ul>
    <h3>Permissons</h3>
    <div style="color:white">
    <label class="container1" style="margin:0 0 20px 10px !important;">Admin<input type="checkbox" id="AdminCheck"><span class="checkmark1"></span></label>
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
                        echo '<h4><span onClick="Open'.$i.'()">'.$cat['Name'].'</span>
                        <label class="container2"><input type="checkbox"  onChange="checkall(this,'."'".''.$cat['Name'].''."'".')"><span class="checkmark2"></span></label>
                        </h4>';
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
                            echo '<li><label class="container1">'.$sub['Name'].'<input type="checkbox" id="check'.$count.'" value="'.$sub['ID'].'" class="'.$cat['Name'].'"><span class="checkmark1"></span></label></li>';
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
        var Username = document.getElementById("Username").value;
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
                    xmlhttp1.open("GET", "AddPermissionsSQL.php?q=<?php echo $com?>||" + SelData + "||" + Username, true);
                    
                    xmlhttp1.send();
                }
            }  
        }
        var Nuwe="";
        if(document.getElementById("AdminCheck").checked)
        {
            Nuwe="Admin";
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
        var Password=document.getElementById("Password").value;
        xmlhttp2.open("GET", "AddLoginDetails.php?q=<?php echo $com?>||" + Username + "||" + Password +"||"+Nuwe, true);
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
    function checkall(source,name)
    {
        checkboxes = document.getElementsByClassName(name);
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
  }
    }
    </script>
</body>
</html>
<?php }?>