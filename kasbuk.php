<?php 
session_start();

if(!isset($_SESSION['nama']) && (!isset($_SESSION['password'])))
{
    //jika session belum di set/register
    $pesan = "ANDA BELUM LOGIN. SILAHKAN LOGIN DAHULU...!!!";
	echo "<script>alert('$pesan');location.href='login.php';</script>";
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">

<html lang=en xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Repeh Rapih Kertaraharja</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="Si Kasep (kulutuk8@yahoo.com)"> 
<meta name="description" content="Sistem Informasi Akuntansi">
<script language="javascript" src="js/cal2.js"></script>
<script language="javascript" src="js/cal_conf2.js"></script>
</head>

<?php 
require("inc/fungsi.php");
include_once('koneksi/inc.connect.php'); 
nocache;
$rek_blud = mysql_fetch_array(mysql_query("SELECT rekening from blud group by rekening"));

//Tanggal--------------------------------------------------------------------------------------------------------------------------------------------------
$tanggal = explode("/", $_REQUEST[tanggal2]);
if ($tanggal[1]=="01") {$bulanter2="Januari";} else if ($tanggal[1]=="02") {$bulanter2="Februari";} else if ($tanggal[1]=="03") {$bulanter2="Maret";} 
else if ($tanggal[1]=="04") {$bulanter2="April";}	else if ($tanggal[1]=="05") {$bulanter2="Mei";} else if ($tanggal[1]=="06") {$bulanter2="Juni";} 
else if ($tanggal[1]=="07") {$bulanter2="Juli";} else if ($tanggal[1]=="08") {$bulanter2="Agustus";} else if ($tanggal[1]=="09") {$bulanter2="September";} 
else if ($tanggal[1]=="10") {$bulanter2="Oktober";} else if ($tanggal[1]=="11") {$bulanter2="November";} else if ($tanggal[1]=="12") {$bulanter2="Desember";}
$tgl="$tanggal[0]-$tanggal[1]";
	
//Hapus Formasi
if ($HTTP_POST_VARS['hapus'])
	{
	$tujuan="index.php?pages=kasbuk&tanggal=$_REQUEST[tanggal]&bulan=$_REQUEST[bulan]&jenis=$_REQUEST[jenis]&rek=$_REQUEST[rek]";
	//ambil nilai
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++) 
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$id= nosql($_POST["$yuhu"]);
	
		//del
		mysql_query("DELETE FROM kasbuk ".
						"WHERE id = '$id'");
		}

	//auto-kembali
	xloc($tujuan);
	}
if ($_POST[TAMBAH])
{
//Cari JIka Tanggal Ganda
$qcc = mysql_query("SELECT tanggal FROM kasbuk WHERE tanggal = '$_POST[tanggal]' and jenis='$_POST[jenis2]'");
$rcc = mysql_fetch_assoc($qcc);
$tcc = mysql_num_rows($qcc);

if ($tcc != 0)
			{
			$pesan = "Maaf, Tanggal $_POST[tanggal], Sudah digunakan";
			echo "<script>alert('$pesan');history.back();</script>";
			}
else {
$qr_masukan="INSERT INTO kasbuk (`tanggal` ,`jenis` ,`jumlah`)					
			 VALUES('$_POST[tanggal]','$_POST[jenis2]','$_POST[jumlah]');";
$qr_jalankan=mysql_query($qr_masukan,$connect);
			if ($qr_jalankan)
			{
			 echo "<script>location.href='index.php?pages=kasbuk&tanggal=$_REQUEST[tgl3]&bulan=$_REQUEST[bulan]&jenis=$_REQUEST[jenis]&rek=$_REQUEST[rek]'</script>";			 
			}
			else
			{
			 echo "Data tidak bisa masuk database, Hubungi Administrator</b><br>".mysql_error();
			 echo "<br><br>";
			}
	exit;
	}
}

if ($_POST[UBAH])
{
$qr_ubah="update kasbuk set `tanggal`='$_POST[tanggal]', `jenis`='$_POST[jenis2]', `jumlah`='$_POST[jumlah]' Where id='$_POST[id]';";
$qr_jalankan=mysql_query($qr_ubah,$connect);
			if ($qr_jalankan)
			{
			 $pesan="Data Kas daerah berhasil diubah";
			 echo "<script>alert('$pesan');location.href='index.php?pages=kasbuk&tanggal=$_REQUEST[tgl3]&bulan=$_REQUEST[bulan]&jenis=$_REQUEST[jenis]&rek=$_REQUEST[rek]'</script>";			 
			}
			else
			{
			 echo "Data tidak Bisa Diubah, Hubungi Administrator</b><br>".mysql_error();
			 echo "<br><br>";
			}
	exit;
}

  ?> 
<body text="#000000" leftmargin="0" topmargin="0" onLoad="document.formx.angka.focus();">
<div align="center"> 
<table width="100%" border="0" cellspacing="0" cellpadding="3">
</table>
<form action="<?php echo"index.php?pages=kasbuk&tanggal=$_REQUEST[tanggal]&bulan=$_REQUEST[bulan]&jenis=$_REQUEST[jenis]&rek=$_REQUEST[rek]";?>" method="post" name="formx"><p>
<div align="left">
<?php if ($_REQUEST[perintah]=="") {?>
Bulan :   <a href="javascript:showCal('Calendar3')"></a>
   
<select name="tgl" onChange="MM_jumpMenu('self',this,0)">
  <option><?php echo"$_REQUEST[bulan]";?></option>
  <option value="index.php?pages=kasbuk&tanggal=01&bulan=JANUARI">JANUARI</option>
  <option value="index.php?pages=kasbuk&tanggal=02&bulan=FEBRUARI">FEBRUARI</option>
  <option value="index.php?pages=kasbuk&tanggal=03&bulan=MARET">MARET</option>
  <option value="index.php?pages=kasbuk&tanggal=04&bulan=APRIL">APRIL</option>
  <option value="index.php?pages=kasbuk&tanggal=05&bulan=MEI">MEI</option>
  <option value="index.php?pages=kasbuk&tanggal=06&bulan=JUNI">JUNI</option>
  <option value="index.php?pages=kasbuk&tanggal=07&bulan=JULI">JULI</option>
  <option value="index.php?pages=kasbuk&tanggal=08&bulan=AGUSTUS">AGUSTUS</option>
  <option value="index.php?pages=kasbuk&tanggal=09&bulan=SEPTEMBER">SEPTEMBER</option>
  <option value="index.php?pages=kasbuk&tanggal=10&bulan=OKTOBER">OKTOBER</option>
  <option value="index.php?pages=kasbuk&tanggal=11&bulan=NOVEMBER">NOVEMBER</option>
  <option value="index.php?pages=kasbuk&tanggal=12&bulan=DESEMBER">DESEMBER</option>
</select> 
Jenis : 
<select name="jen" onChange="MM_jumpMenu('self',this,0)">
  <option><?php echo"$_REQUEST[jenis]";?></option>
  <option value="<?php echo"index.php?pages=kasbuk&tanggal=$_REQUEST[tanggal]&bulan=$_REQUEST[bulan]&jenis=PENDAPATAN&rek=4";?>">PENDAPATAN</option>
  <option value="<?php echo"index.php?pages=kasbuk&tanggal=$_REQUEST[tanggal]&bulan=$_REQUEST[bulan]&jenis=BELANJA&rek=5";?>">BELANJA</option>
</select>
<?php } else {?>

Tanggal :
<input name="tanggal" type="text" size="10" value="<?php echo"$_REQUEST[tanggal2]";?>">
<a href="javascript:showCal('Calendar4')"><img src="images/calendar.jpg" width="16" height="15"></a>
<input name="jenis2" type="hidden" value="<?php echo"$_REQUEST[rek]";?>" size="10" readonly="true"> 
Jumlah : 
<input type="text" name="jumlah" value="<?php echo"$_REQUEST[jumlah]";?>">
<input type="hidden" name="tgl3" value="<?php echo"$_REQUEST[tanggal]";?>">
<input type="hidden" name="rek" value="<?php echo"$_REQUEST[rek]";?>">
<input type="hidden" name="bulan" value="<?php echo"$_REQUEST[bulan]";?>">
<input type="hidden" name="jenis" value="<?php echo"$_REQUEST[jenis]";?>">
<input type="hidden" name="id" size="10" value="<?php echo"$_REQUEST[id]";?>">
<input type="submit" name="<?php echo"$_REQUEST[perintah]";?>" value="<?php echo"$_REQUEST[perintah]";?>">
<input type="button" name="Submit3" value="BATAL" onClick="self.location='<?php echo"index.php?pages=kasbuk&tanggal=$_REQUEST[tanggal]&bulan=$_REQUEST[bulan]&jenis=$_REQUEST[jenis]&rek=$_REQUEST[rek]";?>'">
<?php } ?>
</div>
</p>
</p>

<?php
//query
$q = mysql_query("SELECT * FROM kasbuk where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and jenis like '$_REQUEST[rek]' order by tanggal");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);
?>
<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="#E5AB1F">
  <td colspan="7" align="center" background="images/menuline.png"><strong><strong>TABEL PENCOCOKAN KAS </strong></td>
</tr>
<tr valign="top" bgcolor="#E5AB1F">
<td width="1%">&nbsp;</td>
<td width="1%">&nbsp;</td>
<td><strong>TANGGAL</strong></td>
<td><strong>REK KORAN </strong></td>
<td><strong>REALISASI</strong></td>
<td><strong><?php if ($_REQUEST[rek]=="4") {echo"BLUD";} else if ($_REQUEST[rek]=="5") {echo"POTONGAN";} ?></strong></td>
<td><strong>SELISIH</strong></td>
</tr>
<?php 
$warna01="#F8F8F8";
$warna02="#FDF0DE";
if ($total != 0)
	{
	do 
		{ 
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}
			
		$nomer = $nomer + 1;
		//------------------------------------POTONGAN BELANJA------------------------------------------------------------------------
		
	$jumlah_ppn = mysql_result(mysql_query("SELECT sum(ppn) as Num FROM transaksi_belanja where tanggal like '$row[tanggal]'"),0);
	$jumlah_pph21 = mysql_result(mysql_query("SELECT sum(pph21) as Num FROM transaksi_belanja where tanggal like '$row[tanggal]'"),0);
	$jumlah_pph22 = mysql_result(mysql_query("SELECT sum(pph22) as Num FROM transaksi_belanja where tanggal like '$row[tanggal]'"),0);
	$jumlah_pph23 = mysql_result(mysql_query("SELECT sum(pph23) as Num FROM transaksi_belanja where tanggal like '$row[tanggal]'"),0);
	$jumlah_iwp= mysql_result(mysql_query("SELECT sum(iwp) as Num FROM transaksi_belanja where tanggal like '$row[tanggal]'"),0);
	$jumlah_tabperum = mysql_result(mysql_query("SELECT sum(tabperum) as Num FROM transaksi_belanja where tanggal like '$row[tanggal]'"),0); 
	$jumlah_pot=$jumlah_ppn + $jumlah_pph21 + $jumlah_pph22 + $jumlah_pph23 + $jumlah_iwp + $jumlah_tabperum;

		//---------------------------------------------------------------------------------------------------------------------------
		$kd = nosql($row['id']);
		$kasbuk=number_format($row[jumlah],2,",",".");
		$jum_blud = mysql_result(mysql_query("select sum(debet) from transaksi where tanggal like '$row[tanggal]' and rekening like '$rek_blud[rekening]'"),0);
		$pendapatan = mysql_result(mysql_query("select sum(debet) from transaksi where tanggal like '$row[tanggal]'"),0);
	if ($row[jenis]=="4"){$real = $pendapatan - $jum_blud;}
	else if ($row[jenis]=="5"){$real = mysql_result(mysql_query("select sum(kredit) from transaksi_belanja where tanggal like '$row[tanggal]'"),0);}
		$realisasi=number_format($real,2,",",".");		
		$jumlah_blud=number_format($jum_blud,2,",",".");
		if ($_REQUEST[rek]=="4") {$blud=number_format($jum_blud,2,",","."); $sel=$real-$row[jumlah]; } 
		else if ($_REQUEST[rek]=="5"){$blud=number_format($jumlah_pot,2,",","."); $sel=$real+$jumlah_pot-$row[jumlah]; }
		$selisih=number_format($sel,2,",",".");
		
//---------------------------QUERY TABEL-------------------------------------------------------------------------------------------------------				
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='#ffddbb';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td> 
		<input type="checkbox" name="item'.$nomer.'" value="'.$kd.'">
        </td>
		<td>
		<a href="index.php?pages=kasbuk&id='.$row['id'].'&tanggal='.$row['tanggal'].'&tanggal2='.$row['tanggal'].'&rek='.$row['jenis'].'&jumlah='.$row['jumlah'].'&tanggal='.$_REQUEST[tanggal].'&bulan='.$_REQUEST[bulan].'&jenis='.$_REQUEST[jenis].'&perintah=UBAH">
		<img src="images/edit.gif" width="16" height="16" border="0" title="Ubah data">
		</a>
		</td>
		<td align="left">'.$row['tanggal'].'</td>
		<td align="right">'.$kasbuk.'</td>
		<td align="right">'.$realisasi.'</td>
		<td align="right">'.$blud.'</td>
		<td align="right">'.$selisih.'</td>
        </tr>';	
		} 
	while ($row = mysql_fetch_assoc($q)); 
	}
//-----------------------------------------------------JUMLAH TOTAL PENDAPATAN KESELURUHAN--------------------------------------------------
	if ($_REQUEST[rek]=="4") 
	{ 
	//---------------------------Jumlah Bulan ini-----------------------------------------------------------------------------------------
	$kasbuk_bln = mysql_result(mysql_query("SELECT sum(jumlah) as Num FROM kasbuk where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and jenis like '$_REQUEST[rek]'"),0);
	$blud_bln = mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and rekening like'$rek_blud[rekening]'"),0);
	$real_bln = mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0)-$blud_bln; 
	$selisih_bln=$real_bln - $kasbuk_bln; 
	
	if($_SESSION[tahun_anggaran]=='2018'){
	//---------------------------Jumlah Bulan Lalu 2018-----------------------------------------------------------------------------------------	
	$kasbuk_bln_lalu = mysql_result(mysql_query("SELECT sum(jumlah) as Num FROM kasbuk where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and jenis like '$_REQUEST[rek]'"),0) - '3027716733';
	$blud_bln_lalu = mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and rekening like'$rek_blud[rekening]'"),0);
	$real_bln_lalu = mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0)-$blud_bln_lalu;
	$selisih_bln_lalu=$real_bln_lalu - $kasbuk_bln_lalu;

	//---------------------------Jumlah Sampai Dengan Bulan ini 2018-----------------------------------------------------------------------------
	$kasbuk_bln_ini=$kasbuk_bln+$kasbuk_bln_lalu;
	$real_bln_ini=$real_bln+$real_bln_lalu;
	$blud_bln_ini=$blud_bln+$blud_bln_lalu;
	$selisih_bln_ini=$real_bln_ini - $kasbuk_bln_ini;
	}
	else{
	//---------------------------Jumlah Bulan Lalu-----------------------------------------------------------------------------------------	
	$kasbuk_bln_lalu = mysql_result(mysql_query("SELECT sum(jumlah) as Num FROM kasbuk where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and jenis like '$_REQUEST[rek]'"),0);
	$blud_bln_lalu = mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and rekening like'$rek_blud[rekening]'"),0);
	$real_bln_lalu = mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0)-$blud_bln_lalu;
	$selisih_bln_lalu=$real_bln_lalu - $kasbuk_bln_lalu;

	//---------------------------Jumlah Sampai Dengan Bulan ini-----------------------------------------------------------------------------
	$kasbuk_bln_ini=$kasbuk_bln+$kasbuk_bln_lalu;
	$real_bln_ini=$real_bln+$real_bln_lalu;
	$blud_bln_ini=$blud_bln+$blud_bln_lalu;
	$selisih_bln_ini=$real_bln_ini - $kasbuk_bln_ini;
	}
	}
//-----------------------------------------------------JUMLAH TOTAL BELANJA KESELURUHAN--------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------
	else if ($_REQUEST[rek]=="5") 
	{ 
	//Bulan ini----------------------------------------Bulan ini-----------------------------------------------------------
	$ppn_bln = mysql_result(mysql_query("SELECT sum(ppn) as Num FROM transaksi_belanja where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$pph21_bln = mysql_result(mysql_query("SELECT sum(pph21) as Num FROM transaksi_belanja where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$pph22_bln = mysql_result(mysql_query("SELECT sum(pph22) as Num FROM transaksi_belanja where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$pph23_bln = mysql_result(mysql_query("SELECT sum(pph23) as Num FROM transaksi_belanja where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$iwp_bln= mysql_result(mysql_query("SELECT sum(iwp) as Num FROM transaksi_belanja where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$tabperum_bln = mysql_result(mysql_query("SELECT sum(tabperum) as Num FROM transaksi_belanja where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0); 
	$pot_bln=$ppn_bln + $pph21_bln + $pph22_bln + $pph23_bln + $iwp_bln + $tabperum_bln;

	$kasbuk_bln = mysql_result(mysql_query("SELECT sum(jumlah) as Num FROM kasbuk where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and jenis like '$_REQUEST[rek]'"),0);
	$real_bln = mysql_result(mysql_query("SELECT sum(kredit) as Num FROM transaksi_belanja where tanggal like '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0); 
	$blud_bln = $pot_bln;
	$selisih_bln=$real_bln + $pot_bln - $kasbuk_bln; 
	
	//--------------------------------------------------Bulan Lalu--------------------------------------------------------------
	$ppn_bln_lalu = mysql_result(mysql_query("SELECT sum(ppn) as Num FROM transaksi_belanja where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$pph21_bln_lalu = mysql_result(mysql_query("SELECT sum(pph21) as Num FROM transaksi_belanja where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$pph22_bln_lalu = mysql_result(mysql_query("SELECT sum(pph22) as Num FROM transaksi_belanja where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$pph23_bln_lalu = mysql_result(mysql_query("SELECT sum(pph23) as Num FROM transaksi_belanja where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$iwp_bln_lalu = mysql_result(mysql_query("SELECT sum(iwp) as Num FROM transaksi_belanja where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$tabperum_bln_lalu = mysql_result(mysql_query("SELECT sum(tabperum) as Num FROM transaksi_belanja where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0); 
	$pot_bln_lalu=$ppn_bln_lalu + $pph21_bln_lalu + $pph22_bln_lalu + $pph23_bln_lalu + $iwp_bln_lalu + $tabperum_bln_lalu;
	
	$kasbuk_bln_lalu = mysql_result(mysql_query("SELECT sum(jumlah) as Num FROM kasbuk where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%' and jenis like '$_REQUEST[rek]'"),0);
	$real_bln_lalu = mysql_result(mysql_query("SELECT sum(kredit) as Num FROM transaksi_belanja where tanggal < '$_SESSION[tahun_anggaran]-$_REQUEST[tanggal]%'"),0);
	$blud_bln_lalu = $pot_bln_lalu;
	$selisih_bln_lalu=$real_bln_lalu + $pot_bln_lalu - $kasbuk_bln_lalu;
	
	//---------------------------------------------------Sampai Dengan Bulan ini-----------------------------------------------
	$kasbuk_bln_ini=$kasbuk_bln+$kasbuk_bln_lalu;
	$real_bln_ini=$real_bln+$real_bln_lalu;
	$blud_bln_ini=$pot_bln+$pot_bln_lalu;
	$selisih_bln_ini=$real_bln_ini + $blud_bln_ini - $kasbuk_bln_ini;
	}	
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------Jumlah Keseluruhan-------------------------------------------------------------------
	$kasbuk_bulan=number_format($kasbuk_bln,2,".",",");
	$real_bulan=number_format($real_bln,2,".",",");
	$blud_bulan=number_format($blud_bln,2,".",",");
	$selisih_bulan=number_format($selisih_bln,2,".",",");
	
	$kasbuk_bulan_lalu=number_format($kasbuk_bln_lalu,2,".",",");
	$real_bulan_lalu=number_format($real_bln_lalu,2,".",",");
	$blud_bulan_lalu=number_format($blud_bln_lalu,2,".",",");
	$selisih_bulan_lalu=number_format($selisih_bln_lalu,2,".",",");
	
	$kasbuk_bulan_ini=number_format($kasbuk_bln_ini,2,".",",");
	$real_bulan_ini=number_format($real_bln_ini,2,".",",");
	$blud_bulan_ini=number_format($blud_bln_ini,2,".",",");
	$selisih_bulan_ini=number_format($selisih_bln_ini,2,".",",");
	?>
	<tr valign="top" bgcolor="#E5AB1F">
	<td colspan="3" align="center" background="images/menuline.png"><div align="right"><strong><font color="black">JUMLAH BULAN <?PHP ECHO"$_REQUEST[bulan]";?></font></strong></div></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$kasbuk_bulan";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$real_bulan";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$blud_bulan";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="#FF0000"><?php echo"$selisih_bulan";?></font></strong></td>
	</tr>
	<tr valign="top" bgcolor="#E5AB1F">
	<td colspan="3" align="center" background="images/menuline.png"><div align="right"><strong><font color="black">JUMLAH S/D BULAN LALU </font></strong></div></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$kasbuk_bulan_lalu";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$real_bulan_lalu";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$blud_bulan_lalu";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="#FF0000"><?php echo"$selisih_bulan_lalu";?></font></strong></td>
	</tr>
	<tr valign="top" bgcolor="#E5AB1F">
	<td colspan="3" align="center" background="images/menuline.png"><div align="right"><strong><font color="black">JUMLAH S/D SAAT INI </font></strong></div></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$kasbuk_bulan_ini";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$real_bulan_ini";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="black"><?php echo"$blud_bulan_ini";?></font></strong></td>
	<td align="right" background="images/menuline.png"><strong><font color="#FF0000"><?php echo"$selisih_bulan_ini";?></font></strong></td>
	</tr>
	<?php if (empty($_REQUEST[tanggal])) {echo"";} else {  ?>
	<tr valign="top" bgcolor="#E5AB1F">
	<td colspan="7" align="center" background="images/menuline.png">
	<a href="<?php echo"index.php?pages=kasbuk&tanggal=$_REQUEST[tanggal]&rek=$_REQUEST[rek]&bulan=$_REQUEST[bulan]&jenis=$_REQUEST[jenis]&perintah=TAMBAH";?>">
	<img src="images/bluetambah.gif" width="104" height="26" border="0"></a></td>
	</tr>
	<?php }
echo '</table>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr> 
<td width="263" align="left">
<input name="jml" type="hidden" value="'.$total.'"> 
<input name="s" type="hidden" value="'.$s.'"> 
<input name="kd" type="hidden" value="'.$kdx.'"> 
<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$total.')"> 
<input name="btnBTL" type="button" value="BATAL" onClick="uncheckAll('.$total.')"> 
<input name="hapus" type="submit" value="HAPUS"> 
</td>
<td align="right">Total : <strong><font color="#FF0000">'.$total.'</font></strong> Data.</td>
</tr>
</table>
<tr><td>

</td></tr>';
?>


</td>
    </tr>
</table>
  
</form>
</div>
<SCRIPT LANGUAGE="JavaScript">
function checkAll(x) 
	{
	for (var j = 1; j <= x; j++) 
		{
		box = eval("document.formx.item" + j); 
		if (box.checked == false) box.checked = true;
		}
	}
function uncheckAll(x) 
	{
	for (var j = 1; j <= x; j++) 
		{
		box = eval("document.formx.item" + j); 
		if (box.checked == true) box.checked = false;
	   }
	}
</script>

</body>

</html>
