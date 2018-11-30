<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_test1011 = "127.0.0.1";
$database_test1011 = "tb_user";
$username_test1011 = "root";
$password_test1011 = "3&mXcnAO&R";
$test1011 = mysql_pconnect($hostname_test1011, $username_test1011, $password_test1011) or trigger_error(mysql_error(),E_USER_ERROR); 
?>