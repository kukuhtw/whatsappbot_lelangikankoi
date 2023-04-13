<?php
session_start();

$cookies_visitor = isset($_COOKIE['cookies_visitor']) ? $_COOKIE['cookies_visitor'] : '';
$sessionloginemailclient = isset($_SESSION['sessionloginemailclient']) ? $_SESSION['sessionloginemailclient'] : '';
$sessionloginuserid =  isset($_SESSION['sessionloginuserid']) ? $_SESSION['sessionloginuserid'] : '';

//echo"<br>cookies_visitor  =".$cookies_visitor;
//echo"<br>sessionloginemailclient  =".$sessionloginemailclient;
//echo"<br>sessionloginuserid  =".$sessionloginuserid;

if ($sessionloginemailclient=="") {
	//echo "kickout";
	$usirkeformlogin="logout.php";
	?>
	<meta http-equiv="refresh"  content="0; url=<?php echo $usirkeformlogin ?>">
  <?php
}


?>
     