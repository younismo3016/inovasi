<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// assign user ptj
function get_statusUserptj($value){
	if($value == 1){
		$value = '<span class="label label-success">AKTIF</span>';
	}else{
		$value = '<span class="label">TIDAK AKTIF</span>';
	}
	
	return $value;
    
}
function get_statusPtj($value){
	if($value == 1){
		$value = '<span class="label label-success">AKTIF</span>';
	}else{
		$value = '<span class="label">TIDAK AKTIF</span>';
	}
	
	return $value;
    
}

function comma_num($value){
	
$value = number_format($value, 2);
	
	return $value;
    
}

function reformat_date($value)
{
	$explode = explode("-", $value);
	$a = $explode[0];
	$b = $explode[1];
	$c = $explode[2];
			 //echo $a;
	$gabung = $c."-".$b."-".$a;
			 
			 return $gabung;   
}


// peranan user
function get_peranan($value){
	if($value == 1){
		$value =  "Pentadbir Sistem";
	}else if($value == 2){
		$value =  "Pegawai";
	}
	else{
		$value =  "Penyemak";
	}
	
	return $value;
    
}

function check_tarikh_cetak2($id_surat_peringatan){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM surat_peringatan where id_surat_peringatan='$id_surat_peringatan'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$tarikh_surat_peringatan2= $row->tarikh_surat_peringatan2;
									
			}
			if($tarikh_surat_peringatan2 == '0000-00-00'){
				$check = "tiada";
			}else{
				$check = "ada";
			}
	
	return $check;
    
}

function check_tarikh_cetak_kuiri1($id_surat_peringatan_kuiri){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM surat_peringatan_kuiri where id_surat_peringatan_kuiri='$id_surat_peringatan_kuiri'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$spk1= $row->spk1;
									
			}
			if(($spk1 == null)||($spk1 == '0000-00-00')){
				$check = "tiada";
			}

			
			else{
				$check = "ada";
			}
	
	return $check;
    
}

function check_tarikh_cetak_kuiri2($id_surat_peringatan_kuiri){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM surat_peringatan_kuiri where id_surat_peringatan_kuiri='$id_surat_peringatan_kuiri'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$tarikh_surat_peringatan2= $row->spk2;
									
			}
			if(($tarikh_surat_peringatan2 == '0000-00-00')||($tarikh_surat_peringatan2 == null)){
				$check = "tiada";
			}else{
				$check = "ada";
			}
	
	return $check;
    
}



function check_tarikh_cetak3($id_surat_peringatan){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM surat_peringatan where id_surat_peringatan='$id_surat_peringatan'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$tarikh_surat_peringatan3= $row->tarikh_surat_peringatan3;
									
			}
			if($tarikh_surat_peringatan3 == '0000-00-00'){
				$check = "tiada";
			}else{
				$check = "ada";
			}
	
	return $check;
    
}

function check_tarikh_cetak_kuiri3($id_surat_peringatan_kuiri){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM surat_peringatan_kuiri where id_surat_peringatan_kuiri='$id_surat_peringatan_kuiri'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$tarikh_surat_peringatan3= $row->spk3;
									
			}
		if(($tarikh_surat_peringatan3 == '0000-00-00')||($tarikh_surat_peringatan3 == null)){
				$check = "tiada";
			}else{
				$check = "ada";
			}
	
	return $check;
    
}


function check_tarikh_cetak2_pph($id_surat_peringatan){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM surat_peringatan_pph where id_surat_peringatan='$id_surat_peringatan'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$tarikh_surat_peringatan2= $row->tarikh_surat_peringatan2;
									
			}
			if($tarikh_surat_peringatan2 == '0000-00-00'){
				$check = "tiada";
			}else{
				$check = "ada";
			}
	
	return $check;
    
}

function check_tarikh_cetak3_pph($id_surat_peringatan){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM surat_peringatan_pph where id_surat_peringatan='$id_surat_peringatan'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$tarikh_surat_peringatan3= $row->tarikh_surat_peringatan3;
									
			}
			if($tarikh_surat_peringatan3 == '0000-00-00'){
				$check = "tiada";
			}else{
				$check = "ada";
			}
	
	return $check;
    
}

function get_nama_gambar($id){
		$ci =& get_instance();
			$query = $ci->db->query("SELECT * FROM kuiri3 where id_q3='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$nama_gambar= $row->nama_gambar;
									
			}
			
	
	return $nama_gambar;
    
}


