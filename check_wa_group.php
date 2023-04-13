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
untuk chek ID Whatsapp group

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/

$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

if ($mode=="") {
	$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
}

//echo "<br>mode = ".$mode;


if ($mode=="editwagroupname") {
	$wagroupname = isset($_POST['wagroupname']) ? $_POST['wagroupname'] : '';
	$invite_link = isset($_POST['invite_link']) ? $_POST['invite_link'] : '';
	$id = isset($_POST['id']) ? $_POST['id'] : '';

	$stmt = mysqli_prepare($link, "update `bot_wagroup` set `wagroupname`=? ,`invite_link`=? where `id`=?");
	mysqli_stmt_bind_param($stmt, "ssi", $wagroupname, $invite_link,$id);

	//echo "<br>wagroupname = ".$wagroupname;
	//echo "<br>id = ".$id;
//echo "<br>invite_link = ".$invite_link;


	mysqli_stmt_execute($stmt);
	$query = mysqli_stmt_get_result($stmt);

}            

	$confirmdelete = isset($_POST['confirmdelete']) ? $_POST['confirmdelete'] : '';
	$confirmdelete = trim($confirmdelete);

//echo "<br>mode = ".$mode;
	
	//echo "<br>confirmdelete = ".$confirmdelete;
	
if ($mode=="DELETE" && $confirmdelete=="DELETE" ) {
	$wagroupname = isset($_POST['wagroupname']) ? $_POST['wagroupname'] : '';
	$id = isset($_POST['id']) ? $_POST['id'] : '';

	//echo "<br>wagroupname = ".$wagroupname;
	//echo "<br>id = ".$id;
	//echo "<br>confirmdelete = ".$confirmdelete;

		// Prepare a DELETE statement
		$sql_delete = "DELETE FROM `bot_wagroup` WHERE `id` = ?";
		$stmt = mysqli_prepare($link, $sql_delete);

		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "i", $id);

		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
		    // Record deleted successfully
		} else{
		    die ('gagal delete data'.mysqli_error($link));
		}


}     

if ($mode=="Tambah") {
		$wagroupname = isset($_POST['wagroupname']) ? $_POST['wagroupname'] : '';
		$wagroupid = isset($_POST['wagroupid']) ? $_POST['wagroupid'] : '';
		$wagroupid=trim($wagroupid);
		$wagroupname=trim($wagroupname);



		$response = check_wa_group($Token_Fonnte);
			$json = json_decode($response,true);
			$jumlah_data = count($json["data"]);

        	//echo "<br>jumlah_data = ".$jumlah_data;
			$bolehproses=0;
  	for ($i=0;$i<$jumlah_data;$i++) {
        		$idgroup = $json["data"][$i]["id"];
        		$name = $json["data"][$i]["name"];
        		//echo "<br>";
        		//e/cho "<br>ID = ".$id;
        		//echo "<br>name = ".$name;
        		//echo "<br>";
        		if ($wagroupid==$idgroup) {
							$bolehproses=1;
							break;
        		}
        	}



 	 $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("SELECT COUNT(id) as total FROM bot_wagroup WHERE wagroupid = :wagroupid");
		$stmt->bindParam(':wagroupid', $wagroupid);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$total = $row['total'];

	//	echo "<br>Total = ".$total;

	if ($total == 0 && $bolehproses==1 ) {
		$stmt = $conn->prepare("INSERT INTO bot_wagroup (wagroupid, wagroupname) VALUES (:wagroupid, :wagroupname)");
		$stmt->bindParam(':wagroupid', $wagroupid);
		$stmt->bindParam(':wagroupname', $wagroupname);
		$stmt->execute();

		//echo "<br>insert berhasil !";
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


<html lang="en">
 <?php include("head_register.php") ?>
  <body class="bg-dark">
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header"></div>
        <div class="card-body">

	
<form method="POST">
<input type="hidden" name="mode" value="fetch_wa_group">
<input type="submit" name="" value="UPDATE WHATSAPP GROUP">
</form>
</h3>

		<h2>Daftar Whatsapp group !</h2>

        	<?php

if ($mode=="fetch_wa_group") {
	$response = fetch_wa_group($Token_Fonnte);
		//echo "<br>Response fetch_wa_group = ".$response;
	//echo "<br>Oke Sudah diupdate daftar Whatsapp Group Terbaru !";

}


        	$response = check_wa_group($Token_Fonnte);

        	//echo "<br><br>response check_wa_group = ".$response;


        	$json = json_decode($response,true);


	       	$jumlah_data = count($json["data"]);

        	//echo "<br>jumlah_data = ".$jumlah_data;


        	for ($i=0;$i<$jumlah_data;$i++) {
        		$id = $json["data"][$i]["id"];
        		$name = $json["data"][$i]["name"];
        		echo "<br>";
        		echo "<br>ID = ".$id;
        		echo "<br>name = ".$name;
        		echo "<br>";
        	}

        	

?>

<br>
<?php

 $html ="<br>";
     $html .="<table border='1' width='95%'>";
     $html .="<tr>";
     $html .="<td valign='top'>";
     $html .="WA Group ID";
     $html .="</td>";
     $html .="<td valign='top'>";
     $html .="Wa Group Name";
     $html .="</td>";
     $html .="<td valign='top'>";
     $html .="Delete";
      $html .="</td>";
     $html .="</tr>";


$sql = "select * from `bot_wagroup` 
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
                $id=$row['id'];
                  $wagroupid=$row['wagroupid'];
                   $wagroupname=$row['wagroupname'];
                    $invite_link=$row['invite_link'];

                     $html .="<tr>";
                      $html .="<form method='post'>";
								     $html .="<td valign='top'>";
								     $html .="".$wagroupid."";
								     $html .="</td>";
								     $html .="<td valign='top'>";
								     $html .="Wa Group Name";
								     $html .="<br>";
								     $html .="<input type='text' name='wagroupname' size='30' maxlength='112' value='".$wagroupname."' >";
								     $html .="<br>";
								     $html .="<br>Invite Link";
								     $html .="<br>";
								     $html .="<input type='text' name='invite_link' size='70' maxlength='412' value='".$invite_link."' >";
								     
								      $html .="<input type='hidden' name='mode' value='editwagroupname'>";
								     $html .="<input type='hidden' name='id' value='".$id."'>";
								     $html .="<br><br><input type='submit' value='Edit Wa Group Name dan Invite Link'>";
								      $html .="</form>";
								      $html .="<br>";
								      $html .="<br>";
								     $html .="</td>";
								      $html .="<form method='post'>";
								     $html .="<td valign='top'>";
								     $html .="To Delete this whatsapp group, Type DELETE below this";
								     $html .="<br>";
								     $html .="<input type='text' name='confirmdelete' size='12' maxlength='12' >";
											$html .="<br>";
								     	$html .="<input type='hidden' name='mode' value='DELETE'>";
								     $html .="<input type='hidden' name='id' value='".$id."'>";
								     $html .="<input type='submit' value='Delete'>";
								    
								      $html .="</td>";
								       $html .="</form>";
								     $html .="</tr>";


                 }

$html .="</table>";

echo $html;
?>

<form method="POST">
<br>Whatsapp group ID
<br><input type="text" name="wagroupid" maxlength="35" size="20">
<br>Whatsapp group Game
<br><input type="text" name="wagroupname" maxlength="135" size="20">

<input type="hidden" name="mode" value="Tambah">
<input type="submit" name="" value="Tambah">

</form>

<h3>
	
<form method="POST">
<input type="hidden" name="mode" value="fetch_wa_group">
<input type="submit" name="" value="UPDATE WHATSAPP GROUP">
</form>
</h3>

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
