<?php
include("db.php");
include("sessionclient.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");
include("saatini.php");
include("fonnte/settings.php");


/*
Ini halaman dashboard manajemen data lelang 
untuk rekap detail produk

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/

cek_aktive_not_active($saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$mode = mysqli_real_escape_string($link,$mode);


$seckey = isset($_POST['seckey']) ? $_POST['seckey'] : '';
$seckey = mysqli_real_escape_string($link,$seckey);


$confirm_rekap = isset($_POST['confirm_rekap']) ? $_POST['confirm_rekap'] : '';
$confirm_rekap = mysqli_real_escape_string($link,$confirm_rekap);

$verification_seckey_kirim = md5("rrt".$botid.$botid);

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
                   $linkdisplay = $DOMAIN_URL_IMAGES."display_lelang.php?pid=".$pid."&key=".$public_link_display_key;

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
                  $currentprice_f = number_format($currentprice);
                  $currentwinner=$row['currentwinner'];
                  $currentname=$row['currentname'];
  
                  $number_char_tele = substr_count($currentwinner, '- TELE');
                  $telegramuser=0;
                  if ($number_char_tele==1) {
                        $telegramuser=1;
                  }

                $link_display = "wa.me/".$currentwinner; 
            
                  $grandtotal = $grandtotal + $currentprice;
                 
                  $jambuka=$row['jambuka'];
                  $jamtutup=$row['jamtutup'];

                  $print .="\n";

                  $print .= $rt. ". ".$productname. "";
                 

                 
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


                $detail1 = detail_transaksi_perproductcode_dashboard($botid,$pid,$productcode,$kelipatan,$startvalue,$Token_Fonnte, $saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

                $print .="\n".$detail1;


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

				// $print .="\nJam Buka : ".$jambuka_tampil;
				// $print .="\nJam Tutup : ".$jamtutup_tampil;
				// $print .="\nKeterangan : ".$keterangan_status_lelang;
				//  $print .="\nDetail produk : ".$linkdisplay;
				// $print .="\nCara Ikut BID : Klik https://wa.me/".$botwa."?text=BID%20"
				//  .$productcode;
               // $print .="\n".$keterangan_status_lelang;
				   $print .="\n";


			}
$print .="\nUpdate pada ".ambil_format_hari_3($saatini);

$print .="\nGrand Total  = Rp ".number_format($grandtotal) ;
$fee = 0.05* $grandtotal;


$print_spasi_br = str_replace("\n","<br>",$print);
$print =strip_tags($print);


//echo "<br>mode = ".$mode;
//echo "<br>confirm_rekap = ".$confirm_rekap;
//echo "<br>seckey = ".$seckey;
//echo "<br>verification_seckey_kirim = ".$verification_seckey_kirim;

if ($mode=="kirimrekap"  && $confirm_rekap=="REKAP" && $seckey == $verification_seckey_kirim ) {

	 $phone = $waowner;
     include("fonnte/settings.php");


    $tblname="msbot";
    $fieldname="tokenfonnte";
    $fieldid="botid";
    $valueid=$botid;
    $sender="";
   $token_fonnte=checkvalue_general_table($botid,$sender,$tblname,$fieldid,$valueid,$fieldname,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);


	 $data = [
       "type" => "text",
       "pesan" => $print,
       ];
         
       kirimPesan_padafunction($phone, $data, $token_fonnte);

}
//echo $print;
$html="";
/*
                    $html ="<br><br><form method='POST' action='' >";
                    $html .="<br>Ketik REKAP <br>untuk mengirim Rekap semua produk ini
                    <br><input type='text' name='confirm_rekap' size='6' maxlength='6'>";

                    $html .="<br><input type='hidden' name='mode' value='kirimrekap'>";
                     $seckey_kirim = md5("rrt".$botid.$botid);
                    $html .="<input type='hidden' name='seckey' value=".$seckey_kirim.">";
                   
                    $html .="<br><br><input type='submit' class='btn btn-space btn-primary' name='' value='Kirim Rekap semua Product ini ke owner wa bot ini'>";
                    
                    $html .= "<br></form>";
                    */

?>
<html lang="en">
 <?php include("head_register.php") ?>
  <body class="bg-dark">
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Entry Group</div>
        <div class="card-body">


<?php include("menu.php"); ?>


<h1>Rekap Lelang BERJALAN</h1>


	<?php echo $print_spasi_br ?>

		<?php echo $html ?>

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