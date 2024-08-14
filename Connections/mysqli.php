<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_mysqli = "localhost";
$database_mysqli = "aomsin_login";
$username_mysqli = "root";
$password_mysqli = "12345678";
$mysqli = mysql_pconnect($hostname_mysqli, $username_mysqli, $password_mysqli) or trigger_error(mysql_error(),E_USER_ERROR); 
?>