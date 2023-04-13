<?php
include("db.php");
include("sessionclient.php");
include("saatini.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");
include("fonnte/settings.php");

//echo "<h1>SET SChedule</h1>";
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


$jambuka = isset($_POST['jambuka']) ? $_POST['jambuka'] : '';
$jamtutup = isset($_POST['jamtutup']) ? $_POST['jamtutup'] : '';

//echo "<h2>check jambuka = ".$jambuka."</h2>";
//echo "<h2>check jamtutup = ".$jamtutup."</h2>";


//2021-10-24 05:15:00 am
$check_am_pm_jambuka = substr($jambuka,20,2);
$check_am_pm_jamtutup = substr($jamtutup,20,2);

//echo "<br>check_am_pm_jambuka = ".$check_am_pm_jambuka;
//echo "<br>check_am_pm_jamtutup = ".$check_am_pm_jamtutup;

if ($check_am_pm_jambuka=="pm") {
    $check_jam_buka = substr($jambuka,11,2);

     if ($check_jam_buka==12) {
        $check_jam_buka=0;
        echo "<br>cbila jam buka = 12 maka check_jam_buka = ".$check_jam_buka;
    }

    $check_tahun_bulan_tanggal_jam_buka = substr($jambuka,0,10);
    $check_menit_detik_jambuka = substr($jambuka,14,5);
    //echo "<br>check_jam_buka = ".$check_jam_buka;
    //echo "<br>check_tahun_bulan_tanggal_jam_buka = ".$check_tahun_bulan_tanggal_jam_buka;
      $check_menit_detik_jambuka = substr($jambuka,14,5);
   //echo "<br>check_menit_detik_jambuka = ".$check_menit_detik_jambuka;
    $koreksi_jam_buka = intval($check_jam_buka) + 12;
    //echo "<br>koreksi_jam_buka = ".$koreksi_jam_buka;
    $jambuka_baru = $check_tahun_bulan_tanggal_jam_buka. " ".$koreksi_jam_buka.":". $check_menit_detik_jambuka;
    //echo "<br>jambuka_baru = ".$jambuka_baru;
    $jambuka = $jambuka_baru;
}


if ($check_am_pm_jamtutup=="pm") {
    $check_jam_tutup = substr($jamtutup,11,2);
  //  echo "<br>check_jam_tutup = ".$check_jam_tutup;

    if ($check_jam_tutup==12) {
        $check_jam_tutup=0;
       // echo "<br>cbila jam tutup = 12 maka check_jam_tutup = ".$check_jam_tutup;

    }

    $check_tahun_bulan_tanggal_jam_tutup = substr($jamtutup,0,10);
    //echo "<br>check_tahun_bulan_tanggal_jam_tutup = ".$check_tahun_bulan_tanggal_jam_tutup;

    $check_menit_detik_jamtutup = substr($jamtutup,14,5);
    //echo "<br>check_menit_detik_jamtutup = ".$check_menit_detik_jamtutup;

    $koreksi_jam_tutup = intval($check_jam_tutup) + 12;
    //echo "<br>koreksi_jam_tutup = ".$koreksi_jam_tutup;

    $jamututup_baru = $check_tahun_bulan_tanggal_jam_tutup. " ".$koreksi_jam_tutup.":". $check_menit_detik_jamtutup;
   // echo "<br>jamututup_baru = ".$jamututup_baru;

    $jamtutup = $jamututup_baru;
     // echo "<br>jamtutup = ".$jamtutup;

}

$timestamp_jambuka = strtotime($jambuka);
$timestamp_jamtutup = strtotime($jamtutup);
$timestamp_sekarang = strtotime($saatini);


//echo "<br>timestamp_jambuka = ".$timestamp_jambuka. " Jam Buka:".$jambuka;
//echo "<br>timestamp_jamtutup = ".$timestamp_jamtutup. " Jam Tutup:".$jamtutup;;
//echo "<br>timestamp_sekarang = ".$timestamp_sekarang. " saatini:".$saatini;;


$kelipatan = isset($_POST['kelipatan']) ? $_POST['kelipatan'] : '';
$startvalue = isset($_POST['startvalue']) ? $_POST['startvalue'] : '';


if ($mode=="set_schedule") {

	 $bolehproses=1;
    $isactive = 0;
    if ($timestamp_sekarang > $timestamp_jambuka 
        && 
        $timestamp_sekarang < $timestamp_jamtutup) {
        $isactive = 1;
    }

    if ($timestamp_jambuka>$timestamp_jamtutup) {
        $bolehproses=0;
        $catatan .= "Jam Buka lelang harus sebelum jam tutup lelang";
    }
    
    if ($bolehproses==1) {

        $sql_update = "
        update `msbot` 
        set `jambuka`='$jambuka' ,
        `jamtutup`='$jamtutup' ,
        `startvalue`='$startvalue' ,
        `kelipatan`='$kelipatan' ,
        `isactive`='$isactive'
        
        where `botid`='$botid'
        ";

         //echo "<Br>sql_update = ".$sql_update;
         $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));
      
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


$sql = "SELECT DATE_ADD('".$saatini."', INTERVAL 7 DAY) as `tujuhari`;  ";
//echo "<br>sqltujuhhari =".$sqltujuhhari;
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            foreach($conn->query($sql) as $row) {
                  $tujuhari=$row['tujuhari'];
            }
            $conn=null;

$sql = "SELECT DATE_ADD('".$saatini."', INTERVAL 8 DAY) as `delapanhari` ;";
//echo "<br>sqltujuhhari =".$sqldelapanhari;
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            foreach($conn->query($sql) as $row) {
                  $delapanhari=$row['delapanhari'];
            }
            $conn=null;


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

                  if ($jambuka=="0000-00-00 00:00:00") {
                       $jambuka=$tujuhari; 
                  }
                    if ($jamtutup=="0000-00-00 00:00:00") {
                       $jamtutup=$delapanhari; 
                  }

                  $jambuka_tampil = ambil_format_hari_3($jambuka);
                  $jamtutup_tampil = ambil_format_hari_3($jamtutup);

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
                $html .="Jam Buka (GMT +7) : $jambuka_tampil
                <div class='input-group date form_datetime' data-date='".$tanggalhariini."T".$jamhariini."Z"."' data-date-format='yyyy-mm-dd HH:ii:ss p' data-link-field='jambuka'>
                    <input class='form-control' size='16' type='text' name='jambuka' value='$jambuka'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
          <span class='input-group-addon'><span class='glyphicon glyphicon-th'></span></span>
                </div>
        <input type='hidden' id='jambuka' value='$jambuka' />";
        
         $html .="".$ket_jam_buka."<br><br>";
          $html .="Jam Tutup  (GMT +7)  : $jamtutup_tampil
                <div class='input-group date form_datetime' data-date='".$tanggalhariini."T".$jamhariini."Z"."' data-date-format='yyyy-mm-dd HH:ii:ss p' data-link-field='jamtutup'>
                    <input class='form-control' size='16' type='text' name='jamtutup' value='$jamtutup'>
                    <span class='input-group-addon'><span class='glyphicon glyphicon-remove'></span></span>
          <span class='input-group-addon'><span class='glyphicon glyphicon-th'></span></span>
                </div>
        <input type='hidden' id='jamtutup' value='$jamtutup' />";
             $html .="".$ket_jam_tutup."<br>";   
        

                    $html .="<br>Nilai Awal Nominal Lelang : Rp ".$startvalue_f. "";
                    $html .="<br>";
                    
                    if ($startvalue<=0) {
                        $html .="<b><font color='red'>Nilai awal nominal Lelang Tidak boleh 0</b></font>";
                         $html .="<br>";

                    }

                   $boleh_update_nilai_awal_nominal=1;
                      $status_enabled_disabled_awal_nominal="";
                      $html .="<textarea ".$status_enabled_disabled_awal_nominal." name='startvalue' rows='3' cols='40'>".$startvalue."</textarea>";
                                      
                    $html .="<br><br>Kelipatan Nominal Lelang Rp ".$kelipatan_f. "";
                    $html .="<br>";

                    if ($kelipatan<=0) {
                        $html .="<b><font color='red'>Nilai Kelipatan nominal Lelang Tidak boleh 0</b></font>";
                         $html .="<br>";

                    }

 $html .="<br>";
                    $html .="<textarea name='kelipatan' rows='3' cols='40'>".$kelipatan."</textarea>";
                          $html .="<input type='hidden' name='mode' value='edit_kelipatan'>";


                         $html .="<br><input type='checkbox' name='warn1' required> ";
                             $html .="Saya mengerti , bahwa dengan melakukan edit jadwal buka lelang  dan jadwal tutup lelang, data transaksi lelang sebelumnya akan terhapus, data produk lelang sebelumnya akan terhapus";

  $html .="<br><input type='checkbox' name='warn2' required> ";
                             $html .="Saya mengerti , bahwa saya sudah menyimpan data transaksi lelang sebelumnya, yang ada di menu rekap lelang dan detail lelang";                             
                            $html .="<br><input type='checkbox' name='warn3' required> ";
                             $html .="Saya mengerti , bahwa setelah melakukan setting jam buka lelang, jam tutup lelang, nilai open bid dan kelipatan bid, selanjutnya saya akan mengisi data produk yang akan dilelang, yaitu pada menu ENTRY DATA";   

                         $html .="<input type='hidden' name='mode' value='set_schedule'>";

                         $html .="<br><br><input type='submit' class='btn btn-space btn-primary' name='' value='Update Schedule'>";
                    
                    $html .= "<br></form>";


				}

                $html .= "<h3>Perhatian, Ketika lelang akan berjalan atau sedang berjalan, melakukan update ini, akan berpengaruh kepada data produk , Ketika melakukan entry data ini, harap, melakukan isian kembali data produk di menu entry data</h3>";

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

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>




  </body>

</html>
