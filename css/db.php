<?php
//ini setting untuk dilocalhost , development

$mySQLserver = "localhost";
$mySQLuser = "phpmyadmin";
$mySQLpassword = "M6rufuf%$^93mf90Ff823tg";
$mySQLdefaultdb = "pharmamed";
//$host = "139.59.234.51/";
$host = "pharmamed.online/";
$folderweb="";
$webhook = $host."webhook/";


$link = mysqli_connect($mySQLserver, $mySQLuser, $mySQLpassword,$mySQLdefaultdb) or die ("Could not connect to MySQL");



?>
