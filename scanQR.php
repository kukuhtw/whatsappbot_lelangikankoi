<?php
include("db.php");
include("sessionclient.php");
include("saatini.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");
include("fonnte/settings.php");


ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

/*
Ini halaman dashboard manajemen data lelang 
untuk scan QR Code pada bot yang akan digunakan

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/

$botid = $sessionloginuserid ;
$mode = isset($_POST['mode']) ? $_POST['mode'] : '';



?>

<html lang="en">
 <?php include("head_register.php") ?>
  <body class="bg-dark">
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Entry Group</div>
        <div class="card-body">


<?php include("menu.php"); ?>
        	<?php

$sensor_token = substr($Token_Fonnte,0,6)."XXXXXXXXXXX";

$checkDevice = getDevice($Token_Fonnte);
             //echo "<br>checkDevice : ".$checkDevice;
             $rescheckDevice = json_decode($checkDevice,true);
             $quota = $rescheckDevice["quota"];
             $expired = $rescheckDevice["expired"];

					 echo "<br>Kuota : ".$quota;
					 echo "<br>expired : ".$expired;
					 //echo "<br>checkDevice : ".$checkDevice;
               $response = displayqrcode($Token_Fonnte);
                $responsedecode = json_decode($response,true);

                $mode = isset($_POST['mode']) ? $_POST['mode'] : '';


                //$reason = strtoupper($responsedecode ["reason"]);
                $reason = isset($responsedecode["reason"]) ? $responsedecode["reason"] : '..';
                $reason = strtoupper($responsedecode["reason"]);


				$res = json_decode($response,true);
					if(isset($res['url'])){
						$qr = $res['url'];

					?>
						<br>Pastikan anda sudah mengisi Nilai Token Fonnte sudah benar pada file settings.php di folder fonnte. 
						<br>Tkn :  <?php echo $sensor_token ?>
						<br><img src="data:image/png;base64,<?= $qr ?>"></br>
						<br>
						<?php
						}

					else {
					   
					  echo "<br>tkn:".$sensor_token;
					  echo "<br>".$reason;
					  echo "<br>";
					}
?>


        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>



<script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>



  </body>

</html>
