<?php
function format_uang($angka){
	
	
$jumlah_desimal ="2";
$pemisah_desimal =".";
$pemisah_ribuan =",";

$duwet=number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
return $duwet;
}


function tgl_indo($tgl){
	$t= explode("/",$tgl);
	$tanggal=$t[0];
	$bulan = getBulan($t[1]);
	$tahun=$t[2];
	return $tanggal.' '.$bulan.' '.$tahun;		 
}

function ubah_format($tgl){
	$t= explode("/",$tgl);
	$tahun=$t[2];
	$bulan =$t[1];
	$tanggal=$t[0];
	return $tahun.'-'.$bulan.'-'.$tanggal;		 
	
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




?>