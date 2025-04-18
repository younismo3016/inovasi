<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senarai extends MY_Controller {

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
/*	public function index()
	{
		
		if(isset($_POST['refresh'])) { 
			$array_items=array('sess_tarikh_terima' => '','sess_id_bahagian' => '');
			$this->session->unset_userdata($array_items);
		}
		
		//Untuk Carian 
	if(isset($_POST['carian'])) { 
			$tarikh_terima= $this->input->post('tarikh_terima');
			$data['id_bahagian']= $this->input->post('id_bahagian');
			
			
			if(!empty($tarikh_terima)){
				$data['tarikh_terima']= convert_date_formattodb2($this->input->post('tarikh_terima'));
				//$data['tarikh_jangka_pulang']= convert_date_formattodb($this->input->post('tarikh_jangka_pulang'));
			}
			
			$data['id_bahagian']= $this->input->post('id_bahagian');
			
		} else {	
			$data['tarikh_terima'] = $this->session->userdata('sess_tarikh_terima');
			$data['id_bahagian'] = $this->session->userdata('sess_id_bahagian');
		}
		
		
		$tahun = date('Y');
		$CURRENT_YEAR = date("Y-m-d");
		echo $tahun;
		
		$data['list_bahagian']=$this->db->get('adm_bahagian');
		
		$this->db->select('surat.tarikh_terima, YEAR(surat.tarikh_terima) as tahun2, surat.no_rujukan, surat.tarikh_surat, surat.daripada, surat.tajuk, surat.kepada, adm_bahagian.nama_bahagian, adm_kategori.kategori');
		$this->db->from('surat');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=surat.id_bahagian');
		$this->db->join('adm_kategori','adm_kategori.id_kategori=surat.id_kategori');
		//$this->db->where('tahun2', $tahun);
	//$this->db->where('surat.tarikh_terima', '2016-09-02');
		$this->db->order_by('surat.tarikh_terima', 'desc');
		 
		 if(!empty($data['tarikh_terima']) && !empty($data['id_bahagian']) ){
			$this->db->where('surat.tarikh_terima',$data['tarikh_terima']);
			$this->db->where('adm_bahagian.id_bahagian',$data['id_bahagian']);
		}
		else {
		}
		
		$data['list'] = $this->db->get(''); 
		
		$data['flash_success']=$this->session->flashdata('flash_success');
		$data['flash_error']=$this->session->flashdata('flash_error');
		
		$this->load->view('senarai_surat_terbuka',$data);
		$this->output->enable_profiler(TRUE);
	}*/
	
	public function index()
	{
		if(isset($_POST['refresh'])) { 
			$array_items=array('sess_tarikh_terima' => '','sess_id_bahagian' => '');
			$this->session->unset_userdata($array_items);
		}
		
		 //Untuk Carian 
		if(isset($_POST['carian'])) { 
			$data['tarikh_terima']= convert_date_formattodb($this->input->post('tarikh_terima')); 
			$data['id_bahagian']= $this->input->post('id_bahagian'); 
			
		} else {
			$data['tarikh_terima'] = $this->session->userdata('sess_tarikh_terima');	
			//$data['id_bahagian'] = $this->session->userdata('sess_id_bahagian');
		}
		$this->db->select('surat.id_surat,surat.tarikh_terima, surat.no_rujukan, surat.tarikh_surat, surat.daripada, surat.tajuk, surat.kepada, adm_bahagian.nama_bahagian, adm_kategori.kategori');
		$this->db->from('surat');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=surat.id_bahagian');
		$this->db->join('adm_kategori','adm_kategori.id_kategori=surat.id_kategori');
		$this->db->order_by('surat.tarikh_terima', 'desc');
		
		if(($data['tarikh_terima'] !='tiada') && ($data['id_bahagian'] !='tiada')) {
            $this->db->where('surat.tarikh_terima',$data['tarikh_terima']);
			$this->db->where('adm_bahagian.id_bahagian',$data['id_bahagian']);
		}
		
		
			else{
			
		}
		$data['list'] = $this->db->get('');
		
		$data['flash_success']=$this->session->flashdata('flash_success');
		$data['flash_error']=$this->session->flashdata('flash_error');
		
		//$data['list_bahagian']=$this->db->get('adm_bahagian');
		$data['list_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		
		$this->load->view('senarai_surat_terbuka',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	public function senarai_surat_peribadi()
	{
		if(isset($_POST['refresh'])) { 
			$array_items=array('sess_tarikh_terima' => '','sess_id_bahagiann' => '');
			$this->session->unset_userdata($array_items);
		}
		
		 //Untuk Carian 
		if(isset($_POST['carian'])) { 
			$data['tarikh_terima']= convert_date_formattodb($this->input->post('tarikh_terima')); 
			$data['id_bahagian']= $this->input->post('id_bahagian'); 
			
		} else {
			$data['tarikh_terima'] = $this->session->userdata('sess_tarikh_terima');	
			//$data['id_bahagian'] = $this->session->userdata('sess_id_bahagian');
		}
		$this->db->select('surat_peribadi.id_surat_peribadi,surat_peribadi.tarikh_terima, surat_peribadi.no_rujukan, surat_peribadi.daripada, surat_peribadi.kepada, adm_bahagian.nama_bahagian');
		$this->db->from('surat_peribadi');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=surat_peribadi.id_bahagian');
		$this->db->order_by('surat_peribadi.tarikh_terima', 'desc');
		
		if(($data['tarikh_terima'] !='tiada') && ($data['id_bahagian'] !='tiada')) {
            $this->db->where('surat_peribadi.tarikh_terima',$data['tarikh_terima']);
			$this->db->where('adm_bahagian.id_bahagian',$data['id_bahagian']);
		}
			else{
			
		}
		$data['list'] = $this->db->get('');
		
		$data['flash_success']=$this->session->flashdata('flash_success');
		$data['flash_error']=$this->session->flashdata('flash_error');
		
		//$data['list_bahagian']=$this->db->get('adm_bahagian');
		$data['list_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		
		$this->load->view('senarai_surat_peribadi',$data);
		//$this->output->enable_profiler(TRUE);
	}
}
