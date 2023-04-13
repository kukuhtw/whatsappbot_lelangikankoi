<?php
?>
<Style>
a.bg-primary {
  background-color: #000000;
  color: #ffffff;
  font-family: Verdana;
  font-size: 2rem;
}
</Style>
<br>Login user : <?php echo $sessionloginemailclient ?> : UserID : <?php echo $sessionloginuserid ?>
<br> 

<a href="scanQR.php"  class="bg-primary" >Scan QRCode</a> | 
<a href="check_wa_group.php"  class="bg-primary">Check Wa Group</a> | 
<a href="set_rule.php"  class="bg-primary">Setting Rule dan Rekening</a> | 
<a href="set_schedule.php"  class="bg-primary">Setting Jadwal Lelang</a> | 

<a href="entry_data.php"  class="bg-primary">Entry Data</a> | 

<a href="entry_product.php"  class="bg-primary">Product</a> | 

<a href="rekap_all_product.php"  class="bg-primary">Rekap Lelang</a> | 
<a href="rekap_detail_product.php"  class="bg-primary">Detail Lelang</a> | 
<a href="logout.php"  class="bg-primary">Log Out</a> |

<Br><br>