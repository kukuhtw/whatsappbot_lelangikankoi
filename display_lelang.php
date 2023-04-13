<?php
ini_set("error_log", "errr_display_lelang.txt");
include("db.php");
include("fonnte/function_fonnte_lelang.php");
include("fonnte/settings.php");

include("saatini.php");


/*
Ini halaman info pada website, produk dan harga tertinggi
pada saat lelang sedang berlangsung

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
$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
$pid = mysqli_real_escape_string($link,$pid);

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id = mysqli_real_escape_string($link,$id);

$key = isset($_GET['key']) ? $_GET['key'] : '';
$key = mysqli_real_escape_string($link,$key);
$verification_seckey = md5("s.".$pid.$pid);
$verification_seckey = substr($verification_seckey,0,5);

$key = trim($key);

if ($verification_seckey!=$key) {
    //echo "<h1>Worng URL</h1>";
    //exit;
}



?>
<html lang="en">
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="descriptions" content="">
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:description"  content="" />
    <meta property="og:image" content="" /> 

    <meta name="keywords" content="">
     
  <title>Display Lelang</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h3></h3>
    <form method="post" action="" class="form-horizontal"  role="form">
        <fieldset>
            <legend>Statistik Lelang</legend>
              


 <?php

if ($pid!="") {
    $sql = "SELECT * FROM `msproduct` WHERE `pid`=:pid AND `ishapus`='0' ORDER BY `regdate` DESC";
     $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
} else {
    $sql = "SELECT * FROM `msproduct` WHERE `ishapus`='0' ORDER BY `regdate` DESC";
     $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
    $stmt = $conn->prepare($sql);
}


//echo "<br>sql =".$sql;

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->execute();
            $adadata=0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 $adadata = $adadata+1;
                  $pid=$row['pid'];
                  $botid=$row['botid'];

                  $field="botname";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $botname= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;   

                   $field="botdesc";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $botdesc= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;  



                  $field="waowner";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $waowner= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;    

                  
                  $field="botwa";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $nomor_wa_botini= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ; 

                  $field="alamat_pemilik";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $alamat_pemilik= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;      

                  $link_alamat = "<a target='_1' href='".$alamat_pemilik."'>".$alamat_pemilik."</a>";


                  $urlimage1 = $row['urlimage1'];
                  $link_url_image="";
                  if ($urlimage1!="") {
                   $link_url_image="<a target='_".$pid."' href='$urlimage1'>".$urlimage1."</a>";
                   $link_url_image .= "<br><a target='_".$pid."' href='$urlimage1'><img width='150' height='100%' class='img_responsive' src='".$urlimage1."' ></a>";
                  }



                  $urlvideo1 = $row['urlvideo1'];
                   $link_url_video="";
                  if ($urlvideo1!="") {
                    $link_url_video="<a target='_".$pid."' href='$urlvideo1'>".$urlvideo1."</a>";

                     $link_url_video .="<br><video width='150' height='100%' controls='controls'><source src='".$urlvideo1."' type='video/mp4; ' /></video><br><br>";

                  }

                  $productname=$row['productname'];
                  $productdesc=$row['productdesc'];
                  $productcode=$row['productcode'];
                  $jambuka=$row['jambuka'];
                  $jamtutup=$row['jamtutup'];
                  

                  $jambuka_d = ambil_format_hari($botid,"",$jambuka,$link);
                    $jamtutup_d = ambil_format_hari($botid,"",$jamtutup,$link);


                  $kelipatan=$row['kelipatan'];
                   $kelipatan_f = number_format($kelipatan);

                  $startvalue=$row['startvalue'];
                  $startvalue_f = number_format($startvalue);

                  $regdate=$row['regdate'];

}
           

$timestamp_jambuka = strtotime($jambuka);
$timestamp_jamtutup = strtotime($jamtutup);
$timestamp_sekarang = strtotime($saatini);

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



//echo "<br>timestamp_jambuka = ".$timestamp_jambuka;
//echo "<br>timestamp_jamtutup = ".$timestamp_jamtutup;
//echo "<br>timestamp_sekarang = ".$timestamp_sekarang;


?>

<html lang="en">

  <body class="bg-dark">
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Display Lelang</div>
        <div class="card-body">
<?php

if ($adadata<=0) {
    echo "Lelang Produk ini sudah selesai !";
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>

</html>
    <?php
    exit;
}


$link_wa_owner = "<a target='_wa' href='https://wa.me/".$waowner."'>".$waowner."</a>";
?>

<h1>Lihat Transaksi Lelang</h1>

<h1>Produk : <?php echo $productname ?></h1>
<br>PID : <?php echo $pid ?>
<br>Pemilik lelang : <b><?php echo $botname ?></b>
<br>Keterangan : <?php echo $botdesc ?>
<br>Alamat : <?php //echo $link_alamat ?>
<br>Nomow WA Pemilik Barang Lelang : 👉 <?php echo $link_wa_owner ?> 👈 (kirim pesan untuk bergabung di salah satu whatsapp group Buana KOI)
<br>Produk Kode : <?php echo strtoupper($productcode) ?>
<br>Product Desc : <?php echo $productdesc ?>
<br>Jam Buka : <?php echo $jambuka_d ?>
<br>Jam Tutup : <?php echo $jamtutup_d ?>


<br>Gambar photo :<?php echo $link_url_image ?>
<br>Video :<?php echo $link_url_video ?>


<?php
     $html ="<br><br><Br>Produk ".$productname;
     $html .="<br>Deskripsi : ".$productdesc;
     $html .="<br>Jam Buka Lelang :". $jambuka_d;
     $html .="<br>Jam Tutup Lelang :". $jamtutup_d;
     $html .="<br>". $keterangan_status_lelang;
     $html .="<br>Harga Awal (OB) : ". $startvalue_f;
     $html .="<br>Kelipatan Lelang (KB) : ". $kelipatan_f;

        $html .="<br>";
      //  $html .="Untuk melakukan bid, ikut serta lelang. Ikuti langkah berikut";
      //  $html .="<br>";
       // $html .="<br>";
       // $html .="KETIK BID ".$productcode. " Kirim ke whatsapp nomor : ".$nomor_wa_botini;
            $html .="<br>";
        //       $html .="atau klik link dibawah ini";
       //     $html .="<br>";
        //    $link_shortcut = "https://wa.me/".$nomor_wa_botini."?text=BID%20".$productcode;
        //    $l = "<a target='_xxXX1' href='".$link_shortcut."'>".$link_shortcut."</a>";
         //   $html .=$l;
        $html .="<br>";
        $html .="<br>";

 //echo $html;       

$sql = "select count(id) as `total` from `transaksi_lelang` where `pid` ='$pid' and `botid`='$botid' ";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $total=0;
            foreach($conn->query($sql) as $row) {
                  $total=$row['total'];
            }

if ($total<=0) {
    echo "<br>Belum ada transaksi lelang saat ini ------------ , Lelang belum dibuka!";


    $html = otherlelang($botid,$pid,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
    echo $html;

      $footer = "<h3>BotLelang.com menyediakan Jasa persewaan bot untuk lelang apa saja ,termasuk Ikan Koi</h3>";
    $footer .= "<h4>Hubungi kukuhtw di 👉 <a target='_21' href='https://wa.me/628129893706?text=minta+info+botlelang.com'>https://wa.me/628129893706</a> 👈 </h4>";
    $footer .= "<h5><a target='kukuhtw' href='https://linktr.ee/kukuhtw'>https://linktr.ee/kukuhtw</a></h5>";

    echo $footer;

    exit;
}

/*
$sql = "select * from `transaksi_lelang` 
where `pid` ='$pid' 
and `botid`='$botid' 
and `iscancel`='0'
";
 */

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword, $options);


$stmt = $conn->prepare("SELECT * FROM `transaksi_lelang` WHERE `pid` = :pid AND `botid` = :botid AND `iscancel` = 0");
$stmt->bindParam(':pid', $pid);
$stmt->bindParam(':botid', $botid);
$stmt->execute();


            $no=0;
       
            $link_permanent=$DOMAIN_URL_IMAGES."display_lelang.php?pid=".$pid."&key=".$key;

           // echo "<br>Line 319 = ".$sql;


            $html ="<Br> Produk ".$productname;
            $html .="<br>Deskripsi : ".$productdesc;
            $html .="<br>Jam Buka Lelang :". $jambuka_d;
            $html .="<br>Jam Tutup Lelang :". $jamtutup_d;
            $html .="<br>". $keterangan_status_lelang;
            $html .="<br>Harga Awal (OB) : ". $startvalue_f;
            $html .="<br>Kelipatan Lelang (KB) : ". $kelipatan_f;
            $html .="<br>Url Link : ". $link_permanent;

            $html .="<br><table border='1'>";
            $html .="<tr>";
             $html .="<td>";
              $html .="No";
              $html .="</td>";
            $html .="<td>";
            $html .="Peserta Lelang";
            $html .="</td>";
            $html .="<td>";
            $html .="Nilai Kelipatan";
            $html .="</td>";
            $html .="<td>";
            $html .="Harga posisi terakhir";
            $html .="</td>";
            
            $html .="<td>";
            $html .="Lelang Date";
            $html .="</td>";
          

             $html .="</tr>";
             $kumulatif_current_lelang_nominal=0;
             $rt=0;
             $harga_posisi_terkini=0;

            //  echo "<br>Line 356 = ".$sql;

  
//            foreach($conn->query($sql) as $row) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $rt=$rt+1;
                    $id=$row['id'];
                    $key2 = md5($id."AAs!!@$$".$id);
                    $pid=$row['pid'];
                    $productcode = $row['productcode'];
                    $from = $row['from'];
                
                    $sender=$row['sender'];
                    $jumlah_char_sender = strlen($sender);
                    //62813615669 12 huruf 
                    $ambil_delapan_char_pertama=substr($sender, 0,9);
                    $sensor_sender = $ambil_delapan_char_pertama;
                    $jumlahh_disensor = ($jumlah_char_sender - 9);

                    for ($xx=0;$xx<$jumlahh_disensor;$xx++) {
                        $sensor_sender .= "X";
                    }

                     $senderName=$row['senderName'];


                    $nilaikelipatan=$row['nilaikelipatan'];

                    $nilaikelipatan_f = number_format($nilaikelipatan);

                   // echo "<br>Line 386  senderName = ".$senderName;


                    $default_kb = ambil_nilai_kelipatan_product_ini($pid,$productcode,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

                  //  echo "<br>Line 391  default_kb = ".$default_kb;


 $default_ob =  ambil_nilai_ob_product_ini_dashboard($pid,$productcode,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);


                
                      //echo "<br>default_ob = ".$default_ob;

                     
                    $nilai_jump_pid =  $nilaikelipatan + $default_ob;

                    //echo "<br>nilai_jump_pid = ".$nilai_jump_pid;

                    
                    if ($rt==1) {
                         $harga_posisi_terkini =  $nilaikelipatan + $default_ob;  
                    }
                    else {
                        $harga_posisi_terkini =  $nilaikelipatan + $harga_posisi_terkini ; 
                    }
                                       
                    $harga_posisi_terkini_f = number_format($harga_posisi_terkini);

                     // echo "<br>harga_posisi_terkini_f = ".$harga_posisi_terkini_f;
                    

                
                     $trlelangdate=$row['trlelangdate'];
   //echo "<br>trlelangdate = ".$trlelangdate;
                    
                     $trlelangdate_f = ambil_format_hari_2($trlelangdate,$link);

                       //echo "<br>trlelangdate_f = ".$trlelangdate_f;
                    
                     $groupmana = check_lelang_dari_grupmana($from,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
                    $display_name = $senderName. " ".$groupmana;
            
                    
                     $timestamptrlelangdate = strtotime($trlelangdate);
                    $along_time_ago = get_time_ago( $timestamptrlelangdate );
                  
                    $html .="<tr>";
                     $html .="<td valign='top'>";
                    $html .= $rt;
                    $html .="</td>";
                   $html .="<td valign='top'>";
                    $html .= $sensor_sender;
                    $html .= "<br>(".$senderName.") ".$groupmana;
                    
                    $html .="</td>";
                    $html .="<td valign='top'>";
                    $html .= "Rp ".$nilaikelipatan_f;
                    $html .="</td>";
                     $html .="<td valign='top'>";
                     $html .="Rp ".$harga_posisi_terkini_f;
                    $html .="</td>";
                   $html .="<td valign='top'>";
                    $html .= $trlelangdate_f . " ". $along_time_ago;
                    $html .="</td>";

              
                    $html .="</tr>";
                    

            }
            $html .="</table>";
             $html .="<br>";
        $html .= "Harga penawaran terakhir = Rp ".   $harga_posisi_terkini_f. " ditawar oleh ".$senderName;  
          $html .="<br>";
           $html .="Untuk melakukan bid, ikut serta lelang. Ikuti langkah berikut";
            $html .="<br>";
            $html .="hubungi pemilik farm Buana KOI di ".$link_wa_owner; 
            $html .="<br>";

     echo $html; 


     $html = otherlelang($botid,$pid,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
    echo $html; 

    $footer = "<h3>BotLelang.com menyediakan Jasa persewaan bot untuk lelang apa saja ,termasuk Ikan Koi</h3>";
    $footer .= "<h4>Hubungi kukuhtw di 👉 <a target='_21' href='https://wa.me/628129893706?text=minta+info+botlelang.com'>https://wa.me/628129893706</a> 👈 </h4>";
    $footer .= "<h5><a target='kukuhtw' href='https://linktr.ee/kukuhtw'>https://linktr.ee/kukuhtw</a></h5>";

    echo $footer;

 function otherlelang($botid,$pid,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

    
     $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword, $options);

    $stmt = $conn->prepare("SELECT * FROM `msproduct` WHERE ishapus = 0 AND `botid` = :botid ORDER BY `pid` ASC");
    $stmt->bindParam(':botid', $botid);
    $stmt->execute();

    $html = "<h2>Lihat Lelang Lainnya</h2>";
    $rt = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rt=$rt+1;
     $pid=$row['pid'];
     $botid=$row['botid'];
     $isactive = $row['isactive'];
     $jambuka=$row['jambuka'];
     $jamtutup=$row['jamtutup'];
                     
         if ($isactive=="1") {
                $status_aktive=" 🟢 <b>Masih Aktif</b> , Tutup: ".$jamtutup;
         }
         else {
            $status_aktive=" 🔴 <i>Tidak Aktif</i>";
         }
             $seckey = md5("s.".$pid.$pid);
             $seckey=trim($seckey);
            $public_link_display_key = substr($seckey,0,5);
                 
            $linkdisplay = "display_lelang.php?pid=".$pid."&key=".$public_link_display_key;

            $productname=$row['productname'];
           $urlimage1=$row['urlimage1'];
                   $urlvideo1=$row['urlvideo1'];
                   $productcode=$row['productcode'];
                   $productdesc=$row['productdesc'];

                  

                    $html .= "<br>".$rt.". <a target='_".$botid."' href='".$linkdisplay."'>".$productname."</a>". $status_aktive;


                }


        return $html;
}

?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>

</html>



<?php


function option_selected($p1,$p2) {
    if ($p1==$p2) {
        return "SELECTED";
    }
    else {
        return "";
    }
}


?>
