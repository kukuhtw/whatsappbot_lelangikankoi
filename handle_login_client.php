<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("db.php");
include("saatini.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");


/*
Ini halaman untuk cek login ke dashboard untuk manajemen data lelang

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$loginemailclient = isset($_POST['loginemailclient']) ? $_POST['loginemailclient'] : '';
$loginpasswordclient = isset($_POST['loginpasswordclient']) ? $_POST['loginpasswordclient'] : '';

$status_boleh_login=0;


if ($mode=="loginclient") {
	$loginemailclient = clear_variable_post_get($link,$loginemailclient);
	$password_sha1=sha1($loginpasswordclient);

	$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  );

  $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
  // set the PDO error mode to exception

  $stmt = $conn->prepare('SELECT COUNT(userid) AS `total` FROM `msuser` WHERE `emailuser` = ? AND `password` = ?');
	$stmt->bindParam(1, $loginemailclient);
	$stmt->bindParam(2, $password_sha1);
	$stmt->execute();

	
$total = 0;
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $total = $row['total'];
}


	$userid=0;
    if ($total==1) {
		$status_boleh_login=1;
		$field="userid";
		$userid = check_value_tbl_msuser_based_email($field,$loginemailclient,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
	 } 
	else {
		$status_boleh_login=0;

	}
	
	if ($status_boleh_login==1) {
	$_SESSION['sessionloginemailclient'] = $loginemailclient;
	$_SESSION['sessionloginuserid'] = $userid;
	$sql = " update `msuser` set `lastlogin`='$saatini' where emailuser='$loginemailclient' ";
	//echo "<br>sql = ".$sql;
	//echo "<br>_SESSION sessionloginemailclient = ".$_SESSION['sessionloginemailclient'];
	$query = mysqli_query($link,$sql)or die ('gagal update data'.mysqli_error($link));
	mysqli_close($link); 	
	?>
    <meta http-equiv="refresh"  content="0; url=entry_product.php">
	<?php
	exit;
	}
	else {
	?>
	<meta http-equiv="refresh"  content="0; url=index.php">
	<?php
	echo "<br>Password Salah ! atau username tidak ada !";
	mysqli_close($link); 
	}

	$query=null;


}

?>