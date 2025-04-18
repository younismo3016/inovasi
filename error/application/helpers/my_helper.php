<?php
if (! function_exists('convert_date_formattodb'))
{
	function convert_date_formattodb($value)
	{
		$Date = explode("/", $value);
				$m = $Date[0];
				$d = $Date[1];
				$year = $Date[2];
				$gabung = $year."-".$m."-".$d;
				return $gabung;
	}
}

if (! function_exists('convert_date_formattodb2'))
{
	function convert_date_formattodb2($value)
	{
		$Date = explode("-", $value);
				$d = $Date[0];
				$m = $Date[1];
				$year = $Date[2];
				$gabung = $year."-".$m."-".$d;
				return $gabung;
	}
}

//helper ini tidak digunakan dalam sistem ini
if (! function_exists('get_stok_peralatan'))
{
	function get_stok_peralatan($value)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT 
					j.id_adm_jenis,
					j.jenis_peralatan, 
					sum(if(p.status_peminjaman = 1,1,0)) as jumlah_pinjam,
					sum(if(p.status_peminjaman = 0,1,0)) as jumlah_stok_ada,
					count(*) as stok_keseluruhan 
					FROM spict_peralatan p
					
					inner join adm_jenis j on p.id_adm_jenis = j.id_adm_jenis
					inner join adm_jenama jen on p.id_adm_jenama = jen.id_adm_jenama
					where j.id_adm_jenis='$value'
					group by j.jenis_peralatan");
			$query->num_rows();
			
			
			
			foreach($query->result() as $row)
			{
					return $row->jumlah_stok_ada;
			}
	}
}


if (! function_exists('get_nama_juruteknik'))
{
	function get_nama_juruteknik($value)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT pengguna.nama as nama from pengguna
						join spict_transaksi on spict_transaksi.id_juruteknik=pengguna.id_pengguna
						WHERE pengguna.id_pengguna='$value'");
			$query->num_rows();
			
			foreach($query->result() as $row)
			{
					//return $row->id_juruteknik;
					$id_juruteknik = $row->nama;
					 
			}
			return $id_juruteknik;
	}
}

function get_pertandingan($value){
	if($value == 1){
		$value =  "Anugerah Inovasi KDN";
	}else if($value == 2){
		$value =  "KIK KDN";
	}
	else{
		$value =  "Ralat";
	}
	
	return $value;
    
}

function get_bidang($value){
	if($value == 1){
		$value =  "Inovasi Sosial";
	}
	else{
		$value =  "Inovasi Penyampaian Perkhidmatan";
	}
	
	return $value;
    
}

function get_kategori($value){
	if($value == 1){
		$value =  "Inovasi Penciptaan";
	}
	else{
		$value =  "Inovasi Penambahbaikan";
	}
	
	return $value;
    
}

function get_negeri($value){
	if($value == 1){
		$value =  "JOHOR";
	}else if($value == 2){
		$value =  "KEDAH";
	}else if($value == 3){
		$value =  "KELANTAN";
	}else if($value == 4){
		$value =  "MELAKA";
	}else if($value == 5){
		$value =  "NEGERI SEMBILAN";
	}else if($value == 6){
		$value =  "PAHANG";
	}else if($value == 7){
		$value =  "PULAU PINANG";
	}else if($value == 8){
		$value =  "PERAK";
	}else if($value == 9){
		$value =  "PERLIS";
	}else if($value == 10){
		$value =  "SELANGOR";
	}else if($value == 12){
		$value =  "SABAH";
	}else if($value == 13){
		$value =  "SARAWAK";
	}else if($value == 14){
		$value =  "WILAYAH PERSEKUTUAN";
	}else if($value == 16){
		$value =  "WILAYAH PERSEKUTUAN PUTRAJAYA";
	}
	else{
		$value =  "TERENGGANU";
	}
	
	return $value;
    
}

function get_status_projek($value){
	if($value == 1){
		$value =  "Projek Baru";
	}else if($value == 2){
		$value =  "Pengesahan Ketua Organisasi";
	}else if($value == 3){
		$value =  "Telah Disahkan";
	}else if($value == 4){
		$value =  "Selesai Markah";
	}else if($value == 5){
		$value =  "Menunggu Kelulusan Laporan Urusetia"; //tidak digunakan
	}else if($value == 6){
		$value =  "Telah Dihantar ke Urusetia"; //tidak digunakan
	}
	else if($value == 7){
		$value =  "Tidak Mendapat Kelulusan"; 
	}
	else{
		$value =  "Laporan tidak dihantar";
	}
	
	return $value;
    
}

function get_jabatan($value){
	if($value == 1){
		$value =  "Polis Diraja Malaysia";
	}else if($value == 2){
		$value =  "Jabatan Imigresen Malaysia";
	}else if($value == 3){
		$value =  "Jabatan Pendaftaran Pertubuhan";
	}else if($value == 4){
		$value =  "Jabatan Pendaftaran Negara";
	}else if($value == 5){
		$value =  "Jabatan Penjara Malaysia";
	}else if($value == 6){
		$value =  "Kementerian Dalam Negeri";
	}else if($value == 7){
		$value =  "Agensi Anti Dadah Kebangsaan";
	}else if($value == 8){
		$value =  "Jabatan Pertahanan Awam";
	}else{
		$value =  "Jabatan Sukarelawan Malaysia";
	}
	
	return $value;
    
}

	

function get_status_peranan($value){
	if($value == 1){
		$value =  "Ketua Jabatan";
	}else if($value == 2){
		$value =  "Ketua Projek";
	}else if($value == 3){
		$value =  "Ahli Pasukan";
	}else if($value == 4){
		$value =  "Urusetia";
	}else if($value == 5){
		$value =  "Penyelaras Jabatan";
	}
	else{
		$value =  "Penyemak";
	}
	
	return $value;
    
}

function get_jumlah_character($value)
{
	$jumlah_character = strlen($value);
	
	return $value;
    
}

//untuk convert dari number ke perkataan..utk bulan
if (! function_exists('covert_bulan_to_ejaan'))
{
	function convert_bulan_to_ejaan($value)
	{
		if ($value==1){
			echo "Jan";
		}else if ($value==2){
		 	echo "Feb";
			}else if ($value==3){
		 	echo "Mac";
			}else if ($value==4){
		 	echo "April";
			}else if ($value==5){
		 	echo "Mei";
			}else if ($value==6){
		 	echo "Jun";
			}else if ($value==7){
		 	echo "Jul";
			}else if ($value==8){
		 	echo "Ogos";
			}else if ($value==9){
		 	echo "Sept";
			}else if ($value==10){
		 	echo "Okt";
			}else if ($value==11){
		 	echo "Nov";
			}else if ($value==12){
		 	echo "Dec";
		}
	}
}

