<?php

include("/var/www/html/botlelang_buanakoi/db.php");
include("db.php");
include("saatini.php");
include("fonnte/function_fonnte_lelang.php");
ini_set("error_log", "cronjob_aktivasi_lelang.txt");

/*
Ini Code Cronjob untuk aktivasi dan deaktivasi lelang

+===========================================+
: Aplikasi Whatsapp BotLelang dibuat oleh   :
: Kukuh TW                                  :
: kukuhtw@gmail.com                         :
: https://linktr.ee/kukuhtw                 :
: https://wa.me/628129893706                :
+===========================================+

*/


$sql = " select * from `msbot` where `botid`='1' ";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $no=0;
            foreach($conn->query($sql) as $row) {
                 $no=$no+1;
                  $jambuka=$row['jambuka'];
                  $jamtutup=$row['jamtutup'];

                $timestamp_jambuka = strtotime($jambuka);
                $timestamp_jamtutup = strtotime($jamtutup);
                $timestamp_sekarang = strtotime($saatini);

                $isactive=0;

                if ($timestamp_sekarang>=$timestamp_jambuka && $timestamp_sekarang<=$timestamp_jamtutup) {
                      $isactive = 1;
                }
                
                $sql_update = " update `msbot` 
                set `isactive`='$isactive' where `botid`='1' ";

                 echo "<Br>sql_update = ".$sql_update;
         $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));

            }

$sql = " select * from `msproduct` where `ishapus`='0' and `botid`='1' ";

 echo "<Br>sql = ".$sql;
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $conn = new PDO("mysql:host=$mySQLserver;dbname=$mySQLdefaultdb", $mySQLuser, $mySQLpassword);
            // set the PDO error mode to exception
             $allproductexpire=0;
            $no=0;
           
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            foreach($conn->query($sql) as $row) {
                  $no=$no+1;
                  $pid=$row['pid'];
                   $productname=$row['productname'];
                  $productdesc=$row['productdesc'];
                  $productcode=$row['productcode'];
                  $jambuka=$row['jambuka'];
                  $jamtutup=$row['jamtutup'];


				$timestamp_jambuka = strtotime($jambuka);
				$timestamp_jamtutup = strtotime($jamtutup);
				$timestamp_sekarang = strtotime($saatini);

                echo "<br>timestamp_sekarang = ".$timestamp_sekarang. " ".$saatini;
                echo "<br>timestamp_jamtutup = ".$timestamp_jamtutup. " ".$jamtutup;
                
				$isactive=0;
				if ($timestamp_sekarang>=$timestamp_jambuka && $timestamp_sekarang<=$timestamp_jamtutup) {
					  $isactive = 1;
				}
                else {
                      $isactive = 0;   
                     $allproductexpire= $allproductexpire+1;
                }


				$sql_update = " update `msproduct` 
				set `isactive`='$isactive' where `pid`='$pid' and `botid`='1' ";

				 echo "<Br>sql_update = ".$sql_update;
         $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));

             }

            if ($no==$allproductexpire) {
               $sql_update = " update `msbot` 
                set `isactive`='0' where `botid`='1' ";

                 echo "<Br>sql_update = ".$sql_update;
                $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));
          }   

          if ($no>$allproductexpire) {
               $sql_update = " update `msbot` 
                set `isactive`='1' where `botid`='1' ";

                 echo "<Br>sql_update = ".$sql_update;
                $query = mysqli_query($link,$sql_update)or die ('gagal update data'.mysqli_error($link));
          }   


$conn = null;
  $query = null;

?>