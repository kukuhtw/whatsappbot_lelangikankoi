<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
Ini halaman login ke dashboard untuk manajemen data lelang

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/
?>

<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
$cookies_visitor = isset($_COOKIE['cookies_visitor']) ? $_COOKIE['cookies_visitor'] : '';
//echo"<br>cookies_visitor=".$cookies_visitor;

if(!isset($_COOKIE["cookies_visitor"])){
  $durationcookies = 3600 * 24 * 30 * 12 * 10 ;  // 10 tahun
  $cookies_visitor1=rand(11111,999999999);
  $cookies_visitor2=rand(11111,999999999);
  $cookies_visitor = $cookies_visitor1."-".$cookies_visitor2;
  setcookie("cookies_visitor", $cookies_visitor, time()+$durationcookies);
  //echo"<br>Set cookies_visitor baru = ".$cookies_visitor;
}

//echo"<br>Now cookies_visitor=".$cookies_visitor;
?>
<html lang="en">
 <?php include("head_register.php") ?>
  <body class="bg-dark">
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Login client</div>
        <div class="card-body">
          <?php 
          include("handle_login_client.php") ;
          include("form_login_client.php") ;
          ?>
       
          <div class="text-center">
           </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>

</html>
