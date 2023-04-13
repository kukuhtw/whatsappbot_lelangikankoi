<?php
include("db.php");
include("sessionclient.php");
include("saatini.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");
include("fonnte/settings.php");
include("menusc.php");


/*
Ini halaman dashboard manajemen data lelang 
untuk isi data produk

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

$botid = $sessionloginuserid ;
$mode = isset($_POST['mode']) ? $_POST['mode'] : '';

//echo "<br>mode = ".$mode;

if ($mode=="uploadvideo") {

   $kodeikan = isset($_POST['kodeikan']) ? $_POST['kodeikan'] : '';
   $pid = isset($_POST['pid_original']) ? $_POST['pid_original'] : '';
   $target_dir = "video/";
   $random1 = rand(1111,99999);
   $random2 = rand(1111,99999);
   $replace_filename = $botid. "_".$random2."_".$random1."_".$kodeikan;
  //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir .  $replace_filename.".mp4";

    //echo "<br>target_file tmp_name = ".$target_file;

    $urlvideo1=$DOMAIN_URL_IMAGES."video/".$replace_filename.".mp4";

    $uploadOk = 1;

    $sizevideo = $_FILES["fileToUploadVideo"]["size"];
    //echo "sizevideo = ".$sizevideo. " bytes";


    if ($_FILES["fileToUploadVideo"]["size"] > 2000000) {
      echo "Sorry, your file is too large. ".$sizevideofile. " bytes";
      $uploadOk = 0;
      exit;
    }

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // echo "<br>fileToUpload tmp_name = ".$_FILES["fileToUploadVideo"]["tmp_name"];
   //  $check = getimagesize($_FILES["fileToUploadVideo"]["tmp_name"]);
    // echo "<br>fileToUpload tmp_name = ".$_FILES["fileToUploadVideo"]["tmp_name"];


    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
     // $check = getimagesize($_FILES["fileToUploadVideo"]["tmp_name"]);
      //echo "<br>check = ".$check;
      if($imageFileType =="mp4") {
     //   echo "File is an video - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not a video , but imageFileType is = ". $imageFileType . ".";
        $uploadOk = 0;
      }
    }

    // Check file size 1.375.954 
    $sizevideofile = $_FILES["fileToUploadVideo"]["size"];
    if ($_FILES["fileToUploadVideo"]["size"] > 5000000) {
      echo "Sorry, your file is too large. ".$sizevideofile. " bytes";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "mp4" && $imageFileType != "MP4" && $imageFileType != "Mp4"
    && $imageFileType != "mP4" ) {
      echo "Sorry, only MP4 are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUploadVideo"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUploadVideo"]["name"])). " has been uploaded.";



/* rawan kena sql injection , ganti dengan code dibawahnya
      $sql_update = "
        update `msproduct` 
        set
        `urlvideo1`='$urlvideo1' ,
        `productcode`='$kodeikan'
        where `pid`='$pid'
         and `botid`='$botid'
        ";
         $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));
  */    

        $sql_update = "UPDATE `msproduct` SET `urlvideo1`=?, `productcode`=? WHERE `pid`=? AND `botid`=?";
        $stmt = mysqli_prepare($link, $sql_update);
        mysqli_stmt_bind_param($stmt, "ssii", $urlvideo1, $kodeikan, $pid, $botid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

      } else {
        echo "Sorry, there was an error uploading your file ".$target_file;
      }
    }





}

if ($mode=="upload") {

   $kodeikan = isset($_POST['kodeikan']) ? $_POST['kodeikan'] : '';
   $pid = isset($_POST['pid_original']) ? $_POST['pid_original'] : '';
   $target_dir = "images/";
   $random1 = rand(1111,99999);
   $random2 = rand(1111,99999);
   $replace_filename = $botid. "_".$random2."_".$random1."_".$kodeikan;
  //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir .  $replace_filename.".jpg";

        $urlimage1=$DOMAIN_URL_IMAGES."images/".$replace_filename.".jpg";;

      $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
     
    // Check if image file is a actual image or fake image
     echo "<br>fileToUpload tmp_name = ".$_FILES["fileToUpload"]["tmp_name"];
    
    echo "<br>check[0] = ".$check[0];
    
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }


    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";



/* ganti code dibawah ini untuk menghindari sql injection
  $sql_update = "
        update `msproduct` 
        set 
        `urlimage1`='$urlimage1' ,
        `productcode`='$kodeikan'
        where `pid`='$pid'
         and `botid`='$botid'
        ";

        echo "<Br>sql_update = ".$sql_update;
         $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));
      
*/
        $sql_update = "UPDATE `msproduct` SET `urlimage1`=?, `productcode`=? WHERE `pid`=? AND `botid`=?";
        $stmt = mysqli_prepare($link, $sql_update);
        mysqli_stmt_bind_param($stmt, "ssii", $urlimage1, $kodeikan, $pid, $botid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }


}



$pid = isset($_POST['pid']) ? $_POST['pid'] : '';
$productname = isset($_POST['productname']) ? $_POST['productname'] : '';

$urlimage1 = isset($_POST['urlimage1']) ? $_POST['urlimage1'] : '';
$urlvideo1 = isset($_POST['urlvideo1']) ? $_POST['urlvideo1'] : '';

$productcode = isset($_POST['productcode']) ? $_POST['productcode'] : '';
$productdesc = isset($_POST['productdesc']) ? $_POST['productdesc'] : '';
$jambuka = isset($_POST['jambuka']) ? $_POST['jambuka'] : '';
$jamtutup = isset($_POST['jamtutup']) ? $_POST['jamtutup'] : '';


//2021-10-24 05:15:00 am
$check_am_pm_jambuka = substr($jambuka,20,2);
$check_am_pm_jamtutup = substr($jamtutup,20,2);
//echo "<br>check_am_pm_jambuka = ".$check_am_pm_jambuka;
//echo "<br>check_am_pm_jamtutup = ".$check_am_pm_jamtutup;

if ($check_am_pm_jambuka=="pm") {
    $check_jam_buka = substr($jambuka,11,2);
    $check_tahun_bulan_tanggal_jam_buka = substr($jambuka,0,10);
    $check_menit_detik_jambuka = substr($jambuka,14,5);
    //echo "<br>check_jam_buka = ".$check_jam_buka;
    // echo "<br>check_tahun_bulan_tanggal_jam_buka = ".$check_tahun_bulan_tanggal_jam_buka;
      $check_menit_detik_jambuka = substr($jambuka,14,5);
   // echo "<br>check_menit_detik_jambuka = ".$check_menit_detik_jambuka;
    $koreksi_jam_buka = intval($check_jam_buka) + 12;
    //echo "<br>koreksi_jam_buka = ".$koreksi_jam_buka;
    $jambuka_baru = $check_tahun_bulan_tanggal_jam_buka. " ".$koreksi_jam_buka.":". $check_menit_detik_jambuka;
    //echo "<br>jambuka_baru = ".$jambuka_baru;
    $jambuka = $jambuka_baru;
}


if ($check_am_pm_jamtutup=="pm") {
    $check_jam_tutup = substr($jamtutup,11,2);
    $check_tahun_bulan_tanggal_jam_tutup = substr($jamtutup,0,10);
    $check_menit_detik_jamtutup = substr($jamtutup,14,5);
     $koreksi_jam_tutup = intval($check_jam_tutup) + 12;
    $jamututup_baru = $check_tahun_bulan_tanggal_jam_tutup. " ".$koreksi_jam_tutup.":". $check_menit_detik_jamtutup;
    $jamtutup = $jamututup_baru;
}

$timestamp_jambuka = strtotime($jambuka);
$timestamp_jamtutup = strtotime($jamtutup);
$timestamp_sekarang = strtotime($saatini);



//echo "<br>timestamp_jambuka = ".$timestamp_jambuka;
//echo "<br>timestamp_jamtutup = ".$timestamp_jamtutup;
//echo "<br>timestamp_sekarang = ".$timestamp_sekarang;


$kelipatan = isset($_POST['kelipatan']) ? $_POST['kelipatan'] : '';
$startvalue = isset($_POST['startvalue']) ? $_POST['startvalue'] : '';

$pid = mysqli_real_escape_string($link,$pid);
$productname = mysqli_real_escape_string($link,$productname);
$urlimage1 = mysqli_real_escape_string($link,$urlimage1);
$urlvideo1 = mysqli_real_escape_string($link,$urlvideo1);

$productcode = mysqli_real_escape_string($link,$productcode);
$productdesc = mysqli_real_escape_string($link,$productdesc);
$jambuka = mysqli_real_escape_string($link,$jambuka);
$jamtutup = mysqli_real_escape_string($link,$jamtutup);
$kelipatan = mysqli_real_escape_string($link,$kelipatan);
$startvalue = mysqli_real_escape_string($link,$startvalue);


$confirm_delete = isset($_POST['confirm_delete']) ? $_POST['confirm_delete'] : '';
$confirm_kirim = isset($_POST['confirm_kirim']) ? $_POST['confirm_kirim'] : '';
$confirm_rekap = isset($_POST['confirm_rekap']) ? $_POST['confirm_rekap'] : '';

$confirm_delete = mysqli_real_escape_string($link,$confirm_delete);
$confirm_kirim = mysqli_real_escape_string($link,$confirm_kirim);
$confirm_rekap = mysqli_real_escape_string($link,$confirm_rekap);







$seckey = isset($_POST['seckey']) ? $_POST['seckey'] : '';
$verification_seckey = md5("s.".$pid.$pid);

//echo "<br>mode = ".$mode;
//echo "<br>confirm_delete = ".$confirm_delete;
//echo "<br>seckey = ".$seckey;
//echo "<br>verification_seckey = ".$verification_seckey;

$catatan="";

 $verification_seckey_kirim = md5("rrt".$pid.$pid);

//echo "<br>mode = ".$mode;
//echo "<br>confirm_kirim = ".$confirm_kirim;
//echo "<br>confirm_rekap = ".$confirm_rekap;
//echo "<br>seckey = ".$seckey;
//echo "<br>verification_seckey_kirim = ".$verification_seckey_kirim;
//echo "<br>pid = ".$pid;

$linkdisplay= isset($_POST['linkdisplay']) ? $_POST['linkdisplay'] : '';
$linkdisplay = mysqli_real_escape_string($link,$linkdisplay);
$pre_link = $DOMAIN_URL_IMAGES."".$linkdisplay;


if ($mode=="kirimrekap"  && $confirm_rekap=="REKAP" && $seckey == $verification_seckey_kirim ) {

    
    include("fonnte/settings.php");

        $sql = "select * from `msproduct` where `pid`='$pid' ";
       // echo "<br>sql = ".$sql;
          $options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $no=0;
            foreach($conn->query($sql) as $row) {
                $no=$no+1;
                $botid=$row['botid'];
        }

        $sender="";
        $print = rekap_lelang_current($botid,$sender,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;


                    $phone = $waowner;
                  $data = [
                        "type" => "text",
                          "pesan" => $print,
                    ];
                    $tblname="msbot";
                    $fieldname="tokenfonnte";
                    $fieldid="botid";
                    $valueid=$botid;
                $Token_Fonnte=checkvalue_general_table($botid,$sender,$tblname,$fieldid,$valueid,$fieldname,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

                // echo "<br>phone = ".$phone;
                 //  echo "<br>print = ".$print;

                 kirimPesan_padafunction($phone, $data, $Token_Fonnte);
              


}
if ($mode=="kiriminfo" && $confirm_kirim=="KIRIM" && $seckey == $verification_seckey_kirim ) {

    //kirim ke wa owner bot
    include("fonnte/settings.php");

    $sql = "select * from `msproduct` where `pid`='$pid' ";

    //echo "<br>sql = ".$sql;

    $options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $no=0;
            foreach($conn->query($sql) as $row) {
                $no=$no+1;
                $botid=$row['botid'];
                 $productcode=$row['productcode'];

                 $field="botwa";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $botwa= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ; 
                   $field="botname";
                  $table="msbot";
                  $id1="botid";
                  $value1=$botid;
                  $sender="";
                  $botname= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ; 

                $productname=$row['productname'];
                 $productdesc=$row['productdesc'];
                $urlimage1=$row['urlimage1'];
                  $urlvideo1=$row['urlvideo1'];
                $startvalue=$row['startvalue'];
                $startvalue_f = number_format($startvalue);
                $kelipatan=$row['kelipatan'];
                $kelipatan_f = number_format($kelipatan);
                
                $currentprice=$row['currentprice'];
                $currentprice_f = number_format($currentprice);
                $currentwinner=$row['currentwinner'];

                $link_ngebid = "https://wa.me/".$botwa. "?text=BID%20".$productcode;

                $phone = $waoner;
                $type="image";
                $urlfile=$urlimage1;
                $caption = $productname. " deskripsi : ".$productdesc. " OB -> ".$startvalue_f. " KB -> ".$kelipatan_f. " Harga terkini : Rp ".$currentprice_f. " oleh : ".$currentwinner. " ".$pre_link ." cara BID : Klik link ".$link_ngebid;

                $tblname="msbot";
                $fieldname="tokenfonnte";
                $fieldid="botid";
                $valueid=$botid;
                $sender="";
                $token_fonnte=checkvalue_general_table($botid,$sender,$tblname,$fieldid,$valueid,$fieldname,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);


               // echo "<Br>token_fonnte =".$token_fonnte;
               // echo "<Br>phone =".$phone;
               // echo "<Br>type =".$type;
              //  echo "<Br>urlfile =".$urlfile;
               // echo "<Br>caption =".$caption;
                
                
                if ($urlfile!="") {
                    sendfile_fonntebaru($phone,$type,$urlfile,$caption,$token_fonnte);
                }
                
                $phone = $waoner;
                $type="video";
                $urlfile=$urlvideo1;
                if ($urlfile!="") {
                  sendfile_fonntebaru($phone,$type,$urlfile,$caption,$token_fonnte);
                }


                $data = [
                    "type" => "text",
                  "pesan" => $caption,
                ];
         

                kirimPesan_padafunction($phone, $data, $token_fonnte);


            }

}

if ($mode=="deletegroup" && $confirm_delete=="DELETE" && $seckey == $verification_seckey ) {
    /* ganti code, untuk menghindari sql injection
    $sql_delete = "update `msproduct` 
    set `ishapus`='1' ,
    `datehapus`='$saatini'
    where `pid`='$pid' ";
     //echo "<Br>sql_delete = ".$sql_delete;
         $query = mysqli_query($link,$sql_delete)or die ('gagal update data'.mysqli_error($link));
     $catatan .="Product ID ".$pid." Berhasil dihapus !";
    */
     $sql_delete = "UPDATE `msproduct` SET `ishapus`='1', `datehapus`=? WHERE `pid`=?";
    $stmt = mysqli_prepare($link, $sql_delete);
    mysqli_stmt_bind_param($stmt, "si", $saatini, $pid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $catatan .= "Product ID " . $pid . " Berhasil dihapus!";



 }

if ($mode=="edit_product"  && $seckey == $verification_seckey) {
    
    $catatan ="";
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
    
    if ($productcode=="") {
        $bolehproses=0;
        $catatan .="Product code tidak boleh kosong";
    }
    $jumlah_product_code_exists = check_product_code_exists($botid,$pid,$productcode,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
    if ($jumlah_product_code_exists>=1) {
         $bolehproses=0;
        $catatan .="Product code sudah pernah digunakan";

    }

    if ($bolehproses==1) {

/* ganti code ini untuk menghindari sql injection
        $sql_update = "
        update `msproduct` 
        set `productname`='$productname' , 
        `productdesc`='$productdesc' ,
        `productcode`='$productcode' ,
        `urlimage1`='$urlimage1' , 
         `urlvideo1`='$urlvideo1' , 
        `jambuka`='$jambuka' ,
        `jamtutup`='$jamtutup' ,
        `startvalue`='$startvalue' ,
        `kelipatan`='$kelipatan' ,
        `isactive`='$isactive'
        
        where `pid`='$pid'
         and `botid`='$botid'
        ";

         $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));
*/

         $sql_update = "UPDATE `msproduct` SET `productname`=?, `productdesc`=?, `productcode`=?, `urlimage1`=?, `urlvideo1`=?, `jambuka`=?, `jamtutup`=?, `startvalue`=?, `kelipatan`=?, `isactive`=? WHERE `pid`=? AND `botid`=?";
            $stmt = mysqli_prepare($link, $sql_update);
            mysqli_stmt_bind_param($stmt, "ssssssssssii", $productname, $productdesc, $productcode, $urlimage1, $urlvideo1, $jambuka, $jamtutup, $startvalue, $kelipatan, $isactive, $pid, $botid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);


      
    }

    if ($bolehproses==0) {
        $catatan .=  "<h1>Update Gagal !</h1> ";
        $catatan .="<h2>".$catatan."</h2>";
    }  

}

if ($mode=="addproduct" && $seckey == $verification_seckey ) 
 {
    $kelipatan=20000;
    $startvalue=20000;
    
   // $kelipatan=10000;
    //$startvalue=25000;


    $default_jambuka = $tanggalhariini. " 18:00:00";
    $default_jamtutup = $tanggalhariini. " 21:10:59";

    $productcode=substr($productname,0,1);
    $productcode = strtoupper($productcode);

    $productname=str_replace("Blitar","",$productname);
    $productname=str_replace("Size : ","",$productname);
    $productname=str_replace("Sex : ","",$productname);
    $productname=str_replace("Loc : ","",$productname);


    $sql_insert = " insert into `msproduct` 
    (`productname`,`botid`,
    `urlimage1`,`productcode`,`productdesc`,
    `jambuka`,`jamtutup`,
    `kelipatan`,`startvalue`,`regdate`
    ) 
    values 
    ('$productname ','$botid',
    '$urlimage1','$productcode','$productdesc',
    '$default_jambuka','$default_jamtutup',
    '$kelipatan','$startvalue','$saatini'
) ";
   echo "<Br>sql_insert = ".$sql_insert;
    $query = mysqli_query($link,$sql_insert)or die ('gagal update data'.mysqli_error($link));

    }


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
?>


<html lang="en">
 <?php include("head_register.php") ?>
  <body class="bg-dark">
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Entry Group</div>
        <div class="card-body">


<?php include("menu.php"); ?>
<a href="#bawah">Ke bawah</a>
<a name="atas">Atas</a>
<br><a href="#A">A</a> |
<a href="#B">B</a> |
<a href="#C">C</a> |
<a href="#D">D</a> |
<a href="#E">E</a> |
<a href="#F">F</a> |
<a href="#G">G</a> |
<a href="#H">H</a> |
<a href="#I">I</a> |
<a href="#J">J</a> |
<a href="#K">K</a> |
<a href="#L">L</a> |
<a href="#M">M</a> |
<a href="#N">N</a> |
<a href="#O">O</a> |
<a href="#P">P</a> |
<a href="#Q">Q</a> |
<a href="#R">R</a> |
<a href="#S">S</a> |
<a href="#T">T</a> |

<h1>Entry / Edit Product</h1>

<?php

     $html = "<font color='red'>".$catatan."</font>"; 
     $html .="<br>";
     $html .="<table border='1' width='95%'>";
     $html .="<tr>";
     $html .="<td valign='top'>";
     $html .="Product";
     $html .="</td>";
     $html .="<td valign='top'>";
     $html .="Deskripsi";
     $html .="</td>";
     $html .="<td valign='top'>";
     $html .="Delete/View";
      $html .="</td>";
     $html .="</tr>";

$sql = "select * from `msproduct` 
where `botid` ='$botid' 
and `ishapus`='0'
order by `productcode` asc ";

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
                  $pid=$row['pid'];
                  $pid_original = $pid;
                  $seckey = md5("s.".$pid.$pid);
                  $seckey=trim($seckey);

                  $public_link_display_key = substr($seckey,0,5);
                  $productname=$row['productname'];
                  $urlimage1=$row['urlimage1'];
                   $urlvideo1=$row['urlvideo1'];
                  $productcode=$row['productcode'];
                  $productdesc=$row['productdesc'];
                  $jambuka=$row['jambuka'];
                  $jamtutup=$row['jamtutup'];
                  
       

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

                  if ($jambuka=="0000-00-00 00:00:00") {
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
                  $jambuka_tampil = ambil_format_hari_jam_lengkap($jambuka);
                  $jamtutup_tampil = ambil_format_hari_jam_lengkap($jamtutup);
                  $regdate=$row['regdate'];

                  $regdate_tampil = ambil_format_hari_jam_lengkap($regdate);
                  
                  $isactive=$row['isactive'];

                 $ket_active="";
                  if ($isactive==1) {
                    $ket_active="<font color='green'><b>Lelang dalam keadaan AKTIF</b></font>";
                  }
                   if ($isactive==0) {
                    $ket_active="<font color='red'><b>Lelang dalam keadaan TIDAK AKTIF</b></font>";
                  }
                  
                   $html .="<tr>"; 
                    $html .="<td valign='top'>";
                    $html .= $rt;
                    $html .="</td>";
                
                    $html .="<td valign='top'>";
                    $html .="<br>Product Name";
                     $html .="<br>Product ID : ".$pid;
                    $html .="<br>";
                    $html .="<form method='POST' action='' >";
                    $html .="<textarea name='productname' rows='3' cols='40'>".$productname."</textarea>";
                    $html .="<br><br>";
                   
                    $html .="<br>Url Image 1";
                    $html .="<br>";
                    $html .="<textarea name='urlimage1' rows='3' cols='40'>".$urlimage1."</textarea>";
                    $html .="<br><br>";
                   

                     $html .="<br>Url video 1";
                    $html .="<br>";
                    $html .="<textarea name='urlvideo1' rows='3' cols='40'>".$urlvideo1."</textarea>";
                    $html .="<br><br>";
                   



                      $is_ada_transaksi = apakah_pernah_terjadi_transaksi_lelang_produk_ini($botid,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);


                    $html .="<br>Product Code";
                   
                     if ($is_ada_transaksi>=1) {
                       $html .=" : <b>".$productcode."</b>";
                         $html .="<input type='hidden' name='productcode' value=".$productcode.">";
                     }
                     else {
                        $html .="<br><textarea name='productcode' rows='3' cols='40'>".$productcode."</textarea>";
                         

                     }
                    
                     $html .="<br><br>";
                   


                    $html .="<br>Product Desc";
                    $html .="<br>";
                    $html .="<textarea name='productdesc' rows='3' cols='40'>".$productdesc."</textarea>";
                   

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
           


                    $html .="<br>Nilai Awal Nominal Lelang : Rp ".$startvalue_f;
                    $html .="<br>";
                    
                    if ($startvalue<=0) {
                        $html .="<b><font color='red'>Nilai awal nominal Lelang Tidak boleh 0</b></font>";
                         $html .="<br>";

                    }

                   $boleh_update_nilai_awal_nominal=1;
                   if ($is_ada_transaksi>=1) {
                        $boleh_update_nilai_awal_nominal=0;
                        $html .="<b>Rp ".$startvalue_f."</b>";
                        $status_enabled_disabled_awal_nominal="disabled";
                        $html .="<input type='hidden' name='startvalue' value=".$startvalue.">";
                   }
                   else {
                      $status_enabled_disabled_awal_nominal="";
                      $html .="<textarea ".$status_enabled_disabled_awal_nominal." name='startvalue' rows='3' cols='40'>".$startvalue."</textarea>";
                    }


                    
                    $html .="<br>Kelipatan Nominal Lelang Rp ".$kelipatan_f;
                    $html .="<br>";

                    if ($kelipatan<=0) {
                        $html .="<b><font color='red'>Nilai Kelipatan nominal Lelang Tidak boleh 0</b></font>";
                         $html .="<br>";

                    }
                      if ($is_ada_transaksi>=1) {
                          $html .="<b>Rp ".$kelipatan_f."</b>";
                            $html .="<input type='hidden' name='kelipatan' value=".$kelipatan.">";
                      }   
                      else {

                          $html .="<textarea name='kelipatan' rows='3' cols='40'>".$kelipatan."</textarea>";
                          $html .="<input type='hidden' name='mode' value='edit_kelipatan'>";

                      }
                   

                    
                  
                   $html .="<br><br>";
                   

                 
                   // $html .="<br>is_ada_transaksi =".$is_ada_transaksi;
                   // $html .="<br>botid =".$botid;
                   // $html .="<br>pid =".$pid;



                    $html .="<input type='hidden' name='mode' value='edit_product'>";
                    $html .="<input type='hidden' name='pid' value=".$pid.">";
                    $html .="<input type='hidden' name='seckey' value=".$seckey.">";
                    $html .="<br><br>";
                   
                    $html .= "Tgl pendaftaran produk : ".$regdate_tampil;
                   $html .="<br>";
                   $html .= "Status Lelang Active : ".$ket_active;
                   $html .="<br>";
                     $html .="Lelang dibuka : ".$jambuka_tampil." " .$ket_jam_buka;
                     $html .="<br>Lelang ditutup : ".$jamtutup_tampil." " .$ket_jam_tutup;
                   
                   
                    $html .="<br><br><input type='submit' class='btn btn-space btn-primary' name='' value='Update Product'>";
                    
                    $html .= "<br></form>";

$html .="<a name='".$productcode."'></a>";
//upload video

$html .= "<br>
<h2>Upload Video - Maksimal 2 MB</h2>
URL VIDEO : ".$urlvideo1."<br>
<form action='' method='post' enctype='multipart/form-data'>
    <br><input type='text' name='kodeikan' value='".$productcode."' maxlength='5' size='5'>
<br>
  Select video to upload:
  <input type='file' name='fileToUploadVideo' id='fileToUploadVideo'>
  <input type='hidden' name='mode' value='uploadvideo'>
  <input type='hidden' name='pid_original' value='".$pid_original."'>
  <br>Upload Video - Maksimal 2 MB
  <br><br><input type='submit' class='btn btn-space btn-primary' value='Upload Video' name='submit'>
</form>";
$html .="<a href='#atas'>Balik ke atas</a><br><Br>";


//upload images


$html .= "<br>
<h2>Upload Images - Maksimal 2 Mb</h2>
URL IMAGE : ".$urlimage1."<br>
<form action='' method='post' enctype='multipart/form-data'>
    <br><input type='text' name='kodeikan' value='".$productcode."' maxlength='5' size='5'>
<br>
  Select image to upload:
  <input type='file' name='fileToUpload' id='fileToUpload'>
  <input type='hidden' name='mode' value='upload'>
  <input type='hidden' name='pid_original' value='".$pid_original."'>
  <br>Upload Images - Maksimal 2 Mb
  <br><br>
   <input type='submit' class='btn btn-space btn-primary' value='Upload Image' name='submit'>
</form>";
$html .="<a href='#atas'>Balik ke atas</a>";
$html .= "<br>
<a href='#bawah'>Ke bawah</a>
<a name='atas'>Atas</a>
<br><a href='#A'>A</a> |
<a href='#B'>B</a> |
<a href='#C'>C</a> |
<a href='#D'>D</a> |
<a href='#E'>E</a> |
<a href='#F'>F</a> |
<a href='#G'>G</a> |
<a href='#H'>H</a> |
<a href='#I'>I</a> |
<a href='#J'>J</a> |
<a href='#K'>K</a> |
<a href='#L'>L</a> |
<a href='#M'>M</a> |
<a href='#N'>N</a> |
<a href='#O'>O</a> |
<a href='#P'>P</a> |
<a href='#Q'>Q</a> |
<a href='#R'>R</a> |
<a href='#S'>S</a> |
<a href='#T'>T</a> |
<br> ";


                    $html .="</td>";


                   $html .="<td valign='top'>";
                    $html .="<form method='POST' action='' >";
                    $html .="<br>Ketik DELETE <br>untuk menghapus <br>produk ini<br><input type='text' name='confirm_delete' size='6' maxlength='6'>";

                    $html .="<br><input type='hidden' name='mode' value='deletegroup'>";
                    $html .="<input type='hidden' name='pid' value=".$pid.">";
                    $html .="<input type='hidden' name='seckey' value=".$seckey.">";
                   
                    
                    $html .="<br><br><input type='submit' class='btn btn-space btn-primary' name='' value='DELETE Product'>";
                    
                    $html .= "<br></form>";


   $html .="<br>";
        
                    $html .= "<br>URL display statistik lelang untuk umum";
                    $linkdisplay = "display_lelang.php?pid=".$pid."&key=".$public_link_display_key;
                    $html .= "<br><a target='_".$botid."' href='".$linkdisplay."'>".$linkdisplay."</a>";



                    $html .="</td>";

                    $html .="</tr>";

                  
            }

            $html .="</table>";


         
echo $html;


$pid=0;
$seckey = md5("s.".$pid.$pid);

//echo "<br> pid = ".$pid;
//echo "<br> seckey = ".$seckey;
?>

<a name="bawah">Form</a>
<br><a href="#A">A</a> |
<a href="#B">B</a> |
<a href="#C">C</a> |
<a href="#D">D</a> |
<a href="#E">E</a> |
<a href="#F">F</a> |
<a href="#G">G</a> |
<a href="#H">H</a> |
<a href="#I">I</a> |
<a href="#J">J</a> |
<a href="#K">K</a> |
<a href="#L">L</a> |
<a href="#M">M</a> |
<a href="#N">N</a> |
<a href="#O">O</a> |
<a href="#P">P</a> |
<a href="#Q">Q</a> |
<a href="#R">R</a> |
<a href="#S">S</a> |
<a href="#T">T</a> |


<h1>Add Product</h1>
<form name="addproduct" method="post">
<br>Nama Product Lelang : 
<br><input type="text" name="productname" required>
<br><input type="hidden" name="mode" value="addproduct">
<input type="hidden" name="pid" value="<?php echo $pid ?>">
<input type="hidden" name="seckey" value="<?php echo $seckey ?>">
<br><input type="submit" name="addproduct" value="Add Product">
</form>
 

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


<?php



?>

