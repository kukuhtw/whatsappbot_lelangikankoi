<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("db.php");
include("saatini.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");


/*
Ini code untuk menentukan login dan password masuk ke dashboard,
bila sudah digunakan, HAPUS DARI SERVER ANDA
untuk setting informasi dan notifikasi Rule peraturan lelan

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$loginemailclient = "namauser@namadomain.com"; // ISI DENGAN LOGIN USER SESUAI KEINGINAN ANDA
$loginpasswordclient = "password_disini";// ISI DENGAN PASSWORD SESUAI KEINGINAN ANDA

$status_boleh_login=0;

//echo "<br>loginemailclient = ".$loginemailclient;
//echo "<br>loginpasswordclient = ".$loginpasswordclient;

$mode = "loginclient";

if ($mode=="loginclient") {
	$loginemailclient = clear_variable_post_get($link,$loginemailclient);
	$password_sha1=sha1($loginpasswordclient);


echo "<br>loginemailclient = ".$loginemailclient;
echo "<br>loginpasswordclient = ".$loginpasswordclient;

echo "<br>password_sha1 = ".$password_sha1;
exit;

}

?>