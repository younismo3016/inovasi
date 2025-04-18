<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarkp extends CI_Controller {

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

	
	function add_pengguna()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_pengguna',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	function login()

	{
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		$this->load->view('login',$data);
		
		//$this->output->enable_profiler(TRUE);
	}

	
	
	
	function add_daftar_proses()
	{
				
		//$password = $this->input->post('kata_laluan');
		$email = $this->input->post('email');

		$this->db->where('email',$email);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			$this->load->view('add_pengguna');

		}else{

			$today = date('Y-m-d');
			//echo $password;
			$data = array(			
					
						'nama_penuh' => $this->input->post('nama_penuh'),
						'kata_laluan' => md5($this->input->post('kata_laluan')),
						'email' => $this->input->post('email'),
						'jawatan' => $this->input->post('jawatan'),
						'gred' => $this->input->post('gred'),
						'no_tel' => $this->input->post('no_tel'),
						'level' => '2',
						'cipta_pada' => $today
						
						//'nama_penuh' => $this->input->post('nama_penuh'),
						
						//'no_kp' => $this->input->post('no_kp'),					
					
					);		
			//insert ke table user
			$this->db->insert('user', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya didaftar'); 
			
			
			//lepas simpan data terus ke page senarai
			$this->load->view('login');
			//$this->output->enable_profiler(TRUE);
			
		}	
		
	}
	
		function edit_pengguna_proses()
	{
		
		$id_user = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		'nama_penuh' => $this->input->post('nama_penuh'),
		'jawatan' => $this->input->post('jawatan'),		
		'gred' => $this->input->post('gred'),
		'email' => $this->input->post('email'),
		'no_tel_bimbit' => $this->input->post('no_tel_bimbit'),
		'no_tel' => $this->input->post('no_tel'),
		//'id_user' => $this->input->post('id_user'),
		);
		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id_user,$data,'id_user');
	    $this->output->enable_profiler(TRUE);
		redirect ('main/add_pengguna1','refresh');
	}		
	
	
}
