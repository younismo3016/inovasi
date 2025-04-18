<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()

	{
		$this->load->view('login');
		
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
	
		function add_pengguna()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_pengguna',$data);
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
			redirect('main/login','refresh');

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
			redirect('main/login','refresh');
			//$this->output->enable_profiler(TRUE);
			
		}	
		
	}
	
	
	
	function utama()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$this->db->select('*');
		$this->db->from('projek');
		$this->db->where('id_ketua_projek',$id);
		$data['list'] = $this->db->get('');
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('utama',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	
	function add_pengguna1()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$query = $this->db->query("SELECT * FROM user where id_user = '$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				
				
				$data['nama_penuh'] = $row->nama_penuh;
				$data['jawatan'] = $row->jawatan;
				$data['gred'] = $row->gred;
				$data['email'] = $row->email;
				$data['no_tel_bimbit'] = $row->no_tel_bimbit;
				//$data['id_jabatan'] = $row->id_jabatan;
				$data['level'] = $row->level;
				$data['no_tel'] = $row->no_tel;
			    $data['id_user'] = $row->id_user;
				
			}
			
		$data['act'] = "edit";
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_pengguna1',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	
	
	
	
	function edit_pengguna($id_user)
	{
		$query = $this->db->query("SELECT * FROM user where id_user='$id_user'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				//$data['nama'] = $row->nama;
				$data['nama_penuh'] = $row->nama_penuh;
				$data['jawatan'] = $row->jawatan;
				$data['gred'] = $row->gred;
				$data['email'] = $row->email;
				$data['no_tel_bimbit'] = $row->no_tel_bimbit;
				$data['email_ketua'] = $row->email_ketua;
				$data['id_jabatan'] = $row->id_jabatan;
				$data['level'] = $row->level;
				$data['no_tel'] = $row->no_tel;
			    $data['id_user'] = $row->id_user;
					
			}
			
		$data['act'] = "edit";
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_pengguna1',$data);
		$this->session->set_userdata($data);
		//$this->output->enable_profiler(TRUE);
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
	function kemaskini_pengguna($id_user)
	{
		$query = $this->db->query("SELECT * FROM user where id_user='$id_user'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				//$data['nama'] = $row->nama;
				$data['nama_penuh'] = $row->nama_penuh;
				$data['jawatan'] = $row->jawatan;
				$data['gred'] = $row->gred;
				$data['email'] = $row->email;
				$data['nama_ketua'] = $row->nama_ketua;
				$data['email_ketua'] = $row->email_ketua;
				$data['id_jabatan'] = $row->id_jabatan;
				$data['level'] = $row->level;
				$data['no_tel'] = $row->no_tel;
			    $data['id_user'] = $row->id_user;
					
			}
			
		$data['act'] = "edit";
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('kemaskini_pengguna',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	
	function del_pengguna($id)
	{
		
		
		$this->db->where('id_user', $id);
		$this->db->delete('user');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_pengguna','refresh');
				
	}
	
	function ketua_organisasi()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$query = $this->db->query("SELECT * FROM user where id_user = '$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				
				
				
				$data['level'] = $row->level;
			
			    $data['id_user'] = $row->id_user;
				
			}
			
		$data['act'] = "add";
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('ketua_organisasi',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_ketua_organisasi()
	{
		
		
		//$password = $this->input->post('kata_laluan');
		$email = $this->input->post('email');

		$this->db->where('email',$email);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/utama','refresh');

		}else{

			
			//echo $password;
			$data = array(			
					
						'nama_penuh' => $this->input->post('nama_penuh'),
						'jawatan' => $this->input->post('jawatan'),
						'gred' => $this->input->post('gred'),
						'email' => $this->input->post('email'),
						'no_tel' => $this->input->post('no_tel'),
						'level' => '1',
						'id_ketua_organisasi' => $this->input->post('key'),
						'kata_laluan' => '202cb962ac59075b964b07152d234b70',				
					
					);		
			//insert ke table user
			$this->db->insert('user', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya didaftar'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/utama','refresh');
			//$this->output->enable_profiler(TRUE);
			
		}	
		
	}
	
	function daftar_projek()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$query = $this->db->query("SELECT * FROM user where id_user = '$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				
				
				
				$data['level'] = $row->level;
			
			    $data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			
		$data['act'] = "add";
		$data['list_negeri']=$this->db->get('adm_negeri');
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('daftar_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
		
	}
	
	function daftar_projek_proses()
	{
		
		

			
			//echo $password;
			$data = array(			
					
						'tajuk_projek' => $this->input->post('tajuk_projek'),
						'bidang' => $this->input->post('bidang'),
						'pertandingan' => $this->input->post('pertandingan'),
						'kategori' => $this->input->post('kategori'),
						'nama_kumpulan' => $this->input->post('nama_kumpulan'),
						'negeri' => $this->input->post('negeri'),
						'cawangan' => $this->input->post('cawangan'),
						'jabatan' => $this->input->post('jabatan'),
						'alamat1' => $this->input->post('alamat1'),
						'alamat2' => $this->input->post('alamat2'),
						'alamat3' => $this->input->post('alamat3'),
						//'level' => '1',
						'id_ketua_projek' => $this->input->post('key'),
										
					
					);		
			//insert ke table user
			$this->db->insert('projek', $data);	
			
			//$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya didaftar'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/utama','refresh');
			//$this->output->enable_profiler(TRUE);
			
		}	
		function ahli_pasukan()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$query = $this->db->query("SELECT * FROM user where id_ketua_projek = '$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				
				$data['nama_penuh'] = $row->nama_penuh;
				$data['level'] = $row->level;
				$data['no_tel'] = $row->no_tel;
				$data['email'] = $row->email;
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id_ketua_projek',$id);	
		$data['list'] = $this->db->get('');	
		$data['act'] = "add";
		//$data['list_negeri']=$this->db->get('adm_negeri');
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('ahli_pasukan',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
		
	}
	
	function ahli_pasukan_proses()
	{
		
		

			
			//echo $password;
			$data = array(			
					
						'nama_penuh' => $this->input->post('nama_penuh'),
						'no_tel' => $this->input->post('no_tel'),
						'jawatan' => $this->input->post('jawatan'),
						'no_tel_bimbit' => $this->input->post('no_tel_bimbit'),
						'gred' => $this->input->post('gred'),
						'email' => $this->input->post('email'),
						//'level' => '1',
						'id_ketua_projek' => $this->input->post('key'),
										
					
					);		
			//insert ke table user
			$this->db->insert('user', $data);	
			
			//$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya didaftar'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/ahli_pasukan','refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function view_projek()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$query = $this->db->query("SELECT * FROM user where id_user = '$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				
				
				
				$data['level'] = $row->level;
			
			    $data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			
		$data['act'] = "add";
		$data['list_negeri']=$this->db->get('adm_negeri');
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('view_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
		
	}
	
	function pengguna()
	
	{	
		//$id = $this->session->userdata('sess_id');
		
		$this->db->select('*');
		$this->db->from('user');
		
		$data['list'] = $this->db->get('');
			
		//$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('pengguna',$data);
		//$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	function logout(){
		
		
		// Destroy all the session
		$this->session->sess_destroy();
		//insert data ke audit trail
		
		
		redirect('main/login'); // sesudah logout di redirect ke halaman utama
	}
	
	
	
}
	

	
	
	

			
			
		
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */