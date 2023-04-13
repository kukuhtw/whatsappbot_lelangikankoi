<?php
include("db.php");
include("sessionclient.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");
include("saatini.php");
include("fonnte/settings.php");



ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);


cek_aktive_not_active($saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);


$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$mode = mysqli_real_escape_string($link,$mode);



$seckey = isset($_POST['seckey']) ? $_POST['seckey'] : '';
$seckey = mysqli_real_escape_string($link,$seckey);


$confirm_rekap = isset($_POST['confirm_rekap']) ? $_POST['confirm_rekap'] : '';
$confirm_rekap = mysqli_real_escape_string($link,$confirm_rekap);

$verification_seckey_kirim = md5("rrt".$botid.$botid);

$notifikasi="";
if ($mode=="kirim") {
    $targetphone = isset($_POST['targetphone']) ? $_POST['targetphone'] : '';
    $isipesan =isset($_POST['isipesan']) ? $_POST['isipesan'] : '';
    $notifikasi .= "Pesan dikirim ke ".$targetphone. " isi pesan : ".$isipesan;
    $buttonJSON=null;
    kirimPesan_versiUpdate2022($targetphone,$isipesan,$buttonJSON,$Token_Fonnte) ;
}

$sql = "select * from `msproduct` where `botid`='$botid' and ishapus='0' ";

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $rt=0;
            $grandtotal =0;
            $print = "";
            foreach($conn->query($sql) as $row) {
                 $rt = $rt+1;
                  $pid=$row['pid'];

 				  $seckey_product = md5("s.".$pid.$pid);
                  $seckey_product=trim($seckey_product);

                  $public_link_display_key = substr($seckey_product,0,5);
                   $linkdisplay = "http://botlelang.com/botlelang/display_lelang.php?pid=".$pid."&key=".$public_link_display_key;

				  $botid=$row['botid'];

                 $field="botwa";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $botwa= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ; 

                  $productcode=$row['productcode'];
				  $productname=$row['productname'];
                  $productdesc=$row['productdesc'];
                  $currentprice=$row['currentprice'];

                  $ob = dashboard_ambil_nilai_ob_product_ini($pid,$productcode,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

                  $kelipatan = ambil_nilai_kelipatan_product_ini($pid,$productcode,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

                  $currentprice = dashboard_nilai_nominal_lelang_product_code_ini($pid,$productcode,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);


                  $currentprice_f = number_format($currentprice);
                  $currentwinner=$row['currentwinner'];
                  $currentname=$row['currentname'];
  
                  $number_char_tele = substr_count($currentwinner, '- TELE');
                  $telegramuser=0;
                  if ($number_char_tele==1) {
                        $telegramuser=1;
                  }

                  if ($telegramuser==1) {
                        $currentname=str_replace("- TELE","",$currentname);
                        $link_display = "t.me/".$currentname;
                  }
                  else {
                        $link_display = "wa.me/".$currentwinner; 
                  }

                  if ($currentname=="" && $currentwinner=="") {

                  }
                  else {
                    $grandtotal = $grandtotal + $currentprice; 
                  }
                   
                    //$grandtotal = $grandtotal + $currentprice; 
                  $jambuka=$row['jambuka'];
                  $jamtutup=$row['jamtutup'];

                  $print .="\n";

                  $print .= $rt. ". ".$productname. "\nPemenang saat ini : https://".$link_display. " (".$currentname.") \npada posisi harga Rp ".$currentprice_f;
                 

                 
   				 $timestamp_jambuka = strtotime($jambuka);
                $timestamp_jamtutup = strtotime($jamtutup);
                $timestamp_sekarang = strtotime($saatini);


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

                  if ($jamtutup=="0000-00-00 00:00:00") {
                       $jambuka=$tujuhari; 
                  }
                    if ($jamtutup=="0000-00-00 00:00:00") {
                       $jamtutup=$delapanhari; 
                  }

                  $kelipatan=$row['kelipatan'];
                   $kelipatan_f = number_format($kelipatan);
                  $startvalue=$row['startvalue'];
                  $startvalue_f = number_format($startvalue);
                  $sender="admin";
                  $jambuka_tampil = ambil_format_hari_3($jambuka);
                  $jamtutup_tampil = ambil_format_hari_3($jamtutup);
                  $regdate=$row['regdate'];

                  $regdate_tampil = ambil_format_hari_3($regdate);
                  
                  $isactive=$row['isactive'];


				$keterangan_status_lelang="";
				if ($timestamp_sekarang>=$timestamp_jamtutup) {
				    $keterangan_status_lelang = "Lelang sudah <font color='red'><b>BERAKHIR</b></font>";
				}

				if ($timestamp_sekarang>=$timestamp_jambuka) {
				    $keterangan_status_lelang = "Lelang sudah <font color='red'><b>BERAKHIR</b></font>";
				    $ket_sudah_tutup = get_time_ago($timestamp_jamtutup);
				    $keterangan_status_lelang .=" pada ".$ket_sudah_tutup;
				}

				if ($timestamp_sekarang>=$timestamp_jambuka && $timestamp_sekarang<=$timestamp_jamtutup) {
				    $keterangan_status_lelang = "Lelang masih <font color='green'><b>AKTIF</b> terbuka</font>";
				    $ket_akan_ditutup = get_time_forward($timestamp_jamtutup);
				    $keterangan_status_lelang .=" akan ditutup ".$ket_akan_ditutup;
				}

				if ($timestamp_sekarang<=$timestamp_jambuka && $timestamp_sekarang<=$timestamp_jamtutup ) {
				    $keterangan_status_lelang = "Lelang belum dibuka, akan <b>AKTIF</b> pada ";
				    $ket_akan_dibuka = get_time_forward($timestamp_jambuka);
				    $keterangan_status_lelang .=  $ket_akan_dibuka ." , Dan " ;
				    $keterangan_status_lelang .= "lelang akan ditutup ";
				    $ket_sudah_tutup = get_time_forward($timestamp_jamtutup);
				    $keterangan_status_lelang .=" pada ".$ket_sudah_tutup;
				}

			        // $print .="\n".$keterangan_status_lelang;


				   $print .="\n";


			}
$print .="\nUpdate pada ".ambil_format_hari_3($saatini);

$print .="\nGrand Total  = Rp ".number_format($grandtotal) ;
$fee = 0.05* $grandtotal;



$print_spasi_br = str_replace("\n","<br>",$print);
$print =strip_tags($print);
  $print = str_replace("\n","<br>",$print);

//echo "<br>mode = ".$mode;
//echo "<br>confirm_rekap = ".$confirm_rekap;
//echo "<br>seckey = ".$seckey;
//echo "<br>verification_seckey_kirim = ".$verification_seckey_kirim;

//echo $print;
$html="";

?>
<html lang="en">
 <?php include("head_register.php") ?>
  <body class="bg-dark">
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Entry Group</div>
        <div class="card-body">


<?php include("menu.php"); ?>

<?php echo $notifikasi ?>
<Br>
<h1>Rekap Lelang BERJALAN</h1>




	<?php echo $print_spasi_br ?>

		<?php echo $html ?>
        <?php

     
        //echo "<br><br>Rekap Bidder<br>Update : ".ambil_format_hari_3($saatini);
        $print = rekap_based_on_winner_dashboard($botid,$sender,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

      
        //list($print1,$print2) = explode("~",$print);

           $print = str_replace("\n","<br>",$print);
           $print = str_replace("*Rekap Total Sementara*","",$print);
          
        echo $print;
          //echo $print2;

  $sql = "SELECT DISTINCT(`currentwinner`), sum(`currentprice`) as `total`, `currentname` FROM `msproduct` WHERE `currentwinner` <>''  
        and `botid`='".$botid."' group by `currentwinner` ORDER BY `total` DESC
        ";

         $options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $no=0;
            $grandtotal=0;
            $saatini_d = ambil_format_hari_2($saatini,$link);
            $print="*Rekap Total Sementara*";
             $print2="";
            foreach($conn->query($sql) as $row) {
                $no=$no+1;
                $currentwinner=$row['currentwinner'];
                $currentname=$row['currentname'];
                $link_wa_winner = "<a href='https://wa.me/".$currentwinner."'>https://wa.me/".$currentwinner."</a>";
                 $currentname=$row['currentname'];
                $total=$row['total'];
                $total_f=number_format($total);
                $print .="<br>". $no. ". ". $currentname. " Rp ".$total_f;
                         $grandtotal=$grandtotal + $total;

                $print2 = detail_product_win($botid,$sender,$currentwinner,$currentname,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
              
             
             // echo "<br><br>currentwinner = ".$currentwinner;
             // echo "<br>print2 = ".$print2;
              
        $field="waowner";
        $table="msbot";
        $id1="botid";
        $value1=$botid;
        $waowner= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;    

          $field="rekening_pemilik";
      $table="msbot";
       $id1="botid";
       $value1=$botid;
       $sender="";
        $rekening_pemilik= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ; 

        $print2 .="<br>Hubungi owner di ".$waowner;
        $print2 .="<br>Rekening Pemilik di ".$rekening_pemilik;

        $print2 = str_replace("<br>","\r\n",$print2);

              ?>
              <form method="POST">
                  <textarea name="isipesan" rows='5' cols='100'><?php echo $print2 ?></textarea>
                  <br><input type="hidden" name="targetphone" value="<?php echo $currentwinner ?>">
                  <input type="hidden" name="mode" value="kirim">
                  <Br>
                  <input type="submit" name="" value=Kirim>
              </form>
              <?php
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





<?php


?>