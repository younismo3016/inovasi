<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carian extends MY_Controller {

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
		//utk refresh
		if(isset($_POST['refresh'])) { 
			$array_items=array('sess_no_rujukan' => '');
			$this->session->unset_userdata($array_items);
		}
		
        //Untuk Carian 
		if(isset($_POST['carian'])) { 
			$data['no_rujukan']= $this->input->post('no_rujukan');
						
		} else {
			$data['no_rujukan'] = $this->session->userdata('no_rujukan');
					
		}
			
		$no_rujukan = $this->input->post('no_rujukan');
		
		$this->db->select('surat.id_pengguna,surat.tarikh_terima,surat.daripada,adm_bahagian.nama_bahagian');
		$this->db->from('surat');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=surat.id_bahagian');
		$this->db->where('surat.no_rujukan',$no_rujukan);
		
		
		
		
		if(!empty($data['no_rujukan']) !=''){
			$this->db->where('surat.no_rujukan',$data['no_rujukan']);
			
		}else {
			
		}
				
		$data['list_carian'] = $this->db->get('');

		$data['flash_success']=$this->session->flashdata('flash_success');
		$data['flash_error']=$this->session->flashdata('flash_error');
		
					
		$this->load->view('carian',$data);
		//$this->output->enable_profiler(TRUE);
	}
		
	
}
