<?php 
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    require_once('GetCompany.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Places Search Box</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
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
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
</style>
  </head>
  <body>
  <div id="allappdiv" class="detaillist">
    <table>
      <thead>
        <tr>
          <td>Username</td>
          <td>Location</td>
          <td>Time of Arrival</td>
          <td>Time of Departure</td>
          <td>Duration</td>
          </tr>
      </thead>
      <tbody>
        <?php
          $kryLocationDataSQL=sprintf("SELECT * FROM locationping WHERE Company='$com'");
          $kryLocationData=mysqli_query($riddelsql, $kryLocationDataSQL)or ddie(mysqli_error($riddelsql));
          while($locationData=mysqli_fetch_array($kryLocationData))
          {
            echo '<tr><td>'.$locationData['Username'].'</td><td>'.$locationData['Location'].'</td><td>'.$locationData['Status'].'</td><td>'.$locationData['Date'].'</td><tr>';
          }
        ?>
      </tbody>
    </table>

  </div>
    
    
    
  </body>
</html>