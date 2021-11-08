<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_riddelsql = "localhost";
$database_riddelsql = "riddel";
$username_riddelsql = "root";
$password_riddelsql = "";
$riddelsql = mysqli_connect($hostname_riddelsql, $username_riddelsql, $password_riddelsql) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>