<?php
include("db.php");
include("sessionclient.php");
include("saatini.php");
include("function_botlelang.php");
include("fonnte/function_fonnte_lelang.php");
include("fonnte/settings.php");


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

$catatan="";
$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

if ($mode=="") {
	$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
}


$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$semua = isset($_POST['semua']) ? $_POST['semua'] : '';
$semua = str_replace("/","",$semua);
$semua = str_replace("&","dan",$semua);

$semua = nl2br($semua);
$garisbaru = substr_count( $semua, "\n" );

$conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);

$stmt = $conn->prepare('SELECT * FROM `msbot` WHERE `botid` = ?');
$stmt->bindParam(1, $botid);
$stmt->execute();

$rt = 0;
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $rt=$rt+1;
    $jambuka=$row['jambuka'];
    $jamtutup = $row['jamtutup'];
    $kelipatan = $row['kelipatan'];
    $startvalue = $row['startvalue'];
	$isactive = $row['isactive'];

	$default_jambuka =  $jambuka;
	$default_jamtutup = $jamtutup ;
	$urlimage1="";
				
	 if ($isactive==1) {
         $ket_active="<font color='green'><b>Lelang dalam keadaan AKTIF</b></font>";
     }
     if ($isactive==0) {
       $ket_active="<font color='red'><b>Lelang dalam keadaan TIDAK AKTIF</b></font>";
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

<h1>Entry Data LELANG</h1>

<?php echo $ket_active?>
<br>Dibawah ini adalah contoh data yang harus diformat, harus sesuai format.
<br>
<?php

if ($mode=="") {
?><pre>
Daftar Produk
A Mix 40 Ekor Asagi 11--14 cm Rata 12- 13 cm.
B Chagoi Tembaga 35 cm/ betina.
C Asagi 30 cm/ betina.
D Tategoi Shiro 33 cm/ betina.
E Showa 38 cm/ betina
F Chagoi Tembaga 35 cm/ betina.
G Thanco Showa 32 cm/ betina.
H Showa 31 cm/ betina.
I Chagoi Tembaga 35 cm/ jantan.
J Tategoi Shiro 32 cm/ betina.
k Showa 34 cm/ betina.
L Chagoi Tembaga 36 cm/ jantan.
M Shiro 34 cm/ betina.
N Chagoi Tembaga 37 cm/ betina.
O Showa Strong Jumbo 46 cm/ jantan/ Bola Matanya besar sebelah
</pre>
<?php
}

if ($mode=="insert") {
	//echo "<br>garisbaru<br>".$garisbaru;
	//echo "<br>semua<br>".$semua;
	$pieces_product = explode("\n", $semua);

	$bolehlanjutproses=0;
	for ($i=0;$i<=$garisbaru;$i++) {

		//echo "<br>pieces_product ke ".$i." = ".$pieces_product[$i]."<br>";


    if ($i==0) {
    	//	echo "<br>line 128 . pieces_product ke ".$i." = ".$pieces_product[$i]."<br>";
			$required_word="Daftar Produk";
        	if (strpos($pieces_product[0], $required_word) !== false)
			 {
				  $bolehlanjutproses=1;
			}
			else {
				$bolehlanjutproses=0;
				echo "<br>Tidak Memenuhi syarat ";
				echo "<br>Data paling atas harus tertulis Daftar Produk";
				break;
			}
		}

		if ($i==1 && $bolehlanjutproses==1) {
			$check_baris_kedua_character = substr($pieces_product[1],0,1);
			$check_baris_kedua_character = strtoupper($check_baris_kedua_character);
	//		echo "<br> line 116 karaker pertama baris ".$i." = ".$check_baris_kedua_character;
			if ($check_baris_kedua_character !="A") {
				 echo "<br>Tidak Memenuhi syarat ";
				  echo "<br>Data pertama harus berkode A";
				  $bolehlanjutproses=0;
				  break;
			}
			else {
				$bolehlanjutproses=1;
				
			}
		}

//	  echo "<br> line 127 bolehlanjutproses ke ".$i." = ".$bolehlanjutproses;




		if ($i==0  && $bolehlanjutproses==1) {
			$required_word="Daftar Produk";
        	if ($bolehlanjutproses==1)
			 {
				echo "<br>Memenuhi syarat !";
				//echo "<br>Karena data ".$i." pertama = ~".$pieces_product[0]."~";
				$sql_delete="truncate table `msproduct` ";
						$query = mysqli_query($link,$sql_delete)or die ('gagal truncate data'.mysqli_error($link));

				$sql_delete="truncate table `transaksi_lelang` ";
						$query = mysqli_query($link,$sql_delete)or die ('gagal truncate data'.mysqli_error($link));	

						//echo "<br>sql_delete ! = ".$sql_delete;	
			}
			else {
				echo "<br>Tidak Memenuhi syarat ";
				echo "<br>Data paling atas harus tertulis Daftar Produk";
				$bolehlanjutproses=0;
			}
		}


		
		$product=$pieces_product[$i];
		$productname = $product;
		$productdesc = $product;
		$productcode=substr($product,0,1); 

		$productname=trim($productname);
		$productdesc= strip_tags($productdesc);
		$productname=strip_tags($productname);
		$productname= str_replace(".","",$productname);
		$productname= str_replace("\n","",$productname);
		$productname= str_replace("\r","",$productname);
		$productname= str_replace('\n','',$productname);
		$productname= str_replace('\r','',$productname);
		$productname= str_replace('/','',$productname);
					

		//echo "<br>product = ".$product;

			if ( strlen($productname)>=6 && $i>=1 ) {
					   
					   //truncate data


						$isupcoming='1';
					   $stmt = mysqli_prepare($link, "INSERT INTO msproduct (productname, botid, urlimage1, productcode, productdesc, jambuka, jamtutup, isupcoming, kelipatan, startvalue, regdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					mysqli_stmt_bind_param($stmt, 'sssssssssss', $productname, $botid, $urlimage1, $productcode, $productdesc, $default_jambuka, $default_jamtutup, $isupcoming, $kelipatan, $startvalue, $saatini);
					mysqli_stmt_execute($stmt);


			}
	}

}


if ($mode=="insert" && $bolehlanjutproses==0) {

		?>
				<meta http-equiv="refresh"  content="3; url=entry_data.php">
		<?php
}

if ($mode=="insert" && $bolehlanjutproses==1) {

		?>
		<pre><?php echo trim($semua)?>
		</pre>

			<meta http-equiv="refresh"  content="3; url=entry_product.php">
		<?php
}
?>

<form method="post">
<textarea name="semua" cols="80" rows="20"></textarea>

<input type="hidden" name="mode" value="insert">
<br>
<input type="submit" name="Insert">
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

  </body>

</html>