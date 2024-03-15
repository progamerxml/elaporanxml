<?php
function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}	

function tgl_indo2($tgl){
	$t= explode("/",$tgl);
	$tanggal=$t[0];
	$bulan = getBulan($t[1]);
	$tahun=$t[2];
	return $tanggal.' '.$bulan.' '.$tahun;		 
}

function ubah_format($tgl){
	$t= explode("/",$tgl);
	$tanggal=$t[0];
	$bulan = $t[1];
	$tahun=$t[2];
	return $tahun.'-'.$bulan.'-'.$tanggal;		 
}	

function balik_format($tgl){
	$t= explode("-",$tgl);
	$tanggal=$t[2];
	$bulan = $t[1];
	$tahun=$t[0];
	return $tanggal.'/'.$bulan.'/'.$tahun;		 
}		
	




function waktu_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	$jam=substr($tgl,11,8);
	return $tanggal.' '.$bulan.' '.$tahun." ".$jam;		 
}	


function format_uang($angka){
	
	
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";

	$duwet="Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan).",-";
	return $duwet;
}
function format_uang2($angka){
	
	
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";

	$duwet="".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."";
	return $duwet;
}

function getbulantahun($s1,$s2){
	
	$form=getBulan($s1)." ".$s2;
	return $form;

}

function getBulan($bln){
	switch ($bln){
		case 1: 
		return "Januari";
		break;
		case 2:
		return "Februari";
		break;
		case 3:
		return "Maret";
		break;
		case 4:
		return "April";
		break;
		case 5:
		return "Mei";
		break;
		case 6:
		return "Juni";
		break;
		case 7:
		return "Juli";
		break;
		case 8:
		return "Agustus";
		break;
		case 9:
		return "September";
		break;
		case 10:
		return "Oktober";
		break;
		case 11:
		return "November";
		break;
		case 12:
		return "Desember";
		break;
	}
} 

function terbilang($x) 
{ 
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"); 
  if ($x < 12) 
    return " " . $abil[$x]; 
  elseif ($x < 20) 
    return Terbilang($x - 10) . "belas"; 
  elseif ($x < 100) 
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10); 
  elseif ($x < 200) 
    return " seratus" . Terbilang($x - 100); 
  elseif ($x < 1000) 
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100); 
  elseif ($x < 2000) 
    return " seribu" . Terbilang($x - 1000); 
  elseif ($x < 1000000) 
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000); 
  elseif ($x < 1000000000) 
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000); 
    
    
} 
?>

