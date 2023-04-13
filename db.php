<?php

$mySQLserver = "localhost";
$mySQLuser = "userdatabasemysql_anda";
$mySQLpassword = "password_anda";
$mySQLdefaultdb = "db_anda";
$host = "yourdomain.com/yourfolder_botlelang/";

$link = mysqli_connect($mySQLserver, $mySQLuser, $mySQLpassword,$mySQLdefaultdb) or die ("Could not connect to MySQL");

?>
