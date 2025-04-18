<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	
	 
	public function index()
	{
		$this->mukadepan();
	}
	
	function login()
	{
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		$this->load->view('login',$data);
	}
	
		
	function _prep_password($password)
	{
		return sha1($password.$this->config->item('encryption_key'));
	}
	
	function login_process()
	{
		
		$username = $this->input->post('nama',TRUE);
		$password = md5($this->input->post('kata_laluan',TRUE));
		
		//$user= $this->model_pengguna->check_user($username,$this->_prep_password($password));
		$user= $this->model_pengguna->check_user($username,$password);
		if($user == TRUE){
			
			$this->db->where('nama', $username,'nama_penuh');			
			$query =$this->db->get('user');
			
			if ($query->num_rows() == 1) {
				foreach($query->result() as $row) {
					$sess_nama = $row->nama;
					$sess_nama_penuh = $row->nama_penuh;
					$level = $row->level;
					$id = $row->id_user;
					
				}
			}
				
			$data = array('sess_nama_penuh'=> $sess_nama_penuh,'sess_level'=>$level,'sess_id'=> $id,'logged_in' => TRUE );
			
			$this->session->set_userdata($data);	
			
			redirect('main/mukadepan','refresh');
		
			
			
		}else{
			$this->session->set_flashdata('flash_error', 'Id Pengguna dan Katalaluan tidak sah.'); 
				
	        redirect('main/login','refresh');
			
		}
		//$this->output->enable_profiler(TRUE);
				
	}
	
	
	function kemaskini_katalaluan($id_user)
	
	{
		$query = $this->db->query("SELECT * FROM user where id_user='$id_user'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['nama'] = $row->nama;
				$data['kata_laluan'] = $row->kata_laluan;
				$data['id_user'] = $row->id_user;
					
			}
			
		$data['act'] = "edit";
		$this->load->view('kemaskini_katalaluan',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	
	
	function kemaskini_katalaluan_proses()
	
	{
		
		$id_user = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		'kata_laluan' => md5($this->input->post('kata_laluan')),
			
		);
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id_user,$data,'id_user');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_pengguna','refresh');		
	}
	
	
		function add_pengguna()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_pengguna',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	
	function add_pengguna_proses()
	{
		
		
		//$password = $this->input->post('kata_laluan');
		$id_user = $this->input->post('nama');

		$this->db->where('nama', $id_user);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/pengemaskinian_pengguna','refresh');

		}else{

			$today = date('Y-m-d');
			//echo $password;
			$data = array(			
					
						'nama' => $id_user,
						'kata_laluan' => md5($this->input->post('kata_laluan')),
						'nama_penuh' => $this->input->post('nama_penuh'),
						'jawatan' => $this->input->post('jawatan'),
						'gred' => $this->input->post('gred'),
						'email' => $this->input->post('email'),		
						'level' => $this->input->post('level'),
						'no_tel' => $this->input->post('no_tel'),
						'cipta_pada' => $today
					
					);		
			//insert ke table user
			$this->db->insert('user', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di simpan'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/pengemaskinian_pengguna','refresh');
			//$this->output->enable_profiler(TRUE);

		}				
	}
	
	
	function edit_pengguna($id_user)
	{
		$query = $this->db->query("SELECT * FROM user where id_user='$id_user'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['nama'] = $row->nama;
				$data['nama_penuh'] = $row->nama_penuh;
				$data['jawatan'] = $row->jawatan;
				$data['gred'] = $row->gred;
				$data['level'] = $row->level;
				$data['no_tel'] = $row->no_tel;
				$data['email'] = $row->email;
				$data['id_user'] = $row->id_user;
					
			}
			
		$data['act'] = "edit";
		$this->load->view('add_pengguna',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
		function edit_pengguna_proses()
	{
		
		$id_user = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		'nama' => $this->input->post('nama'),
		'nama_penuh' => $this->input->post('nama_penuh'),		
		'jawatan' => $this->input->post('jawatan'),
		'gred' => $this->input->post('gred'),
		'email' => $this->input->post('email'),
		'no_tel' => $this->input->post('no_tel'),
		'level' => $this->input->post('level'),
	
		);
		
		$kata_laluan = $this->input->post('kata_laluan');
		if(!empty($kata_laluan)){
			$data .= array (			
			
			'kata_laluan' => $this->input->post('kata_laluan'),
			
			);
		}
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id_user,$data,'id_user');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_pengguna','refresh');
	}
	
	
	function del_pengguna($id)
	{
		
		
		$this->db->where('id_user', $id);
		$this->db->delete('user');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_pengguna','refresh');
				
	}
	
	
	
	
	
	function view_pengguna($id)
	{
		
		$query = $this->db->query("SELECT * FROM pengguna where id='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['id_pengguna'] = $row->id_pengguna;
				//$data['level'] = $row->level;
				
				$data['status'] = $row->status;
				$data['id'] = $row->id;				
				
					
			}
		
		//$data['act'] = "edit";
		$this->load->view('view_pengguna',$data);
		//$this->output->enable_data_lamaer(TRUE);		
	}
	
	
	function pengemaskinian_ptj()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['nama_ptj']= $this->input->post('nama_ptj');		
			$this->session->set_userdata('sess_nama_ptj',$data['nama_ptj']);
			
			
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['nama_ptj'] = $this->session->userdata('sess_nama_ptj');
				
				
		}
		
			
		$this->db->select('ptj.kod_ptj as kod_ptj,ptj.nama_ptj as nama_ptj,ptj.id_ptj as id_ptj,ptj.status_aktif as status_aktif,user.nama_penuh as nama_penuh');			
		$this->db->from('ptj');
		$this->db->join('user','ptj.id_user = user.id_user','left');
		
		
		
		
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['nama_ptj'])){
			$this->db->like('nama_ptj',$data['nama_ptj']);
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_ptj/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pengemaskinian_ptj($pagination['per_page'],$this->uri->segment(4,0),$data['kod_ptj'],$data['nama_ptj']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('pengemaskinian_ptj',$data);
		//$this->output->enable_profiler(TRUE);
	}
		function pengemaskinian_pengguna()
	{	
	
	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['level']= $this->input->post('level');		
			$this->session->set_userdata('sess_f_level',$data['level']);
			
			$data['status']= $this->input->post('status');		
			$this->session->set_userdata('sess_f_status',$data['status']);
			
	
			
		} else {
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['level'] = $this->session->userdata('sess_f_level');
				$data['status'] = $this->session->userdata('sess_f_status');
				
		}
		
		$this->db->select('*');			
		$this->db->from('user');
		//$this->db->join('ptj','ptj.id_user = user.id_user');
		
		if(!empty($data['nama'])){
			$this->db->like('nama',$data['nama']);
		}
		if(!empty($data['level'])){
			$this->db->where('level',$data['level']);
		}
		if($data['status'] != 'pilih'){
			$this->db->where('status',$data['status']);
		}
		
		
		
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_pengguna/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "10";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pengemaskinian_pengguna($pagination['per_page'],$this->uri->segment(4,0),$data['nama'],$data['level'],$data['status']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('pengemaskinian_pengguna',$data);
		//$this->output->enable_profiler(TRUE);
	}
function pengemaskinian_kuiri()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['q1']= $this->input->post('q1');		
			$this->session->set_userdata('sess_q1',$data['q1']);
			
			
			
			
		} else {
				
				$data['q1'] = $this->session->userdata('sess_q1');
				
				
		}
		
		$this->db->select('*');			
		$this->db->from('kuiri1');
		
		
		
		if(!empty($data['q1'])){
			$this->db->like('q1',$data['q1']);
			
			
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_kuiri/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pengemaskinian_kuiri($pagination['per_page'],$this->uri->segment(4,0),$data['q1']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('pengemaskinian_kuiri',$data);
		$this->output->enable_profiler(TRUE);
	}

function add_kuiri()
	
	{
		$data['act'] = "add";
			

		
		
			
		$this->load->view('add_kuiri',$data);
		//$this->output->enable_profiler(TRUE);		


	}
	function add_kuiri_proses()
	
	{
	$data = array (		
		'q1' => $this->input->post('q1'),

		
		//'id_adm_negeri' => $this->input->post('negeri'),
		
		);

		
		//user = nama table
		$this->db->insert('kuiri1',$data);
		
		
		
	
		
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_kuiri','refresh');	
				
	}
	function del_kuiri($id)
	{
		
		
		$this->db->where('id_q1', $id);
		$this->db->delete('kuiri1');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_kuiri','refresh');
				
	}
	function edit_kuiri($id)
	{
		$query = $this->db->query("SELECT * FROM kuiri1 where id_q1='$id'");					
		
			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['q1'] = $row->q1;	
				$data['id_q1'] = $row->id_q1;
				
				
			}
		//$this->db->from('adm_negeri');	
		$this->db->from('kuiri1');	
		//$this->db->where('level = 1');			
		$data['list_user'] = $this->db->get('');
		
		$data['act'] = "edit";
		$this->load->view('add_kuiri',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function edit_kuiri_proses()
	{
		$id= $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		'q1' => $this->input->post('q1')
		
		
		
	
		
		
		);
		//$data['list_negeri'] = $this->db->get('adm_negeri');
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
	
		$this->model_pengguna->update_data('kuiri1',$id,$data,'id_q1');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_kuiri','refresh');
	}
	
	function pengemaskinian_jenis_kuiri($id_q1)
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['q2']= $this->input->post('q2');		
			$this->session->set_userdata('sess_q2',$data['q2']);
			
			
			
			
		} else {
				
				$data['q2'] = $this->session->userdata('sess_q2');
				
				
		}
		
		
		
		$this->db->select('*');			
		$this->db->from('kuiri2');
		$this->db->where('id_q1',$id_q1);
		
		
		
		if(!empty($data['q2'])){
			$this->db->like('q2',$data['q2']);
			
			
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_jenis_kuiri/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pengemaskinian_jenis_kuiri($pagination['per_page'],$this->uri->segment(4,0),$data['q2'],$id_q1);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['id_q1'] =$id_q1;
		
		$this->load->view('pengemaskinian_jenis_kuiri',$data);
		$this->output->enable_profiler(TRUE);
	}
	function add_jenis_kuiri($id_q1)
	
	{
	
		
		
		
		$data['act'] = "add";
		
		//$this->db->from('user');	
		//$this->db->where('level = 3');			
		//$data['list_user'] = $this->db->get('');
		
	
		//$this->db->from('adm_negeri');
		//$data['list_negeri'] = $this->db->get('');
		$data['id_q1'] =$id_q1;	
		$this->load->view('add_jenis_kuiri',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	function add_jenis_kuiri_proses()
	
	{
	
	$id= $this->input->post('key');
	$data = array (		
		'q2' => $this->input->post('q2'),

		'id_q1' => $this->input->post('key'),
		//'id_adm_negeri' => $this->input->post('negeri'),
		
		);

		
		//user = nama table
		$this->db->insert('kuiri2',$data);
		
		
		
	
		
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_jenis_kuiri/'.$id,'refresh');	
				
	}
	function del_jenis_kuiri($id)
	{
		
		
		$this->db->where('id_q2', $id);
		$this->db->delete('kuiri2');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_kuiri','refresh');
				
	}
	function edit_jenis_kuiri($id)
	{
		$query = $this->db->query("SELECT * FROM kuiri1 where id_q1='$id'");					
		
			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['q1'] = $row->q1;	
				$data['id_q1'] = $row->id_q1;
				
				
			}
		//$this->db->from('adm_negeri');	
		$this->db->from('kuiri1');	
		//$this->db->where('level = 1');			
		$data['list_user'] = $this->db->get('');
		
		$data['act'] = "edit";
		$this->load->view('add_kuiri',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function edit_jenis_kuiri_proses()
	{
		$id= $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		'q1' => $this->input->post('q1')
		
		
		
	
		
		
		);
		//$data['list_negeri'] = $this->db->get('adm_negeri');
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
	
		$this->model_pengguna->update_data('kuiri1',$id,$data,'id_q1');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_jenis_kuiri/'.$id,'refresh');
	}
		
	
	function pengemaskinian_sub_kuiri($id_q2)
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['q3']= $this->input->post('q3');		
			$this->session->set_userdata('sess_q3',$data['q3']);
			
			
			
			
		} else {
				
				$data['q3'] = $this->session->userdata('sess_q3');
				
				
		}
		
		
		
		$this->db->select('*');			
		$this->db->from('kuiri3');
		$this->db->where('id_q2',$id_q2);
		
		
		
		if(!empty($data['q3'])){
			$this->db->like('q3',$data['q3']);
			
			
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_sub_kuiri/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pengemaskinian_sub_kuiri($pagination['per_page'],$this->uri->segment(4,0),$data['q3'],$id_q2);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		$data['id_q2'] =$id_q2;
		$this->load->view('pengemaskinian_sub_kuiri',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function add_sub_kuiri($id_q2)
	
	{
		$data['act'] = "add";
			

		
		//$this->db->from('user');	
		//$this->db->where('level = 3');			
		//$data['list_user'] = $this->db->get('');
		
	
		//$this->db->from('adm_negeri');
		//$data['list_negeri'] = $this->db->get('');
		$data['id_q2'] =$id_q2;	
		$this->load->view('add_sub_kuiri',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	function add_sub_kuiri_proses()
	
	{
	
		
		
		
		//upload gambar
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			
			 $error = array('error' => $this->upload->display_errors());
			 echo var_dump($error);
			//echo "gagal";

			//$this->load->view('upload_form', $error);
		}
		else
		{
			$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			$file_name = $upload_data['file_name'];
			
			//
			$id= $this->input->post('key');
			$data = array (		
			'q3' => $this->input->post('q3'),

			'id_q2' => $this->input->post('key'),
			'nama_gambar' => $file_name,
			//'id_adm_negeri' => $this->input->post('negeri'),
			
			);

			
			//user = nama table
			$this->db->insert('kuiri3',$data);
			//echo "berjaya";
			//$this->load->view('upload_success', $data);
		}
		
		
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_sub_kuiri/'.$id,'refresh');	
				
	}
	function del_sub_kuiri($id)
	{
		
		$nama_gambar=get_nama_gambar($id);
		$path_image =	"img/".$nama_gambar ;
		unlink($path_image); // correct
		
		$this->db->where('id_q3', $id);
		$this->db->delete('kuiri3');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_kuiri','refresh');
				
	}
	

		
			function senarai_penerimaan()
{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			$data['tahun_terima']= $this->input->post('tahun_terima');		
			$this->session->set_userdata('sess_tahun_terima',$data['tahun_terima']);
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				$data['tahun_terima'] = $this->session->userdata('sess_tahun_terima');
				
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		
		
		
		if(!empty($data['kod_ptj'])){
			$this->db->like('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['bulan_kkwt'])){
			$this->db->where('bulan_kkwt',$data['bulan_kkwt']);
		}
		if(!empty($data['nama_ptj'])){
			$this->db->where('nama_ptj',$data['nama_ptj']);
		}


		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/senarai_penerimaan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->senarai_penerimaan($pagination['per_page'],$this->uri->segment(4,0),$data['kod_ptj'],$data['bulan_kkwt'],$data['tahun_terima']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
		
		//indicator bilangan hari semakan dokumen

		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('senarai_penerimaan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	
	function senarai_PP()
	{	
	
	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['level']= $this->input->post('level');		
			$this->session->set_userdata('sess_f_level',$data['level']);
			
		
			
	
			
		} else {
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['level'] = $this->session->userdata('sess_f_level');
				
				
		}
		
		$this->db->select('*');			
		$this->db->from('user');
		//$this->db->join('ptj','ptj.id_user = user.id_user');
		
		if(!empty($data['nama'])){
			$this->db->like('nama',$data['nama']);
		}
		if(!empty($data['level'])){
			$this->db->where('level',$data['level']);
		}
		
		
		
		
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/senarai_PP/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "10";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->senarai_PP($pagination['per_page'],$this->uri->segment(4,0),$data['nama'],$data['level']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('senarai_PP',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function list_user_ptj($id_user)
	{	
		
		$data['list'] = $this->model_pengguna->list_user_ptj($id_user);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('list_user_ptj',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function add_ptj()
	
	{
		$data['act'] = "add";
			

		
		$this->db->from('user');	
		$this->db->where('level = 3');			
		$data['list_user'] = $this->db->get('');
		
	
		//$this->db->from('adm_negeri');
		//$data['list_negeri'] = $this->db->get('');
			
		$this->load->view('add_ptj',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	function add_ptj_proses()
	
	{
	$today = date('Y-m-d');
	$data = array (		
		'nama_ptj' => $this->input->post('nama_ptj'),
		'kod_ptj' => $this->input->post('kod_ptj'),
		'nama_jabatan' => $this->input->post('nama_jabatan'),
		'alamat' => $this->input->post('alamat'),
		'alamat2' => $this->input->post('alamat2'),
		'alamat3' => $this->input->post('alamat3'),
		'poskod' => $this->input->post('poskod'),
		'negeri' => $this->input->post('negeri'),
		'no_telefon' => $this->input->post('no_telefon'),
		'saiz_ptj' => $this->input->post('saiz_ptj'),
		'nama_pegawai' => $this->input->post('nama_pegawai'),
		'id_negeri' => $this->input->post('kategori'),
		'id_daerah' => $this->input->post('subkategori'),	
		'id_user' => $this->input->post('user'),
		'status_aktif' =>'1',
		'cipta_pada' => $today,
		
		//'id_adm_negeri' => $this->input->post('negeri'),
		
		);

		
		//user = nama table
		$this->db->insert('ptj',$data);
		
		
		
	
		
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_ptj','refresh');	
				
	}
	
	function edit_ptj($id)
	{
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					
		
			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['kod_ptj'] = $row->kod_ptj;				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['nama_jabatan'] = $row->nama_jabatan;
				$data['alamat'] = $row->alamat;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['negeri'] = $row->negeri;
				$data['nama_pegawai'] = $row->nama_pegawai;
				$data['no_telefon'] = $row->no_telefon;
				$data['saiz_ptj'] = $row->saiz_ptj;
				$data['poskod'] = $row->poskod;
				$data['list_negeri'] = $this->db->get('adm_negeri');
				$data['id_ptj'] = $row->id_ptj;
				$data['id_user'] = $row->id_user;
				$data['status_aktif'] = $row->status_aktif;
				$data['hapus_pada'] = $row->hapus_pada;
				//$data['id_adm_negeri'] = $row->id_adm_negeri;
				
			}
		//$this->db->from('adm_negeri');	
		$this->db->from('user');	
		//$this->db->where('level = 1');			
		$data['list_user'] = $this->db->get('');
		
		$data['act'] = "edit";
		$this->load->view('add_ptj',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function edit_ptj_proses()
	{
		$id = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		'kod_ptj' => $this->input->post('kod_ptj'),
		'nama_ptj' => $this->input->post('nama_ptj'),
		'nama_jabatan' => $this->input->post('nama_jabatan'),
		'alamat' => $this->input->post('alamat'),
		'alamat2' => $this->input->post('alamat2'),
		'alamat3' => $this->input->post('alamat3'),
		'nama_pegawai' => $this->input->post('nama_pegawai'),
		'no_telefon' => $this->input->post('no_telefon'),
		'saiz_ptj' => $this->input->post('saiz_ptj'),
		'poskod' => $this->input->post('poskod'),
		'negeri' => $this->input->post('negeri'),
		'id_user' => $this->input->post('user'),
		'status_aktif' => $this->input->post('status_aktif'),
		'hapus_pada' => $this->input->post('hapus_pada'),
	
		
		
		);
		//$data['list_negeri'] = $this->db->get('adm_negeri');
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
	
		$this->model_pengguna->update_data('ptj',$id,$data,'id_ptj');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_ptj','refresh');
	}
	
	function del_ptj($id)
	{
		
		
		$this->db->where('id_ptj', $id);
		$this->db->delete('ptj');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_ptj','refresh');
				
	}
	
	
	
	

	function penerimaan()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['nama_ptj']= $this->input->post('nama_ptj');		
			$this->session->set_userdata('sess_nama_ptj',$data['nama_ptj']);
			
			
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['nama_ptj'] = $this->session->userdata('sess_nama_ptj');
				
				
		}
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('user','user.id_user = ptj.id_user');
		
		if(!empty($data['kod_ptj'])){
			$this->db->like('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['nama_ptj'])){
			$this->db->like('nama_ptj',$data['nama_ptj']);
			
			
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/penerimaan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->penerimaan($pagination['per_page'],$this->uri->segment(4,0),$data['kod_ptj'],$data['nama_ptj']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('penerimaan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	function surat_peringatan()
{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['tahun_terima']= $this->input->post('tahun_terima');		
			$this->session->set_userdata('sess_tahun_terima',$data['tahun_terima']);
			
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				$data['tahun_terima'] = $this->session->userdata('sess_tahun_terima');
				
				
		}
		
		//$this->db->select('id_ptj,kod_ptj,nama_ptj,negeri');
		//$this->db->from('ptj');
		//$not_in="SELECT ptj.id_ptj FROM ptj
		//		inner join penerimaan ON ptj.id_ptj = penerimaan.id_ptj where bulan_kkwt='".$bulan_kkwt."' and tahun_terima='".$tahun_terima."'";
		//$this->db->where_not_in('p1.id_ptj',$not_in);
		
		
		
		//Pagination init
		/*
		$pagination['base_url'] 	= base_url().'index.php/main/semakan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		*/
		
		$data['list'] = $this->model_pengguna->surat_peringatan($data['kod_ptj'],$data['bulan_kkwt'],$data['tahun_terima']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('surat_peringatan',$data);
		$this->output->enable_profiler(TRUE);
	}
	
	function semakan()
{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			$data['nama_ptj']= $this->input->post('nama_ptj');		
			$this->session->set_userdata('sess_nama_ptj',$data['nama_ptj']);
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				$data['nama_ptj'] = $this->session->userdata('sess_nama_ptj');
				
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj.id_user',$id_sess_pengguna);
		}
		
		
		if(!empty($data['kod_ptj'])){
			$this->db->like('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['bulan_kkwt'])){
			$this->db->where('bulan_kkwt',$data['bulan_kkwt']);
		}
		if(!empty($data['nama_ptj'])){
			$this->db->where('nama_ptj',$data['nama_ptj']);
		}


		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/semakan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->semakan($pagination['per_page'],$this->uri->segment(4,0),$data['kod_ptj'],$data['bulan_kkwt'],$data['nama_ptj']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
		
		//indicator bilangan hari semakan dokumen

		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('semakan',$data);
		$this->output->enable_profiler(TRUE);
	}
	
	
	
	function surat_pertanyaan()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['nama_ptj']= $this->input->post('nama_ptj');		
			$this->session->set_userdata('sess_nama_ptj',$data['nama_ptj']);
			
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			$data['tahun_terima']= $this->input->post('tahun_terima');		
			$this->session->set_userdata('sess_tahun_terima',$data['tahun_terima']);
			
			
			
			
		} else {
				$data['nama_ptj'] = $this->session->userdata('sess_nama_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				$data['tahun_terima'] = $this->session->userdata('sess_tahun_terima');
				
				
		
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		
		
		
		if(!empty($data['nama_ptj'])){
			$this->db->like('nama_ptj',$data['nama_ptj']);
		}
		if(!empty($data['bulan_kkwt'])){
			$this->db->like('bulan_kkwt',$data['bulan_kkwt']);
		}
		if(!empty($data['tahun_terima'])){
			$this->db->like('tahun_terima',$data['tahun_terima']);
		}


		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/surat_pertanyaan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->surat_pertanyaan($pagination['per_page'],$this->uri->segment(4,0),$data['nama_ptj'],$data['bulan_kkwt'],$data['tahun_terima']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
		
		//indicator bilangan hari semakan dokumen

		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('surat_pertanyaan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	

	function surat_pertanyaan_todo($id,$bulan=null,$tahun_kuiri=null)
	{
		
		$data['bulan_kkwt_kuiri']=$bulan;
		$data['tahun_kuiri']=$tahun_kuiri;
		$query = $this->db->query("SELECT nama_ptj,id_ptj FROM ptj where id_ptj='$id' ");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
				
					
			}
			
			$query2 = $this->db->query("SELECT tarikh_kuiri FROM penerimaan where id_ptj='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['tarikh_kuiri'] = $row->tarikh_kuiri;
			
					
			}
			$query3 = $this->db->query("SELECT * FROM  senarai_kuiri join kuiri1 on kuiri1.id_q1=senarai_kuiri.id_q1 join kuiri2 on kuiri2.id_q2=senarai_kuiri.id_q2 
			join kuiri3 on kuiri2.id_q3=senarai_kuiri.id_q1 where senarai_kuiri.id_ptj='$id'");					

			if ($query3->num_rows() > 0)
			{
				$row = $query3->row(); 
				//umpukan variable  ke //field dari table
				
				$data['id_ptj'] = $row->id_ptj;
			
					
			}
			
		
			
		$pagination['base_url'] 	= base_url().'index.php/main/surat_pertanyaan_todo/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->surat_pertanyaan_todo($pagination['per_page'],$this->uri->segment(4,0),$data['id_ptj'],$bulan,$tahun_kuiri);
		//$this->model_pengguna->maklumbalas_kuiri('senarai_kuiri',$id,$data,'id_penerimaan');
		$data['act'] = "add";
		$data['list_q1'] = $this->db->get('kuiri1');
		$data['list_q2'] = $this->db->get('kuiri2');
		$data['list_q3'] = $this->db->get('kuiri3');
		//$data['act'] = "edit";
		$data['step'] = "";
		$this->load->view('surat_pertanyaan_todo',$data);
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function surat_pertanyaan_step1()
	
	{
		$id = $this->input->post('id_ptj');
		$bulan = $this->input->post('bulan_kkwt_kuiri');
		$tahun_kuiri = $this->input->post('tahun_kuiri');
		$data['id_q1'] = $id_q1 = $this->input->post('id_q1');
		
		$data['list_q1'] = $this->db->get('kuiri1');
		//$data['list_q2'] = $this->db->get('kuiri2');
		//$data['list_q3'] = $this->db->get('kuiri3');
		
		//get kueri 1
		$this->db->where('id_q1',$id_q1);
		$data['list_q2'] = $this->db->get('kuiri2');
			
		//get kueri 1
		$bulan_kkwt_kuiri = $this->input->post('bulan_kkwt_kuiri');		
		$data['bulan_kkwt_kuiri']=$bulan;
		$data['tahun_kuiri']=$tahun_kuiri;
		$query = $this->db->query("SELECT nama_ptj,id_ptj FROM ptj where id_ptj='$id' ");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
				
					
			}
			
			$query2 = $this->db->query("SELECT tarikh_kuiri FROM penerimaan where id_ptj='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['tarikh_kuiri'] = $row->tarikh_kuiri;
			
					
			}
			$query3 = $this->db->query("SELECT * FROM  senarai_kuiri join kuiri1 on kuiri1.id_q1=senarai_kuiri.id_q1 join kuiri2 on kuiri2.id_q2=senarai_kuiri.id_q2 
			join kuiri3 on kuiri2.id_q3=senarai_kuiri.id_q1 where senarai_kuiri.id_ptj='$id'");					

			if ($query3->num_rows() > 0)
			{
				$row = $query3->row(); 
				//umpukan variable  ke //field dari table
				
				$data['id_ptj'] = $row->id_ptj;
			
					
			}
			
		
			
		$pagination['base_url'] 	= base_url().'index.php/main/surat_pertanyaan_todo/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->surat_pertanyaan_todo($pagination['per_page'],$this->uri->segment(4,0),$data['id_ptj'],$bulan,$tahun_kuiri);
		//$this->model_pengguna->maklumbalas_kuiri('senarai_kuiri',$id,$data,'id_penerimaan');
		$data['act'] = "add";
		$data['step'] = 1;
		//$data['act'] = "edit";
		$this->load->view('surat_pertanyaan_todo',$data);
		
		//$this->output->enable_profiler(TRUE);
				
	}
		function surat_pertanyaan_step2()
	
	{
		$id = $this->input->post('id_ptj');
		$bulan = $this->input->post('bulan_kkwt_kuiri');
		$tahun_kuiri = $this->input->post('tahun_kuiri');
		$data['id_q1'] = $id_q1 = $this->input->post('id_q1');
		$data['id_q2'] = $id_q2 = $this->input->post('id_q2');
		$data['id_q3'] = $id_q3 = $this->input->post('id_q3');
		
		$data['list_q1'] = $this->db->get('kuiri1');
		//$data['list_q2'] = $this->db->get('kuiri2');
		//$data['list_q3'] = $this->db->get('kuiri3');
		
		//get kueri 2
		$this->db->where('id_q2',$id_q2);
		$data['list_q2'] = $this->db->get('kuiri2');
			
		//get kueri 2
		
		//get kueri 2
		$this->db->where('id_q2',$id_q2);
		$data['list_q3'] = $this->db->get('kuiri3');
			
		//get kueri 2
			
		$data['bulan_kkwt_kuiri']=$bulan;
		$data['tahun_kuiri']=$tahun_kuiri;
		$query = $this->db->query("SELECT nama_ptj,id_ptj FROM ptj where id_ptj='$id' ");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
				
					
			}
			
			$query2 = $this->db->query("SELECT tarikh_kuiri FROM penerimaan where id_ptj='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['tarikh_kuiri'] = $row->tarikh_kuiri;
			
					
			}
			$query3 = $this->db->query("SELECT * FROM  senarai_kuiri join kuiri1 on kuiri1.id_q1=senarai_kuiri.id_q1 join kuiri2 on kuiri2.id_q2=senarai_kuiri.id_q2 
			join kuiri3 on kuiri2.id_q3=senarai_kuiri.id_q1 where senarai_kuiri.id_ptj='$id'");					

			if ($query3->num_rows() > 0)
			{
				$row = $query3->row(); 
				//umpukan variable  ke //field dari table
				
				$data['id_ptj'] = $row->id_ptj;
			
					
			}
			
		
			
		$pagination['base_url'] 	= base_url().'index.php/main/surat_pertanyaan_todo/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->surat_pertanyaan_todo($pagination['per_page'],$this->uri->segment(4,0),$data['id_ptj'],$bulan,$tahun_kuiri);
		//$this->model_pengguna->maklumbalas_kuiri('senarai_kuiri',$id,$data,'id_penerimaan');
		$data['act'] = "add";
		$data['step'] = 2;
		//$data['act'] = "edit";
		$this->load->view('surat_pertanyaan_todo',$data);
		
		//$this->output->enable_profiler(TRUE);
				
	}
	
	
	function surat_pertanyaan_proses()
	
	{
		$bulan_kkwt_kuiri = $this->input->post('bulan_kkwt_kuiri');
		$tahun_kuiri = $this->input->post('tahun_kuiri');
	$data = array (		
		'id_q1' => $this->input->post('id_q1'),
		'id_q2' => $this->input->post('id_q2'),
		'id_q3' => $this->input->post('id_q3'),
		'id_ptj' => $this->input->post('id_ptj'),
		'bulan_kkwt_kuiri' => $this->input->post('bulan_kkwt_kuiri'),
		'tahun_kuiri' => $this->input->post('tahun_kuiri'),
		
		
		
		);
        
		$id_ptj=$this->input->post('id_ptj');
		
		//user = nama table
		$this->db->insert('senarai_kuiri',$data);
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/surat_pertanyaan_todo/'.$id_ptj."/".$bulan_kkwt_kuiri."/".$tahun_kuiri,'refresh');	
				
	}
	
	function select_province(){
        if('IS_AJAX') {
        	$data['option_province'] = $this->model_pengguna->getprovince();
			$this->load->view('selectprovince',$data);
		}
		//$this->output->enable_profiler(TRUE);
	}
	function del_surat_pertanyaan($id,$id_ptj,$bulan_kkwt_kuiri,$tahun_kuiri)
	{
	    
		
		$this->db->where('id_senarai_kuiri', $id);
		$this->db->delete('senarai_kuiri');
		
	
		//$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect ('main/surat_pertanyaan_todo/'.$id_ptj."/".$bulan_kkwt_kuiri."/".$tahun_kuiri,'refresh');
				
	}
	
	function maklumbalas_kuiri()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['tahun_kuiri']= $this->input->post('tahun_kuiri');		
			$this->session->set_userdata('sess_tahun_kuiri',$data['tahun_kuiri']);
			
			$data['bulan_kkwt_kuiri']= $this->input->post('bulan_kkwt_kuiri');		
			$this->session->set_userdata('sess_bulan_kkwt_kuiri',$data['bulan_kkwt_kuiri']);
			
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			
			
			
		} else {
				$data['tahun_kuiri'] = $this->session->userdata('sess_tahun_kuiri');
				$data['bulan_kkwt_kuiri'] = $this->session->userdata('sess_bulan_kkwt_kuiri');
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				
				
		}
		
	
		$this->db->select('*');			
		$this->db->from('senarai_kuiri');
		$this->db->join('kuiri1','senarai_kuiri.id_q1 = kuiri1.id_q1');
		$this->db->join('kuiri2','senarai_kuiri.id_q2 = kuiri2.id_q2');
		$this->db->join('kuiri3','senarai_kuiri.id_q3 = kuiri3.id_q3');
		$this->db->join('ptj','ptj.id_ptj = senarai_kuiri.id_ptj');
		
		
		if(!empty($data['tahun_kuiri'])){
			$this->db->where('tahun_kuiri',$data['tahun_kuiri']);
		}
		if(!empty($data['bulan_kkwt_kuiri'])){
			$this->db->where('bulan_kkwt_kuiri',$data['bulan_kkwt_kuiri']);
		}
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
			
		}else{
			$this->db->where('kod_ptj','x');
		}
		$kod_ptj=$this->input->post('kod_ptj');
		$bulan_kkwt_kuiri=$this->input->post('bulan_kkwt_kuiri');
		$query = $this->db->query("SELECT nama_ptj,kod_ptj FROM ptj where kod_ptj='$kod_ptj' ");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				
				
					
			}
			$query2 = $this->db->query("SELECT id_senarai_kuiri,kod_ptj,tarikh_maklumbalas FROM senarai_kuiri join ptj on ptj.id_ptj=senarai_kuiri.id_ptj where kod_ptj='$kod_ptj' and bulan_kkwt_kuiri='$bulan_kkwt_kuiri'  ");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['id_senarai_kuiri'] = $row->id_senarai_kuiri;
				$data['tarikh_maklumbalas'] = $row->tarikh_maklumbalas;
			
					
			}
			
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/maklumbalas_kuiri/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->maklumbalas_kuiri($pagination['per_page'],$this->uri->segment(4,0),$data['tahun_kuiri'],$data['bulan_kkwt_kuiri'],$data['kod_ptj']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('maklumbalas_kuiri',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function maklumbalas_kuiri_todo($id)
	{
	/*
	$query = $this->db->query("SELECT tarikh_kuiri FROM penerimaan where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['tarikh_kuiri'] = $row->tarikh_kuiri;				
				
					
			}
			*/
			$query2 = $this->db->query("SELECT * FROM senarai_kuiri join ptj on ptj.id_ptj=senarai_kuiri.id_ptj  where id_senarai_kuiri='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['id_senarai_kuiri'] = $row->id_senarai_kuiri;
				$data['tarikh_maklumbalas'] = $row->tarikh_maklumbalas;
				$data['id_ptj'] = $row->id_ptj;
			
					
			}
			
	
	$this->load->view('maklumbalas_kuiri_todo',$data);
	//$this->output->enable_profiler(TRUE);
	}
	
	
	function maklumbalas_kuiri_proses()
	
	{
	$id = $this->input->post('key');
	$data = array (		
		'tarikh_maklumbalas' => $this->input->post('tarikh_maklumbalas'),
		
		
		
		
		);

		
		//user = nama table
		
		
		
		
	$this->model_pengguna->update_data('senarai_kuiri',$id,$data,'id_senarai_kuiri');
		
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/maklumbalas_kuiri','refresh');	
				
	}
	function cetak_maklumbalas_kuiri()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		
				 $data['tahun_kuiri'] = $this->session->userdata('sess_tahun_kuiri');
				 $data['bulan_kkwt_kuiri'] = $this->session->userdata('sess_bulan_kkwt_kuiri'); 
				 $data['kod_ptj'] = $this->session->userdata('sess_kod_ptj'); 
				
		
		
	
		$this->db->select('*');			
		$this->db->from('senarai_kuiri');
		$this->db->join('kuiri1','senarai_kuiri.id_q1 = kuiri1.id_q1');
		$this->db->join('kuiri2','senarai_kuiri.id_q2 = kuiri2.id_q2');
		$this->db->join('kuiri3','senarai_kuiri.id_q3 = kuiri3.id_q3');
		$this->db->join('ptj','ptj.id_ptj = senarai_kuiri.id_ptj');
		
		
		if(!empty($data['tahun_kuiri'])){
			$this->db->where('tahun_kuiri',$data['tahun_kuiri']);
		}
		if(!empty($data['bulan_kkwt_kuiri'])){
			$this->db->where('bulan_kkwt_kuiri',$data['bulan_kkwt_kuiri']);
		}
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
			
		}else{
			$this->db->where('kod_ptj','x');
		}
		$kod_ptj=$this->session->userdata('sess_kod_ptj'); 
		$bulan_kkwt_kuiri=$this->input->post('bulan_kkwt_kuiri');
		$query = $this->db->query("SELECT nama_ptj,kod_ptj FROM ptj where kod_ptj='$kod_ptj' ");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				
				
					
			}
			$query2 = $this->db->query("SELECT id_senarai_kuiri,kod_ptj,tarikh_maklumbalas FROM senarai_kuiri join ptj on ptj.id_ptj=senarai_kuiri.id_ptj where kod_ptj='$kod_ptj' and bulan_kkwt_kuiri='$bulan_kkwt_kuiri'  ");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['id_senarai_kuiri'] = $row->id_senarai_kuiri;
				$data['tarikh_maklumbalas'] = $row->tarikh_maklumbalas;
			
					
			}
			
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/maklumbalas_kuiri/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->maklumbalas_kuiri($pagination['per_page'],$this->uri->segment(4,0),$data['tahun_kuiri'],$data['bulan_kkwt_kuiri'],$data['kod_ptj']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('cetak_maklumbalas_kuiri',$data);
		//$this->output->enable_profiler(TRUE);
	}

	function surat_pertanyaan_perbendaharaan()
	
    
	{
		         $data['tahun_kuiri'] = $this->session->userdata('sess_tahun_kuiri');
				 $data['bulan_kkwt_kuiri'] = $this->session->userdata('sess_bulan_kkwt_kuiri'); 
				 $data['kod_ptj'] = $this->session->userdata('sess_kod_ptj'); 
				
		
		
	
		$this->db->select('*');			
		$this->db->from('senarai_kuiri');
		$this->db->join('kuiri1','senarai_kuiri.id_q1 = kuiri1.id_q1');
		$this->db->join('kuiri2','senarai_kuiri.id_q2 = kuiri2.id_q2');
		$this->db->join('kuiri3','senarai_kuiri.id_q3 = kuiri3.id_q3');
		$this->db->join('ptj','ptj.id_ptj = senarai_kuiri.id_ptj');
		
		
		if(!empty($data['tahun_kuiri'])){
			$this->db->where('tahun_kuiri',$data['tahun_kuiri']);
		}
		if(!empty($data['bulan_kkwt_kuiri'])){
			$this->db->where('bulan_kkwt_kuiri',$data['bulan_kkwt_kuiri']);
		}
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
			
		}else{
			$this->db->where('kod_ptj','x');
		}
		$tahun_kuiri=$this->session->userdata('sess_tahun_kuiri');
		$kod_ptj=$this->session->userdata('sess_kod_ptj'); 
		$bulan_kkwt_kuiri=$this->input->post('bulan_kkwt_kuiri');
		$query = $this->db->query("SELECT * FROM ptj where kod_ptj='$kod_ptj' ");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke field dari table
				
				
				$data['nama_jabatan'] = $row->nama_jabatan;
				$data['alamat'] = $row->alamat;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['negeri'] = $row->negeri;
				$data['poskod'] = $row->poskod;
				
				
					
			}
			$query2 = $this->db->query("SELECT id_senarai_kuiri,kod_ptj,tarikh_maklumbalas FROM senarai_kuiri join ptj on ptj.id_ptj=senarai_kuiri.id_ptj where kod_ptj='$kod_ptj' and bulan_kkwt_kuiri='$bulan_kkwt_kuiri'  ");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['id_senarai_kuiri'] = $row->id_senarai_kuiri;
				$data['tarikh_maklumbalas'] = $row->tarikh_maklumbalas;
				$data['bulan_kkwt_kuiri'] = $row->bulan_kkwt_kuiri;
				$data['tahun_kuiri'] = $row->tahun_kuiri;
			
					
			}
	
	
	$this->load->view('surat_pertanyaan_perbendaharaan',$data);
	//$this->output->enable_profiler(TRUE);
	}
	function surat_tiada_kuiri()
	
    
	{
		         $data['tahun_kuiri'] = $this->session->userdata('sess_tahun_kuiri');
				 $data['bulan_kkwt_kuiri'] = $this->session->userdata('sess_bulan_kkwt_kuiri'); 
				 $data['kod_ptj'] = $this->session->userdata('sess_kod_ptj'); 
				
		
		
	
		$this->db->select('*');			
		$this->db->from('senarai_kuiri');
		$this->db->join('kuiri1','senarai_kuiri.id_q1 = kuiri1.id_q1');
		$this->db->join('kuiri2','senarai_kuiri.id_q2 = kuiri2.id_q2');
		$this->db->join('kuiri3','senarai_kuiri.id_q3 = kuiri3.id_q3');
		$this->db->join('ptj','ptj.id_ptj = senarai_kuiri.id_ptj');
		
		
		if(!empty($data['tahun_kuiri'])){
			$this->db->where('tahun_kuiri',$data['tahun_kuiri']);
		}
		if(!empty($data['bulan_kkwt_kuiri'])){
			$this->db->where('bulan_kkwt_kuiri',$data['bulan_kkwt_kuiri']);
		}
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
			
		}else{
			$this->db->where('kod_ptj','x');
		}
		$tahun_kuiri=$this->session->userdata('sess_tahun_kuiri');
		$kod_ptj=$this->session->userdata('sess_kod_ptj'); 
		$bulan_kkwt_kuiri=$this->input->post('bulan_kkwt_kuiri');
		$query = $this->db->query("SELECT * FROM ptj where kod_ptj='$kod_ptj' ");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke field dari table
				
				
				$data['nama_jabatan'] = $row->nama_jabatan;
				$data['alamat'] = $row->alamat;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['negeri'] = $row->negeri;
				$data['poskod'] = $row->poskod;
			
				
				
					
			}
			$query2 = $this->db->query("SELECT * FROM senarai_kuiri join ptj on ptj.id_ptj=senarai_kuiri.id_ptj where kod_ptj='$kod_ptj' and bulan_kkwt_kuiri='$bulan_kkwt_kuiri'  ");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['id_senarai_kuiri'] = $row->id_senarai_kuiri;
				$data['tarikh_maklumbalas'] = $row->tarikh_maklumbalas;
				$data['bulan_kkwt_kuiri'] = $row->bulan_kkwt_kuiri;
				$data['tahun_kuiri'] = $row->tahun_kuiri;
				
			
					
			}
	
	
	$this->load->view('surat_tiada_kuiri',$data);
	//$this->output->enable_profiler(TRUE);
	}
	function mukadepan()
	{
		$this->myclass->check_login();
		$data['act'] = "add";
		
		//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				
				
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		$this->db->join('user','user.id_user = penerimaan.cipta_penerimaan');
		$this->db->where('penerimaan.tarikh_siap_semak' ,'0000-00-00');
		$this->db->or_where('penerimaan.tarikh_siap_semak' ,'');
		
		if( $this->session->userdata('sess_level') != 1/2){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj.id_user',$id_sess_pengguna);
		}
		
		
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['bulan_kkwt'])){
			$this->db->where('bulan_kkwt',$data['bulan_kkwt']);
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/mukadepan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->baki_semakan($pagination['per_page'],$this->uri->segment(4,0),$data['kod_ptj'],$data['bulan_kkwt']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
		
		//indicator bilangan hari semakan dokumen

		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		$data['act']='baki_semakan';
		
		$query = $this->db->query("SELECT * FROM buletin where id_buletin=1");
		if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
	            
				$data['id_buletin'] = $row->id_buletin;
				$data['tajuk_buletin'] = $row->tajuk_buletin;
				$data['buletin1'] = $row->buletin1;
				$data['buletin2'] = $row->buletin2;
				$data['buletin3'] = $row->buletin3;
				$data['buletin4'] = $row->buletin4;
			}
			
		$this->load->view('mukadepan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	
	 /* --------------------Buletin------------------ */
	 
	 
	 function buletin($id)
	{
		
		
		$query = $this->db->query("SELECT * FROM buletin where id_buletin='$id'");
		if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
	            
				$data['id_buletin'] = $row->id_buletin;
				$data['tajuk_buletin'] = $row->tajuk_buletin;
				$data['buletin1'] = $row->buletin1;
				$data['buletin2'] = $row->buletin2;
				$data['buletin3'] = $row->buletin3;
				$data['buletin4'] = $row->buletin4;
			}
		
		
		$data['act'] = "edit";
		
		$this->load->view('mukadepan',$data,$id);
		
	}
		
	
	
	function edit_buletin_proses()
	
	{
	$id = $this->input->post('key');	
	
	$data = array (		
		'tajuk_buletin' => $this->input->post('tajuk_buletin'),
		'buletin1' => $this->input->post('buletin1'),
		'buletin2' => $this->input->post('buletin2'),
		'buletin3' => $this->input->post('buletin3'),
		'buletin4' => $this->input->post('buletin4'),
		
		);

	
		$this->model_pengguna->update_data('buletin',$id,$data,'id_buletin');
		//user = nama table
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/mukadepan','refresh');	
				
	}
	
	
	
	
	
		
	
	/* ------------------END PAGE UTAMA----------------------------------------- */
	
	
	function penerimaan_todo($id)
	{
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['kod_ptj'] = $row->kod_ptj;				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['nama_jabatan'] = $row->nama_jabatan;
				//$data['nama_pegawai'] = $row->nama_pegawai;
				$data['alamat'] = $row->alamat;
				$data['negeri'] = $row->negeri;
				$data['no_telefon'] = $row->no_telefon;
				$data['saiz_ptj'] = $row->saiz_ptj;
				$data['id_ptj'] = $row->id_ptj;
				$data['id_user'] = $row->id_user;
					
			}
			
		$data['act'] = "add";
		$this->load->view('penerimaan_todo',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	function laporan()
	{
		
		
		$this->load->view('laporan');
	}
	
		function penerimaan_proses(){
		
		//define data from form for insert table
		$data = array (		
		'bulan_kkwt' => $this->input->post('bulan_kkwt'),
		'tarikh_semak' => '0000-00-00',
		'tarikh_kuiri' => '0000-00-00',	
		'tarikh_siap_semak' => '0000-00-00',
		'tarikh_terima' => $this->input->post('tarikh_terima'),
		'tahun_terima' => $this->input->post('tahun_terima'),
		'id_ptj' => $this->input->post('id_ptj'),
		'cipta_penerimaan' =>$this->session->userdata('sess_id'),
		);
	//semak data dari table telah wujud atau tidak
		$this->db->where('bulan_kkwt', $this->input->post('bulan_kkwt'));
		$this->db->where('id_ptj', $this->input->post('id_ptj'));
		$this->db->where('tahun_terima', $this->input->post('tahun_terima'));
		$this->db->from('penerimaan');
		$check = $this->db->count_all_results();
		
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/penerimaan','refresh');

		}else{
			//user = nama table
			$this->db->insert('penerimaan',$data);
			$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
		}	
		//$this->output->enable_profiler(TRUE);
		redirect ('main/penerimaan','refresh');
	
		
	}
		function surat_peringatan_todo($id)
	{
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan where id_ptj='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['bulan_kkwt'] = $row->bulan_kkwt;
				$data['tahun_terima'] = $row->tahun_terima;
				$data['tarikh_surat_peringatan1'] = $row->tarikh_surat_peringatan1;
				$data['tarikh_surat_peringatan2'] = $row->tarikh_surat_peringatan2;
				$data['tarikh_surat_peringatan3'] = $row->tarikh_surat_peringatan3;
				$data['id_ptj'] = $row->id_ptj;
					
			}
		$data['act'] = "add";
		
		$this->load->view('surat_peringatan_todo',$data);
		
		//$this->output->enable_profiler(TRUE);
		
	}
	function surat_peringatan1($id)
	{
	    
		
		$bulan_kkwt=$this->session->userdata('sess_bulan_kkwt');
		$tahun_terima=$this->session->userdata('sess_tahun_terima');
		
		$query = $this->db->query("SELECT * FROM ptj join user on ptj.id_user=user.id_user  where id_ptj='$id'");
		
		

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['nama_penuh'] = $row->nama_penuh;
				$data['nama_ptj'] = $row->nama_ptj;
				$data['kod_ptj'] = $row->kod_ptj;
				$data['id_ptj'] = $row->id_ptj;
				$data['alamat'] = $row->alamat;
				$data['nama_jabatan'] = $row->nama_jabatan;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['negeri'] = $row->negeri;
				
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan where id_ptj='$id' and bulan_kkwt='$bulan_kkwt' and tahun_terima='$tahun_terima'");			

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['bulan_kkwt'] = $row->bulan_kkwt;
				$data['tahun_terima'] = $row->tahun_terima;
				$data['tarikh_surat_peringatan1'] = $row->tarikh_surat_peringatan1;
				$data['tarikh_surat_peringatan2'] = $row->tarikh_surat_peringatan2;
				$data['tarikh_surat_peringatan3'] = $row->tarikh_surat_peringatan3;
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['id_ptj'] = $row->id_ptj;
					
			}
		
		
	    $this->load->view('surat_peringatan1',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function surat_peringatan2($id)
	{
	    
		$bulan_kkwt=$this->session->userdata('sess_bulan_kkwt');
		$tahun_terima=$this->session->userdata('sess_tahun_terima');
		
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['kod_ptj'] = $row->kod_ptj;
				$data['id_ptj'] = $row->id_ptj;
				$data['alamat'] = $row->alamat;
				$data['nama_jabatan'] = $row->nama_jabatan;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['negeri'] = $row->negeri;
				
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan where id_ptj='$id' and bulan_kkwt='$bulan_kkwt' and tahun_terima='$tahun_terima'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['bulan_kkwt'] = $row->bulan_kkwt;
				$data['tahun_terima'] = $row->tahun_terima;
				$data['tarikh_surat_peringatan1'] = $row->tarikh_surat_peringatan1;
				$data['tarikh_surat_peringatan2'] = $row->tarikh_surat_peringatan2;
				$data['tarikh_surat_peringatan3'] = $row->tarikh_surat_peringatan3;
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['id_ptj'] = $row->id_ptj;
					
			}
		
		
	    $this->load->view('surat_peringatan2',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function surat_peringatan3($id)
	{
	   
	   $bulan_kkwt=$this->session->userdata('sess_bulan_kkwt');
		$tahun_terima=$this->session->userdata('sess_tahun_terima');
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['kod_ptj'] = $row->kod_ptj;
				$data['id_ptj'] = $row->id_ptj;
				$data['alamat'] = $row->alamat;
				$data['nama_jabatan'] = $row->nama_jabatan;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['negeri'] = $row->negeri;
				
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan where id_ptj='$id' and bulan_kkwt='$bulan_kkwt' and tahun_terima='$tahun_terima'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['bulan_kkwt'] = $row->bulan_kkwt;
				$data['tahun_terima'] = $row->tahun_terima;
				$data['tarikh_surat_peringatan1'] = $row->tarikh_surat_peringatan1;
				$data['tarikh_surat_peringatan2'] = $row->tarikh_surat_peringatan2;
				$data['tarikh_surat_peringatan3'] = $row->tarikh_surat_peringatan3;
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['id_ptj'] = $row->id_ptj;
					
			}
		
		
	    $this->load->view('surat_peringatan3',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	
	
function edit_surat_peringatan($id)
	{
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan join ptj on ptj.id_ptj=surat_peringatan.id_ptj where id_surat_peringatan='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
			    $data['tarikh_surat_peringatan1'] = $row->tarikh_surat_peringatan1;
				$data['tarikh_surat_peringatan2'] = $row->tarikh_surat_peringatan2;
				$data['tarikh_surat_peringatan3'] = $row->tarikh_surat_peringatan3;
				$data['bulan_kkwt'] = $row->bulan_kkwt;
				$data['id_ptj'] = $row->id_ptj;
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['nama_ptj'] = $row->nama_ptj;
				
			}
		
		$data['act'] = "edit";
		
		$this->load->view('edit_surat_peringatan',$data);
		//$this->output->enable_profiler(TRUE);
		
	}
			function edit_surat_peringatan_proses(){
	
	$id = $this->input->post('id_surat_peringatan');
		//define data from form for insert table
		$tarikh_surat_peringatan1 = $this->input->post('tarikh_surat_peringatan1'); 
		$tarikh_surat_peringatan2 = $this->input->post('tarikh_surat_peringatan2'); 
		$tarikh_surat_peringatan3 = $this->input->post('tarikh_surat_peringatan3');

		
		if($tarikh_surat_peringatan1 == '' && $tarikh_surat_peringatan2 == ''&& $tarikh_surat_peringatan3 == ''){
			$data = array (		
			
		
			'id_user' =>$this->session->userdata('sess_id'),
			
			
			
			);
		
		}else if($tarikh_surat_peringatan1 != '' && $tarikh_surat_peringatan2 == '' && $tarikh_surat_peringatan3 == '' ){
			$data = array (		
			
			'tarikh_surat_peringatan1' => $this->input->post('tarikh_surat_peringatan1'),	
			
			'id_user' =>$this->session->userdata('sess_id'),
			
			
			
			
			);
		}else if ($tarikh_surat_peringatan1 != '' && $tarikh_surat_peringatan2 != '' && $tarikh_surat_peringatan3 == ''){
			$data = array (	
			
			'tarikh_surat_peringatan1' => $this->input->post('tarikh_surat_peringatan1'),	
			'tarikh_surat_peringatan2' => $this->input->post('tarikh_surat_peringatan2'),	
			'id_user' =>$this->session->userdata('sess_id'),
			
		
			
			
			
			);
			
			
		}else{
			$data = array (		
			
			'tarikh_surat_peringatan1' => $this->input->post('tarikh_surat_peringatan1'),
			'tarikh_surat_peringatan2' => $this->input->post('tarikh_surat_peringatan2'),	
			'tarikh_surat_peringatan3' => $this->input->post('tarikh_surat_peringatan3'),	
			'id_user' =>$this->session->userdata('sess_id'),		
			
			);
		}
		
		
		//user = nama table
		$this->model_pengguna->update_data('surat_peringatan',$id,$data,'id_surat_peringatan');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/cetak_surat_peringatan','refresh');
	
		
	}
	function del_surat_peringatan1($id)
	{
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan join ptj on ptj.id_ptj=surat_peringatan.id_ptj where id_surat_peringatan='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
			    $data['tarikh_surat_peringatan1'] = $row->tarikh_surat_peringatan1;
				$data['id_ptj'] = $row->id_ptj;
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['nama_ptj'] = $row->nama_ptj;
				
			}
		
		$data['act'] = "edit";
		
		$this->load->view('del_surat_peringatan1',$data);
		//$this->output->enable_profiler(TRUE);
		
	}

		function del_surat_peringatan1_proses(){
	
	$id = $this->input->post('id_surat_peringatan');
		//define data from form for insert table
		$data = array (	
		
		'tarikh_surat_peringatan1' => '0000-00-00',
		
		'id_surat_peringatan' => $this->input->post('id_surat_peringatan'),
		//'id_user' => $this->input->post('id_user'),
		
		
		);

		
		//user = nama table
		$this->model_pengguna->update_data('surat_peringatan',$id,$data,'id_surat_peringatan');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/cetak_surat_peringatan','refresh');
	
		
	}
	function del_surat_peringatan2($id)
	{
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan join ptj on ptj.id_ptj=surat_peringatan.id_ptj where id_surat_peringatan='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
			    $data['tarikh_surat_peringatan2'] = $row->tarikh_surat_peringatan2;
				$data['id_ptj'] = $row->id_ptj;
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['nama_ptj'] = $row->nama_ptj;
				
			}
		
		$data['act'] = "edit";
		
		$this->load->view('del_surat_peringatan2',$data);
		//$this->output->enable_profiler(TRUE);
		
	}

		function del_surat_peringatan2_proses(){
	
	$id = $this->input->post('id_surat_peringatan');
		//define data from form for insert table
		$data = array (	
		
		'tarikh_surat_peringatan2' => '0000-00-00',
		
		'id_surat_peringatan' => $this->input->post('id_surat_peringatan'),
		//'id_user' => $this->input->post('id_user'),
		
		
		);

		
		//user = nama table
		$this->model_pengguna->update_data('surat_peringatan',$id,$data,'id_surat_peringatan');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/cetak_surat_peringatan','refresh');
	
		
	}
	function del_surat_peringatan3($id)
	{
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['id_ptj'] = $row->id_ptj;
					
			}
			
			$query2 = $this->db->query("SELECT * FROM surat_peringatan join ptj on ptj.id_ptj=surat_peringatan.id_ptj where id_surat_peringatan='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
			    $data['tarikh_surat_peringatan3'] = $row->tarikh_surat_peringatan3;
				$data['id_ptj'] = $row->id_ptj;
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['nama_ptj'] = $row->nama_ptj;
				
			}
		
		$data['act'] = "edit";
		
		$this->load->view('del_surat_peringatan3',$data);
		//$this->output->enable_profiler(TRUE);
		
	}

		function del_surat_peringatan3_proses(){
	
	$id = $this->input->post('id_surat_peringatan');
		//define data from form for insert table
		$data = array (	
		
		'tarikh_surat_peringatan3' => '0000-00-00',
		
		'id_surat_peringatan' => $this->input->post('id_surat_peringatan'),
		//'id_user' => $this->input->post('id_user'),
		
		
		);

		
		//user = nama table
		$this->model_pengguna->update_data('surat_peringatan',$id,$data,'id_surat_peringatan');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/cetak_surat_peringatan','refresh');
	
		
	}
	function semakan_todo($id)
	{
		
		
		$query = $this->db->query("SELECT * FROM penerimaan join ptj on ptj.id_ptj=penerimaan.id_ptj where penerimaan.id_penerimaan='$id'");				

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['tarikh_terima'] = $row->tarikh_terima;
				$data['tarikh_semak'] = $row->tarikh_semak;
				$data['tarikh_siap_semak'] = $row->tarikh_siap_semak;
				$data['tarikh_kuiri'] = $row->tarikh_kuiri;
				$data['id_penerimaan'] = $row->id_penerimaan;
				$data['bil_resit'] = $row->bil_resit;
				$data['jumlah_hasil'] = $row->jumlah_hasil;
				$data['nama_ptj'] = $row->nama_ptj;
				$data['bulan_kkwt'] = $row->bulan_kkwt;

				
			
			}
		
		
		$data['act'] = "add";
		$this->load->view('semakan_todo',$data);
		//$this->output->enable_profiler(TRUE);
		
	}
	function surat_peringatan_proses(){
	
	$data = $this->input->post('selectedId');
	//'id_user' => $this->input->post('id_user'),
		
	

	//user = nama table guna check box dan kenalpasti data telah wujud atau tidak
		foreach ($data as $datas)	
		{
			$this->db->where('bulan_kkwt', $this->input->post('bulan_kkwt'));
			$this->db->where('tahun_terima', $this->input->post('tahun_terima'));
			$this->db->where('id_ptj', $datas);
			$this->db->from('surat_peringatan');
			$check = $this->db->count_all_results();
			//semak data dari table telah wujud atau tidak
			if ($check){
				$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
				//redirect('main/surat_peringatan_popup','refresh');

			}else{
			
			
				$data = array(
							'id_ptj' => $datas,
							'bulan_kkwt' => $this->input->post('bulan_kkwt'),
							'tahun_terima' => $this->input->post('tahun_terima'),
							'tarikh_surat_peringatan1' => $this->input->post('tarikh_surat_peringatan1'),
							'tarikh_surat_peringatan2' => '0000-00-00',
							'tarikh_surat_peringatan3' => '0000-00-00',
							
							
							);	
					$this->db->insert('surat_peringatan',$data);
					
					$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			}		
		}
		
		
	   $data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		
		redirect ('main/surat_peringatan','refresh');
	
	
		
		//$this->output->enable_profiler(TRUE);
	}
	
			function senarai_pejabat_pemungut()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{

			$data['nama_penuh']= $this->input->post('nama_penuh');		
			$this->session->set_userdata('sess_nama_penuh_penyemak',$data['nama_penuh']);
			
			$data['saiz_ptj']= $this->input->post('saiz_ptj');		
			$this->session->set_userdata('sess_saiz_ptj',$data['saiz_ptj']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
		} else {
				
				$data['nama_penuh'] = $this->session->userdata('sess_nama_penuh_penyemak');
				$data['saiz_ptj'] = $this->session->userdata('sess_saiz_ptj');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
		
		}
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->where('level = 3');			
		$this->db->join('ptj','ptj.id_user = user.id_user');
		
		
		if($data['nama_penuh'] != 'Pilih'){
			$this->db->where('nama_penuh',$data['nama_penuh']);
		}
		else if($data['saiz_ptj'] != 'Pilih'){
			$this->db->where('saiz_ptj',$data['saiz_ptj']);
		}
		else if(($data['nama_jabatan'] != '')){
					$this->db->like('nama_jabatan',$data['nama_jabatan']);		
				}else{
					
				}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/senarai_pejabat_pemungut/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "20";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->senarai_pejabat_pemungut($pagination['per_page'],$this->uri->segment(4,0),$data['nama_penuh'],$data['saiz_ptj'],$data['nama_jabatan']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		
		$this->load->view('senarai_pejabat_pemungut',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	function jumlah_pejabat_pemungut()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['saiz_ptj']= $this->input->post('saiz_ptj');		
			$this->session->set_userdata('sess_saiz_ptj',$data['saiz_ptj']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
		} else {
				
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['saiz_ptj'] = $this->session->userdata('sess_saiz_ptj');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
				
		}
		
			$q= "SELECT
				ptj.kod_ptj as kod_ptj,
				ptj.nama_jabatan as nama_jabatan,
				sum(case when ptj.negeri!='SARAWAK' and ptj.negeri!='SABAH' then 1 else 0 END) as bil_semenanjung,
				sum(case when ptj.negeri='SABAH' then 1 else 0 END) as bil_sabah,
				sum(case when ptj.negeri='SARAWAK' then 1 else 0 END) as bil_sarawak

				FROM
				ptj
				INNER JOIN `user` ON ptj.id_user = `user`.id_user ";
				
				//where ptj.cipta_oleh=3
				
				if($data['nama'] !='Pilih' && $data['saiz_ptj'] !='Pilih')
				{
					
					$nama = $data['nama'];
					$saiz_ptj = $data['saiz_ptj'];
					$q.="where user.nama='$nama'";
					$q.="and ptj.saiz_ptj='$saiz_ptj'";
					
					
				}
				
				else if($data['nama'] !='Pilih')
				{
					
					$nama = $data['nama'];
					$q.="where user.nama='$nama'";
					
					
					
				}
				
				else if($data['saiz_ptj'] !='Pilih')
				{
					
					$saiz_ptj = $data['saiz_ptj'];
					$q.="where ptj.saiz_ptj='$saiz_ptj'";

					
					
				}
				
				else if($data['nama_jabatan'] !='Pilih')
				{
					
					$nama_jabatan = $data['nama_jabatan'];
					$q.="where ptj.nama_jabatan like'%$nama_jabatan%'";
					
					
					
				}
				else{
				
				}
				
				$q.=" GROUP BY ptj.nama_jabatan";
				
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_users'] = $this->db->get('user');
		
		$this->load->view('jumlah_pejabat_pemungut',$data);
		$this->output->enable_profiler(TRUE);
	}
	//-----------PENERIMAAN KKWT-------------------------------------
	
	function keseluruhan_penerimaan()
	{	
	
		
		$data['list'] = $this->db->query("select b.bulan_penuh as bulan,
	 			(select count(p1.id_ptj) from ptj p1 
					where month(cipta_pada) <= b.bulan and status_aktif = 1 )  as jumlah ,
				(select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_terima) 				>= 0 and day(pn1.tarikh_terima) <= 10 and month(tarikh_terima) = b.bulan ) as 	
				terima_dlm_tempoh,
  				(select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_terima) 				>= 11 and day(pn1.tarikh_terima) <= 31 and month(tarikh_terima) = b.bulan ) as 	 	
				terima_luar_tempoh,
				(select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_terima) 				> 31 and month(pn1.tarikh_terima) > b.bulan ) as terima_luar_bulan,
				(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_terima) = 				b.bulan ) as jumlah_diterima
				from adm_bulan b join ptj p
				group by b.bulan_penuh 
				ORDER BY b.bulan");

		
		
		//$data['list'] = $this->model_pengguna->keseluruhan_penerimaan();
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		
		$this->load->view('keseluruhan_penerimaan',$data);
		//$this->output->enable_profiler(TRUE);
	}
		function penerimaan_zon_all()
		{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['zon']= $this->input->post('zon');		
			$this->session->set_userdata('sess_zon',$data['zon']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$data['tempoh_laporan2']= $this->input->post('tempoh_laporan2');		
			$this->session->set_userdata('sess_tempoh_laporan2',$data['tempoh_laporan2']);
			
			if(!empty($data['tempoh_laporan1']) && !empty($data['tempoh_laporan1'])){
			
			$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			//echo "---------->".$a;
			//echo "b";
			}
			
			
		} else {
				
				$data['zon'] = $this->session->userdata('sess_zon');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->session->userdata('sess_tempoh_laporan1');
				$tempoh_laporan2 =  $data['tempoh_laporan2'] = $this->session->userdata('sess_tempoh_laporan2');
				//echo "a";
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
				
			
		}


			
$tahun = $this->input->post('tahun');
$terkini = date(Y);
if($data['zon'] !='' && $data['tahun'] !='' ){
	if($data['zon'] == 'Sabah'){	
		$q .= " SELECT bulan_kkwt as bulan,  
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $tahun  and b.bulan < month(hapus_pada) and negeri = 'SABAH' )as jumlah_negeri,
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $tahun  and b.bulan < month(hapus_pada) )  as jumlah_ptj,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan  and YEAR(cipta_pada) <= $tahun   ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
WHERE ptj.negeri ='SABAH'
AND tahun_terima ='$tahun'
group by bulan_kkwt order by  id_adm_bulan ASC 
";
		
	}else if($data['zon'] == 'Sarawak'){	
		$q .= " SELECT bulan_kkwt as bulan,  
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $tahun  and b.bulan < month(hapus_pada) and negeri = 'SARAWAK' )as jumlah_negeri,
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $tahun  and b.bulan < month(hapus_pada) )  as jumlah_ptj,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan  and YEAR(cipta_pada) <= $tahun   ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
WHERE ptj.negeri ='SARAWAK'
AND tahun_terima ='$tahun'
group by bulan_kkwt order by  id_adm_bulan ASC  
";
}else if($data['zon'] == ''){	
		$q .= " SELECT bulan_kkwt as bulan,  
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $tahun  and b.bulan < month(hapus_pada) )  as jumlah_ptj,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan  and YEAR(cipta_pada) <= $tahun   ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
WHERE tahun_terima ='$tahun'
group by bulan_kkwt order by  id_adm_bulan ASC  
";
	}else{//semenanjung
		$q .= "SELECT bulan_kkwt as bulan, 

(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $tahun  and b.bulan < month(hapus_pada) and negeri NOT IN('SABAH','SARAWAK') )as jumlah_negeri,		
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $tahun  and b.bulan < month(hapus_pada) )  as jumlah_ptj,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan  and YEAR(cipta_pada) <= $tahun   ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
WHERE ptj.negeri NOT IN('SABAH','SARAWAK')
AND tahun_terima ='$tahun'
group by bulan_kkwt order by id_adm_bulan ASC  ";	
	}
	
	}else{
	$q .= "  SELECT bulan_kkwt as bulan,  
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and YEAR(cipta_pada) <= $terkini and b.bulan < month(hapus_pada) ) as jumlah_negeri,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $terkini  
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $terkini 
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan   and YEAR(cipta_pada) <= $terkini    ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
AND tahun_terima ='$terkini'
group by bulan_kkwt order by id_adm_bulan ASC     ";
}
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_users'] = $this->db->get('user');
		
		$this->load->view('penerimaan_zon_all',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function penerimaan_jabatan()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['zon']= $this->input->post('zon');		
			$this->session->set_userdata('sess_zon',$data['zon']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$data['tempoh_laporan2']= $this->input->post('tempoh_laporan2');		
			$this->session->set_userdata('sess_tempoh_laporan2',$data['tempoh_laporan2']);
			
			if(!empty($data['tempoh_laporan1']) && !empty($data['tempoh_laporan1'])){
			
			$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			//echo "---------->".$a;
			//echo "b";
			}
			
			
		} else {
				
				$data['zon'] = $this->session->userdata('sess_zon');
				$data['nama_jabatan'] = $this->session->userdata('nama_jabatan');
				$data['tahun'] = $this->session->userdata('tahun');
				
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->session->userdata('sess_tempoh_laporan1');
				$tempoh_laporan2 =  $data['tempoh_laporan2'] = $this->session->userdata('sess_tempoh_laporan2');
				//echo "a";
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
		}
		
/*			$q = " select b.bulan_penuh as bulan,
    (select count(p1.id_ptj) from ptj p1 
    where month(cipta_pada) <= b.bulan and status_aktif = 1 )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_terima) = b.bulan AND year( pn1.tarikh_terima ) = ".$tahun_hasil_dari_explode.") as jumlah_diterima
from adm_bulan b join ptj p

";
*/

$q = " ";

			
$tahun = $this->input->post('tahun');	
$nama_jabatan = $this->input->post('nama_jabatan');

if($data[''] !='Pilih' && $data['tempoh_laporan1'] !='' && $data['tempoh_laporan2'] !=''){
	if($data['zon'] == 'Sabah'){	
		$q .= " SELECT bulan_kkwt as bulan,
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and b.bulan < month(hapus_pada) and YEAR(cipta_pada) <= $tahun  )  as jumlah ,
(select count(*) from penerimaan p2 where DAY(p2.tarikh_terima) >= 1 and DAY(p2.tarikh_terima) <=10 and MONTH(p2.tarikh_terima) = (b.bulan + 1) and year(p2.tarikh_terima) <= $tahun) as terima_dlm_tempoh,
(select count(*) from penerimaan p2 where DAY(p2.tarikh_terima) >= 11 and DAY(p2.tarikh_terima) <=31 and MONTH(p2.tarikh_terima) = (b.bulan + 1) and year(p2.tarikh_terima) <= $tahun) as terima_luar_tempoh,
(select count(*) from penerimaan p2 where  MONTH(p2.tarikh_terima) > (b.bulan + 1) ) as 'lebih_tempoh',
count(*) as Jumlah 
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
group by bulan_kkwt;
";
		
	}else if($data['zon'] == 'Sarawak'){	
		$q .= " SELECT
	b.bulan_penuh AS bulan,
	(
		SELECT
			count(p1.id_ptj)
		FROM
			ptj p1
		WHERE
			MONTH(cipta_pada)<= b.bulan
		AND status_aktif = 1
	AND cipta_pada BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p1.negeri IN('SARAWAK')
	)AS jumlah,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 0
	AND DAY(pn1.tarikh_terima)<= 10
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_dlm_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 11
	AND DAY(pn1.tarikh_terima)<= 31
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_luar_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)> 31
	AND MONTH(pn1.tarikh_terima)> b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_luar_bulan,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		MONTH(tarikh_terima)= b.bulan
	AND pn1.tarikh_terima BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p2.negeri IN('SARAWAK')
	)AS jumlah_diterima
FROM
	adm_bulan b
JOIN ptj p
WHERE
	b.bulan BETWEEN MONTH('".$tempoh_laporan1."')
AND MONTH('".$tempoh_laporan2."')
GROUP BY
	b.bulan_penuh
ORDER BY
	b.bulan
";
	}else{//semenanjung
		$q .= "SELECT
	b.bulan_penuh AS bulan,
	(
		SELECT
			count(p1.id_ptj)
		FROM
			ptj p1
		WHERE
			MONTH(cipta_pada)<= b.bulan
		AND status_aktif = 1
	AND cipta_pada BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p1.negeri NOT IN('SABAH','SARAWAK')
	)AS jumlah,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 0
	AND DAY(pn1.tarikh_terima)<= 10
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS terima_dlm_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 11
	AND DAY(pn1.tarikh_terima)<= 31
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS terima_luar_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)> 31
	AND MONTH(pn1.tarikh_terima)> b.bulan
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS terima_luar_bulan,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		MONTH(tarikh_terima)= b.bulan
	AND pn1.tarikh_terima BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS jumlah_diterima
FROM
	adm_bulan b
JOIN ptj p
WHERE
	b.bulan BETWEEN MONTH('".$tempoh_laporan1."')
AND MONTH('".$tempoh_laporan2."')
GROUP BY
	b.bulan_penuh
ORDER BY
	b.bulan";	
	}
	
	}else{
	$q .= "SELECT bulan_kkwt as bulan,
(SELECT COUNT(*) FROM ptj WHERE nama_jabatan = '$nama_jabatan')as jumlah_jabatan, 	
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and b.bulan < month(hapus_pada) and YEAR(cipta_pada) <= $tahun  )  as jumlah_ptj,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and b.bulan < month(hapus_pada) and YEAR(cipta_pada) <= $tahun  ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
WHERE ptj.nama_jabatan = '$nama_jabatan'
AND tahun_terima = '$tahun'
group by bulan_kkwt order by  id_adm_bulan ASC    ";
}
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_jabatan'] = $this->db->get('adm_jabatan');
		
		$this->load->view('penerimaan_jabatan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function penerimaan_pengguna()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['zon']= $this->input->post('zon');		
			$this->session->set_userdata('sess_zon',$data['zon']);
			
			$data['nama_penyemak']= $this->input->post('nama_penyemak');		
			$this->session->set_userdata('sess_nama_penyemak',$data['nama_penyemak']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$data['tempoh_laporan2']= $this->input->post('tempoh_laporan2');		
			$this->session->set_userdata('sess_tempoh_laporan2',$data['tempoh_laporan2']);
			
			if(!empty($data['tempoh_laporan1']) && !empty($data['tempoh_laporan1'])){
			
			$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			//echo "---------->".$a;
			//echo "b";
			}
			
			
		} else {
				
				$data['zon'] = $this->session->userdata('sess_zon');
				$data['nama_penyemak'] = $this->session->userdata('nama_penyemak');
				$data['tahun'] = $this->session->userdata('tahun');
				
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->session->userdata('sess_tempoh_laporan1');
				$tempoh_laporan2 =  $data['tempoh_laporan2'] = $this->session->userdata('sess_tempoh_laporan2');
				//echo "a";
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
		}
		
/*			$q = " select b.bulan_penuh as bulan,
    (select count(p1.id_ptj) from ptj p1 
    where month(cipta_pada) <= b.bulan and status_aktif = 1 )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_terima) = b.bulan AND year( pn1.tarikh_terima ) = ".$tahun_hasil_dari_explode.") as jumlah_diterima
from adm_bulan b join ptj p

";
*/

$q = " ";

			
$tahun = $this->input->post('tahun');	
$nama_penyemak = $this->input->post('nama_penyemak');

if($data[''] !='Pilih' && $data['tempoh_laporan1'] !='' && $data['tempoh_laporan2'] !=''){
	if($data['zon'] == 'Sabah'){	
		$q .= " SELECT bulan_kkwt as bulan,
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and status_aktif = 1 and YEAR(cipta_pada) <= $tahun  )  as jumlah ,
(select count(*) from penerimaan p2 where DAY(p2.tarikh_terima) >= 1 and DAY(p2.tarikh_terima) <=10 and MONTH(p2.tarikh_terima) = (b.bulan + 1) and year(p2.tarikh_terima) <= $tahun) as terima_dlm_tempoh,
(select count(*) from penerimaan p2 where DAY(p2.tarikh_terima) >= 11 and DAY(p2.tarikh_terima) <=31 and MONTH(p2.tarikh_terima) = (b.bulan + 1) and year(p2.tarikh_terima) <= $tahun) as terima_luar_tempoh,
(select count(*) from penerimaan p2 where  MONTH(p2.tarikh_terima) > (b.bulan + 1) ) as 'lebih_tempoh',
count(*) as Jumlah 
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
group by bulan_kkwt;
";
		
	}else if($data['zon'] == 'Sarawak'){	
		$q .= " SELECT
	b.bulan_penuh AS bulan,
	(
		SELECT
			count(p1.id_ptj)
		FROM
			ptj p1
		WHERE
			MONTH(cipta_pada)<= b.bulan
		AND status_aktif = 1
	AND cipta_pada BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p1.negeri IN('SARAWAK')
	)AS jumlah,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 0
	AND DAY(pn1.tarikh_terima)<= 10
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_dlm_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 11
	AND DAY(pn1.tarikh_terima)<= 31
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_luar_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)> 31
	AND MONTH(pn1.tarikh_terima)> b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_luar_bulan,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		MONTH(tarikh_terima)= b.bulan
	AND pn1.tarikh_terima BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p2.negeri IN('SARAWAK')
	)AS jumlah_diterima
FROM
	adm_bulan b
JOIN ptj p
WHERE
	b.bulan BETWEEN MONTH('".$tempoh_laporan1."')
AND MONTH('".$tempoh_laporan2."')
GROUP BY
	b.bulan_penuh
ORDER BY
	b.bulan
";
	}else{//semenanjung
		$q .= "SELECT
	b.bulan_penuh AS bulan,
	(
		SELECT
			count(p1.id_ptj)
		FROM
			ptj p1
		WHERE
			MONTH(cipta_pada)<= b.bulan
		AND status_aktif = 1
	AND cipta_pada BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p1.negeri NOT IN('SABAH','SARAWAK')
	)AS jumlah,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 0
	AND DAY(pn1.tarikh_terima)<= 10
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS terima_dlm_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 11
	AND DAY(pn1.tarikh_terima)<= 31
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS terima_luar_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)> 31
	AND MONTH(pn1.tarikh_terima)> b.bulan
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS terima_luar_bulan,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		MONTH(tarikh_terima)= b.bulan
	AND pn1.tarikh_terima BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p2.negeri NOT IN('SABAH','SARAWAK')
	)AS jumlah_diterima
FROM
	adm_bulan b
JOIN ptj p
WHERE
	b.bulan BETWEEN MONTH('".$tempoh_laporan1."')
AND MONTH('".$tempoh_laporan2."')
GROUP BY
	b.bulan_penuh
ORDER BY
	b.bulan";	
	}
	
	}else{
	$q .= "SELECT bulan_kkwt as bulan,
(SELECT COUNT(*) FROM ptj WHERE id_user = '$nama_penyemak')as jumlah_jabatan, 	
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and b.bulan < month(hapus_pada) and YEAR(cipta_pada) <= $tahun  )  as jumlah_ptj,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and b.bulan < month(hapus_pada) and YEAR(cipta_pada) <= $tahun  ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN user on user.id_user = p.cipta_penerimaan
WHERE user.id_user = '$nama_penyemak'
AND tahun_terima = '$tahun'
group by bulan_kkwt order by  id_adm_bulan ASC    ";
}
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		
		$this->load->view('penerimaan_pengguna',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function muatturun_laporan_keseluruhan()
	{
		if(isset($_POST['submit']))
		{
			
			
			$tahun= $this->input->post('tahun');		
			//$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$tempoh_bulan1 = $this->input->post('tempoh_bulan1');		
			//$this->session->set_userdata('sess_tempoh_bulan1',$data['tempoh_bulan1']);
			
			$tempoh_bulan2 = $this->input->post('tempoh_bulan2');		
			//$this->session->set_userdata('sess_tempoh_bulan2',$data['tempoh_bulan2']);
			
			
				
			
			$q = $this->db->query("SELECT * FROM penerimaan
							JOIN adm_bulan ON penerimaan.bulan_kkwt = adm_bulan.bulan_penuh
							JOIN ptj on penerimaan.id_ptj =ptj.id_ptj
							join user on user.id_user=ptj.id_user
							where tahun_terima ='".$tahun."'
							and adm_bulan.id_adm_bulan BETWEEN  '".$tempoh_bulan1."' and '".$tempoh_bulan2."'");
						
						
			

			 
			//generate excell
			
			//load our new PHPExcel library
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('test worksheet');
			//set cell A1 content with some text
			
			$this->excel->getActiveSheet()->setCellValue('A1', 'KOD PTJ');
			$this->excel->getActiveSheet()->setCellValue('B1', 'NAMA PENYEMAK');
			$this->excel->getActiveSheet()->setCellValue('C1', 'SAIZ');
			$this->excel->getActiveSheet()->setCellValue('D1', 'NAMA JABATAN');
			$this->excel->getActiveSheet()->setCellValue('E1', 'NAMA PEJABAT PEMUNGUT');
			$this->excel->getActiveSheet()->setCellValue('F1', 'NEGERI');
			$this->excel->getActiveSheet()->setCellValue('G1', 'TARIKH TERIMA');
			$this->excel->getActiveSheet()->setCellValue('H1', 'TARIKH SIAP');
			$this->excel->getActiveSheet()->setCellValue('I1', 'BULAN');
			
			$Av=2;
			//$A='A';
			//$B='';
			 foreach($q->result() as $row){
				//$B=$A."".$Av;
				//echo "------->".$tarikh_semak = $row->tarikh_semak;
				//echo "-->".$B;
				$kod_ptj = $row->kod_ptj;
				$nama_penyemak = $row->nama;
				$saiz_ptj = $row->saiz_ptj;
				$nama_jabatan = $row->nama_jabatan;
				$nama_ptj = $row->nama_ptj;
				$negeri = $row->negeri;
				$tarikh_terima = $row->tarikh_terima;
				$tarikh_siap_semak = $row->tarikh_siap_semak;
				$bulan_kkwt = $row->bulan_kkwt;
				
				$this->excel->getActiveSheet()->setCellValue('A'.$Av, $kod_ptj);
				$this->excel->getActiveSheet()->setCellValue('B'.$Av, $nama_penyemak);
				$this->excel->getActiveSheet()->setCellValue('C'.$Av, $saiz_ptj);
				$this->excel->getActiveSheet()->setCellValue('D'.$Av, $nama_jabatan);
				$this->excel->getActiveSheet()->setCellValue('E'.$Av, $nama_ptj);
				$this->excel->getActiveSheet()->setCellValue('F'.$Av, $negeri);
				$this->excel->getActiveSheet()->setCellValue('G'.$Av, $tarikh_terima);
				$this->excel->getActiveSheet()->setCellValue('H'.$Av, $tarikh_siap_semak);
				$this->excel->getActiveSheet()->setCellValue('I'.$Av, $bulan_kkwt);
				$Av++;
			 }
			

			//change the font size
			//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
			//merge cell A1 until D1
			//$this->excel->getActiveSheet()->mergeCells('A1:D1');
			//set aligment to center for that merged cell (A1 to D1)
			//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			 
			$filename='just_some_random_name.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');	
			
			
			
			
		

			
		} 
		
		
		
		$this->db->order_by('bulan','ASC');
		$data['list_adm_bulan'] = $this->db->get('adm_bulan');
		$this->load->view('muatturun_laporan_keseluruhan',$data);
		$this->output->enable_profiler(TRUE);
	}
	function muatturun_laporan_tidakterima()
	{
		if(isset($_POST['submit']))
		{
			
			
			$tahun= $this->input->post('tahun');		
			//$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$bulan_kkwt = $this->input->post('bulan_kkwt');		
			//$this->session->set_userdata('sess_tempoh_bulan1',$data['tempoh_bulan1']);
			
			
			
			
				
			
			$q = $this->db->query("select id_ptj,kod_ptj,nama_ptj,negeri,nama_jabatan,nama,saiz_ptj from ptj p1 join user on p1.id_user =user.id_user where p1.id_ptj not in (
				SELECT ptj.id_ptj FROM ptj
				inner join penerimaan ON ptj.id_ptj = penerimaan.id_ptj  where bulan_kkwt='".$bulan_kkwt."' and tahun_terima='".$tahun."')");
						
						
			

			 
			//generate excell
			
			//load our new PHPExcel library
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('test worksheet');
			//set cell A1 content with some text
			
			$this->excel->getActiveSheet()->setCellValue('A1', 'KOD PTJ');
			$this->excel->getActiveSheet()->setCellValue('B1', 'NAMA PENYEMAK');
			$this->excel->getActiveSheet()->setCellValue('C1', 'SAIZ');
			$this->excel->getActiveSheet()->setCellValue('D1', 'NAMA JABATAN');
			$this->excel->getActiveSheet()->setCellValue('E1', 'NAMA PEJABAT PEMUNGUT');
			$this->excel->getActiveSheet()->setCellValue('F1', 'NEGERI');
			$this->excel->getActiveSheet()->setCellValue('G1', 'TARIKH TERIMA');
			$this->excel->getActiveSheet()->setCellValue('H1', 'TARIKH SIAP');
			$this->excel->getActiveSheet()->setCellValue('I1', 'BULAN');
			
			$Av=2;
			//$A='A';
			//$B='';
			 foreach($q->result() as $row){
				//$B=$A."".$Av;
				//echo "------->".$tarikh_semak = $row->tarikh_semak;
				//echo "-->".$B;
				$kod_ptj = $row->kod_ptj;
				$nama_penyemak = $row->nama;
				$saiz_ptj = $row->saiz_ptj;
				$nama_jabatan = $row->nama_jabatan;
				$nama_ptj = $row->nama_ptj;
				$negeri = $row->negeri;
				$tarikh_terima = $row->tarikh_terima;
				$tarikh_siap_semak = $row->tarikh_siap_semak;
				//$bulan_kkwt = $row->bulan_kkwt;
				
				$this->excel->getActiveSheet()->setCellValue('A'.$Av, $kod_ptj);
				$this->excel->getActiveSheet()->setCellValue('B'.$Av, $nama_penyemak);
				$this->excel->getActiveSheet()->setCellValue('C'.$Av, $saiz_ptj);
				$this->excel->getActiveSheet()->setCellValue('D'.$Av, $nama_jabatan);
				$this->excel->getActiveSheet()->setCellValue('E'.$Av, $nama_ptj);
				$this->excel->getActiveSheet()->setCellValue('F'.$Av, $negeri);
				$this->excel->getActiveSheet()->setCellValue('G'.$Av, $tarikh_terima);
				$this->excel->getActiveSheet()->setCellValue('H'.$Av, $tarikh_siap_semak);
				$this->excel->getActiveSheet()->setCellValue('I'.$Av, $bulan_kkwt);
				$Av++;
			 }
			

			//change the font size
			//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
			//merge cell A1 until D1
			//$this->excel->getActiveSheet()->mergeCells('A1:D1');
			//set aligment to center for that merged cell (A1 to D1)
			//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			 
			$filename='just_some_random_name.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');	
			
			
			
			
		

			
		} 
		
		
		
		$this->db->order_by('bulan','ASC');
		$data['list_adm_bulan'] = $this->db->get('adm_bulan');
		$this->load->view('muatturun_laporan_tidakterima',$data);
		$this->output->enable_profiler(TRUE);
	}
	
	//-----------SEMAKAN KKWT-------------------------------------
	
			function semakan_zon()
		{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			$data['zon']= $this->input->post('zon');		
			$this->session->set_userdata('sess_zon',$data['zon']);
			
			$data['nama_penuh']= $this->input->post('nama_penuh');		
			$this->session->set_userdata('sess_nama_penuh',$data['nama_penuh']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
			$data['tempoh_laporan1']= $this->input->post('tempoh_laporan1');		
			$this->session->set_userdata('sess_tempoh_laporan1',$data['tempoh_laporan1']);
			
			$data['tempoh_laporan2']= $this->input->post('tempoh_laporan2');		
			$this->session->set_userdata('sess_tempoh_laporan2',$data['tempoh_laporan2']);
			//ambil tarikh dari date picker

			//explode atau just extract tahun dari parameter yang diambil dari date picker ke satu parameter baru
			//$tempoh_laporan1 = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			//$tempoh_laporan2 = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			if(!empty($data['tempoh_laporan1']) && !empty($data['tempoh_laporan1'])){
			
			$tempoh_laporan1 = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			//echo "---------->".$a;
			
			}
			
			
		} else {
				
				$data['zon'] = $this->session->userdata('sess_zon');
				$data['nama_penuh'] = $this->session->userdata('sess_nama_penuh');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
				$data['tempoh_laporan1'] = $this->session->userdata('sess_tempoh_laporan1');
				$data['tempoh_laporan2'] = $this->session->userdata('sess_tempoh_laporan2');
				
		}
		
/*			$q = " select b.bulan_penuh as bulan,
    (select count(p1.id_ptj) from ptj p1 
    where month(cipta_pada) <= b.bulan and status_aktif = 1 )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_terima) = b.bulan AND year( pn1.tarikh_terima ) = ".$tahun_hasil_dari_explode.") as jumlah_diterima
from adm_bulan b join ptj p

";
*/
if($data['tempoh_laporan1'] !='' && $data['tempoh_laporan2'] !=''){
	
	$q = " select b.bulan_penuh as bulan,
    (select count(p1.id_ptj) from ptj p1 
    where month(cipta_pada) <= b.bulan and status_aktif = 1 AND
    cipta_pada BETWEEN '".$tempoh_laporan1."' AND '".$tempoh_laporan2."'
    )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_semak) = b.bulan AND pn1.tarikh_semak BETWEEN '".$tempoh_laporan1."' AND '".$tempoh_laporan2."' ) as jumlah_disemak
from adm_bulan b join ptj p 
where b.bulan BETWEEN MONTH ('".$tempoh_laporan1."') AND MONTH ('".$tempoh_laporan2."')
				

";
	
		
}else{
	$now=date('Y-m-d');
$q = " select b.bulan_penuh as bulan,
    (select count(p1.id_ptj) from ptj p1 
    where month(cipta_pada) <= b.bulan and status_aktif = 1 AND
    cipta_pada BETWEEN '".$now."' AND '".$now."'
    )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_semak) = b.bulan AND pn1.tarikh_semak BETWEEN '".$now."' AND '".$now."' ) as jumlah_disemak
from adm_bulan b join ptj p
			

";

}

if($data['zon'] !='Pilih' && $data['nama_penuh'] !='Pilih'){
	
	if($data['zon'] == 'Sabah'){	
		$q .= "WHERE p.negeri IN ('SABAH')";
	}else if($data['zon'] == 'Sarawak'){
		$q .= "WHERE p.negeri IN ('SARAWAK')";
	}else{
		$q .= "WHERE p.negeri NOT IN ('SABAH','SARAWAK')";	
	}	
	
	$nama_penuh=$data['nama_penuh'];
	$q .= "and p.id_user = '".$nama_penuh."'";
	
		
}else if($data['nama_penuh'] !='Pilih'){
	
	    $nama_penuh=$data['nama_penuh'];
		$q .= "where p.id_user = '".$nama_penuh."'";	
		

	
		
}else if($data['zon'] !='Pilih'){
	
	    if($data['zon'] == 'Sabah'){	
		$q .= "WHERE p.negeri IN ('SABAH')";
	}else if($data['zon'] == 'Sarawak'){
		$q .= "WHERE p.negeri IN ('SARAWAK')";
	}else{
		$q .= "WHERE p.negeri NOT IN ('SABAH','SARAWAK')";	
	}		
	
		
}

$q .= "
group by b.bulan_penuh 
ORDER BY b.bulan";
	
				$data["list"]=$q=$this->db->query($q);




				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		
		$this->load->view('semakan_zon',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	function laporan_semakan_beta()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{

			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['saiz_ptj']= $this->input->post('saiz_ptj');		
			$this->session->set_userdata('sess_saiz_ptj',$data['saiz_ptj']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
		} else {
				
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['saiz_ptj'] = $this->session->userdata('sess_saiz_ptj');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
		
		}
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('ptj','ptj.id_user = user.id_user');
		
		
		if($data['nama'] != 'Pilih'){
			$this->db->where('nama',$data['nama']);
		}
		else if($data['saiz_ptj'] != 'Pilih'){
			$this->db->where('saiz_ptj',$data['saiz_ptj']);
		}
		else if(($data['nama_jabatan'] != '')){
					$this->db->like('nama_jabatan',$data['nama_jabatan']);		
				}else{
					
				}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/laporan_semakan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "10";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->laporan_semakan($pagination['per_page'],$this->uri->segment(4,0),$data['nama'],$data['saiz_ptj'],$data['nama_jabatan']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		
		$this->load->view('laporan_semakan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function laporan_semakan()
		{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['zon']= $this->input->post('zon');		
			$this->session->set_userdata('sess_zon',$data['zon']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$data['tempoh_laporan2']= $this->input->post('tempoh_laporan2');		
			$this->session->set_userdata('sess_tempoh_laporan2',$data['tempoh_laporan2']);
			
			
			
			
		} else {
				
				$data['zon'] = $this->session->userdata('sess_zon');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				
				
				
			
		}


			
$tahun = $this->input->post('tahun');
$terkini = date(Y);
if($data['zon'] !='' && $data['tahun'] !='' ){
	if($data['zon'] == 'Sabah'){	
		$q .= " SELECT bulan_kkwt as bulan,    
(select count(*) from penerimaan join ptj on ptj.id_ptj = penerimaan.id_ptj WHERE bulan_kkwt = b.bulan_penuh  and tahun_terima = '$tahun' and negeri = 'SABAH'   ) as jumlah_negeri,     
     
(select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and status_aktif = 1 and YEAR(cipta_pada) <= $tahun  )  as jumlah_ptj,
SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) <=30 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun
  THEN 1
  ELSE 0
  END ) AS semak_dlm_tempoh, 
SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) >=30 
  THEN 1
  ELSE 0
  END ) AS semak_luar_tempoh,
SUM(
  CASE WHEN p.tarikh_siap_semak = '0000-00-00' and p.tarikh_semak = '0000-00-00'
  THEN 1
  ELSE 0
  END ) AS dalam_tindakan,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
WHERE ptj.negeri ='SABAH'
AND tahun_terima = '$tahun'
group by bulan_kkwt order by id_adm_bulan ASC  
";
		
	}else if($data['zon'] == 'Sarawak'){	
		$q .= " SELECT bulan_kkwt as bulan, 

(select count(*) from penerimaan join ptj on ptj.id_ptj = penerimaan.id_ptj WHERE bulan_kkwt = b.bulan_penuh  and tahun_terima = '$tahun' and negeri = 'SARAWAK'   ) as jumlah_negeri,     

SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) <=30 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun
  THEN 1
  ELSE 0
  END ) AS semak_dlm_tempoh, 
SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) >=30 
  THEN 1
  ELSE 0
  END ) AS semak_luar_tempoh,
SUM(
  CASE WHEN p.tarikh_siap_semak = '0000-00-00' and p.tarikh_semak = '0000-00-00'
  THEN 1
  ELSE 0
  END ) AS dalam_tindakan,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
WHERE ptj.negeri ='SARAWAK'
AND tahun_terima = '$tahun'
group by bulan_kkwt order by id_adm_bulan ASC
";
}else if($data['zon'] == ''){	
		$q .= " SELECT bulan_kkwt as bulan,  
(select count(*) from penerimaan join ptj on ptj.id_ptj = penerimaan.id_ptj WHERE bulan_kkwt = b.bulan_penuh  and tahun_terima = $tahun  )  as jumlah_ptj,
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 1 and DAY(p.tarikh_terima) <=10 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_dlm_tempoh, 
SUM(
  CASE WHEN DAY(p.tarikh_terima) >= 11 and DAY(p.tarikh_terima) <=31 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS terima_luar_tempoh, 
SUM(
  CASE WHEN MONTH(p.tarikh_terima) > (b.bulan + 1)
  THEN 1
  ELSE 0
  END ) AS lebih_tempoh, 
((select count(*) from ptj p1 where month(cipta_pada) <= b.bulan and status_aktif = 1 and YEAR(cipta_pada) <= $tahun   ) - COUNT( * ) ) as belum_terima,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
WHERE tahun_terima ='$tahun'
group by bulan_kkwt order by  id_adm_bulan ASC  
";
	}else{//semenanjung
		$q .= "SELECT bulan_kkwt as bulan,  
(select count(*) from penerimaan join ptj on ptj.id_ptj = penerimaan.id_ptj WHERE bulan_kkwt = b.bulan_penuh  and tahun_terima = '$tahun' and negeri NOT IN('SABAH','SARAWAK')   ) as jumlah_negeri,      
SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) <=30 and MONTH(p.tarikh_terima) = (b.bulan + 1) and year(p.tarikh_terima) <= $tahun 
  THEN 1
  ELSE 0
  END ) AS semak_dlm_tempoh, 
SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) >=30 
  THEN 1
  ELSE 0
  END ) AS semak_luar_tempoh,
SUM(
  CASE WHEN p.tarikh_siap_semak = '0000-00-00' and p.tarikh_semak = '0000-00-00'
  THEN 1
  ELSE 0
  END ) AS dalam_tindakan,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
WHERE ptj.negeri NOT IN('SABAH','SARAWAK')
AND tahun_terima ='$tahun '
group by bulan_kkwt order by id_adm_bulan ASC    ";	
	}
	
	}else{
	$q .= "  SELECT bulan_kkwt as bulan,  
(select count(*) from penerimaan join ptj on ptj.id_ptj = penerimaan.id_ptj WHERE bulan_kkwt = b.bulan_penuh  and tahun_terima = $terkini  ) as jumlah_negeri,
SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) <=30 and p.bulan_kkwt = b.bulan_penuh and year(p.tarikh_terima) <= $terkini 
  THEN 1
  ELSE 0
  END ) AS semak_dlm_tempoh, 
SUM(
  CASE WHEN DATEDIFF(p.tarikh_siap_semak,p.tarikh_semak) >=30 
  THEN 1
  ELSE 0
  END ) AS semak_luar_tempoh,
SUM(
  CASE WHEN p.tarikh_siap_semak = '0000-00-00' and p.tarikh_semak = '0000-00-00'
  THEN 1
  ELSE 0
  END ) AS dalam_tindakan,
COUNT( * ) AS TOTAL
FROM penerimaan p 
INNER JOIN adm_bulan b on p.bulan_kkwt = b.bulan_penuh
JOIN ptj on ptj.id_ptj = p.id_ptj
AND tahun_terima ='$terkini '
group by bulan_kkwt order by id_adm_bulan ASC  ";
}
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_users'] = $this->db->get('user');
		
		$this->load->view('laporan_semakan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
		
	
	function laporan_analisakuiri()
		{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			//ambil tarikh dari date picker

			//explode atau just extract tahun dari parameter yang diambil dari date picker ke satu parameter baru
			//$tempoh_laporan1 = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			//$tempoh_laporan2 = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			
			
		} else {
				
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				
				
		}
		
		
			$q = " SELECT kuiri1.q1 AS q1,kuiri2.q2 AS q2,kuiri3.q3 AS q3,ptj.nama_penyemak as penyemak,ptj.nama_jabatan as jbtn,ptj.kod_ptj as kod_ptj,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'JANUARI' THEN 1 ELSE 0 END) as Januari,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'FEBRUARI' THEN 1 ELSE 0 END) as Februari,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'MAC' THEN 1 ELSE 0 END) as Mac,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'APRIL' THEN 1 ELSE 0 END) as Apr,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'MEI' THEN 1 ELSE 0 END) as Mei,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'JUN' THEN 1 ELSE 0 END) as Jun,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'JULAI' THEN 1 ELSE 0 END) as Jul,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'OGOS' THEN 1 ELSE 0 END) as Ogs,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'SEPTEMBER' THEN 1 ELSE 0 END) as Sept,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'OKTOBER' THEN 1 ELSE 0 END) as Okt,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'NOVEMBER' THEN 1 ELSE 0 END) as Nov,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'DISEMBER' THEN 1 ELSE 0 END) as Dis,
           
		   count(*) as Jumlah
		   FROM
		   senarai_kuiri AS sq
		   left JOIN kuiri1 ON sq.id_q1 = kuiri1.id_q1
		   left JOIN kuiri2 ON sq.id_q2 = kuiri2.id_q2
		   left JOIN kuiri3 ON sq.id_q3 = kuiri3.id_q3
		   left join ptj ON sq.id_ptj = ptj.id_ptj

			

";

$kod_ptj = $data['kod_ptj'];
$tahun = $this->input->post('tahun');
$nama = $this->input->post('nama');
$nama_jabatan = $this->input->post('nama_jabatan');
//echo $data['nama'] ;
//echo $data['nama_jabatan'];
			if($data['nama'] !='Pilih' && $nama_jabatan !='Pilih'&& $kod_ptj !=''&& $tahun !='')
				{
					
					$q.="where ptj.kod_ptj='$kod_ptj'";
					$q.="and ptj.id_user='$nama'";
					$q.="and ptj.nama_jabatan='$nama_jabatan'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
				}
				
				
			else if($data['nama'] !='Pilih' && $nama_jabatan !='Pilih'&& $tahun !='')
				{
					
					$q.="where ptj.id_user='$nama'";
					$q.="and ptj.nama_jabatan='$nama_jabatan'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}
				
			else if($data['nama'] !='Pilih' && $kod_ptj !=''&& $tahun !='')
				{
					
					$q.="where ptj.id_user='$nama'";
					$q.="and ptj.kod_ptj='$kod_ptj'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}
			else if($data['nama'] !='Pilih'&& $tahun !='')
				{
					
					$q.="where ptj.id_user='$nama'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}	
			else if($data['nama_jabatan'] !='Pilih'&& $tahun !='')
				{
					
					$q.="where ptj.nama_jabatan='$nama_jabatan'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}
			else if($data['kod_ptj'] !=''&& $tahun !='')
				{
					
					$q.="where ptj.kod_ptj='$kod_ptj'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}	
			
				else{
				
				}
				
				$q.=" GROUP BY kuiri1.q1,kuiri2.q2,kuiri3.q3";






	
				$data["list"]=$q=$this->db->query($q);




				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		$data['list_jabatan'] = $this->db->get('adm_jabatan');
		$this->load->view('laporan_analisakuiri',$data);
		$this->output->enable_profiler(TRUE);
	}
	function laporan_prestasi()
		{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_ptj',$data['kod_ptj']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			//ambil tarikh dari date picker

			//explode atau just extract tahun dari parameter yang diambil dari date picker ke satu parameter baru
			//$tempoh_laporan1 = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			//$tempoh_laporan2 = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			
			
		} else {
				
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				
				
		}
		
		
			$q = " SELECT kuiri1.q1 AS q1,kuiri2.q2 AS q2,kuiri3.q3 AS q3,ptj.nama_penyemak as penyemak,ptj.nama_jabatan as jbtn,ptj.kod_ptj as kod_ptj,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'JANUARI' THEN 1 ELSE 0 END) as Januari,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'FEBRUARI' THEN 1 ELSE 0 END) as Februari,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'MAC' THEN 1 ELSE 0 END) as Mac,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'APRIL' THEN 1 ELSE 0 END) as Apr,
           SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'MEI' THEN 1 ELSE 0 END) as Mei,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'JUN' THEN 1 ELSE 0 END) as Jun,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'JULAI' THEN 1 ELSE 0 END) as Jul,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'OGOS' THEN 1 ELSE 0 END) as Ogs,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'SEPTEMBER' THEN 1 ELSE 0 END) as Sept,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'OKTOBER' THEN 1 ELSE 0 END) as Okt,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'NOVEMBER' THEN 1 ELSE 0 END) as Nov,
		   SUM(CASE WHEN sq.bulan_kkwt_kuiri = 'DISEMBER' THEN 1 ELSE 0 END) as Dis,
           
		   count(*) as Jumlah
		   FROM
		   senarai_kuiri AS sq
		   left JOIN kuiri1 ON sq.id_q1 = kuiri1.id_q1
		   left JOIN kuiri2 ON sq.id_q2 = kuiri2.id_q2
		   left JOIN kuiri3 ON sq.id_q3 = kuiri3.id_q3
		   left join ptj ON sq.id_ptj = ptj.id_ptj

			

";

$kod_ptj = $data['kod_ptj'];
$tahun = $this->input->post('tahun');
$nama = $this->input->post('nama');
$nama_jabatan = $this->input->post('nama_jabatan');
//echo $data['nama'] ;
//echo $data['nama_jabatan'];
			if($data['nama'] !='Pilih' && $nama_jabatan !='Pilih'&& $kod_ptj !=''&& $tahun !='')
				{
					
					$q.="where ptj.kod_ptj='$kod_ptj'";
					$q.="and ptj.id_user='$nama'";
					$q.="and ptj.nama_jabatan='$nama_jabatan'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
				}
				
				
			else if($data['nama'] !='Pilih' && $nama_jabatan !='Pilih'&& $tahun !='')
				{
					
					$q.="where ptj.id_user='$nama'";
					$q.="and ptj.nama_jabatan='$nama_jabatan'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}
				
			else if($data['nama'] !='Pilih' && $kod_ptj !=''&& $tahun !='')
				{
					
					$q.="where ptj.id_user='$nama'";
					$q.="and ptj.kod_ptj='$kod_ptj'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}
			else if($data['nama'] !='Pilih'&& $tahun !='')
				{
					
					$q.="where ptj.id_user='$nama'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}	
			else if($data['nama_jabatan'] !='Pilih'&& $tahun !='')
				{
					
					$q.="where ptj.nama_jabatan='$nama_jabatan'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}
			else if($data['kod_ptj'] !=''&& $tahun !='')
				{
					
					$q.="where ptj.kod_ptj='$kod_ptj'";
					$q.="and sq.tahun_kuiri ='$tahun'";
					
					
					
					
				}	
			
				else{
				
				}
				
				$q.=" GROUP BY kuiri1.q1,kuiri2.q2,kuiri3.q3";






	
				$data["list"]=$q=$this->db->query($q);




				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		$data['list_jabatan'] = $this->db->get('adm_jabatan');
		$this->load->view('laporan_prestasi',$data);
		$this->output->enable_profiler(TRUE);
	}
	function laporan_analisakuiri_beta()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{

			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
			$data['kod_ptj']= $this->input->post('kod_ptj');		
			$this->session->set_userdata('sess_kod_jabatan',$data['kod_ptj']);
			
			$data['tahun_kuiri']= $this->input->post('tahun_kuiri');		
			$this->session->set_userdata('sess_tahun_kuiri',$data['tahun_kuiri']);
			
			
			
		} else {
				
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['tahun_kuiri'] = $this->session->userdata('sess_tahun_kuiri');
				
		
		}
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('ptj','ptj.id_user = user.id_user');
		
		
		if($data['nama'] != 'Pilih'){
			$this->db->where('nama',$data['nama']);
		}
		else if($data['saiz_ptj'] != 'Pilih'){
			$this->db->where('saiz_ptj',$data['saiz_ptj']);
		}
		else if(($data['nama_jabatan'] != '')){
					$this->db->like('nama_jabatan',$data['nama_jabatan']);		
				}else{
					
				}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/laporan_analisakuiri/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "10";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->laporan_analisakuiri($pagination['per_page'],$this->uri->segment(4,0),$data['nama'],$data['nama_jabatan'],$data['kod_ptj'],$data['tahun_kuiri']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		
		$data['list_jabatan'] = $this->db->get('adm_jabatan');
		
		$this->load->view('laporan_analisakuiri_beta',$data);
		$this->output->enable_profiler(TRUE);
	}
	
	

	function penerimaan_jumlah_pejabat_pemungut()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['zon']= $this->input->post('zon');		
			$this->session->set_userdata('sess_zon',$data['zon']);
			
			//$data['saiz_ptj']= $this->input->post('saiz_ptj');		
			//$this->session->set_userdata('sess_saiz_ptj',$data['saiz_ptj']);
			
			//$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			//$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
		} else {
				
				$data['zon'] = $this->session->userdata('sess_zon');
				//$data['saiz_ptj'] = $this->session->userdata('sess_saiz_ptj');
				//$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
				
		}
		
			$q = "select b.bulan_penuh as bulan,
	(select count(p1.id_ptj) from ptj p1 
	where month(cipta_pada) <= b.bulan and status_aktif = 1 )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_semak) >= 0 
and day(pn1.tarikh_semak) <= 10 and month(tarikh_semak) = b.bulan ) as terima_dlm_tempoh,
  (select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_semak) >= 11 
and day(pn1.tarikh_semak) <= 31 and month(tarikh_semak) = b.bulan ) as terima_luar_tempoh,
  (select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_semak) 				> 31 and month(pn1.tarikh_semak) > b.bulan ) as terima_luar_bulan,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_semak) = b.bulan ) as jumlah_diterima
from adm_bulan b join ptj p
";

if($data['zon'] !='Pilih'){
	
	if($data['zon'] == 'Sabah'){	
		$q .= "WHERE p.negeri IN ('SABAH')";
	}else if($data['zon'] == 'Sarawak'){
		$q .= "WHERE p.negeri IN ('SARAWAK')";
	}else{
		$q .= "WHERE p.negeri NOT IN ('SARAWAK','SARAWAK')";	
	}	
	
		
}



$q .= "
group by b.bulan_penuh 
ORDER BY b.bulan";
	
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_users'] = $this->db->get('user');
		
		$this->load->view('penerimaan_by_tarikh',$data);
		//$this->output->enable_profiler(TRUE);
	}
	//-----------------END PENERIMAAN KKWT----------------------------------------------
	
	function senarai_cetak()
	{
		//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{

			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['saiz_ptj']= $this->input->post('saiz_ptj');		
			$this->session->set_userdata('sess_saiz_ptj',$data['saiz_ptj']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
		} else {
				
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['saiz_ptj'] = $this->session->userdata('sess_saiz_ptj');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
		
		}
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('ptj','ptj.id_user = user.id_user');
		
		
		if($data['nama'] != 'Pilih'){
			$this->db->where('nama',$data['nama']);
		}
		else if($data['saiz_ptj'] != 'Pilih'){
			$this->db->where('saiz_ptj',$data['saiz_ptj']);
		}
		else if(($data['nama_jabatan'] != '')){
					$this->db->like('nama_jabatan',$data['nama_jabatan']);		
				}else{
					
				}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/senarai_pejabat_pemungut/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "10";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->senarai_pejabat_pemungut($pagination['per_page'],$this->uri->segment(4,0),$data['nama'],$data['saiz_ptj'],$data['nama_jabatan']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_user'] = $this->db->get('user');
		
		
		$this->load->view('senarai_cetak',$data);
	}
	
		function surat_peringatan_popup()
	{
	
	$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('surat_peringatan_popup',$data);
	}
	
	function jumlah_cetak()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['nama']= $this->input->post('nama');		
			$this->session->set_userdata('sess_nama',$data['nama']);
			
			$data['saiz_ptj']= $this->input->post('saiz_ptj');		
			$this->session->set_userdata('sess_saiz_ptj',$data['saiz_ptj']);
			
			$data['nama_jabatan']= $this->input->post('nama_jabatan');		
			$this->session->set_userdata('sess_nama_jabatan',$data['nama_jabatan']);
			
		} else {
				
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['saiz_ptj'] = $this->session->userdata('sess_saiz_ptj');
				$data['nama_jabatan'] = $this->session->userdata('sess_nama_jabatan');
				
		}
		
			$q= "SELECT
				ptj.kod_ptj as kod_ptj,
				ptj.nama_jabatan as nama_jabatan,
				sum(case when ptj.negeri!='SARAWAK' and ptj.negeri!='SABAH' then 1 else 0 END) as bil_semenanjung,
				sum(case when ptj.negeri='SABAH' then 1 else 0 END) as bil_sabah,
				sum(case when ptj.negeri='SARAWAK' then 1 else 0 END) as bil_sarawak

				FROM
				ptj
				INNER JOIN `user` ON ptj.id_user = `user`.id_user ";
				
				//where ptj.cipta_oleh=3
				
				if($data['nama'] !='Pilih' && $data['saiz_ptj'] !='Pilih')
				{
					
					$nama = $data['nama'];
					$saiz_ptj = $data['saiz_ptj'];
					$q.="where user.nama='$nama'";
					$q.="and ptj.saiz_ptj='$saiz_ptj'";
					
					
				}
				
				else if($data['nama'] !='Pilih')
				{
					
					$nama = $data['nama'];
					$q.="where user.nama='$nama'";
					
					
					
				}
				
				else if($data['saiz_ptj'] !='Pilih')
				{
					
					$saiz_ptj = $data['saiz_ptj'];
					$q.="where ptj.saiz_ptj='$saiz_ptj'";
					
					
				}
				
				else if($data['nama_jabatan'] !='Pilih')
				{
					
					$nama_jabatan = $data['nama_jabatan'];
					$q.="where ptj.nama_jabatan like'%$nama_jabatan%'";
					
					
					
				}
				else{
				
				}
				
				$q.=" GROUP BY ptj.nama_jabatan";
				
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_users'] = $this->db->get('user');
		
		$this->load->view('jumlah_cetak',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	function senarai_cetak_penerimaan_zon()
	{
		//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			
			
			$data['zon']= $this->input->post('zon');		
			$this->session->set_userdata('sess_zon',$data['zon']);
			
			$data['tempoh_laporan1']= $this->input->post('tempoh_laporan1');		
			$this->session->set_userdata('sess_tempoh_laporan1',$data['tempoh_laporan1']);
			
			$data['tempoh_laporan2']= $this->input->post('tempoh_laporan2');		
			$this->session->set_userdata('sess_tempoh_laporan2',$data['tempoh_laporan2']);
			
			if(!empty($data['tempoh_laporan1']) && !empty($data['tempoh_laporan1'])){
			
			$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
			
			//echo "---------->".$a;
			//echo "b";
			}
			
			
		} else {
				
				$data['zon'] = $this->session->userdata('sess_zon');
				
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->session->userdata('sess_tempoh_laporan1');
				$tempoh_laporan2 =  $data['tempoh_laporan2'] = $this->session->userdata('sess_tempoh_laporan2');
				//echo "a";
				$tempoh_laporan1 = $data['tempoh_laporan1'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan1']);
			$tempoh_laporan2 = $data['tempoh_laporan2'] = $this->model_pengguna->convert_date_db($data['tempoh_laporan2']);
		}
		
/*			$q = " select b.bulan_penuh as bulan,
    (select count(p1.id_ptj) from ptj p1 
    where month(cipta_pada) <= b.bulan and status_aktif = 1 )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_terima) = b.bulan AND year( pn1.tarikh_terima ) = ".$tahun_hasil_dari_explode.") as jumlah_diterima
from adm_bulan b join ptj p

";
*/

$q = " ";

			
	

if($data['zon'] !='Pilih' && $data['tempoh_laporan1'] !='' && $data['tempoh_laporan2'] !=''){
	if($data['zon'] == 'Sabah'){	
		$q .= " SELECT
	b.bulan_penuh AS bulan,
	(
		SELECT
			count(p1.id_ptj)
		FROM
			ptj p1
		WHERE
			MONTH(cipta_pada)<= b.bulan
		AND status_aktif = 1
	AND cipta_pada BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p1.negeri IN('SABAH')
	)AS jumlah,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 0
	AND DAY(pn1.tarikh_terima)<= 10
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SABAH')
	)AS terima_dlm_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 11
	AND DAY(pn1.tarikh_terima)<= 31
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SABAH')
	)AS terima_luar_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)> 31
	AND MONTH(pn1.tarikh_terima)> b.bulan
AND p2.negeri IN('SABAH')
	)AS terima_luar_bulan,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		MONTH(tarikh_terima)= b.bulan
	AND pn1.tarikh_terima BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p2.negeri IN('SABAH')
	)AS jumlah_diterima
FROM
	adm_bulan b
JOIN ptj p
WHERE
	b.bulan BETWEEN MONTH('".$tempoh_laporan1."')
AND MONTH('".$tempoh_laporan2."')
GROUP BY
	b.bulan_penuh
ORDER BY
	b.bulan
";
		
	}else if($data['zon'] == 'Sarawak'){	
		$q .= " SELECT
	b.bulan_penuh AS bulan,
	(
		SELECT
			count(p1.id_ptj)
		FROM
			ptj p1
		WHERE
			MONTH(cipta_pada)<= b.bulan
		AND status_aktif = 1
	AND cipta_pada BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p1.negeri IN('SARAWAK')
	)AS jumlah,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 0
	AND DAY(pn1.tarikh_terima)<= 10
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_dlm_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 11
	AND DAY(pn1.tarikh_terima)<= 31
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_luar_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)> 31
	AND MONTH(pn1.tarikh_terima)> b.bulan
AND p2.negeri IN('SARAWAK')
	)AS terima_luar_bulan,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		MONTH(tarikh_terima)= b.bulan
	AND pn1.tarikh_terima BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p2.negeri IN('SARAWAK')
	)AS jumlah_diterima
FROM
	adm_bulan b
JOIN ptj p
WHERE
	b.bulan BETWEEN MONTH('".$tempoh_laporan1."')
AND MONTH('".$tempoh_laporan2."')
GROUP BY
	b.bulan_penuh
ORDER BY
	b.bulan
";
	}else{//semenanjung
		$q .= "SELECT
	b.bulan_penuh AS bulan,
	(
		SELECT
			count(p1.id_ptj)
		FROM
			ptj p1
		WHERE
			MONTH(cipta_pada)<= b.bulan
		AND status_aktif = 1
	AND cipta_pada BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p1.negeri IN('SABAH','SARAWAK')
	)AS jumlah,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 0
	AND DAY(pn1.tarikh_terima)<= 10
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SABAH','SARAWAK')
	)AS terima_dlm_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)>= 11
	AND DAY(pn1.tarikh_terima)<= 31
AND MONTH(tarikh_terima)= b.bulan
AND p2.negeri IN('SABAH','SARAWAK')
	)AS terima_luar_tempoh,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		DAY(pn1.tarikh_terima)> 31
	AND MONTH(pn1.tarikh_terima)> b.bulan
AND p2.negeri IN('SABAH','SARAWAK')
	)AS terima_luar_bulan,
	(
		SELECT
			count(pn1.id_penerimaan)
		FROM
			penerimaan pn1
		INNER JOIN ptj p2 ON pn1.id_ptj = p2.id_ptj
	WHERE
		MONTH(tarikh_terima)= b.bulan
	AND pn1.tarikh_terima BETWEEN '".$tempoh_laporan1."'
AND '".$tempoh_laporan2."'
AND p2.negeri IN('SABAH','SARAWAK')
	)AS jumlah_diterima
FROM
	adm_bulan b
JOIN ptj p
WHERE
	b.bulan BETWEEN MONTH('".$tempoh_laporan1."')
AND MONTH('".$tempoh_laporan2."')
GROUP BY
	b.bulan_penuh
ORDER BY
	b.bulan";	
	}
	
	}else{
	$q .= "select b.bulan_penuh as bulan,
    (select count(p1.id_ptj) from ptj p1 
    where month(cipta_pada) <= b.bulan and status_aktif = 1 )  as jumlah ,
(select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_terima) >= 0 
and day(pn1.tarikh_terima) <= 10 and month(tarikh_terima) = b.bulan ) as terima_dlm_tempoh,
  (select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_terima) >= 11 
and day(pn1.tarikh_terima) <= 31 and month(tarikh_terima) = b.bulan ) as terima_luar_tempoh,
  (select count(pn1.id_penerimaan) from penerimaan pn1 where day(pn1.tarikh_terima) > 31 and month(pn1.tarikh_terima) > b.bulan ) as terima_luar_bulan,
(select count(pn1.id_penerimaan) from penerimaan pn1 where month(tarikh_terima) = b.bulan ) as jumlah_diterima
from adm_bulan b join ptj p

group by b.bulan_penuh 
ORDER BY b.bulan   ";
}
				$data["list"]=$q=$this->db->query($q);
				
				
				
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['list_users'] = $this->db->get('user');
		
		$this->load->view('senarai_cetak_penerimaan_zon',$data);
		//$this->output->enable_profiler(TRUE);
	}
	

		function cetak_surat_peringatan()
{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['nama_ptj']= $this->input->post('nama_ptj');		
			$this->session->set_userdata('sess_nama_ptj',$data['nama_ptj']);
			
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			$data['tahun_terima']= $this->input->post('tahun_terima');		
			$this->session->set_userdata('sess_tahun_terima',$data['tahun_terima']);
			
			
			
			
		} else {
				$data['nama_ptj'] = $this->session->userdata('sess_nama_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				$data['tahun_terima'] = $this->session->userdata('sess_tahun_terima');
				
				
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('surat_peringatan','surat_peringatan.id_ptj = ptj.id_ptj');
		
		//$check_tarikh_cetak = $this->model_pengguna->check_tarikh_cetak();
		
		if(!empty($data['nama_ptj'])){
			$this->db->like('nama_ptj',$data['nama_ptj']);
		}
		if(!empty($data['bulan_kkwt'])){
			$this->db->like('bulan_kkwt',$data['bulan_kkwt']);
		}
		if(!empty($data['tahun_terima'])){
			$this->db->like('tahun_terima',$data['tahun_terima']);
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/cetak_surat_peringatan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->cetak_surat_peringatan($pagination['per_page'],$this->uri->segment(4,0),$data['nama_ptj'],$data['bulan_kkwt'],$data['tahun_terima']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('cetak_surat_peringatan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	
	function catatan_surat_peringatan($id)
	{
		
		
		$query = $this->db->query("SELECT * FROM surat_peringatan where id_surat_peringatan='$id'");
		if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
	            
				$data['id_surat_peringatan'] = $row->id_surat_peringatan;
				$data['catatan_surat_peringatan'] = $row->catatan_surat_peringatan;
			}
		
		
		$data['act'] = "edit";
		
		$this->load->view('catatan_surat_peringatan',$data,$id);
	}
	
	function edit_catatan_surat_peringatan_proses()
	
	{
	$id = $this->input->post('key');	
	
	$data = array (		
		'catatan_surat_peringatan' => $this->input->post('catatan_surat_peringatan'),
		
		
		//'id_adm_negeri' => $this->input->post('negeri'),
		
		);

		$this->model_pengguna->update_data('surat_peringatan',$id,$data,'id_surat_peringatan');
		//user = nama table
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/cetak_surat_peringatan','refresh');	
				
	}
	
	function del_surat_peringatan($id)
	{
		
		
		$this->db->where('id_surat_peringatan', $id);
		$this->db->delete('surat_peringatan');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/cetak_surat_peringatan','refresh');
				
	}
	
	
	
	 function semakan_proses(){
	
	$id = $this->input->post('id_penerimaan');
		//define data from form for insert table dan jika terdapat tarikh yang tidak diisi jika didalam database not allowed null

		$tarikh_terima = $this->input->post('tarikh_terima'); 
		$tarikh_semak = $this->input->post('tarikh_semak'); 
		$tarikh_siap_semak = $this->input->post('tarikh_siap_semak');
		$tarikh_kuiri = $this->input->post('tarikh_kuiri');
		
		if($tarikh_kuiri == '' && $tarikh_siap_semak == ''){
			$data = array (		
			
			'tarikh_semak' => $this->input->post('tarikh_semak'),					
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			
			
			
			);
		
		}else if($tarikh_kuiri == '' && $tarikh_siap_semak != ''  ){
			$data = array (		
			
			'tarikh_siap_semak' => $this->input->post('tarikh_siap_semak'),	
			'tarikh_semak' => $this->input->post('tarikh_semak'),
						
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			
			
			
			
			);
		}else if ($tarikh_siap_semak == '' && $tarikh_kuiri != ''){
			$data = array (	
			
			'tarikh_kuiri' => $this->input->post('tarikh_kuiri'),	
			'tarikh_semak' => $this->input->post('tarikh_semak'),					
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			
		
			
			
			
			);
		}else{
			$data = array (		
			
			'tarikh_semak' => $this->input->post('tarikh_semak'),
			'tarikh_siap_semak' => $this->input->post('tarikh_siap_semak'),	
			'tarikh_kuiri' => $this->input->post('tarikh_kuiri'),			
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			);
		}
		
	
		if($tarikh_semak !='' && $tarikh_siap_semak !='' && $tarikh_kuiri !=''){
				if($tarikh_semak < $tarikh_terima){
					$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Semak Selepas Tarikh Terima'); 
					redirect ('main/semakan_todo/'.$id,'refresh');
					//echo "1";
					
				}else if($tarikh_siap_semak < $tarikh_semak){ 
					$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Siap Semak Selepas Tarikh Semak'); 
					redirect ('main/semakan_todo/'.$id,'refresh');
					//echo "2"; 
					
				/*}else if($tarikh_kuiri < $tarikh_siap_semak){
					$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Kuiri Selepas Tarikh Siap Semak!!!!!'); 
					redirect ('main/semakan_todo/'.$id,'refresh');
					//echo "3"; */

				}else if($tarikh_kuiri < $tarikh_semak){
					$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Kuiri Selepas Tarikh Semak!!!!!'); 
					redirect ('main/semakan_todo/'.$id,'refresh');
					//echo "4";

					
				}else{
					$data = array (		
					
					'tarikh_semak' => $tarikh_semak,
					'tarikh_siap_semak' => $tarikh_siap_semak,
					'tarikh_kuiri' => $tarikh_kuiri,
					'bil_resit' => $this->input->post('bil_resit'),
					'jumlah_hasil' => $this->input->post('jumlah_hasil'),
					
						
					
					);

		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
						
		//echo "4";
		redirect ('main/semakan','refresh');
		}
	
		}else if($tarikh_siap_semak !='' && $tarikh_semak !=''){
			if($tarikh_semak < $tarikh_terima){
					$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Semak Selepas Tarikh Terima'); 
					redirect ('main/semakan_todo/'.$id,'refresh');
					//echo "a";
				
				}else if($tarikh_siap_semak < $tarikh_semak){ 
					$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Siap Semak Selepas Tarikh Semak'); 
					redirect ('main/semakan_todo/'.$id,'refresh'); 
					//echo "c";
				}else{
					
				
					$data = array (

		
					
					'tarikh_semak' => $tarikh_semak,
					'tarikh_siap_semak' => $tarikh_siap_semak,
					//'tarikh_kuiri' => $tarikh_kuiri,
					'tarikh_kuiri' => '0000-00-00',	
					'bil_resit' => $this->input->post('bil_resit'),
					'jumlah_hasil' => $this->input->post('jumlah_hasil'),
							
					
					);

		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
		$this->session->set_flashdata('flash_success', ' Maklumat Tarikh Siap Semak telah berjaya disimpan dan disemak'); 
						
		//echo "e";
		redirect ('main/semakan','refresh');
					
		}

		}else if($tarikh_kuiri !='' && $tarikh_semak !=''){
			
				if($tarikh_kuiri < $tarikh_terima){

				$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Kuiri Selepas Tarikh Mula Semak'); 
				redirect ('main/semakan_todo/'.$id,'refresh');
				//echo "fff";
				
				}else if($tarikh_kuiri < $tarikh_semak){ 
					$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Kuiri Selepas Tarikh Mula Semak'); 
					redirect ('main/semakan_todo/'.$id,'refresh'); 
					//echo "c";

					
				}else{
					
					

				
					$data = array (		
					
					'tarikh_semak' => $tarikh_semak,
					//'tarikh_siap_semak' => $tarikh_siap_semak,
					'tarikh_kuiri' => $tarikh_kuiri,
					'tarikh_siap_semak' => '0000-00-00',	
					'bil_resit' => $this->input->post('bil_resit'),
					'jumlah_hasil' => $this->input->post('jumlah_hasil'),
							
					
					);

		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
		$this->session->set_flashdata('flash_success', ' Maklumat Kuiri telah berjaya disimpan dan disemak'); 
						
		//echo "eeee";
		redirect ('main/semakan','refresh');

		}		
		

		}else if($tarikh_kuiri !='' && $tarikh_semak ==''){
			if($tarikh_kuiri < $tarikh_terima){

				$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Kuiri Selepas Tarikh Mula Semak'); 
				//redirect ('main/semakan_todo/'.$id,'refresh');
				echo "hhhh";
				
			
	
					
				}else{
					
					

				
					$data = array (		
					
					'tarikh_semak' => $tarikh_semak,
					//'tarikh_siap_semak' => $tarikh_siap_semak,
					'tarikh_kuiri' => $tarikh_kuiri,
					'tarikh_siap_semak' => '0000-00-00',	
					'bil_resit' => $this->input->post('bil_resit'),
					'jumlah_hasil' => $this->input->post('jumlah_hasil'),
							
					
					);

		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
		$this->session->set_flashdata('flash_success', ' Maklumat Kuiri telah berjaya disimpan dan disemak'); 
						
		echo "ggggg";
		//redirect ('main/semakan','refresh');

		}		
		



		}else{
	
		if (($tarikh_semak < $tarikh_terima)&& ($tarikh_semak !='0000-00-00')){
			
			
			$this->session->set_flashdata('flash_error', ' Ralat : Sila Masukkan Tarikh Semak Selepas Tarikh Terima'); 
			redirect ('main/semakan_todo/'.$id,'refresh');
			//echo "f";
						
				}else{
					$data = array (		
					
					'tarikh_semak' => $tarikh_semak,
					//'tarikh_siap_semak' => $tarikh_siap_semak,
					//'tarikh_kuiri' => $tarikh_kuiri,
					'tarikh_kuiri' => '0000-00-00',	
					'tarikh_siap_semak' => '0000-00-00',
					'bil_resit' => $this->input->post('bil_resit'),
					'jumlah_hasil' => $this->input->post('jumlah_hasil'),
					
							
					
			);

			//user = nama table
			$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
			$this->session->set_flashdata('flash_success', ' Maklumat Tarikh Semak telah berjaya disimpan dan disemak'); 
						
			//echo "5";
			redirect ('main/semakan','refresh');
				}
			//echo "y";
			//echo $tarikh_semak."</br>";
			//echo $tarikh_terima;
			//echo $tarikh_kuiri;


		}

		//user = nama table
		//$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
		//$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/semakan','refresh');
	
		
	}
	
	
	
	function aktif_pengguna($id)
	{
		
		$data = array(			
				
						'status' => 1,
					
				);	
		//update table			
		$this->model_pengguna->update_data('user',$id,$data,'id_user');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/pengemaskinian_pengguna','refresh');
		//$this->output->enable_profiler(TRUE);
	}
	
	function tidak_aktif_pengguna($id)
	{
		
		$data = array(			
				
						'status' => 0,
					
				);	
		//update table			
		$this->model_pengguna->update_data('user',$id,$data,'id_user');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/pengemaskinian_pengguna','refresh');
		//$this->output->enable_profiler(TRUE);
	}
	
	
	function aktif_ptj($id)
	{
		
		$data = array(			
				
						'status' => 1,
					
				);	
		//update table			
		$this->model_pengguna->update_data('user_ptj',$id,$data,'id_user_ptj');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/senarai_assign_pengguna','refresh');
		//$this->output->enable_profiler(TRUE);
	}
	
	function tidak_aktif_ptj($id)
	{
		
		$data = array(			
				
						'status' => 0,
					
				);	
		//update table			
		$this->model_pengguna->update_data('user_ptj',$id,$data,'id_user_ptj');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/senarai_assign_pengguna','refresh');
	}
	
	
	
	
	function senarai_assign_pengguna()
	{	
	
	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['nama_assign']= $this->input->post('nama_assign');		
			$this->session->set_userdata('sess_nama_assign',$data['nama_assign']);
			
			//$data['level']= $this->input->post('level');		
			//$this->session->set_userdata('sess_level',$data['level']);
			
			
			
			
		} else {
				$data['nama_assign'] = $this->session->userdata('sess_nama_assign');
				//$data['level'] = $this->session->userdata('sess_level');
				
				
		}
		
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('user_ptj','user.id_user = user_ptj.id_user');
		$this->db->join('ptj','ptj.id_ptj = user_ptj.id_ptj');	
			
	
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/senarai_assign_pengguna/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->senarai_assign_pengguna($pagination['per_page'],$this->uri->segment(4,0),$data['nama_assign']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('senarai_assign_pengguna',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function pengemaskinian_penerimaan()
	{	
	//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			$data['tahun_terima']= $this->input->post('tahun_terima');		
			$this->session->set_userdata('sess_tahun_terimat',$data['tahun_terima']);
			
			$data['nama_ptj']= $this->input->post('nama_ptj');		
			$this->session->set_userdata('sess_nama_ptj',$data['nama_ptj']);
			
			
			
			
		} else {
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				$data['tahun_terima'] = $this->session->userdata('sess_tahun_terima');
				$data['nama_ptj'] = $this->session->userdata('sess_nama_ptj');
				
				
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		if(!empty($data['bulan_kkwt'])){
			$this->db->like('bulan_kkwt',$data['bulan_kkwt']);
		}
		if(!empty($data['tahun_terima'])){
			$this->db->where('tahun_terima',$data['tahun_terima']);
		}
		if(!empty($data['nama_ptj'])){
			$this->db->like('nama_ptj',$data['nama_ptj']);
			
			
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_penerimaan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pengemaskinian_penerimaan($pagination['per_page'],$this->uri->segment(4,0),$data['bulan_kkwt'],$data['tahun_terima'],$data['nama_ptj']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('pengemaskinian_penerimaan',$data);
		//$this->output->enable_profiler(TRUE);
	}
		function pengemaskinian_penerimaan_todo($id)
	{
		
		
		$query = $this->db->query("SELECT * FROM penerimaan join ptj on ptj.id_ptj=penerimaan.id_ptj where penerimaan.id_penerimaan='$id'");				

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['tarikh_terima'] = $row->tarikh_terima;
				$data['tarikh_kuiri'] = $row->tarikh_kuiri;
				$data['id_penerimaan'] = $row->id_penerimaan;
				$data['bil_resit'] = $row->bil_resit;
				$data['jumlah_hasil'] = $row->jumlah_hasil;
				$data['tarikh_semak'] = $row->tarikh_semak;
				$data['tarikh_siap_semak'] = $row->tarikh_siap_semak;
				$data['nama_ptj'] = $row->nama_ptj;
				$data['bulan_kkwt'] = $row->bulan_kkwt;
				$data['tahun_terima'] = $row->tahun_terima;
				
				
				
				
			
			}
		
		
		$data['act'] = "edit";
		$this->load->view('pengemaskinian_penerimaan_todo',$data);
		//$this->output->enable_profiler(TRUE);
		
	}
	
	
	function pengemaskinian_penerimaan_proses(){
	
	$id = $this->input->post('id_penerimaan');
		//define data from form for insert table
		
		/*
		if($this->input->post('tarikh_terima') !='00-00-0000' || $this->input->post('tarikh_terima') ==''){
			$tarikh_terima = $this->model_pengguna->convert_date_db($this->input->post('tarikh_terima'));
		}	
		if($this->input->post('tarikh_semak') !='00-00-0000' || $this->input->post('tarikh_semak') ==''){
			$tarikh_siap_semak = $this->model_pengguna->convert_date_db($this->input->post('tarikh_semak'));
		}
		if($this->input->post('tarikh_siap_semak') !='0000-00-00' || $this->input->post('tarikh_siap_semak') ==''){
			$tarikh_siap_semak = $this->model_pengguna->convert_date_db($this->input->post('tarikh_siap_semak'));
		}
		if($this->input->post('tarikh_kuiri') !='0000-00-00' || $this->input->post('tarikh_kuiri') ==''){
			$tarikh_siap_semak = $this->model_pengguna->convert_date_db($this->input->post('tarikh_kuiri'));
		}
		
		$data = array (	
		
		'tarikh_terima' => $tarikh_terima,
		'tarikh_semak' => $tarikh_semak,
		'tarikh_siap_semak' => $tarikh_siap_semak,
		'tarikh_kuiri' => $tarikh_kuiri,
		'bil_resit' => $this->input->post('bil_resit'),
		'jumlah_hasil' => $this->input->post('jumlah_hasil'),
		'bulan_kkwt' => $this->input->post('bulan_kkwt'),
		'tahun_terima' => $this->input->post('tahun_terima'),
		
		*/
		
		//define data from form for insert table dan jika terdapat tarikh yang tidak diisi jika didalam database not allowed null

		$tarikh_terima = $this->input->post('tarikh_terima'); 
		$tarikh_semak = $this->input->post('tarikh_semak'); 
		$tarikh_siap_semak = $this->input->post('tarikh_siap_semak');
		$tarikh_kuiri = $this->input->post('tarikh_kuiri');
		
		if($tarikh_kuiri == '' && $tarikh_siap_semak == ''){
			$data = array (		
			
			'tarikh_terima' => $this->input->post('tarikh_terima'),
			'tarikh_semak' => $this->input->post('tarikh_semak'),					
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			
			
			
			);
			
			
		
		}else if($tarikh_kuiri == '' && $tarikh_siap_semak != ''  ){
			$data = array (		
			
			'tarikh_terima' => $this->input->post('tarikh_terima'),
			'tarikh_siap_semak' => $this->input->post('tarikh_siap_semak'),	
			'tarikh_semak' => $this->input->post('tarikh_semak'),
						
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			
			
			
			
			);
			
			
		}else if ($tarikh_siap_semak == '' && $tarikh_kuiri != ''){
			$data = array (	
			
			'tarikh_terima' => $this->input->post('tarikh_terima'),
			'tarikh_kuiri' => $this->input->post('tarikh_kuiri'),	
			'tarikh_semak' => $this->input->post('tarikh_semak'),					
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			
		
			
			
			
			);
			
			
			
		}else{
		
			
			$data = array (		
			
			'tarikh_terima' => $this->input->post('tarikh_terima'),
			'tarikh_semak' => $this->input->post('tarikh_semak'),
			'tarikh_siap_semak' => $this->input->post('tarikh_siap_semak'),	
			'tarikh_kuiri' => $this->input->post('tarikh_kuiri'),			
			'bil_resit' => $this->input->post('bil_resit'),
			'jumlah_hasil' => $this->input->post('jumlah_hasil'),
			'id_user' =>$this->session->userdata('sess_id'),
			);
			
		
		}
		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_penerimaan','refresh');
	
		
	}
	
	function del_penerimaan($id)
	{
		
		
		$this->db->where('id_penerimaan', $id);
		$this->db->delete('penerimaan');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_penerimaan','refresh');
				
	}

	
	
	function assign_pengguna_ptj()
	{
		//Untuk Carian==kena sama dengan model pengguna
		if(isset($_POST['submit']))
		{
			$data['kod_jabatan']= $this->input->post('kod_jabatan');		
			$this->session->set_userdata('sess_kod_jabatan',$data['kod_jabatan']);
		
		} else {
				$data['kod_jabatan'] = $this->session->userdata('sess_kod_jabatan');
	
		}
		
		$this->db->select('*');			
		$this->db->from('ptj');
		

				
		if(!empty($data['kod_jabatan'])){
			$this->db->where('kod_jabatan',$data['kod_jabatan']);
		}
		
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/assign_pengguna_ptj/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "15";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->assign_pengguna_ptj($pagination['per_page'],$this->uri->segment(4,0),$data['kod_jabatan']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('assign_pengguna_ptj',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	
	
	function assign_pengguna_ptj_proses()
	{
		
		$data = $this->input->post('id_ptj');   
       
        if (is_array($data))
        {
            foreach($data as $datas)
            {
           
                $data_da = array(
                        'id_ptj' => $datas,
						'id_user' => $this->input->post('id_user'), 
                    );
                /* insert ke table user */
               $this->db->insert('user_ptj', $data_da);
           
                    $this->session->set_flashdata('flash_success', 'Tahniah !.Data telah dimasukkan.');
                    //redirect('main/senarai_assign_pengguna','refresh');   
                }
            }else{
                $this->session->set_flashdata('flash_error', 'Ralat !. Sila Pilih ');
                //redirect('anggota/cetakan_list_by_nokp','refresh');   
            }    
		
		
	   // $this->output->enable_profiler(TRUE);
	
	}
	
	
	
	
	
	
	function tampilkan_list_daerah()
	{
		$kategori = $this->uri->segment(3);
		$this->db->where('id_adm_negeri',$kategori);
		$subkategori = $this->db->get('adm_daerah');
		echo $this->lib_general->create_combobox('subkategori',$subkategori,'id_adm_daerah','daerah');
		//insert data dalam audit trail	
		//$this->lib_general->audit_log();	
		//$this->output->enable_profiler(TRUE);
	}
	
	
	function tampilkan_subkategori()
	{
		$kategori = $this->uri->segment(3);
		$this->db->where('id_adm_negeri',$kategori);
		$subkategori = $this->db->get('adm_daerah');
		
		
		echo $this->lib_general->create_combobox('subkategori',$subkategori,'id_adm_daerah','daerah');
		//$this->output->enable_profiler(TRUE);
	}
	
	

	
	
	
		
	function upload_gambar()
	{
		$id = $this->input->post('key');
		$catatan = $this->input->post('catatan');
		
			
		
		$_FILES['gambar']['name'];
		
		
		$folder_path = "upload";
		if ($folder_path==TRUE) {
			//if ($folder_path_negeri==TRUE) {
				@mkdir($folder_path ."/" .$id, 0777);
			//}
		}
		//echo base_url()."upload/".$id;
		$config['upload_path'] = "upload/".$id; //IMAGE_PATH;//IMAGE_PATH to upload image
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		//$config['allowed_types'] = ‘gif|jpg|png|jpeg’; // allowed files types to upload
		$config['max_size'] = 5120; // maximum image upload size.
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('gambar')) //up_file is the name of the file type field on which the file is uploading in html page
		{
			$data=$this->upload->data();
			$this->image_lib->clear();
			$image['image_library'] = 'GD2';
			$image['source_image'] = $data['full_path'];//$this->comm->logo_path(‘user’,'original’).$data['file_name'];
			$image['new_image'] = "upload/".$id."/".$data['file_name']; //SMALL_IMAGE_PATH to upload small image
			$image['maintain_ratio'] = TRUE;
			$size = getimagesize($_FILES["gambar"]["tmp_name"]); //getting the origional image height and width
			$ow=$size['0'];
			$oh=$size['1'];
			if($oh > $ow){
				$image['master_dim'] = 'height';
			}else{
				$image['master_dim'] = 'width';
			}

			$image['width'] = 600; // desigred small image width
			$image['height'] = 600; // desigred small image height
			$this->image_lib->initialize($image);
			$this->image_lib->resize();
			
			//insert to table pemohon_gallery
			$data = array(			
					
						'catatan' => $catatan,
						'id_pemohon' => $id,
						'nama_fail' => $data['file_name']
						
					
					);		
					//insert ke table user
					$this->db->insert('pemohon_gallery', $data);
					
					redirect('main/detail_pemohon/'.$id,'refresh');
			
		}else{
			$error = $this->upload->display_errors();
			print_r($error);// errors if there is any error in uploading image.
		}
		
		redirect('main/detail_pemohon/'.$id,'refresh');
		//$this->load->view(image_uploader); // image_uploader showing the file view to upload file upload
		
	}
	
	function upload_photo()
	{
		$id = $this->input->post('key');
		//$catatan = $this->input->post('catatan');
		
			
		
		$_FILES['gambar']['name'];
		
		
		$folder_path ="upload";
		if ($folder_path==TRUE) {
			//if ($folder_path_negeri==TRUE) {
				@mkdir($folder_path ."/" .$id, 0777);
			//}
		}
		
		$config['upload_path'] = "upload/".$id; //IMAGE_PATH;//IMAGE_PATH to upload image
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		//$config['allowed_types'] = ‘gif|jpg|png|jpeg’; // allowed files types to upload
		$config['max_size'] = 5120; // maximum image upload size.
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('gambar')) //up_file is the name of the file type field on which the file is uploading in html page
		{
			$data=$this->upload->data();
			$this->image_lib->clear();
			$image['image_library'] = 'GD2';
			$image['source_image'] = $data['full_path'];//$this->comm->logo_path(‘user’,'original’).$data['file_name'];
			$image['new_image'] = "upload/".$id."/".$data['file_name']; //SMALL_IMAGE_PATH to upload small image
			$image['maintain_ratio'] = TRUE;
			$size = getimagesize($_FILES["gambar"]["tmp_name"]); //getting the origional image height and width
			$ow=$size['0'];
			$oh=$size['1'];
			if($oh > $ow){
				$image['master_dim'] = 'height';
			}else{
				$image['master_dim'] = 'width';
			}

			$image['width'] = 600; // desigred small image width
			$image['height'] = 600; // desigred small image height
			$this->image_lib->initialize($image);
			$this->image_lib->resize();
			
			//insert to table pemohon_gallery
			$data = array(			
					
						//'photo' => $catatan,
						//'id_pemohon' => $id,
						'photo' => $data['file_name']
						
					
					);		
					//insert ke table user
					$this->model_pengguna->update_data('pemohon',$id,$data,'id_pemohon');
			redirect('main/detail_pemohon/'.$id,'refresh');
		}else{
			$error = $this->upload->display_errors();
			print_r($error);// errors if there is any error in uploading image.
			
			
		}
		
		redirect('main/detail_pemohon/'.$id,'refresh');
		//$this->load->view(image_uploader); // image_uploader showing the file view to upload file upload
		//$this->output->enable_profiler(TRUE);
	}
	
	
	
	
			
	
	function migrate_data()
    {
		//Buang no KP ada - sebelum transfer ke pemohon
		
		$sql =   $this->db->query("update pemohon set no_kp = replace(no_kp, '-', '');");
		$sql =   $this->db->query("update data_baru set no_kp_peserta = replace(no_kp_peserta, '-', '');");
		$sql =   $this->db->query("update data_lama set no_kp_peserta = replace(no_kp_peserta, '-', '');");
		
		
                
        $sql =   $this->db->query("SELECT no_kp_peserta, id FROM data_baru where no_kp_peserta !='' order by id ASC ");
			$count=0;
			
			foreach ($sql->result() as $row)
            {
                $no_kp_peserta = $row->no_kp_peserta;				
				$id = $row->id;
				
				
				$this->db->where('no_kp_peserta', $no_kp_peserta);			
				$query2 =$this->db->get('data_lama');
				
				
				
				if ($query2->num_rows() > 0) {
				
					//echo "x wujud";
					//insert ke table pemohon
					
					$data = array(			
					
						'status_migrate' => 2,
						//'id_data_baru' => $id
						
					
					);		
					//insert ke table user
					//$this->db->insert('pemohon', $data);
					$this->model_pengguna->update_data('data_baru',$id,$data,'id');

					$data_update = array(			
					
							
							
							'status_migrate' =>2					
							
						);	
						//update table			
						$this->model_pengguna->update_data('data_baru',$no_kp_peserta,$data_update,'no_kp_peserta');		
					
				}else{
				//telah wujud
				//echo "telah wujud";
						$data = array(			
					
							
							
							'status_migrate' =>1					
							
						);	
						//update table			
						$this->model_pengguna->update_data('data_baru',$no_kp_peserta,$data,'no_kp_peserta');
				
				}
                       
                  $count++;
				
            }
			
			$sql =   $this->db->query("SELECT  no_kp_kir, id FROM data_baru where no_kp_kir !=''  order by id ASC ");
			$count=0;
			
			foreach ($sql->result() as $row)
            {
                //$no_kp_peserta = $row->no_kp_peserta;
				$no_kp_kir = $row->no_kp_kir;
				$id = $row->id;		
				
				
				$this->db->where('no_kp_peserta', $no_kp_kir);			
				$query3 =$this->db->get('data_lama');
				
				if ($query2->num_rows() > 0) {
				
					//echo "x wujud";
					//insert ke table pemohon
					
					$data = array(			
					
						'status_migrate' => 2,
						//'id_data_baru' => $id
						
					
					);		
					//insert ke table user
					//$this->db->insert('pemohon', $data);
					$this->model_pengguna->update_data('data_baru',$id,$data,'id');

					$data_update = array(			
					
							
							
							'status_migrate' =>2					
							
						);	
						//update table			
						$this->model_pengguna->update_data('data_baru',$no_kp_peserta,$data_update,'no_kp_peserta');		
					
				}else{
				//telah wujud
				//echo "telah wujud";
						$data = array(			
					
							
							
							'status_migrate' =>1					
							
						);	
						//update table			
						$this->model_pengguna->update_data('data_baru',$no_kp_peserta,$data,'no_kp_peserta');
				
				}
                       
                  $count++;
				
            }
			
			//Check existing no_kp KIR
             /*   
			$sql2 =   $this->db->query("SELECT no_kp_kir,id FROM data_baru order by id ASC");
			$count=0;
			
			foreach ($sql2->result() as $row)
            {
                $no_kp_peserta = $row->no_kp_kir;
				$id = $row->id;
				
				//echo $no_kp_peserta."<br>";
				$this->db->where('no_kp_peserta', $no_kp_peserta);			
				$query3 =$this->db->get('data_lama');
				
				//$this->db->where('no_kp', $no_kp_peserta);			
				//$query2 =$this->db->get('pemohon');
				
				if ($query3->num_rows() > 0) {
				
					//echo "x wujud";
					//insert ke table pemohon
					
					$data = array(			
					
						'status_migrate' => 2,
						//'id_data_baru' => $id
						
					
					);		
					//insert ke table user
					//$this->db->insert('pemohon', $data);
					$this->model_pengguna->update_data('data_baru',$id,$data,'id');

					$data_update = array(			
					
							
							
							'status_migrate' =>2					
							
						);	
						//update table			
						$this->model_pengguna->update_data('data_baru',$no_kp_peserta,$data_update,'no_kp_peserta');		
					
				}else{
				//telah wujud
				//echo "telah wujud";
						$data = array(			
					
							
							
							'status_migrate' =>1					
							
						);	
						//update table			
						$this->model_pengguna->update_data('data_baru',$no_kp_peserta,$data,'no_kp_peserta');
				
				}
                       
                  $count++;
				
            }
			*/
			
        //$data['count'] = $count;                        
        $this->session->set_flashdata('flash_success', 'Migrasi Berjaya dilaksanakan !');                                                 
        $this->load->view('migrate_data');
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