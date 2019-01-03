<?php
require('fpdf/fpdf_landscape.php');
include_once('../koneksi/inc.connect.php'); 
class PDF extends FPDF
{
var $widths;
var $aligns;
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		if ($w < 20) 
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
		else if ($w > 20 and $w < 40) 
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
		else
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
// Page header
function Header()
{	
	if ($this->PageNo() == 1)
		{
		$this->SetFont('Times','B',12);		
		//JUDUL
		$pemda = mysql_fetch_array(mysql_query("SELECT * from data_umum.data_umum"));
		$this->Cell(275,5,'PEMERINTAH '.$pemda[nama_pemda].'',0,0,'C');
		$this->ln();
		$this->Cell(275,5,'DATA ANGGARAN',0,0,'C');
		$this->ln();
		$this->Cell(275,5,'BERDASARKAN REKENING',0,0,'C');
		$this->ln();
		$this->Cell(275,5,'SAMPAI DENGAN BULAN '.$_REQUEST[bulan].'',0,0,'C');
		$this->ln(10);
		}
   	// Arial bold 15
    $this->SetFont('Arial','B',8);
	$this->SetFillColor(240, 100, 100);
    // Title
	$this->Cell(20,10,'REKENING',1,0,'C');
	$this->Cell(80,10,'URAIAN',1,0,'C');
	$this->Cell(33,10,'APBD',1,0,'C');
	$this->Cell(33,10,'S/D BULAN LALU',1,0,'C');
	$this->Cell(33,10,'BULAN INI',1,0,'C');
	$this->Cell(33,10,'SD BULAN INI',1,0,'C');
	$this->Cell(33,10,'TAMBAH/KURANG',1,0,'C');
	$this->Cell(10,10,'(%)',1,0,'C');
    // Line break
    $this->Ln();
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
	$this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',8);
// sql query-----------------------------------
$sql_merk = "SELECT * FROM `kode_rek` where level < '2' and kode_rek like '4%' order by kode_rek";
$qr_merk  = mysql_query($sql_merk);
while($hs_merk=mysql_fetch_array($qr_merk))
	{
	$pdf->SetWidths(array(20,80,33,33,33,33,33,10));
	srand(microtime()*1000000);
	if ($_REQUEST[anggaran]=="APBD")
	{	$jumawal = mysql_result(mysql_query("SELECT sum(anggaran_awal) as Num FROM anggaran where rekening like '$hs_merk[kode_rek]%' "),0); }
	else if ($_REQUEST[anggaran]=="PERUBAHAN")
	{	$jumawal = mysql_result(mysql_query("SELECT sum(anggaran_perubahan) as Num FROM anggaran where rekening like '$hs_merk[kode_rek]%' "),0); }
	$jum_awal=number_format($jumawal,2,".",",");
	if($_REQUEST[tanggal] < 11){
	$tgl_lalu=$_REQUEST[tanggal]-1; $tgllalu="0$tgl_lalu";
	}else{
	$tgl_lalu=$_REQUEST[tanggal]-1; $tgllalu="$tgl_lalu";
	}
	if($_REQUEST[tanggal] < 11){
	$tgl_ini=$_REQUEST[tanggal]-1; $tglini="0$tgl_ini";
	}else{
	$tgl_ini=$_REQUEST[tanggal]-1; $tglini="$tgl_ini";
	}
	$jumrealisasilalu= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_merk[kode_rek]%' 
											 and rekening_skpd <> '' and tanggal < '$_REQUEST[tahun]-$tgllalu%'"),0);
	$jumrealisasiini= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_merk[kode_rek]%' 
											 and rekening_skpd <> '' and tanggal like '$_REQUEST[tahun]-$tglini%'"),0);
	$jumrealisasi= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_merk[kode_rek]%' 
											 and rekening_skpd <> '' and tanggal < '$_REQUEST[tahun]-$_REQUEST[tanggal]%'"),0); 
	//die($jumrealisasiini);
	$persentase=@($jumrealisasi/$jumawal * 100) ;
	$jum_realisasilalu=number_format($jumrealisasilalu,2,".",",");
	$jum_realisasiini=number_format($jumrealisasiini,2,".",",");
	$jum_realisasi=number_format($jumrealisasi,2,".",",");
	$persen=number_format($persentase,2,".",",");
	$selisih_beda=$jumawal-$jumrealisasi;
	$selisih=number_format($selisih_beda,2,".",",");
	$pdf->SetFont('Times','B',8);
	$pdf->Row(array(''.$hs_merk[kode_rek].'',''.$hs_merk[uraian].'',''.$jum_awal.'',''.$jum_realisasilalu.'',''.$jum_realisasiini.'',''.$jum_realisasi.'',''.$selisih.'',''.$persen.''));	
	
		//--------------------------------------------------QUERY RINCIAN LEVEL 2--------------------------------------------
		$sql_rinc = "SELECT * FROM `anggaran` where rekening2 like '$hs_merk[kode_rek]%' group by rekening2";
		$qr_rinc  = mysql_query($sql_rinc);
		while($hs_rinc=mysql_fetch_array($qr_rinc))
		{
		$uraian = mysql_fetch_array(mysql_query("SELECT uraian from kode_rek where kode_rek like '$hs_rinc[rekening2]'"));
		if ($_REQUEST[anggaran]=="APBD")
		{$jumawal2 = mysql_result(mysql_query("SELECT sum(anggaran_awal) as Num FROM anggaran where rekening2 like '$hs_rinc[rekening2]' "),0);	
		$jum_awal2=number_format($jumawal2,2,".",","); }
		
		else if ($_REQUEST[anggaran]=="PERUBAHAN")
		{$jumawal2 = mysql_result(mysql_query("SELECT sum(anggaran_perubahan) as Num FROM anggaran where rekening2 like '$hs_rinc[rekening2]' "),0);	
		$jum_awal2=number_format($jumawal2,2,".",","); }
		
		$jumrealisasilalu2= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc[rekening2]%' and tanggal < '$_REQUEST[tahun]-$tgllalu%'"),0);
		$jumrealisasiini2= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc[rekening2]%' and tanggal like '$_REQUEST[tahun]-$tglini%'"),0);
		$jumrealisasi2= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc[rekening2]%' and tanggal < '$_REQUEST[tahun]-$_REQUEST[tanggal]%'"),0);
		
		$persentase2=@($jumrealisasi2/$jumawal2 * 100) ;
		$jum_realisasilalu2=number_format($jumrealisasilalu2,2,".",",");
		$jum_realisasiini2=number_format($jumrealisasiini2,2,".",",");
		$jum_realisasi2=number_format($jumrealisasi2,2,".",",");
		$persen2=number_format($persentase2,2,".",",");
		$selisih_beda2=$jumawal2-$jumrealisasi2;
		$selisih2=number_format($selisih_beda2,2,".",",");
		$pdf->SetFont('Times','B',8);
		$pdf->Row(array(''.$hs_rinc[rekening2].'',''.$uraian[uraian].'',''.$jum_awal2.'',''.$jum_realisasilalu2.'',''.$jum_realisasiini2.'',''.$jum_realisasi2.'',''.$selisih2.'',''.$persen2.''));
		
			//--------------------------------------------------QUERY RINCIAN LEVEL 3--------------------------------------------
			$sql_rinc3 = "SELECT * FROM `anggaran` where rekening3 like '$hs_rinc[rekening2]%' group by rekening3";
			$qr_rinc3  = mysql_query($sql_rinc3);
			while($hs_rinc3=mysql_fetch_array($qr_rinc3))
			{
			$uraian3 = mysql_fetch_array(mysql_query("SELECT uraian from kode_rek where kode_rek like '$hs_rinc3[rekening3]'"));
			if ($_REQUEST[anggaran]=="APBD")
			{$jumawal3 = mysql_result(mysql_query("SELECT sum(anggaran_awal) as Num FROM anggaran where rekening3 like '$hs_rinc3[rekening3]' "),0);	
			$jum_awal3=number_format($jumawal3,2,".",","); }
		
			else if ($_REQUEST[anggaran]=="PERUBAHAN")
		{$jumawal3 = mysql_result(mysql_query("SELECT sum(anggaran_perubahan) as Num FROM anggaran where rekening3 like '$hs_rinc3[rekening3]' "),0);	
			$jum_awal3=number_format($jumawal3,2,".",","); }
		
			$jumrealisasilalu3= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc3[rekening3]%' and tanggal < '$_REQUEST[tahun]-$tgllalu%'"),0);
			$jumrealisasiini3= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc3[rekening3]%' and tanggal like '$_REQUEST[tahun]-$tglini%'"),0);
			$jumrealisasi3= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc3[rekening3]%' and tanggal < '$_REQUEST[tahun]-$_REQUEST[tanggal]%'"),0);
			
			if ($jumawal3 > 0)
			{$persentase3=$jumrealisasi3/$jumawal3 * 100;} else {$persentase3=0;}
			$jum_realisasilalu3=number_format($jumrealisasilalu3,2,".",",");
			$jum_realisasiini3=number_format($jumrealisasiini3,2,".",",");
			$jum_realisasi3=number_format($jumrealisasi3,2,".",",");
			$persen3=number_format($persentase3,2,".",",");
			$selisih_beda3=$jumawal3-$jumrealisasi3;
			$selisih3=number_format($selisih_beda3,2,".",",");
			$pdf->SetFont('Times','B',8);
			$pdf->Row(array(''.$hs_rinc3[rekening3].'',''.$uraian3[uraian].'',''.$jum_awal3.'',''.$jum_realisasilalu3.'',''.$jum_realisasiini3.'',''.$jum_realisasi3.'',''.$selisih3.'',''.$persen3.''));
			
				//--------------------------------------------------QUERY RINCIAN LEVEL 4--------------------------------------------
				$sql_rinc4 = "SELECT * FROM `anggaran` where rekening4 like '$hs_rinc3[rekening3]%' group by rekening4";
				$qr_rinc4  = mysql_query($sql_rinc4);
				while($hs_rinc4=mysql_fetch_array($qr_rinc4))
				{
				$uraian4 = mysql_fetch_array(mysql_query("SELECT uraian from kode_rek where kode_rek like '$hs_rinc4[rekening4]'"));
				if ($_REQUEST[anggaran]=="APBD")
			{$jumawal4 = mysql_result(mysql_query("SELECT sum(anggaran_awal) as Num FROM anggaran where rekening4 like '$hs_rinc4[rekening4]' "),0);	
				$jum_awal4=number_format($jumawal4,2,".",","); }
		
				else if ($_REQUEST[anggaran]=="PERUBAHAN")
		{$jumawal4 = mysql_result(mysql_query("SELECT sum(anggaran_perubahan) as Num FROM anggaran where rekening4 like '$hs_rinc4[rekening4]' "),0);	
				$jum_awal4=number_format($jumawal4,2,".",","); }
		
				$jumrealisasilalu4= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc4[rekening4]%' and tanggal < '$_REQUEST[tahun]-$tgllalu%'"),0);
				$jumrealisasiini4= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc4[rekening4]%' and tanggal like '$_REQUEST[tahun]-$tglini%'"),0);
				$jumrealisasi4= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc4[rekening4]%' and tanggal < '$_REQUEST[tahun]-$_REQUEST[tanggal]%'"),0);
				
				if ($jumawal4 > 0)
				{$persentase4=$jumrealisasi4/$jumawal4 * 100;} else {$persentase4=0;}
				$jum_realisasilalu4=number_format($jumrealisasilalu4,2,".",",");
				$jum_realisasiini4=number_format($jumrealisasiini4,2,".",",");
				$jum_realisasi4=number_format($jumrealisasi4,2,".",",");
				$persen4=number_format($persentase4,2,".",",");
				$selisih_beda4=$jumawal4-$jumrealisasi4;
				$selisih4=number_format($selisih_beda4,2,".",",");
				$pdf->SetFont('Times','B',8);
				
				$pdf->Row(array(''.$hs_rinc4[rekening4].'',''.$uraian4[uraian].'',''.$jum_awal4.'',''.$jum_realisasilalu4.'',''.$jum_realisasiini4.'',''.$jum_realisasi4.'',''.$selisih4.'',''.$persen4.''));
				
				//--------------------------------------------------QUERY RINCIAN LEVEL 5--------------------------------------------
				$sql_rinc5 = "SELECT * FROM `anggaran` where rekening like '$hs_rinc4[rekening4]%' group by rekening";
				$qr_rinc5  = mysql_query($sql_rinc5);
				while($hs_rinc5=mysql_fetch_array($qr_rinc5))
				{
				$uraian5 = mysql_fetch_array(mysql_query("SELECT uraian from kode_rek where kode_rek like '$hs_rinc5[rekening]'"));
				if ($_REQUEST[anggaran]=="APBD")
			{$jumawal5 = mysql_result(mysql_query("SELECT sum(anggaran_awal) as Num FROM anggaran where rekening like '$hs_rinc5[rekening]' "),0);	
				$jum_awal5=number_format($jumawal5,2,".",","); }
		
				else if ($_REQUEST[anggaran]=="PERUBAHAN")
		{$jumawal5 = mysql_result(mysql_query("SELECT sum(anggaran_perubahan) as Num FROM anggaran where rekening like '$hs_rinc5[rekening]' "),0);	
				$jum_awal5=number_format($jumawal5,2,".",","); }
		
				$jumrealisasilalu5= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc5[rekening]%' and tanggal < '$_REQUEST[tahun]-$tgllalu%'"),0);
				$jumrealisasiini5= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc5[rekening]%' and tanggal like '$_REQUEST[tahun]-$tglini%'"),0);
				$jumrealisasi5= mysql_result(mysql_query("SELECT sum(debet) as Num FROM transaksi where rekening like '$hs_rinc5[rekening]%' and tanggal < '$_REQUEST[tahun]-$_REQUEST[tanggal]%'"),0);
				
				if ($jumawal5 > 0)
				{$persentase5=$jumrealisasi5/$jumawal5 * 100;} else {$persentase5=0;}
				$jum_realisasilalu5=number_format($jumrealisasilalu5,2,".",",");
				$jum_realisasiini5=number_format($jumrealisasiini5,2,".",",");
				$jum_realisasi5=number_format($jumrealisasi5,2,".",",");
				$persen5=number_format($persentase5,2,".",",");
				$selisih_beda5=$jumawal5-$jumrealisasi5;
				$selisih5=number_format($selisih_beda5,2,".",",");
				$pdf->SetFont('Times','',8);
				$pdf->Row(array(''.$hs_rinc5[rekening].'',''.$uraian5[uraian].'',''.$jum_awal5.'',''.$jum_realisasilalu5.'',''.$jum_realisasiini5.'',''.$jum_realisasi5.'',''.$selisih5.'',''.$persen5.''));
				}
				//---------------------------------
				}
			//---------------------------
			}
		//--------------------------
		}
		//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
	}
//---------------------------FORMAT TANDATANGAN-----------------------------------------
		$pdf->Ln();	
		$pdf->Ln();		
		$pdf->SetFont('Times','B',10);
		$pdf->Cell(200,5,'',0,0,'C');
		$ttd = mysql_fetch_array(mysql_query("SELECT * from tbl_penandatangan where id = '1'"));
		$pdf->Cell(74,5,''.$ttd[jabatan].'',0,0,'C');
		
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();	
		$pdf->SetFont('Times','U',10);	
		$pdf->Cell(200,5,'',0,0,'C');
		$pdf->Cell(74,5,''.$ttd[nama].'',0,0,'C');
$pdf->Output();
?>
