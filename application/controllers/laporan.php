<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(isset($_POST['refresh'])) { 
			$array_items=array('sess_tarikh_terima' => '','sess_tarikh_terima2' => '','sess_id_bahagian' => '','sess_id_kategori' => '');
			$this->session->unset_userdata($array_items);
		}
		
		 //Untuk Carian 
		if(isset($_POST['carian'])) 
		{ 
			$data['tarikh_terima']= convert_date_formattodb($this->input->post('tarikh_terima')); 
			$data['tarikh_terima2']= convert_date_formattodb($this->input->post('tarikh_terima2')); 
			$data['id_bahagian']= $this->input->post('id_bahagian');
			$data['id_kategori']= $this->input->post('id_kategori');
			
			if(!empty($tarikh_terima)){
				$data['tarikh_terima']= convert_date_formattodb($this->input->post('tarikh_terima'));
				
			}
			
			if(!empty($tarikh_terima2)){
				$data['tarikh_terima2']= convert_date_formattodb($this->input->post('tarikh_terima2'));
			}
			
		} else {
			$data['tarikh_terima'] = $this->session->userdata('sess_tarikh_terima');	
			$data['tarikh_terima2'] = $this->session->userdata('sess_tarikh_terima2');
			//$data['id_bahagian'] = $this->session->userdata('sess_id_bahagian');
			$data['id_kategori'] = $this->session->userdata('id_kategori');
			$data['nama_bahagian'] = $this->session->userdata('sess_nama_bahagian');
		}
		
		
		$tarikh_terima = $this->input->post('tarikh_terima');
		$tarikh_terima2 = $this->input->post('tarikh_terima2');
		$id_bahagian = $this->input->post('id_bahagian');
		$id_kategori = $this->input->post('id_kategori');
		$nama_bahagian = $this->input->post('nama_bahagian');
		
				
		$this->db->select('surat.id_surat,surat.tarikh_terima, surat.no_rujukan, surat.tarikh_surat, surat.daripada, surat.tajuk, surat.kepada');
		$this->db->from('surat');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=surat.id_bahagian');
		$this->db->join('adm_kategori','adm_kategori.id_kategori=surat.id_kategori');
		$this->db->where('tarikh_terima BETWEEN "'. date('Y-m-d',strtotime(str_replace('/', '-', $tarikh_terima))). '" and "'. date('Y-m-d',strtotime(str_replace('/', '-', $tarikh_terima2))).'"');
		//$this->db->where('tarikh_terima BETWEEN "'. date('Y-d-m', strtotime($tarikh_terima)). '" and "'. date('Y-d-m', strtotime($tarikh_terima2)).'"');
		
				
		if(!empty($data['id_bahagian']) && ($data['id_kategori'] !='' )){
			
			$this->db->where('surat.id_bahagian',$data['id_bahagian']);
			$this->db->where('surat.id_kategori',$data['id_kategori']);
		
		}else if (($data['tarikh_terima'] !='') && ($data['tarikh_terima2'] !='') && ($data['id_bahagian'] !='') && ($data['id_kategori'] !='')) {
			
            $this->db->where('surat.tarikh_terima',$data['tarikh_terima']);
			$this->db->where('surat.tarikh_terima2',$data['tarikh_terima2']);
			$this->db->where('adm_bahagian.nama_bahagian',$data['nama_bahagian']);
			$this->db->where('surat.id_kategori',$data['id_kategori']);
				
		}else {
			
		}
		
		$data['list_surat_terbuka'] = $this->db->get('');
		
		//$data['senarai_bahagian']=$this->db->get('adm_bahagian'); // select * from adm_bahagian	
		$data['senarai_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		$data['senarai_kategori']=$this->db->get('adm_kategori'); // select * from adm_kategori	
		
		$this->load->view('laporan_suratrbuka',$data);
		$this->output->enable_profiler(TRUE);
		
	}
	function cetak_laporan_suratrbuka($tarikh_terima,$tarikh_terima2,$id_bahagian,$id_kategori)
	{
		
		$data['tarikh_terima'] = $this->session->userdata('sess_tarikh_terima');	
		$data['tarikh_terima2'] = $this->session->userdata('sess_tarikh_terima2');
		$data['id_bahagian'] = $this->session->userdata('sess_id_bahagian');	
		$data['id_kategori'] = $this->session->userdata('sess_id_kategori');
		$data['id_surat'] = $this->session->userdata('sess_id_surat');
		$data['nama_bahagian'] = $this->session->userdata('sess_nama_bahagian');
		
		$data['tarikh_terima'] = $tarikh_terima;
		$data['tarikh_terima2'] = $tarikh_terima2;
		
			
		$namabahagian =$this->db->query("Select * from adm_bahagian where id_bahagian='$id_bahagian'");
	
		if($namabahagian->num_rows() > 0)
		{
			$row =$namabahagian->row();
		
			$data['nama_bahagian']=$row->nama_bahagian;
		
		}	
		$kategori =$this->db->query("Select * from adm_kategori where id_kategori='$id_kategori'");
	
		if($kategori->num_rows() > 0)
		{
			$row =$kategori->row();
		
			$data['kategori']=$row->kategori;
		
		}
		
		$data['cetak'] = $this->db->query("SELECT 
		surat.id_surat,surat.tarikh_terima,
		surat.no_rujukan,surat.tarikh_surat,
		surat.daripada,surat.tajuk,surat.kepada
		FROM surat
		JOIN adm_bahagian ON adm_bahagian.id_bahagian=surat.id_bahagian
		JOIN adm_kategori ON adm_kategori.id_kategori=surat.id_kategori
		WHERE tarikh_terima BETWEEN '".$tarikh_terima."' and '".$tarikh_terima2."'
		AND surat.id_bahagian = '".$id_bahagian."'
		AND surat.id_kategori = '".$id_kategori."'");
		
		$this->load->view('cetak_laporan_suratrbuka',$data);
		//$this->output->enable_profiler(TRUE);
	}		
	function laporan_surat_peribadi()
	{
		/*if(isset($_POST['refresh'])) { 
			$array_items=array('sess_tarikh_terima_mula' => '','sess_tarikh_terima_hingga' => '','sess_id_bahagian' => '');
			$this->session->unset_userdata($array_items);
		}*/
		
		
		if(isset($_POST['carian'])) { 
			$data['tarikh_terima_mula']= convert_date_formattodb($this->input->post('tarikh_terima_mula')); 
			$data['tarikh_terima_hingga']= convert_date_formattodb($this->input->post('tarikh_terima_hingga')); 
			$data['id_bahagian']= $this->input->post('id_bahagian'); 
			
		} else {
			$data['tarikh_terima_mula'] = $this->session->userdata('sess_tarikh_terima_mula');	
			$data['tarikh_terima_hingga'] = $this->session->userdata('sess_tarikh_terima_hingga');
			//$data['id_bahagian'] = $this->session->userdata('sess_id_bahagian');
		}
		//$data['senarai_bahagian']=$this->db->get('adm_bahagian'); 
		$data['senarai_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		
		$this->db->select('surat_peribadi.id_surat_peribadi, surat_peribadi.no_rujukan, surat_peribadi.tarikh_terima, surat_peribadi.daripada, surat_peribadi.kepada, surat_peribadi.id_bahagian, adm_bahagian.nama_bahagian');
		$this->db->from('surat_peribadi');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=surat_peribadi.id_bahagian');
		$this->db->order_by('tarikh_terima', 'asc');
		
		//cara ni pun boleh guna
		/*if(($data['tarikh_terima_mula'] !='tiada') && ($data['tarikh_terima_hingga'] !='tiada') && ($data['id_bahagian'] !='tiada')) {
           $this->db->where('tarikh_terima >=',$data['tarikh_terima_mula']);
			$this->db->where('tarikh_terima <=',$data['tarikh_terima_hingga']);
			$this->db->where('id_bahagian',$data['id_bahagian']);
		}
			else{
			
		}*/
		
		if(!empty($data['tarikh_terima_mula']) && !empty($data['tarikh_terima_hingga']) &&!empty($data['tarikh_terima_hingga'])){
			$this->db->where('surat_peribadi.tarikh_terima >=',$data['tarikh_terima_mula']);
			$this->db->where('surat_peribadi.tarikh_terima <=',$data['tarikh_terima_hingga']);
			$this->db->where('surat_peribadi.id_bahagian',$data['id_bahagian']);
	
		}else{
			
		}
		$data['list'] = $this->db->get('');
		
		
		$data['flash_success']=$this->session->flashdata('flash_success');
		$data['flash_error']=$this->session->flashdata('flash_error');
		
		// select * from adm_bahagian	
		
		$this->load->view('laporan_surat_peribadi',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function cetak_laporan_surat_peribadi($tarikh_terima_mula,$tarikh_terima_hingga,$id_bahagian)
	{
		$data['tarikh_terima_mula'] = $tarikh_terima_mula; //umpukan tarikh_terima_mula ke tarikh_a tuuan untuk dipapar kat view
		$data['tarikh_terima_hingga'] = $tarikh_terima_hingga;
		$data['id_bahagian'] = $id_bahagian;
		
		//hantar variable / define variable
		/*$data['tarikh_terima_mula'] = $this->session->userdata('sess_tarikh_terima_mula');	
		$data['tarikh_terima_hingga'] = $this->session->userdata('sess_tarikh_terima_hingga');
		$data['id_bahagian'] = $this->session->userdata('sess_id_bahagian');
		//$id_bahagian = $data['id_bahagian'];	*/
		
		//convert_date_formattodb($this->input->post('$tarikh_terima_mula'))
		//$tarikh_a= $data['tarikh_terima_mula'];
		//$tarikh_b= $data['tarikh_terima_hingga'];
		$q1 =$this->db->query("Select * from adm_bahagian where id_bahagian='$id_bahagian'");
	
	if($q1->num_rows() > 0)
	{
		$row =$q1->row();
		
		$data['nama_bahagian']=$row->nama_bahagian;
		
	}
	/*	$q="SELECT
	surat_peribadi.no_rujukan,
	surat_peribadi.tarikh_terima,
	surat_peribadi.daripada,
	surat_peribadi.kepada,
	surat_peribadi.id_bahagian
	FROM
	surat_peribadi
	JOIN adm_bahagian ON adm_bahagian.id_bahagian=surat_peribadi.id_bahagian 
	WHERE surat_peribadi.tarikh_terima >= '$tarikh_terima_mula' and surat_peribadi.tarikh_terima <='$tarikh_terima_hingga' and surat_peribadi.id_bahagian=$id_bahagian";*/
	
		//$data["list"]=$q=$this->db->query($q);
		
		$this->db->select('surat_peribadi.id_surat_peribadi, surat_peribadi.no_rujukan, surat_peribadi.tarikh_terima, surat_peribadi.daripada, surat_peribadi.kepada, surat_peribadi.id_bahagian, adm_bahagian.nama_bahagian');
		$this->db->from('surat_peribadi');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=surat_peribadi.id_bahagian');
		$this->db->order_by('tarikh_terima', 'asc');
		
		//cara ni pun boleh guna
		/*if(($data['tarikh_terima_mula'] !='tiada') && ($data['tarikh_terima_hingga'] !='tiada') && ($data['id_bahagian'] !='tiada')) {
           $this->db->where('tarikh_terima >=',$data['tarikh_terima_mula']);
			$this->db->where('tarikh_terima <=',$data['tarikh_terima_hingga']);
			$this->db->where('id_bahagian',$data['id_bahagian']);
		}
			else{
			
		}*/
		
		if(!empty($data['tarikh_terima_mula']) && !empty($data['tarikh_terima_hingga']) &&!empty($data['tarikh_terima_hingga'])){
			$this->db->where('surat_peribadi.tarikh_terima >=',$data['tarikh_terima_mula']);
			$this->db->where('surat_peribadi.tarikh_terima <=',$data['tarikh_terima_hingga']);
			$this->db->where('surat_peribadi.id_bahagian',$data['id_bahagian']);
	
		}else{
			
		}
		$data['list'] = $this->db->get('');

		
		$this->load->view('cetak_laporan_surat_peribadi',$data);
		//$this->output->enable_profiler(TRUE);
	}
}
