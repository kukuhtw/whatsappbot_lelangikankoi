<?php
ini_set('display_errors', 1); //unset bila sedang debug
ini_set('display_startup_errors', 1); //unset bila sedang debug
error_reporting(E_ALL); //unset bila sedang debug

/*
File telegram bot Tidak diaktifkan, tidak digunakan.
+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/


function clear_variable_post_get($link,$namevariablel)
{
	$namevariablel = mysqli_real_escape_string($link,$namevariablel);
	//echo "<br>namevariablel = ".$namevariablel;
	$namevariablel = addslashes($namevariablel);
	//echo "<br>namevariablel = ".$namevariablel;
	$namevariablel=strip_tags($namevariablel);

	$return = $namevariablel;
	//echo "<br>return = ".$return;
	return $return;
}


// =================== check / QUERY VALUE PADA TABLE =============================


function check_value_tbl_msuser_based_email($field,$email,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$sql = " select `$field` as `value` from 
	`msuser` where `emailuser`='$email'  ";
	//echo "<br>sql = ".$sql;
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				);
				$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$value="";
				foreach($conn->query($sql) as $row) {
						$value=$row['value'];
				}
		$conn=null;		
		return $value;
	
}

function get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$field = clear_variable_post_get($link,$field);
	$table = clear_variable_post_get($link,$table);
	$id1 = clear_variable_post_get($link,$id1);
	$value1 = clear_variable_post_get($link,$value1);

	$sql=" select `$field` as `fielddatabase` from `$table` where `$id1`='$value1' ";
	
	//$namafile="line 54 get_value_general_table_based_1_parameter function.php";
	//$content = "<br>sql = ".$sql;
	//insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

	$fielddatabase="";
		$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$total=0;
			$fielddatabase="";
			foreach($conn->query($sql) as $row) {
				$total=1;
					$fielddatabase=$row['fielddatabase'];
			}
	
	//$namafile="line 72 get_value_general_table_based_1_parameter function.php";
	//$content = "<br>fielddatabase = ".$fielddatabase;
	//insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

	$conn = null;	
	return $fielddatabase;

}


function get_value_tbl_msbot_based_on_botid($field,$botid,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$table="msbot";
	$id1="botid";
	$value1=$botid;
	$fielddatabase = get_value_general_table_based_1_parameter($field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

	return $fielddatabase;

}



function get_value_tbl_msproduct_based_on_pid($botid,$sender,$pid,$field,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$table="msproduct";
	$id1="pid";
	$value1=$pid;
	$fielddatabase = get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
	return $fielddatabase;

}


function get_value_tbl_peserta_based_on_sender($sender,$field,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$sql=" select `$field` as field from `peserta` where `sender`='$sender' ";
	
	$fielddatabase="";
		$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$total=0;
			$fielddatabase="";
			foreach($conn->query($sql) as $row) {
				$total=1;
					$fielddatabase=$row['field'];
			}
	
	$conn = null;	
	return $fielddatabase;

}


function check_value_tbl_transaksilelang_based_pid_active($field,$pid,$isactive,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$sql = " select `$field` as `value` from 
	`transaksi_lelang` where `pid`='$pid' and `isactive`='$isactive' ";
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				);
				$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$value="";
				foreach($conn->query($sql) as $row) {
						$value=$row['value'];
				}
		$conn=null;		
		return $value;
	
}

/// ====================== SEGALA MACAM CHECK EXISTS ============================

function check_peserta_exists($sender,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$id="id";
	$field="sender";
	$valuefield=$sender;
	$table = "peserta";
	$total = check_exists_table_something($id,$field,$table,$valuefield,$link,
	$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;
	return $total;
}

function check_bot_exists($botid,$sender,$botkey,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$id="botid";
	$field="botkey";
	$valuefield=$botkey;
	$field2="botid";
	$valuefield2=$botid;
	$table = "msbot";
	$total = check_exists_table_something_based_2_parameter($botid,$sender,$id,$table,$field,$valuefield,$field2,$valuefield2,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;
	return $total;
}


function check_exists_table_something_based_2_parameter($botid,$sender,$id,$table,$field,$valuefield,$field2,$valuefield2,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) 
{
		$sql = " select count($id) as total from `$table` where `$field`='$valuefield' 
		and `$field2`='$valuefield2'

		";

	

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

	$namafile="function line 172 checkvalue_general_table";
	$content = "<br>sql = ".$sql;
	$content .= "<br>total = ".$total;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

	return $total;

}

function check_exists_table_something($id,$field,$table,$valuefield,$link,
	$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) 
{
		$sql = " select count($id) as total from `$table` where `$field`='$valuefield'";
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
	return $total;

}

//======================== KUMPULAN INSERT INTO ============================

function insert_product($botid,$productname,$productcode,$productdesc,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$botkey=sha1($botname.$botowneremail.$saatini);
	$sql = "insert into `msproduct` (botid,productname,productcode,productdesc,regdate) 
	values 
	('$botid','$productname','$productcode','$productdesc',;$saatini') ";
	
	//echo "<br>sql = ".$sql;
	$query = mysqli_query($link,$sql)or die ('gagal update data'.mysqli_error($link));
	
}

function insert_msbot($botname,$botowneremail,$botwa,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$botkey=sha1($botname.$botowneremail.$saatini);
	$sql = "insert into msbot (botname,botkey,botowneremail,botwa,botregdate) 
	values 
	('$botname','$botkey','$botowneremail','$botwa',;$saatini') ";
	
	//echo "<br>sql = ".$sql;
	$query = mysqli_query($link,$sql)or die ('gagal update data'.mysqli_error($link));
	
}

function insert_peserta($botid,$sender,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$sql = " insert into `peserta` (`sender`,`temp_botid`,`regdate`) 
	values 
	('$sender','$botid','$saatini') ";
	$namafile="function line 215 insert_peserta";
	$content = "<br>sql = ".$sql;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

	$query = mysqli_query($link,$sql)or die ('gagal insert_msuser data'.mysqli_error($link));
}

function insert_msuser($sender,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$sql = " insert into `msuser` (`sender`,`regdate`) values ('$sender','$saatini') ";
	//echo $sql;
	$query = mysqli_query($link,$sql)or die ('gagal insert_msuser data'.mysqli_error($link));
}

function chek_jumlah_transaksi_lelang_produk_ini($sender,$botid,$pid,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$sql = " select count(id) as total from `transaksi_lelang`  where `pid`='$pid' 
	and `botid`='$botid'
	";

	
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

	$namafile = "function line 268 chek_jumlah_transaksi_lelang_produk_ini";
	$content = "<br>sql = ".$sql;
	$content .= "<br>total = ".$total;
	$content .= "<br>sender = ".$sender;
	$content .= "<br>botid = ".$botid;
	$content .= "<br>pid = ".$pid;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

	return $total;		

}

function insert_transaksi_lelang($sender,$botid,$pid,$productcode,$nilaikelipatan,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$sql = " insert into `transaksi_lelang` 
	(`sender`,`botid`,`pid`,`productcode`,`nilaikelipatan`,`regdate`) 
	values 
	('$sender','$botid','$pid','$productcode','$nilaikelipatan','$saatini') ";
	//echo $sql;
	$query = mysqli_query($link,$sql)or die ('gagal insert_msuser data'.mysqli_error($link));
}

//-============================= END SEGALA MACAM INSERT =================================


function checkvalue_general_table($botid,$sender,$tblname,$fieldid,$valueid,$fieldname,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$botid = clear_variable_post_get($link,$botid);
	$sender = clear_variable_post_get($link,$sender);
	$tblname = clear_variable_post_get($link,$tblname);
	$fieldid = clear_variable_post_get($link,$fieldid);
	$valueid = clear_variable_post_get($link,$valueid);
	$fieldname = clear_variable_post_get($link,$fieldname);

	$sql="select `$fieldname` as `returnvalue` from `$tblname` where $fieldid='$valueid' ";
	//echo $sql;
	$namafile="function line 267 checkvalue_general_table";
	$content = "<br>sql = ".$sql;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$returnvalue="";
			foreach($conn->query($sql) as $row) {
				$returnvalue=$row['returnvalue'];
			}
	return $returnvalue;
}

function checkvalue_general_table_on_2_condition($botid,$sender,$tblname,$fieldid,$valueid,$fieldid2,$valueid2,$fieldname,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$botid = clear_variable_post_get($link,$botid);
	$sender = clear_variable_post_get($link,$sender);
	$tblname = clear_variable_post_get($link,$tblname);
	$fieldid = clear_variable_post_get($link,$fieldid);
	$valueid = clear_variable_post_get($link,$valueid);
	$fieldid2 = clear_variable_post_get($link,$fieldid2);
	$valueid2 = clear_variable_post_get($link,$valueid2);
	$fieldname = clear_variable_post_get($link,$fieldname);

	$sql="select `$fieldname` as `returnvalue` from `$tblname` 
	where `$fieldid`='$valueid' 
    and `$fieldid2`='$valueid2'
	";
	
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$returnvalue="";
			foreach($conn->query($sql) as $row) {
				$returnvalue=$row['returnvalue'];
			}

	//echo $sql;
	$namafile="function line 330 checkvalue_general_table_on_2_condition";
	$content = "<br>sql = ".$sql;
	$content .= "<br>returnvalue = ".$returnvalue;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);


	return $returnvalue;
}


function update_otp_peserta($sender,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$otp_random = rand(111111,999999);
	$tblname="peserta";
	$fieldtbl="otp";
	$valueid=$otp_random;
	$fieldid="sender";
	$valueid=$sender;
	update_general_table($tblname,$fieldid,$valueid,$fieldtbl,$valuefield,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;


}

function update_general_table($botid,$sender,$tblname,$fieldid,$valueid,$fieldtbl,$valuefield,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$sql = " update `$tblname` set `$fieldtbl` = '$valuefield' where `$fieldid`='$valueid'";
	$namafile="function line 281 update_general_table";
	$content = "<br>sql = ".$sql;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);
	$query = mysqli_query($link,$sql)or die ('gagal update data'.mysqli_error($link));
}

function update_general_table_where_2_condition($botid,$sender,$tblname,$fieldid,$valueid,$fieldid2,$valueid2,$fieldtbl,$valuefield,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	$sql = " update `$tblname` set `$fieldtbl` = '$valuefield' where `$fieldid`='$valueid' and `$fieldid2`='$valueid2' ";
	
	$namafile="function line 289 update_general_table_where_2_condition";
	$content = "<br>sql = ".$sql;

	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);
	$query = mysqli_query($link,$sql)or die ('gagal update data'.mysqli_error($link));
}


//===========Nama Function : checkemailvalid ===========================
function checkemailvalid($emailaddress) {
	$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
	if (preg_match($pattern, $emailaddress) === 1) {
	    // emailaddress is valid
		return 1;
	}
	else {
		return 0;

	}
	
}


function insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link) {
	$saatini = str_replace("am","",$saatini);
	$saatini = str_replace("pm","",$saatini);
	$content = mysqli_escape_string($link,$content);
	$content = str_replace("\n", "<br>", $content);
	$sql="insert into `log_debug` 
	(`botid`,`sender`,`namafile`,`content`,`debugdate`) 
	values 
	('$botid','$sender','$namafile','$content','$saatini') ";
	$query = mysqli_query($link,$sql)or die ('gagal insert data function line 391'.mysqli_error($link));
}


function debug_text($namafile,$contentdebug) {
	$myfile = fopen($namafile, "w") or die("Unable to open file!");
	fwrite($myfile, $contentdebug);
	fclose($myfile);
}


function ambil_format_hari($botid,$sender,$questiondate,$link) {
		$questiondate = str_replace("pm", "", $questiondate);
		$questiondate = str_replace("am", "", $questiondate);

		$jam_menit_detik = substr($questiondate,11,9);
		$dt = strtotime($questiondate);
		$day = strtolower(date("D", $dt));
		$tahun = substr($questiondate,0,4);
		$tanggal = substr($questiondate,8,2);
		$bulan = substr($questiondate,5,2);
		//2020-12-31 12:59:56
		$jam_menit_detik = substr($questiondate,11,9);
		$namahari="";
		$namabulan="";
			if ($bulan=="01") {
					$namabulan="January";
			} else if ($bulan=="02") {
						$namabulan="February";
					} else if ($bulan=="03") {
						$namabulan="Maret";
					} else if ($bulan=="04") {
						$namabulan="April";
					} else if ($bulan=="05") {
						$namabulan="May";
					} else if ($bulan=="06") {
						$namabulan="Juni";
					} else if ($bulan=="07") {
						$namabulan="July";
					} else if ($bulan=="08") {
						$namabulan="Agustus";
					} else if ($bulan=="09") {
						$namabulan="September";
					} else if ($bulan=="10") {
						$namabulan="Oktober";
					} else if ($bulan=="11") {
						$namabulan="November";
					} else if ($bulan=="12") {
						$namabulan="Desember";
					}

					if ($day=="sun") {
						$namahari="Minggu";
					} else if ($day=="mon") {
						$namahari="Senin";
					} else if ($day=="tue") {
						$namahari="Selasa";
					} else if ($day=="wed") {
						$namahari="Rabu";
					} else if ($day=="thu") {
						$namahari="Kamis";
					} else if ($day=="fri") {
						$namahari="Jumat";
					} else if ($day=="sat") {
						$namahari="Sabtu";
					}
					
					$formatwaktu = $namahari . " ".$tanggal . " ".$namabulan. " " .$tahun." jam ".$jam_menit_detik; ;
					return $formatwaktu;

}

// DAFTAR PRODUK YANG SEDANG DILELANG ==


//  ======================== PESERTA IKUT NGEBID

function peserta_ngebid($botid,$sender,$pid,$productcode,$namafiletele,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {
	// check apakah code produk terdaftar dan masih active
	$tblname = "msproduct";
	$fieldname = "productcode";
	$fieldid = "pid";
	$valueid = $pid;
	$fieldid2= "isactive"; 
	$valueid2 = 1;
	$product_code_db = checkvalue_general_table_on_2_condition($botid,$sender,$tblname,$fieldid,$valueid,$fieldid2,$valueid2,$fieldname,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
	$product_code_db = strtoupper($product_code_db);
	$productcode = strtoupper($productcode);

	$product_code_db=trim($product_code_db);
	$productcode=trim($productcode);

	$namafile="line 487  peserta_ngebid function.php";
	$content = "<br>product_code_db = ~".$product_code_db."~";
	$content .= "<br>productcode = ~".$productcode."~";
	$content .= "<br>pid = ".$pid;
	$content .= "<br>botid = ".$botid;
	$content .= "<br>sender = ".$sender;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);


	$productlelangada=0;
	if ($product_code_db==$productcode) {
		$productlelangada=1;
		//ambil datanya
		$sql = "select * from `msproduct` where `botid`='$botid' and `pid`='$pid' and `isactive`='1' ";
			//echo "<br>sql = ".$sql;

			$namafile="line 503  peserta_ngebid function.php";
			$content = "<br>sql = ~".$sql."~";
			insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

			$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$print="";
			$no=0;
			foreach($conn->query($sql) as $row) {
				$no=$no+1;
				$productname=$row['productname'];
				$productcode=$row['productcode'];
				$startvalue=$row['startvalue'];
				$startvalue_f = number_format($startvalue);
				$kelipatan=$row['kelipatan'];
				$kelipatan_f = number_format($kelipatan);

				$namafile="line 524  peserta_ngebid function.php";
				$content = "<br>productname = ~".$productname."~";
				$content .= "<br>productcode = ~".$productcode."~";
				$content .= "<br>startvalue = ~".$startvalue."~";
				$content .= "<br>startvalue_f = ~".$startvalue_f."~";
				$content .= "<br>kelipatan = ~".$kelipatan."~";
				$content .= "<br>kelipatan_f = ~".$kelipatan_f."~";
				$content .= "<br>productlelangada = ~".$productlelangada."~";
				
				insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);


				$print .="\nNama Produk :".$productname;
				$print .="\nKodeProduk :".$productcode;
				$print .="\nHarga Awal : Rp *".$startvalue_f."*";
				$print .="\nNilai Kelipatan Lelang : Rp *".$kelipatan_f."*";
				$print .="\n";
			}
			$temp_kelipatan = $kelipatan;
			$temp_kelipatan_f = number_format($temp_kelipatan);

	} 

	if ($productlelangada==0)  {
		$print = "Product Code ".$productcode." tidak dikenal ";
		return $print;
	} // end if ($productlelangada==0)

	if ($productlelangada==1)  {

		//bila ada simpan ditable peserta sementara
		$sql_update = "update `peserta` 
		set `temp_kelipatan`='$temp_kelipatan' ,
		`temp_pid`='$pid',
		`temp_productcode`='$productcode' ,
		`temp_date`='$saatini',
		`temp_contentid`='about_to_bid' ,
		`temp_botid`='$botid'
		where `sender`='$sender' ";
		//echo "<br>sql_update = ".$sql_update;
		$namafile="line 563  peserta_ngebid function.php";
		$content = "<br>sql_update = ~".$sql_update."~";
		insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);


		$query = mysqli_query($link,$sql_update)or die ('gagal insert data function 79'.mysqli_error($link));

		$print = rekap_lelang_current($botid,$sender,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;

		 $table="msproduct";
		 $field="currentprice";
		 $id1="pid";
		 $value1=$pid;
		 $currentprice = get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;

	

		 $currentprice_f = number_format($currentprice);
		 $lelang_tertinggi = $currentprice + $temp_kelipatan;
		$lelang_tertinggi_f = number_format($lelang_tertinggi);
		 
		$print .="\n\n";
		$print .="Bila anda setuju, maka penawaran anda akan menjadi *TERTINGGI* saat ini, menjadi Rp *".$lelang_tertinggi_f."*";
	$print .="\nNilai kelipatan lelang adalah Rp *".$temp_kelipatan_f."*";
		$print .="\nKetik *IYA* bila anda yakin akan ikut lelang ini!";
		return $print;

	} // end if ($productlelangada==1)

	
}
	
// KIRIM KE peserta lelang

function kirim_last_updated_daftar_peserta_lelang($botid,$sender,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$sql = "SELECT DISTINCT(sender) as `peserta_lelang` 
	FROM `transaksi_lelang` 
	WHERE pid='$pid' 
	and `istesting`='0' 
	and `sender`<>'$sender'
	";
	
	$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$tblname="msbot";
			$fieldname="tokenfonnte";
			$fieldid="botid";
			$valueid=$botid;
		   	 $Token_Fonnte=checkvalue_general_table($botid,$sender,$tblname,$fieldid,$valueid,$fieldname,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

		   	  $field="waowner";
              $table="msbot";
              $id1="botid";
              $value1=$botid;
              $sender="";
              $waowner= get_value_general_table_based_1_parameter($botid,$sender,$field,$table,$id1,$value1,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ; 
			
			$field="currentwinner";
			$currentwinner = get_value_tbl_msproduct_based_on_pid($botid,$sender,$pid,$field,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);

			$field="currentprice";
			$currentprice = get_value_tbl_msproduct_based_on_pid($botid,$sender,$pid,$field,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
			$currentprice_f = number_format($currentprice);

			$field="productcode";
			$productcode = get_value_tbl_msproduct_based_on_pid($botid,$sender,$pid,$field,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);


			$field="productname";
			$productname = get_value_tbl_msproduct_based_on_pid($botid,$sender,$pid,$field,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword);
			

			$desc_Waktu = ambil_format_hari($botid,$sender,$saatini,$link) ;
			
			$saatini_d=str_replace("am","",$saatini);
			$saatini_d=str_replace("pm","",$saatini_d);
			
			$timestamp_saat_ini = strtotime($saatini_d);
			$kapan_terjadinya = get_time_ago( $timestamp_saat_ini );

			$isipesan = "seseorang pada ".$desc_Waktu." (".$kapan_terjadinya.") melakukan bidding untuk product code: ".$productcode. " Nama Produk : ".$productname .", posisi harga saaat ini Rp *".$currentprice_f."*" ;
			$isipesan .= "\nKetik *STATS ".$productcode. "* untuk melihat detail";
		
			$namafile="line 591 kirim_last_updated_daftar_peserta_lelang function.php";
			$content = "<br>currentwinner = ".$currentwinner;
			$content .= "<br>currentprice = ".$currentprice;
			$content .= "<br>isipesan = ".$isipesan;
			$content .= "<br>saatini = ".$saatini;
			$content .= "<br>timestamp_saat_ini = ".$timestamp_saat_ini;
			$content .= "<br>kapan_terjadinya = ".$kapan_terjadinya;
			$content .= "<br>sql = ".$sql;

			
			insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

			//kirim ke owner wa bot dulu
			$phone = $waowner;
			$print = $isipesan ;
			$data = [
		       "type" => "text",
		       "pesan" => $print,
		    ];

			kirimPesan_padafunction($phone, $data, $Token_Fonnte);


			foreach($conn->query($sql) as $row) {
				$no=$no+1;
				$peserta_lelang=$row['peserta_lelang'];
				$phone = $peserta_lelang;

				$print = $isipesan ;
				$data = [
		            "type" => "text",
		              "pesan" => $print,
		        ];

  			
				$namafile="line 600 kirim_last_updated_daftar_peserta_lelang function.php";
				$content = "<br>peserta_lelang = ".$peserta_lelang;
				$content .= "<br>pid = ".$pid;
				$content .= "<br>phone = ".$phone;
				insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

				if ($peserta_lelang!=$waowner) {
  				    kirimPesan_padafunction($phone, $data, $Token_Fonnte);
  				}


							
			}


}


// ================= PESERTA KONFIRMASI BID DIYAKINI

function peserta_konfirmasi_ngebid($botid,$sender,$usermessages_lower,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	// check data peserta lelang
	$print = "";
	$sql = " select * from `peserta` where `sender`='$sender' and `temp_botid`='$botid' ";
	//echo "<br>sql = ".$sql;

	$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$returnvalue="";
			$no=0;
			foreach($conn->query($sql) as $row) {
				$no=$no+1;
				$temp_pid=$row['temp_pid'];
				$temp_productcode=$row['temp_productcode'];
				$temp_kelipatan=$row['temp_kelipatan'];
			}


	// check apakah code produk terdaftar dan masih active
	$sql = "select count(`pid`) as `total` from `msproduct` where `botid`='$botid' and `pid`='$temp_pid' and `isactive`='1' and `productcode`='$temp_productcode' and `botid`='$botid' order by pid desc limit 0,1 ";
			//echo "<br>sql = ".$sql;
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

	//echo "<br>total = ".$total;		
	if ($total==0) {
		$print = "Lelang Product ini tidak ada atau sudah selesai !";
	}		
	if ($total==1) {
		$sql_insert = "insert into `transaksi_lelang` 
		(`botid`,`pid`,`productcode`,
		`sender`,`nilaikelipatan`,`trlelangdate`) 
		values 
		('$botid','$pid','$temp_productcode',
		'$sender','$temp_kelipatan','$saatini') ";
		$query = mysqli_query($link,$sql_insert)or die ('gagal insert data function 79'.mysqli_error($link));

		$print .= rekap_lelang_current($botid,$sender,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;
		$print .="\nAnda baru saja mengikuti lelang.";

		//bersihkan data
		$sql_update = "update `peserta` 
		set `temp_kelipatan`='' ,
		`temp_pid`='',
		`temp_productcode`='' ,
		`temp_date`='',
		`temp_contentid`='' 
		where `sender`='$sender' and `temp_botid`='$botid' ";
		//echo "<br>sql_update = ".$sql_update;
		$query = mysqli_query($link,$sql_update)or die ('gagal insert data function 79'.mysqli_error($link));



	}		

	return $print;

	// Tampilkan posisi harga terakhir
	// Bila jawaban iya, masukkan ke daftar transaksi
	// bila jawaban bukan Iya...hapus nilai temporarty bid peserta


}


function peserta_konfirmasi_ngebid_testing($botid,$sender,$usermessages_lower,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	// check data peserta lelang
	$print = "";
	$sql = " select * from `peserta` where `sender`='$sender' and `temp_botid`='$botid' ";
	//echo "<br>sql = ".$sql;

	$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$returnvalue="";
			$no=0;
			foreach($conn->query($sql) as $row) {
				$no=$no+1;
				$temp_pid=$row['temp_pid'];
				$temp_productcode=$row['temp_productcode'];
				$temp_kelipatan=$row['temp_kelipatan'];
			}


	// check apakah code produk terdaftar dan masih active
	$sql = "select count(`pid`) as `total` from `msproduct` where `botid`='$botid' and `pid`='$temp_pid' and `isactive`='1' and `productcode`='$temp_productcode' and `botid`='$botid' order by pid desc limit 0,1 ";
			//echo "<br>sql = ".$sql;
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

	//echo "<br>total = ".$total;		
	if ($total==0) {
		$print = "Lelang Product ini tidak ada atau sudah selesai !";
	}		
	if ($total==1) {
		$sql_insert = "insert into `transaksi_lelang` 
		(`botid`,`pid`,`productcode`,
		`sender`,`nilaikelipatan`,`trlelangdate`,`istesting`) 
		values 
		('$botid','$pid','$temp_productcode',
		'$sender','$temp_kelipatan','$saatini','1') ";
		$query = mysqli_query($link,$sql_insert)or die ('gagal insert data function 79'.mysqli_error($link));

		$print .= rekap_lelang_current($botid,$sender,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) ;
		$print .="\nAnda baru saja mengikuti lelang.";

		//bersihkan data
		$sql_update = "update `peserta` 
		set `temp_kelipatan`='' ,
		`temp_pid`='',
		`temp_productcode`='' ,
		`temp_date`='',
		`temp_contentid`='' 
		where `sender`='$sender' and `temp_botid`='$botid' ";
		//echo "<br>sql_update = ".$sql_update;
		$query = mysqli_query($link,$sql_update)or die ('gagal insert data function 79'.mysqli_error($link));



	}		

	return $print;

	// Tampilkan posisi harga terakhir
	// Bila jawaban iya, masukkan ke daftar transaksi
	// bila jawaban bukan Iya...hapus nilai temporarty bid peserta


}



//================= REKAP ======================

function rekap_lelang_current($botid,$sender,$pid,$saatini,$link,$mySQLserver,$mySQLdefaultdb,$mySQLuser,$mySQLpassword) {

	$sql = "select * from `msproduct` where `botid`='$botid' and `pid`='$pid' and `isactive`='1' ";
	
	$namafile="line 614 rekap_lelang_current function.php";
	$content = "<br>sql = ".$sql;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);


	$print="Detail Lelang\n";
	$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$returnvalue="";
			$no=0;
			foreach($conn->query($sql) as $row) {
				$no=$no+1;
				$productname = $row['productname'];
				$productdesc = $row['productdesc'];
				$productcode = $row['productcode'];
				$startvalue=$row['startvalue'];
				$startvalue_f = number_format($startvalue);
				$kelipatan=$row['kelipatan'];
				$kelipatan_f = number_format($kelipatan);
				$jambuka = $row['jambuka'];
				$jamtutup = $row['jamtutup'];
				$timestamp_jambuka = strtotime($jambuka);
				$timestamp_jamtutup = strtotime($jamtutup);
				$deskripsi_jambuka= get_time_ago( $timestamp_jambuka );
				$deskripsi_jamtutup = get_time_forward( $timestamp_jamtutup );


				$print .="\nNama Produk :".$productname;
				$print .="\nKode Produk :".$productcode;
				$print .="\nDesc :".$productdesc;
				$print .="\nHarga Awal : Rp *".$startvalue_f."*";
				$print .="\nKelipatan Lelang : Rp *".$kelipatan_f."*";
				$print .="\nJam Buka :".$jambuka;
				$print .="\nJam Tutup :".$jamtutup;
				$print .="\nLelang dibuka sejak ".$deskripsi_jambuka;
				$print .="\nLelang akan ditutup ".$deskripsi_jamtutup;
				$print .="\n";
				$print .="\nKetik *BID ".$productcode. "* untuk mengikuti lelang ini";
				$print .="\n";
			}


	$namafile="line 662 rekap_lelang_current function.php";
	$content = "<br>no = ".$no;
	insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);



	if ($no>=1) {
			$sql = "select * from `transaksi_lelang` where `botid`='$botid' and `pid`='$pid' and `isexpired`='0' and `iscancel`='0' order by id asc";		
			//echo "<br>sql = ".$sql;

			$namafile="line 672 rekap_lelang_current function.php";
			$content = "<br>sql = ".$sql;
			insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);


		$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$returnvalue="";
			$no2=0;
			$kumulatif_current_lelang_nominal = 0;
			foreach($conn->query($sql) as $row) {
				$no2=$no2+1;
				$sender_lelang=$row['sender'];

				$jumlah_char_sender = strlen($sender_lelang);
					//62813615669 12 huruf 
					$ambil_delapan_char_pertama=substr($sender_lelang, 0,9);
					$sensor_sender_lelang = $ambil_delapan_char_pertama;
					$jumlahh_disensor = ($jumlah_char_sender - 9);

					for ($xx=0;$xx<$jumlahh_disensor;$xx++) {
						$sensor_sender_lelang .= "X";
					}

				$nilaikelipatan=$row['nilaikelipatan'];
				$nilaikelipatan_f=number_format($nilaikelipatan);

				$trlelangdate=$row['trlelangdate'];
				$trlelangdate_F = ambil_format_hari($botid,$sender,$trlelangdate,$link);
				$timestamptrlelangdate = strtotime($trlelangdate);
				$along_time_ago = get_time_ago( $timestamptrlelangdate );

				$kumulatif_current_lelang_nominal = $kumulatif_current_lelang_nominal + $nilaikelipatan;
				$total_nilai_lelang = $startvalue + $kumulatif_current_lelang_nominal ;
				$total_nilai_lelang_f = number_format($total_nilai_lelang);

				$print .="\n".$no2.". _".$sensor_sender_lelang."_ Bid Rp ".$nilaikelipatan_f;
				$print .=" Harga update *Rp ".$total_nilai_lelang_f."*" ;
				$print .=" pada ".$trlelangdate_F;
				$print .=" ".$along_time_ago;

				
			}
		
			$print .="\n\n Harga akhir = Rp *".$total_nilai_lelang_f. "* Pemenang sementara oleh _".$sensor_sender_lelang."_";
			$saatini_d = ambil_format_hari($botid,$sender,$saatini,$link);
			$print .="\nUpdate pada ".$saatini_d;
			$print .="\n";
			$print .="\nLelang akan ditutup ".$deskripsi_jamtutup;
				$print .="\nKetik *BID ".$productcode. "* untuk mengikuti lelang ini";
				$print .="\n";
				


				//public statistik
				 $seckey = md5("s.".$pid.$pid);
                  $seckey=trim($seckey);
                  $public_link_display_key = substr($seckey,0,5);

				  $print .= "\nInformasi realtime lelang ini juga bisa diikuti di";
                   include("db.php");
                    $linkdisplay = "http://botlelang.com/botlelang/display_lelang.php?pid=".$pid."&key=".$public_link_display_key;
                    $print .= "\n".$linkdisplay;

			//update rekap
			$sql_update = "update `msproduct` 
			set `currentprice`='$total_nilai_lelang',
			`currentwinner`='$sender_lelang'  
			where `pid`='$pid' ";
			//echo "<br>sql_update = ".$sql_update;
			
			$namafile="line 720 rekap_lelang_current function.php";
			$content = "<br>sql_update = ".$sql_update;
			insert_trace_log($botid,$sender,$namafile,$content,$saatini,$link);

			$query = mysqli_query($link,$sql_update)or die ('gagal insert data function 79'.mysqli_error($link));
			return $print;
	} // end if $no>1	

	if ($no<=0) {
		$print = "Belum ada data lelang saat ini ";
		return $print;
	}

}

function get_time_forward( $time )
{
    $time_difference = $time - time() ;

    if( $time_difference < 1 ) { return 'lebih kurang sedetik yang lalu'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'tahun',
                30 * 24 * 60 * 60       =>  'bulan',
                24 * 60 * 60            =>  'hari',
                60 * 60                 =>  'jam',
                60                      =>  'menit',
                1                       =>  'detik'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'sekitar ' . $t . ' ' . $str . ( $t > 1 ? '' : '' ) . ' lagi';
        }
    }
}



function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'lebih kurang sedetik yang lalu'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'tahun',
                30 * 24 * 60 * 60       =>  'bulan',
                24 * 60 * 60            =>  'hari',
                60 * 60                 =>  'jam',
                60                      =>  'menit',
                1                       =>  'detik'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'sekitar ' . $t . ' ' . $str . ( $t > 1 ? '' : '' ) . ' lalu';
        }
    }
}


function sendfile_fonntebaru($phone,$type,$urlfile,$caption,$token_fonnte) {
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://hp.fonnte.com/api/send_message.php",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => array('phone' => $phone,'type' => $type,'url' => $urlfile,'caption' => $caption,'delay' => '0','delay_req' => '0','schedule' => '0'),
		CURLOPT_HTTPHEADER => array(
		  "Authorization: ".$token_fonnte. ""
		),
	  ));
	  $response = curl_exec($curl);
	  curl_close($curl);
	  return $response;
 
}


function kirimPesan_padafunction($phone, $data, $Token_Fonnte) {
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://hp.fonnte.com/api/send_message.php",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array(
	    'phone' => $phone,
	    'type' => $data['type'],
	    'text' => $data['pesan'],
	    'caption' => $data['pesan'],
	    'url' => (($data['type'] == "text") ? "" : $data['url_file']),
	    'delay' => '1',
	    'schedule' => '0'),
	  CURLOPT_HTTPHEADER => array(
	    "Authorization: $Token_Fonnte"
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	echo $response;
	return $response;
}



?>