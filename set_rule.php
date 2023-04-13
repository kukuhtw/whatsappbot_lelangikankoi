<?php
include("db.php");
include("sessionclient.php");
include("saatini.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");
include("fonnte/settings.php");

/*
Ini halaman dashboard manajemen data lelang 
untuk setting informasi dan notifikasi Rule peraturan lelan

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/

cek_aktive_not_active($saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$catatan="";
$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

if ($mode=="") {
	$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
}

//echo "<br>mode = ".$mode;



//echo "<br>timestamp_jambuka = ".$timestamp_jambuka. " Jam Buka:".$jambuka;
//echo "<br>timestamp_jamtutup = ".$timestamp_jamtutup. " Jam Tutup:".$jamtutup;;
//echo "<br>timestamp_sekarang = ".$timestamp_sekarang. " saatini:".$saatini;;


$kelipatan = isset($_POST['kelipatan']) ? $_POST['kelipatan'] : '';
$startvalue = isset($_POST['startvalue']) ? $_POST['startvalue'] : '';


if ($mode=="set_rule") {

    $edit_rule = isset($_POST['edit_rule']) ? $_POST['edit_rule'] : '';
    $edit_waowner = isset($_POST['edit_waowner']) ? $_POST['edit_waowner'] : '';
$edit_rekening = isset($_POST['edit_rekening']) ? $_POST['edit_rekening'] : '';

	 $bolehproses=1;
    
    if ($bolehproses==1) {

          $sql_update = "UPDATE msbot 
        SET aturan_pemilik=?, waowner=?, rekening_pemilik=?
        WHERE botid=?";

        $stmt = mysqli_prepare($link, $sql_update);
        mysqli_stmt_bind_param($stmt, "sssi", $edit_rule, $edit_waowner, $edit_rekening, $botid);
        mysqli_stmt_execute($stmt);
      
    }

    if ($bolehproses==0) {
        $catatan .=  "<h1>Update Gagal !</h1> ";
        $catatan .="<h2>".$catatan."</h2>";

       // echo "<Br>catatan = ".$catatan;


    }  

    
 }

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



     $html = "<font color='red' size='1'><h1>".$catatan."</h1></font>"; 
     $html .="<br>";

$sql = "select * from `msbot` 
where `botid` ='$botid' ";

//echo "<br>sql = ".$sql;

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $rt=0;
            foreach($conn->query($sql) as $row) {
                $rt=$rt+1;
                  $aturan_pemilik=$row['aturan_pemilik'];
                  $rekening_pemilik=$row['rekening_pemilik'];
                  $alamat_pemilik=$row['alamat_pemilik'];
                  $waowner=$row['waowner'];

                  
                  $jambuka=$row['jambuka'];
                  $jamtutup = $row['jamtutup'];
                    $kelipatan = $row['kelipatan'];

                      $startvalue = $row['startvalue'];
					 $isactive = $row['isactive'];

 				$kelipatan=$row['kelipatan'];
                   $kelipatan_f = number_format($kelipatan);
                  $startvalue=$row['startvalue'];
                  $startvalue_f = number_format($startvalue);

                $timestamp_jambuka = strtotime($jambuka);
                $timestamp_jamtutup = strtotime($jamtutup);
                $timestamp_sekarang = strtotime($saatini);

                
     if ($isactive==1) {
         $ket_active="<font color='green'><b>Lelang dalam keadaan AKTIF</b></font>";
     }
     if ($isactive==0) {
       $ket_active="<font color='red'><b>Lelang dalam keadaan TIDAK AKTIF</b></font>";
    }
    
    
 				if ($timestamp_sekarang<=$timestamp_jambuka) {
                   $ket_jam_buka = "Lelang akan dibuka pada ".get_time_forward($timestamp_jambuka);
                }

                if ($timestamp_sekarang>=$timestamp_jambuka) {
                 $ket_jam_buka = "Lelang telah dibuka sejak ".get_time_ago($timestamp_jambuka);
                }

                if ($timestamp_sekarang<=$timestamp_jamtutup) {
                    $ket_jam_tutup = "Lelang akan ditutup pada ".get_time_forward($timestamp_jamtutup);
                }
                if ($timestamp_sekarang>=$timestamp_jamtutup) {
                    $ket_jam_tutup = "Lelang telah ditutup sejak ".get_time_ago($timestamp_jamtutup);
                }

              
                    $ket_active="";
                  if ($isactive==1) {
                    $ket_active="<font color='green'><b>Lelang dalam keadaan AKTIF</b></font>";
                  }
                   if ($isactive==0) {
                    $ket_active="<font color='red'><b>Lelang dalam keadaan TIDAK AKTIF</b></font>";
                  }
                  
                    $html ="<br>";
                     $html ="<br>Status Active : ".$ket_active;
                    $html .="<form method='POST' action='' >";

                    $html .="<br><br>";
                    $html .="<br>Rule ";
                    $html .="<br>";
                    

                      $html .="<br><textarea name='edit_rule' rows='20' cols='90'>".$aturan_pemilik."</textarea>";
                                      

                    $html .="<br><br>Rekening<br><br>";
                    $html .="<textarea name='edit_rekening' rows='10' cols='90'>".$rekening_pemilik."</textarea>";

                    $html .="<br><br>Whatsapp owner<br><br>";
                    $html .="<textarea name='edit_waowner' rows='1' cols='20'>".$waowner."</textarea>";
                    
                          $html .="<input type='hidden' name='mode' value='set_rule'>";

                         $html .="<br><br><input type='submit' class='btn btn-space btn-primary' name='' value='Update Rule dan Rekening'>";
                    
                    $html .= "<br></form>";
				}

echo $html;

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
