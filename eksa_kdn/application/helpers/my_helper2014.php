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


