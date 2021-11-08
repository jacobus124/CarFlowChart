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
#EditIframe
{
	border-style:none;
    position:absolute;
	top:120px;
	/*min-height:797px;*/
	margin:0;
	padding:0;
	width:100%;
}
</style>
</head>
<body>
    <h3>Select a User</h3>
    <ul>
        <li>
            <select name="UserSelect" id="UserSelect" style="min-width:200px;" onChange="GetUser()">
                <option hidden>Select A User</option>
                <?php
                    $KryUserSql=sprintf("SELECT * FROM loginkar WHERE Company='$com'");
                    $KryUser=mysqli_query($riddelsql, $KryUserSql)or die(mysqli_error($riddelsql));
                    while($User=mysqli_fetch_array($KryUser))
                    {
                        echo '<option value="'.$User['Username'].'">'.$User['Username'].'</option>';
                    }
                ?>
            </select>
        </li>
    </ul>
    <iframe src="" id="EditIframe" name="EditIframe" style="z-index:1; width:98%; height:80%;">
    </iframe>
    <script>
        function GetUser()
        {
            var user = document.getElementById("UserSelect").value;
            document.getElementById("EditIframe").src = "EditUser.php?q="+user;

        }
    </script>
</body>
</html>