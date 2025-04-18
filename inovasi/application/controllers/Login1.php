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
		$sql = $this->db->query("select level from user where email = '$email'");
		
		
		//$user= $this->model_pengguna->check_user($username,$this->_prep_password($password));
		$user= $this->model_pengguna->check_user($email,$password );
		//$this->output->enable_profiler(TRUE);
		//exit();
		//f$level=$this->session->userdata('sess_level');
		if($user == TRUE){
			
			$this->db->where('email', $email);			
			$query =$this->db->get('user');
			
			if ($query->num_rows() == 1) {
				foreach($query->result() as $row) {
					
					$sess_nama_penuh = $row->nama_penuh;
					
					
					$level = $row->level;
					
					$id = $row->id_user;
					
					
					
					
				}
			}
			
			
		  $data = array('sess_nama_penuh'=> $sess_nama_penuh,'sess_level'=>$level,'sess_id'=> $id,'logged_in' => TRUE);
			
			$this->session->set_userdata($data);
			//$data = array('sess_nama_penuh'=> $sess_nama_penuh,'sess_level'=>$level,'sess_id_user'=> $id_user,'logged_in' => TRUE);
			
			//$this->db->where('email', $email);	
			if($level != 4){
				$today=date('Y-m-d');
				$this->db->where('date_range >=',$today);
				$this->db->where('id_user =',$id);
				$query2 =$this->db->get('user');
				
				if ($query2->num_rows() < 1) {
				
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
					else
					{
						redirect('main/add_pengguna1/'.$id,'refresh');
					}
		
			
			
		}else{
		
		
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
						'date_range' => $today,
						
						//'nama_penuh' => $this->input->post('nama_penuh'),
						
						//'no_kp' => $this->input->post('no_kp'),					
					
					);		
			
			
			
			$this->db->insert('user', $data);	
			
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat berjaya didaftar');
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/login','refresh');
		
			//$this->output->enable_profiler(TRUE);
			
		}	
		
	}
	
	
}
