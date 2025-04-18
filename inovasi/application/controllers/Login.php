<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('login');
		
	}
	
	function add_pengguna()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_pengguna',$data);
		
		//$this->output->enable_profiler(TRUE);		
	}
	
	
	
	function login_proses()
	{
		
		$email = $this->input->post('email',TRUE);
		$password = md5($this->input->post('kata_laluan',TRUE));
		$this->db->where('email', $email);			
		$this->db->where('kata_laluan', $password);			
		$query =$this->db->get('user');
		
		if($query->num_rows() == 1){
			$user = $query->row();
			
			$data = array(
					'sess_nama_penuh'=> $user->nama_penuh,
					'sess_level'=>$user->level,
					'sess_id'=> $user->id_user,
					'sess_id_jabatan'=> $user->id_jabatan,
					'logged_in' => TRUE);
			
			$this->session->set_userdata($data);
			
			if(($user->level != 4)&& ($user->level != 1)){ //if bukan urusetia
				$today=date('Y-m-d');
				if($today > $user->date_range){
					$this->session->set_flashdata('flash_error', 'Tarikh penyertaan telah ditutup.'); 
						redirect('login','refresh');
				}
			}
			
			if($level == 4)
			{
				redirect('main/utama/'.$id,'refresh');
			}
				else if($level == 1)
				{
					redirect('main/utama/'.$id,'refresh');
				}
				else if($level == 5)
				{
					redirect('main/utama2/'.$id,'refresh');
				}
					else
					{
						redirect('main/add_pengguna1/'.$id,'refresh');
					}
		
			
			
		}else {
		
		
		 $this->session->set_flashdata('flash_error', 'Id Pengguna dan Katalaluan tidak sah.'); 
				
			redirect('login','refresh');
		   
		  
			
		}
		
		//echo "-->".$sess_level = $this->session->userdata('sess_level');
		
		
		$this->output->enable_profiler(TRUE);
				
	}
	
	function add_daftar_proses()
	{
		
		
		//$password = $this->input->post('kata_laluan');
		$email = $this->input->post('email');
		

		$this->db->where('email',$email);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		$query =$this->db->get('user');
		$user = $query->row();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('login','refresh');

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
						'cipta_pada' => $today,
						'date_range' => $user->date_range,
						
						//'nama_penuh' => $this->input->post('nama_penuh'),
						
						//'no_kp' => $this->input->post('no_kp'),					
					
					);		
			
			
//			var_dump($data);die;
			$this->db->insert('user', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya didaftar');
			
			
			//lepas simpan data terus ke page senarai
			redirect('login','refresh');
		
			//$this->output->enable_profiler(TRUE);
			
		}	
		
	}
	
	
}
