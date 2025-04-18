<?php

class model_pengguna extends CI_Model {



	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function penerimaan($perPage,$uri,$kod_ptj,$nama_ptj)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($nama_ptj)){
			$this->db->where('nama_ptj',$nama_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function semakan($perPage,$uri,$kod_ptj,$bulan_kkwt)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('laporan_kewangan','laporan_kewangan.id_laporan_kewangan = ptj.id_ptj');
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function surat_peringatan($perPage,$uri,$kod_ptj,$bulan_kkwt)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id');
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function list_tanggungan($perPage,$uri)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('tanggungan');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function data_lama($perPage,$uri)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('data_lama');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function data_baru($perPage,$uri)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('data_baru');
		$this->db->order_by('nama_peserta','ASC');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function pengemaskinian_ptj($perPage,$uri,$kod_ptj,$nama_ptj)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($nama_ptj)){
			$this->db->where('nama_ptj',$nama_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function list_kod_masalah($perPage,$uri)
	{
		
		
		
		$this->db->select('status_bancian.status_bancian as status_bancian,kod_masalah.masalah as masalah,kod_masalah.id_kod_masalah as id_kod_masalah');			
		$this->db->from('kod_masalah');
		$this->db->join('status_bancian', 'status_bancian.id_status_bancian = kod_masalah.status_bancian');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function jenis_peralatan($perPage,$uri)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('jenis_peralatan');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function peralatan($perPage,$uri)
	{
		
		
		
		$this->db->select('peralatan.id_peralatan as id_peralatan,peralatan.peralatan as peralatan,jenis_peralatan.jenis_peralatan as jenis_peralatan');			
		$this->db->from('peralatan');
		$this->db->join('jenis_peralatan', 'jenis_peralatan.id = peralatan.jenis_peralatan');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function kursus($perPage,$uri)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('kursus');
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function pemohon($perPage,$uri,$negeri,$daerah,$parlimen,$dun)
	{
		
		$this->db->select('*');			
		$this->db->from('pemohon');
		//$this->db->join('data_baru', 'data_baru.id = pemohon.id_data_baru');
		$this->db->join('status_bancian', 'status_bancian.id_status_bancian = pemohon.status_bancian','LEFT');
		$this->db->join('pengguna', 'pengguna.id = pemohon.id_pembanci','LEFT');
		$this->db->order_by('pemohon.nama','ASC');
		//$this->db->where('pemohon.status_bancian',4);
		//$this->db->where('pemohon.id_pembanci',0);
		//if($negeri !=0){
			if(!empty($negeri)){
				$this->db->where('pemohon.negeri',$negeri);
			}
		//}
		
		if(!empty($daerah)){
			$this->db->where('pemohon.daerah',$daerah);
		}
		if(!empty($parlimen)){
			$this->db->where('pemohon.parlimen',$parlimen);
		}
		if(!empty($dun)){
			$this->db->where('pemohon.dun',$dun);
		}
		//$this->db->where('pemohon.id_pembanci',0);
		$level = $this->session->userdata('sess_level');
		 $id = $this->session->userdata('sess_id');
		if($level==2){
			$this->db->where('pemohon.id_pembanci',$id);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function update_data($table,$id,$data,$field_key)
	{
		$this->db->where($field_key,$id);
		$this->db->update($table, $data); 
	}
	
	function check_user($username, $password) 
	{
		$this->db->where('id_pengguna',$username);
		$this->db->where('katalaluan',$password);
		//$this->db->where('status',1);
		$query = $this->db->get('pengguna');
		
		if($query->num_rows() > 0) {		
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function getcountry_edit(){
		$result = array();
		$this->db->select('*');
		$this->db->from('status_bancian');
		//$this->db->order_by('negeri','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
			
            $result[0]= '-Pilih Status-';
            $result[$row->id_status_bancian]= $row->status_bancian;
        }

        return $result;
	}
	
	
	
	function get_list_jenis_peralatan(){
		$result = array();
		$this->db->select('*');
		$this->db->from('jenis_peralatan');
		//$this->db->order_by('negeri','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
			
            $result[0]= '-Pilih Status-';
            $result[$row->id]= $row->jenis_peralatan;
        }

        return $result;
	}
	
	function pemohon_peralatan($id){
		$result = array();
		$this->db->select('*');
		$this->db->from('pemohon_peralatan');
		$this->db->join('peralatan','pemohon_peralatan.id_peralatan=peralatan.id_peralatan');
		$this->db->where('id_pemohon',$id);
		$this->db->where('id_pemohon',$id);
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
			
            //$result[0]= '-Pilih Status-';
            $result[$row->id]= $row->peralatan;
        }

        return $result;
	}
	
	function list_jenis_peralatan()
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('jenis_peralatan');
		
		  
		$getData = $this->db->get('');

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function getprovince(){
		$country_id = $this->input->post('country_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('kod_masalah');
		$this->db->where('status_bancian',$country_id);
		//$this->db->order_by('daerah','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Kod Masalah-';
            $result[$row->id_kod_masalah]= $row->masalah;
        }

        return $result;
	}
	
	function get_kod_masalah($status_bancian){
		//$country_id = $this->input->post('country_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('kod_masalah');
		$this->db->where('status_bancian',$status_bancian);
		$this->db->order_by('status_bancian','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Kod Status-';
            $result[$row->id_kod_masalah]= $row->masalah;
        }

        return $result;
	}
	
	function select_peralatan(){
		$country_id = $this->input->post('country_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('peralatan');
		$this->db->where('jenis_peralatan',$country_id);
		//$this->db->order_by('daerah','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            //$result[0]= '-Pilih Peralatan-';
            $result[$row->id_peralatan]= $row->peralatan;
        }

        return $result;
	}
	
	
	function pemohon_gallery($id)
	{
		
		
		
		$this->db->select('*');	
		$this->db->where('id_pemohon',$id);			
		$this->db->from('pemohon_gallery');
		
		  
		$getData = $this->db->get('');

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
}

