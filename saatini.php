<?php
date_default_timezone_set("Asia/Jakarta");
$tanggalhariini = date("Y-m-d");
$tanggalhariini = str_replace("/","-",$tanggalhariini);
$jamhariini = date("H:i:sa");
$jamhariini = str_replace("pm","",$jamhariini);
$jamhariini = str_replace("am","",$jamhariini);
$saatini = $tanggalhariini. " ".$jamhariini;
$saatini_tanpaampm = str_replace("am", "", $saatini);
$saatini_tanpaampm = str_replace("pm", "", $saatini_tanpaampm);
$saatini = $saatini_tanpaampm;

?>