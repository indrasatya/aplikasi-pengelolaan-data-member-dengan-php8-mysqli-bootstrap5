<?php
// format nama hari indonesia
function nama_hari_indo($tanggal) {
	// format tanggal yyyy-mm-dd
	$tgl = substr($tanggal,8,2);
	$bln = substr($tanggal,5,2);
	$thn = substr($tanggal,0,4);

	$info = date('w', mktime(0,0,0,$bln,$tgl,$thn));

	switch ($info) {
		case '0': return "Minggu"; break;
		case '1': return "Senin"; break;
		case '2': return "Selasa"; break;
		case '3': return "Rabu"; break;
		case '4': return "Kamis"; break;
		case '5': return "Jumat"; break;
		case '6': return "Sabtu"; break;
	}
}

// format tanggal indonesia
function tanggal_indo($tanggal){
	$bulan = array (
		1 =>'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
	);
	$explode = explode('-', $tanggal);
	
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
	return $explode[2] . ' ' . $bulan[ (int)$explode[1] ] . ' ' . $explode[0];
}

// format nama bulan indonesia
function nama_bulan_indo($tanggal){
	$bulan = array (
		1 =>'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
	);
	$explode = explode('-', $tanggal);
	
	// variabel pecahkan 0 = bulan
	return $bulan[ (int)$explode[0] ] ;
}
