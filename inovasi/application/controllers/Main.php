<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

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
		
		
		//papar mesej bila berjaya 
		//$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		//$data['flash_error'] = $this->session->flashdata('flash_error');
		$this->load->view('login');
		
		
	}
	
	
	function login()

	{
				
		//papar mesej bila berjaya 
		//$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		//$data['flash_error'] = $this->session->flashdata('flash_error');
		$this->load->view('login');
		
		//$this->output->enable_profiler(TRUE);
	}
	
	
		
	function utama()
	
	{	
		$id = $this->session->userdata('sess_id');
		$level = $this->session->userdata('sess_level');
		
		
		
		if(isset($_POST['submit']))
		{
			
			$data['tajuk_projek']= $this->input->post('tajuk_projek');		
			$this->session->set_userdata('sess_tajuk_projek',$data['tajuk_projek']);
			
			$data['status']= $this->input->post('status');		
			$this->session->set_userdata('sess_status',$data['status']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$data['jabatan']= $this->input->post('jabatan');		
			$this->session->set_userdata('sess_jabatan',$data['jabatan']);
			
		} else {
				
				$data['tajuk_projek'] = $this->session->userdata('sess_tajuk_projek');
				$data['status'] = $this->session->userdata('sess_status');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				$data['jabatan'] = $this->session->userdata('sess_jabatan');
				
		}
		
			
		$this->db->select('*');
		$this->db->from('projek');
		$this->db->order_by('id_projek','DESC');
		
		if( $level == 1){ //kalau login sbg ketua Jabatan
		$this->db->where('id_ketua_organisasi',$id);
		
		}

		if( $level == 2){
		$this->db->where('id_ketua_projek',$id);
		
		}
		
		
		if(!empty($data['tajuk_projek'])){
			$this->db->like('tajuk_projek',$data['tajuk_projek']);
		}
		if(!empty($data['status'])){
			$this->db->where('status',$data['status']);
		}
		if(!empty($data['tahun'])){
			$this->db->where('tahun',$data['tahun']);
		}
		if(!empty($data['jabatan'])){
			$this->db->where('jabatan',$data['jabatan']);
		}
		$data['list2'] = $this->db->get('');
		
		
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('utama',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	function utama2()
	
	{	
		$id = $this->session->userdata('sess_id');
		$level = $this->session->userdata('sess_level');
		$id_jabatan = $this->session->userdata('sess_id_jabatan');
		
		
		
		if(isset($_POST['submit']))
		{
			
			$data['tajuk_projek']= $this->input->post('tajuk_projek');		
			$this->session->set_userdata('sess_tajuk_projek',$data['tajuk_projek']);
			
			$data['status']= $this->input->post('status');		
			$this->session->set_userdata('sess_status',$data['status']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			$data['jabatan']= $this->input->post('jabatan');		
			$this->session->set_userdata('sess_jabatan',$data['jabatan']);
			
		} else {
				
				$data['tajuk_projek'] = $this->session->userdata('sess_tajuk_projek');
				$data['status'] = $this->session->userdata('sess_status');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				$data['jabatan'] = $this->session->userdata('sess_jabatan');
				
		}
		
			
		$this->db->select('*');
		$this->db->from('projek');
		$this->db->where('jabatan',$id_jabatan);
		$this->db->order_by('id_projek','DESC');
		
		
		
		if(!empty($data['tajuk_projek'])){
			$this->db->like('tajuk_projek',$data['tajuk_projek']);
		}
		if(!empty($data['status'])){
			$this->db->where('status',$data['status']);
		}
		if(!empty($data['tahun'])){
			$this->db->where('tahun',$data['tahun']);
		}
		if(!empty($data['jabatan'])){
			$this->db->where('jabatan',$data['jabatan']);
		}
		$data['list2'] = $this->db->get('');
		
		
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('utama2',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_tarikh_tutup()
	
	{	
		
		$this->db->select('');
		$this->db->from('projek');
		$this->db->where('id_ketua_projek',$id);
		
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_tarikh_tutup',$data);
	
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_tarikh_tutup_proses()
	
	{	
		
		$tarikh_tutup = convert_date_formattodb($this->input->post('tarikh_tutup')); 
		
		$this->db->set('date_range',$tarikh_tutup);
		$this->db->update('user');
		
		redirect('main/utama','refresh');
	
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function add_pengguna()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_pengguna',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	function add_pengguna1($id_user)
	
	{	
		$id_user = $this->session->userdata('sess_id');
		$id = $this->session->userdata('sess_id');
		
		
		
		
		if(isset($_POST['submit']))
		{
			
			$data['tajuk_projek']= $this->input->post('tajuk_projek');		
			$this->session->set_userdata('sess_tajuk_projek',$data['tajuk_projek']);
			
			$data['status']= $this->input->post('status');		
			$this->session->set_userdata('sess_status',$data['status']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
		} else {
				
				$data['tajuk_projek'] = $this->session->userdata('sess_tajuk_projek');
				$data['status'] = $this->session->userdata('sess_status');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				
		}
		
			
		$this->db->select('*');
		$this->db->from('projek');
		$this->db->where('id_ketua_organisasi',$id);
		
		
		
		
		if(!empty($data['tajuk_projek'])){
			$this->db->where('tajuk_projek',$data['tajuk_projek']);
		}
		if(!empty($data['status'])){
			$this->db->where('status',$data['status']);
		}
		if(!empty($data['tahun'])){
			$this->db->where('tahun',$data['tahun']);
		}
		$data['list2'] = $this->db->get('');
		
		$query = $this->db->query("SELECT * FROM user where id_user = '$id_user'");					

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
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_pengguna1',$data);
		$this->session->set_userdata($data);
		
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
			//redirect('main/login','refresh');

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
			//redirect('main/login','refresh');
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
		
		//$id = $this->session->userdata('sess_id');
		$id_user = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		'nama_penuh' => $this->input->post('nama_penuh'),
		'jawatan' => $this->input->post('jawatan'),		
		'gred' => $this->input->post('gred'),
		'email' => $this->input->post('email'),
		'no_tel_bimbit' => $this->input->post('no_tel_bimbit'),
		'no_tel' => $this->input->post('no_tel'),
		
		);
		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini Sila isi maklumat Ketua Organisasi'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id_user,$data,'id_user');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/ketua_organisasi','refresh');
	}
	
	
	
		function edit_pengguna_proses2()
	{
		
		//$id = $this->session->userdata('sess_id');
		$id_user = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		'nama_penuh' => $this->input->post('nama_penuh'),
		'jawatan' => $this->input->post('jawatan'),		
		'gred' => $this->input->post('gred'),
		'email' => $this->input->post('email'),
		'no_tel_bimbit' => $this->input->post('no_tel_bimbit'),
		'no_tel' => $this->input->post('no_tel'),
		'level' => $this->input->post('level'),
		'id_jabatan' => $this->input->post('jabatan'),
		);
		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id_user,$data,'id_user');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengguna','refresh');
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
				$data['no_tel_bimbit'] = $row->no_tel_bimbit;
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
	
	
	function add_kemaskini_pengguna($id_user)
	{
		
			
		$data['act'] = "add";
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
		
	$id_user = $this->session->userdata('sess_id');
		
		
			$query = $this->db->query("SELECT * FROM user where id_user = '$id_user'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				
				
				
				//$data['level'] = $row->level;
				 $data['id_ketua_organisasi'] = $row->id_ketua_organisasi;
			    
				//$data['id_ketua_organisasi'] = $row->id_ketua_organisasi;
				//$data['negeri'] = $row->negeri;
				
			}
			
			
		$id_ketua_organisasi = $data['id_ketua_organisasi'];
		
		
			$query2 = $this->db->query("SELECT * FROM user where id_user = '$id_ketua_organisasi'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				$data['no_tel'] = $row->no_tel;			
				 $data['no_tel_bimbit'] = $row->no_tel_bimbit;
				 $data['jawatan'] = $row->jawatan;
				 $data['gred'] = $row->gred;
				 $data['email'] = $row->email;
				 $data['nama_penuh'] = $row->nama_penuh;
			    $data['id_user'] = $row->id_user;
				//$data['id_ketua_organisasi'] = $row->id_ketua_organisasi;
				//$data['negeri'] = $row->negeri;
				
			}
		
		
		
		
		
		
	
		
		
		//$data['act'] = "add";
		
		$this->load->view('ketua_organisasi',$data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	function add_ketua_jabatan()
	
	{	
		
	
		
		
		
		
		
		
		
		
	
		
		
		//$data['act'] = "add";
		
		$this->load->view('add_ketua_jabatan',$data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_ketua_organisasi_email()
	{
		
		$id = $this->session->userdata('sess_id');
		//$password = $this->input->post('kata_laluan');
		$email = $this->input->post('email');

		$this->db->where('email',$email);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat Ketua Organisasi telah wujud sila pilih ketua organisasi');
			redirect('main/daftar_projek','refresh');

		}else{

			
			//echo $password;
			$data = array(			
					
						'nama_penuh' => $this->input->post('nama_penuh'),
						'jawatan' => $this->input->post('jawatan'),
						'gred' => $this->input->post('gred'),
						'email' => $this->input->post('email'),
						'no_tel' => $this->input->post('no_tel'),
						'level' => '1',
						'id_ketua_organisasi' => $this->session->userdata('sess_id'),
						'kata_laluan' => '202cb962ac59075b964b07152d234b70',				
					
					);		
			//insert ke table user
			$this->db->insert('user', $data);	
			
			//$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya dikemaskini.Sila daftar maklumat projek'); 
			
			//==========Part email
			
			$query2 = $this->db->query("SELECT max(id_user) as last_id FROM user");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
			    $last_id = $row->last_id;
				
					
			}	
			
			$query3 = $this->db->query("SELECT * FROM user where id_user = '$last_id'");					

			if ($query3->num_rows() > 0)
			{
				$row = $query3->row(); 
				//umpukan variable  ke //field dari table
			    $nama_penuh = $row->nama_penuh;
				$jawatan = $row->jawatan;
				$kata_laluan = $row->kata_laluan;
				$email = $row->email;	
			}
			

		//email untuk $to_pemohon = ke Ketua Organisasi.
		
                                                $to_pemohon = $this->model_pengguna->get_email_ketua_organisasi($last_id);
                                                $config = Array(
                                                  'protocol' => 'smtp',
                                                  'smtp_host' => 'smtp.moha.gov.my',
                                                  'smtp_port' => 25,
                                                  'smtp_user' => 'myfile@moha.gov.my',
                                                  'smtp_pass' => '',
							 'mailtype' => 'html',
							 'charset' => 'utf-8',
												
                                                
                                                );

							//echo $to_pemohon;

                                                $this->load->library('email', $config);
                                        
                                                //untuk update katalaluan ke email
                                                
                                                $this->email->set_newline("\r\n");
        
                                                $this->email->from('urusetia_inovasi@moha.gov.my', 'Inovasi');
                                                $this->email->to($to_pemohon);
                                                
                                                $this->email->subject('Makluman');
                                                $data = "TERIMA KASIH. EMAIL ANDA TELAH DIDAFTARKAN UNTUK SISTEM HAB INOVASI"."<br>";
                                                
                                                //panggil variable dalam session yang telah di declare dalam controller Pengguna
                                               //$sess_nama = $this->session->userdata('sess_nama');
                                               //$sess_no_ic = $this->session->userdata('sess_no_ic');
											   //$sess_id_bahagian = $this->session->userdata('sess_id_bahagian');
                                                
                                                $data .= "Nama Pengguna:".$nama_penuh."<br>";
                                                $data .= "Jawatan:".$jawatan."<br>";
												$data .= "kata_laluan : ".$kata_laluan."<br>";
												//$data .= "Tajuk Fail : ".$tajuk_fail_mohon."<br>";
                                                //$data .= "Pegawai Pelulus : ".get_nama_pegawai_pelulus($sess_id_bahagian);
                                                
                                                $this->email->message($data);
                                                $this->email->set_mailtype("html");
                                                
                                                if (!$this->email->send())//email tdk dpt dihantar
                                                {
                                                        //show_error($this->email->print_debugger());
                                                        $this->session->set_flashdata('flash_error_email','Ralat,email tidak berjaya dihantar !');
                                                        //redirect('main/senarai_permohonan','refresh');  
								redirect('main/daftar_projek','refresh');      
                                                }else
                                                {
                                                        $this->session->set_flashdata('flash_success_email','Your e-mail has been sent!');
                                                  
                                                        ///redirect('main/senarai_permohonan','refresh');        
                                                        redirect('main/daftar_projek','refresh');
                                                }        
                                                
                                        




			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/daftar_projek','refresh');
			//$this->output->enable_profiler(TRUE);
			
		}	
		
	}


	
	
	function add_ketua_organisasi()
	{
		
		$id = $this->session->userdata('sess_id');
		//$password = $this->input->post('kata_laluan');
		$email = $this->input->post('email');

		$this->db->where('email',$email);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat Ketua Organisasi telah wujud sila pilih ketua organisasi');
			redirect('main/daftar_projek','refresh');

		}else{

			$email = $this->input->post('email');
			//echo $password;
			$data = array(			
					
						'nama_penuh' => $this->input->post('nama_penuh'),
						'jawatan' => $this->input->post('jawatan'),
						'gred' => $this->input->post('gred'),
						'email' => $email,
						'no_tel' => $this->input->post('no_tel'),
						'level' => '1',
						'id_ketua_organisasi' => $this->session->userdata('sess_id'),
						'kata_laluan' => '202cb962ac59075b964b07152d234b70',
						'date_range' => $today,						
					
					);		
			//insert ke table user
			$this->db->insert('user', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya dikemaskini.Sila daftar maklumat projek'); 
			$this->load->library('email');
			$config = Array(
						  'protocol' => 'smtp',
						  'smtp_host' => 'smtp.moha.gov.my',
						  'smtp_port' => '25',
						  'smtp_user' => 'urusetia_inovasi@moha.gov.my',
						  'smtp_pass' => 'Pass123*',
						  'smtp_timeout' => '30',
						  'mailtype' => 'html',
						  'charset' => 'UTF-8',
						  'validate' => FALSE,
						  'priority' => 3,
						  'newline' => '\r\n',
						  'send_multipart' => FALSE,
						  'wordwrap' => TRUE
													  
						//'smtp_user' => 'urusetia_inovasi@moha.gov.my',
						 // 'smtp_pass' => 'Pass123*',
						);

						//$this->load->library('email', $config);
					
						//untuk update katalaluan ke email
						
						//$this->email->set_newline("\r\n");
						$this->email->initialize($config);

						$this->email->from('urusetia_inovasi@moha.gov.my', 'Sistem Hab Inovasi KDN');
						$this->email->to($email);
						
						$this->email->subject(' Pendaftaran Ketua Organisasi');
						
						
						
						$data .= "Untuk makluman, Anda telah didaftarkan didalam sistem Hab Inovasi KDN sebagai Pegawai Pengesah Projek"."<br>";
						$data .= "Mohon pihak tuan/puan untuk login menggunakan id user email ini "."<br>";
						$data .= "Link Sistem : http://inovasi.moha.gov.my "."<br>";
						$data .= "Id Pengguna : ".$email."<br>";
						$data .= "Katalaluan sementara anda ialah : 123"."<br>";
						
						
						//$data .= "No Ic : ".$no_kp."<br>";
						//$data .= "Tarikh Peminjaman : ".$tarikh_peminjaman."<br>";
						//$data .= "Tarikh Pemulangan : ".$tarikh_jangka_pulang."<br>";
						//$data .= "Sekian Terima kasih."."<br>";
						
						$this->email->message($data);
						$this->email->set_mailtype("html");
						
						if (!$this->email->send())//email tdk dpt dihantar
						{
							show_error($this->email->print_debugger());
							$this->session->set_flashdata('flash_error_email','Ralat,email tidak berjaya dihantar !');
							//echo "ERROR";
						}else
						{
							$this->session->set_flashdata('flash_success_email','Your e-mail has been sent!');
							//echo "SUCCESS";
						}	
						
						
			//lepas simpan data terus ke page senarai
			redirect('main/daftar_projek','refresh');
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
							
				
				
				
				//$data['level'] = $row->level;
			
			    $data['id_user'] = $row->id_user;
				//$data['id_ketua_organisasi'] = $row->id_ketua_organisasi;
				//$data['negeri'] = $row->negeri;
				
			}
			
		$data['act'] = "add";
		$data['list_negeri']=$this->db->get('adm_negeri');
		$data['ketua_organisasi']=$this->db->query("SELECT * from user where level =1");
		$this->load->view('daftar_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
		
	}
	
	function edit_daftar_projek($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['tajuk_projek'] = $row->tajuk_projek;
				$data['bidang'] = $row->bidang;
				$data['kategori'] = $row->kategori;
				$data['pertandingan'] = $row->pertandingan;
				$data['nama_kumpulan'] = $row->nama_kumpulan;
				$data['cawangan'] = $row->cawangan;
				$data['jabatan'] = $row->jabatan;
				$data['negeri'] = $row->negeri;
				$data['alamat1'] = $row->alamat1;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['id_projek'] = $row->id_projek;
				$data['id_user'] = $row->id_ketua_organisasi;
				$data['poskod'] = $row->poskod;
				
			}
			
		$data['act'] = "edit";
		$data['list_negeri']=$this->db->get('adm_negeri');
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$data['ketua_organisasi']=$this->db->query("SELECT * from user where level =1");
		$this->load->view('daftar_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
		
	}
	
	function daftar_projek_proses()
	{
		
		$id_user = $this->session->userdata('sess_id');

		$year = date('Y');	
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
						'poskod' => $this->input->post('poskod'),
						'id_ketua_projek' => $this->input->post('key'),
						'id_ketua_organisasi' => $this->input->post('id_ketua_organisasi'),
						'status' => 1,
						'tahun' => $year,
										
					
					);		
			//insert ke table user
			$this->db->insert('projek', $data);	
			
			
			
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya didaftar.Sila tambah ahli pasukan'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/add_ahli_pasukan','refresh');
			//$this->output->enable_profiler(TRUE);
			
		}


	function edit_projek_proses()
	
	{	
		
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'tajuk_projek' => $this->input->post('tajuk_projek'),
						'bidang' => $this->input->post('bidang'),
						'pertandingan' => $this->input->post('pertandingan'),
						'kategori' => $this->input->post('kategori'),
						'nama_kumpulan' => $this->input->post('nama_kumpulan'),
						'negeri' => $this->input->post('negeri'),
						'cawangan' => $this->input->post('cawangan'),
						'jabatan' => $this->input->post('jabatan'),
						'poskod' => $this->input->post('poskod'),
						'alamat1' => $this->input->post('alamat1'),
						'alamat2' => $this->input->post('alamat2'),
						'alamat3' => $this->input->post('alamat3'),
						'id_projek' => $this->input->post('key'),
						'id_ketua_organisasi' => $this->input->post('id_ketua_organisasi'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('projek',$id_projek,$data,'id_projek');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/utama','refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}



		
		function ahli_pasukan($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['tajuk_projek'] = $row->tajuk_projek;
			
				
			}
			
		$this->db->select('*');
		$this->db->from('ahli_pasukan');
		$this->db->where('id_ketua_projek',$id);
		$this->db->where('id_projek',$id_projek);
		$data['list'] = $this->db->get('');
		
		$data['act'] = "add";
		//$data['list_negeri']=$this->db->get('adm_negeri');
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('ahli_pasukan',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
		
	}
	
	function add_ahli_pasukan()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
			
				
			}
		$this->db->select('*');
		$this->db->from('projek');
		$this->db->where('id_ketua_projek',$id);
		$this->db->order_by('id_projek','DESC');
		
		$data['list'] = $this->db->get('');
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_ahli_pasukan',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function ahli_pasukan_proses()
	{
		
		$id_projek = $this->input->post('id_projek');
		$today = date('Y-m-d');
			
			//echo $password;
			$data = array(			
					
						'nama_ahli' => $this->input->post('nama_ahli'),
						'no_tel' => $this->input->post('no_tel'),
						'jawatan' => $this->input->post('jawatan'),
						'no_tel_bimbit' => $this->input->post('no_tel_bimbit'),
						'gred' => $this->input->post('gred'),
						'email' => $this->input->post('email'),
						'level' => '3',
						'id_ketua_projek' => $this->input->post('key'),
						'id_projek' => $this->input->post('id_projek'),
						
						'cipta_pada' => $today
					
					);		
			//insert ke table user
			$this->db->insert('ahli_pasukan', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat ahli pasukan berjaya dikemaskini.Jika selesai ,sila kemaskini laporan projek'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect ('main/ahli_pasukan/'.$id_projek,'refresh');
			
			
			//$this->output->enable_profiler(TRUE);
			
		}
		
		
		function del_ahli_pasukan($id,$id_projek)
	{
		//$id_projek = $this->input->post('id_projek');
		
		$this->db->where('id_ahli_pasukan', $id);
		$this->db->delete('ahli_pasukan');
		//echo $id_projek;
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat ahli pasukan berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		//redirect ('main/add_ahli_pasukan','refresh');
		redirect('main/ahli_pasukan/'.$id_projek,'refresh');	
		//redirect ('main/ahli_pasukan/'.$id_projek,'refresh');		
	}
	
		function del_projek($id)
	{
		$id_projek = $this->input->post('id_projek');
		
		
		$this->db->where('id_projek', $id);
		$this->db->delete('projek');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat projek berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect ('main/utama','refresh');
		//redirect ('main/ahli_pasukan/'.$id_projek,'refresh');		
	}
	
	function view_projek($id_projek )
	{
		$id = $this->session->userdata('sess_id');
	      $data['key'] = $id_projek ; 
		
		//dapatkan maklumat by id_projek
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['ringkasan'] = $row->ringkasan;
				$data['n1'] = $row->n1;
				$data['n2'] = $row->n2;
				$data['n3'] = $row->n3;
				$data['n4'] = $row->n4;
				$data['n5'] = $row->n5;
				$data['n6'] = $row->n6;
				$data['n7'] = $row->n7;
				$data['n8'] = $row->n8;
				$data['n9'] = $row->n9;
				$data['n10'] = $row->n10;
				$data['n11'] = $row->n11;
				$data['n12'] = $row->n12;
				$data['n13'] = $row->n13;
				$data['n14'] = $row->n14;
				$data['n15'] = $row->n15;
				$data['n16'] = $row->n16;
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			$id = $this->session->userdata('sess_id');
		$level = $this->session->userdata('sess_level');
		
		//maklumat ketua projek
		$query2 = $this->db->query("SELECT * FROM projek left join user on projek.id_ketua_projek = user.id_user where projek.id_projek = '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				
				$data['tajuk_projek'] = $row->tajuk_projek;
				$data['id_projek'] = $row->id_projek;
				$data['bidang'] = $row->bidang;
				$data['kategori'] = $row->kategori;
				$data['pertandingan'] = $row->pertandingan;
				$data['nama_kumpulan'] = $row->nama_kumpulan;
				$data['cawangan'] = $row->cawangan;
				$data['jabatan'] = $row->jabatan;
				$data['nama_ketua_projek'] = $row->nama_penuh;
				$data['negeri'] = $row->negeri;
				$data['alamat1'] = $row->alamat1;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['status'] = $row->status;
				$data['level'] = $level;
				
				
			}
			
			
			//maklumat ketua organisasi
				$query3 = $this->db->query("SELECT * FROM user join projek on projek.id_ketua_organisasi = user.id_user 
		where projek.id_projek = '$id_projek'");					

			if ($query3->num_rows() > 0)
			{
				$row = $query3->row(); 
				//umpukan variable  ke //field dari table
							
				$data['nama_ketua_organisasi'] = $row->nama_penuh;
				
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			
		$this->db->select('*');
		$this->db->from('ahli_pasukan');
		$this->db->where('id_projek',$id_projek);	
		$data['list'] = $this->db->get('');	
			
			
			
			
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('view_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function senarai_projek()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
			
		$this->db->select('*');
		$this->db->from('projek');
		$this->db->where('id_ketua_projek',$id);	
		$this->db->order_by('id_projek','DESC');
		$data['list'] = $this->db->get('');	
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('senarai_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	
	function add_ringkasan($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
				
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_ringkasan',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_ringkasan($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['ringkasan'] = $row->ringkasan;
				
				
				
			}
			
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_ringkasan',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_ringkasan_proses()
	
	{	
	
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'ringkasan' => $this->input->post('ringkasan'),
						
						
						'id_projek' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		redirect ('main/edit_ringkasan/'.$id_projek,'refresh');
		//redirect('main/edit_n10/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_ringkasan_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'ringkasan' => $this->input->post('ringkasan'),
					
						
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	
	
	function laporan_inovasi($id_projek )
	
	{	
		$id = $this->session->userdata('sess_id');
	      $data['key'] = $id_projek ; 
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['ringkasan'] = $row->ringkasan;
				$data['n1'] = $row->n1;
				$data['n2'] = $row->n2;
				$data['n3'] = $row->n3;
				$data['n4'] = $row->n4;
				$data['n5'] = $row->n5;
				$data['n6'] = $row->n6;
				$data['n7'] = $row->n7;
				$data['n8'] = $row->n8;
				$data['n9'] = $row->n9;
				$data['n10'] = $row->n10;
				$data['n11'] = $row->n11;
				$data['n12'] = $row->n12;
				$data['n13'] = $row->n13;
				$data['n14'] = $row->n14;
				$data['n15'] = $row->n15;
				$data['n16'] = $row->n16;
				$data['id_ketua_projek'] = $row->id_ketua_projek;
				$data['image1_n1'] = $row->image1_n1;
				$data['image2_n1'] = $row->image2_n1;
				$data['image1_n2'] = $row->image1_n2;
				$data['image2_n2'] = $row->image2_n2;
				$data['image1_n3'] = $row->image1_n3;
				$data['image2_n3'] = $row->image2_n3;
				$data['image1_n4'] = $row->image1_n4;
				$data['image2_n4'] = $row->image2_n4;
				$data['image1_n5'] = $row->image1_n5;
				$data['image2_n5'] = $row->image2_n5;
				$data['image1_n6'] = $row->image1_n6;
				$data['image2_n6'] = $row->image2_n6;
				$data['image1_n7'] = $row->image1_n7;
				$data['image2_n7'] = $row->image2_n7;
				$data['image1_n8'] = $row->image1_n8;
				$data['image2_n8'] = $row->image2_n8;
				$data['image1_n9'] = $row->image1_n9;
				$data['image2_n9'] = $row->image2_n9;
				$data['image1_n10'] = $row->image1_n10;
				$data['image2_n10'] = $row->image2_n10;
				$data['image1_n11'] = $row->image1_n11;
				$data['image2_n11'] = $row->image2_n11;
				$data['image1_n12'] = $row->image1_n12;
				$data['image2_n12'] = $row->image2_n12;
				$data['image1_n13'] = $row->image1_n13;
				$data['image2_n13'] = $row->image2_n13;
				$data['image1_n14'] = $row->image1_n14;
				$data['image2_n14'] = $row->image2_n14;
				$data['image1_n15'] = $row->image1_n15;
				$data['image2_n15'] = $row->image2_n15;
				$data['image1_n16'] = $row->image1_n16;
				$data['image2_n16'] = $row->image2_n16;
				$data['status'] = $row->status;
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			
			
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek = '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['markah_n1'] = $row->markah_n1;
				$data['markah_n2'] = $row->markah_n2;
				$data['markah_n3'] = $row->markah_n3;
				$data['markah_n4'] = $row->markah_n4;
				$data['markah_n5'] = $row->markah_n5;
				$data['markah_n6'] = $row->markah_n6;
				$data['markah_n7'] = $row->markah_n7;
				$data['markah_n8'] = $row->markah_n8;
				$data['markah_n9'] = $row->markah_n9;
				$data['markah_n10'] = $row->markah_n10;
				$data['markah_n11'] = $row->markah_n11;
				$data['markah_n12'] = $row->markah_n12;
				$data['markah_n13'] = $row->markah_n13;
				$data['markah_n14'] = $row->markah_n14;
				$data['markah_n15'] = $row->markah_n15;
				$data['markah_n16'] = $row->markah_n16;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			
			
				$query3 = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query3->num_rows() > 0)
			{
				$row = $query3->row(); 
				//umpukan variable  ke //field dari table
							
				$data['tajuk_projek'] = $row->tajuk_projek;
				
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
		
		
			
		//$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('laporan_inovasi',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function ringkasan_projek($id_projek )
	
	{	
		$id = $this->session->userdata('sess_id');
	      $data['key'] = $id_projek ; 
		
		//dapatkan maklumat by id_projek
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['ringkasan'] = $row->ringkasan;
				$data['n1'] = $row->n1;
				$data['n2'] = $row->n2;
				$data['n3'] = $row->n3;
				$data['n4'] = $row->n4;
				$data['n5'] = $row->n5;
				$data['n6'] = $row->n6;
				$data['n7'] = $row->n7;
				$data['n8'] = $row->n8;
				$data['n9'] = $row->n9;
				$data['n10'] = $row->n10;
				$data['n11'] = $row->n11;
				$data['n12'] = $row->n12;
				$data['n13'] = $row->n13;
				$data['n14'] = $row->n14;
				$data['n15'] = $row->n15;
				$data['n16'] = $row->n16;
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
		$id = $this->session->userdata('sess_id');
		$level = $this->session->userdata('sess_level');
		
		//maklumat ketua projek
		$query2 = $this->db->query("SELECT * FROM projek left join user on projek.id_ketua_projek = user.id_user where projek.id_projek = '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				
				$data['tajuk_projek'] = $row->tajuk_projek;
				$data['id_projek'] = $row->id_projek;
				$data['bidang'] = $row->bidang;
				$data['kategori'] = $row->kategori;
				$data['pertandingan'] = $row->pertandingan;
				$data['nama_kumpulan'] = $row->nama_kumpulan;
				$data['cawangan'] = $row->cawangan;
				$data['jabatan'] = $row->jabatan;
				$data['nama_ketua_projek'] = $row->nama_penuh;
				$data['negeri'] = $row->negeri;
				$data['alamat1'] = $row->alamat1;
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['status'] = $row->status;
				$data['level'] = $level;
				$data['email_ketua_projek'] = $row->email;
				$data['no_tel_ketua_projek'] = $row->no_tel;
				
				
			}
			
			
			//maklumat ketua organisasi
				$query3 = $this->db->query("SELECT * FROM user join projek on projek.id_ketua_organisasi = user.id_user 
		where projek.id_projek = '$id_projek'");					

			if ($query3->num_rows() > 0)
			{
				$row = $query3->row(); 
				//umpukan variable  ke //field dari table
							
				$data['nama_ketua_organisasi'] = $row->nama_penuh;
				$data['email_ketua_organisasi'] = $row->email;
				$data['no_tel_ketua_organisasi'] = $row->no_tel;
				
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			
		$this->db->select('*');
		$this->db->from('ahli_pasukan');
		$this->db->where('id_projek',$id_projek);	
		$data['list'] = $this->db->get('');	
			
			
			
			
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('ringkasan_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}	
	
	function muatturun_lampiran($id_projek )
	
	{	
		//$id = $this->session->userdata('sess_id');
	      //$data['key'] = $id_projek ; 
		
		//dapatkan maklumat by id_projek
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				//$data['ringkasan'] = $row->ringkasan;
				$data['image1_n1'] = $row->image1_n1;
				$data['image1_n2'] = $row->image1_n2;
				$data['image1_n3'] = $row->image1_n3;
				$data['image1_n4'] = $row->image1_n4;
				$data['image1_n5'] = $row->image1_n5;
				$data['image1_n6'] = $row->image1_n6;
				$data['image1_n7'] = $row->image1_n7;
				$data['image1_n8'] = $row->image1_n8;
				$data['image1_n9'] = $row->image1_n9;
				$data['image1_n10'] = $row->image1_n10;
				$data['image1_n11'] = $row->image1_n11;
				$data['image1_n12'] = $row->image1_n12;
				$data['image1_n13'] = $row->image1_n13;
				$data['image1_n14'] = $row->image1_n14;
				$data['image1_n15'] = $row->image1_n15;
				$data['image1_n16'] = $row->image1_n16;
				
				
				//$data['catatan'] = $row->catatan;
				
			
			    //$data['id_user'] = $row->id_user;
				//$data['negeri'] = $row->negeri;
				
			}
			
		
		
			
		//$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('muatturun_lampiran',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}	
	
	
	function kemaskini_semula_laporan($id_projek)
	
	{	
		
		
		//define data from form for insert table
		$data = array(			
					
						'status' => 1,
						
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', ' Maklumat telah dihantar semula kepada Ketua Projek'); 
		//user = nama table
		$this->model_pengguna->update_data('projek',$id_projek,$data,'id_projek');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/utama','refresh');
				
				
			
			
		
			
		
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	function edit_laporan_status()
	
	{	
		
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'status' => 2,
						
						'id_projek' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('projek',$id_projek,$data,'id_projek');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/utama','refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	
	function pengesahan_status($id_projek)
	
	{	
		
		
		//define data from form for insert table
		$data = array(			
					
						'status' => 3,
						
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di sahkan'); 
		//user = nama table
		$this->model_pengguna->update_data('projek',$id_projek,$data,'id_projek');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/utama','refresh');
				
				
			
			
		
			
		
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	function edit_tidak_lulus($id_projek)
	
	{	
		
		
		//define data from form for insert table
		$data = array(			
					
						'status' => 7,
						
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Maklumat berjaya di simpan'); 
		//user = nama table
		$this->model_pengguna->update_data('projek',$id_projek,$data,'id_projek');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/utama','refresh');
				
				
			
			
		
			
		
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	function simpan_markah($id_markah_inovasi)
	
	{	
		$id_projek = $this->input->post('key');
		$peratus = $this->input->post('peratus');
		
		//echo $id_markah_inovasi;
		
		//define data from form for insert table
		$data = array(			
					
						//'status' => 4,
						'markah_peratus' => $peratus,
						
						
						
										
					
					);		
					
					
			$data2 = array(			
					
						'status' => 4,
						
						
						
						
										
					
					);		
		
		

		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di sahkan'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
		$this->model_pengguna->update_data('projek',$id_projek,$data2,'id_projek');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/utama','refresh');
				
				
			
			
		
			
		
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	
	
	
//===========================================================================================================================	
	
	
	function add_n1($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		$data['id_projek'] = $id_projek;
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
				
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n1',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n1($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		$data['id_projek'] = $id_projek;
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n1'] = $row->n1;
				$data['image1_n1'] = $row->image1_n1;
				$data['image2_n1'] = $row->image2_n1;
				$data['markah_n1'] = $row->markah_n1;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n1'] = $row->markah_n1;
				
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n1',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n1_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n1' => $this->input->post('n1'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n1/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n1_proses()
	
	{  


			          
        $id_projek = $this->input->post('key');
    
    
        //Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
                //$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                    //$picture2= $uploadData['file_name2'];
                    
                    $data = array (        
        
                        
                        'id_projek' => $this->input->post('key'),
                        'image1_n1' => $picture,
                        //'image2_n1' => $picture2,
                        
                        
                        //'n2' => $this->input->post('n2'),
                        );
        
        
        
                }else{
                    $data = array (        
        
                        
                        'id_projek' => $this->input->post('key'),
                        'image1_n1' => $picture,
                        
       
                        );
						
        
                }
            }else{
                    $data = array (        
        
                    'image1_n1' => $picture,
                    'id_projek' => $this->input->post('key'),
                    
                    

                    );
        
            }
            
            
            
      
        //define data from form for insert table
        
        //echo $error = $this->upload->display_errors();
        
        $this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini');
        //user = nama table
        $this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
        
        
        
        //redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n1/'.$id_projek,'refresh');
                
                
            
            
        
            
        //$data['act'] = "edit";
        //$data['list_jabatan']=$this->db->get('adm_jabatan');
        //$this->load->view('add_kriteria',$data);
        $this->session->set_userdata($data);
        
        //$this->output->enable_profiler(TRUE);    
    }
	
		function edit_markah_n1_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n1' => $this->input->post('markah_n1'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n1_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n1' => $this->input->post('markah_n1'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n1_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n1' => $this->input->post('n1'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n1/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	
	
	
	
		function add_n2($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
				
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n2',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n2($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n2'] = $row->n2;
				$data['image1_n2'] = $row->image1_n2;
				$data['image2_n2'] = $row->image2_n2;
				$data['markah_n2'] = $row->markah_n2;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n2'] = $row->markah_n2;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n2',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n2_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n2' => $this->input->post('n2'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n2/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n2_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n2' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n2' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n2' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n2/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n2_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n2' => $this->input->post('markah_n2'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n2_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n2' => $this->input->post('markah_n2'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n2_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n2' => $this->input->post('n2'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n2/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	
	
	
		function add_n3($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n3',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n3($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n3'] = $row->n3;
				$data['image1_n3'] = $row->image1_n3;
				$data['image2_n3'] = $row->image2_n3;
				$data['markah_n3'] = $row->markah_n3;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n3'] = $row->markah_n3;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n3',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n3_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n3' => $this->input->post('n3'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect ('main/edit_n3/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n3_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n3' => $picture,
						
						);
		
		
		
                }else{
                   $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n3' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n3' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    redirect('main/edit_n3/'.$id_projek,'refresh');
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n3_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n3' => $this->input->post('markah_n3'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n3_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n3' => $this->input->post('markah_n3'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n3_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n3' => $this->input->post('n3'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n3/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	
	
		function add_n4($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n4',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n4($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n4'] = $row->n4;
				$data['image1_n4'] = $row->image1_n4;
				$data['image2_n4'] = $row->image2_n4;
				$data['markah_n4'] = $row->markah_n4;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n4'] = $row->markah_n4;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n4',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n4_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n4' => $this->input->post('n4'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n4/'.$id_projek,'refresh');		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n4_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n4' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n4' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n4' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
  
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
		redirect('main/edit_n4/'.$id_projek,'refresh');			
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n4_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n4' => $this->input->post('markah_n4'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n4_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n4' => $this->input->post('markah_n4'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n4_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n4' => $this->input->post('n4'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n4/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
		
		
	//========================================================================================================================================
	
	
		function add_n5($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n5',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n5($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n5'] = $row->n5;
				$data['image1_n5'] = $row->image1_n5;
				$data['image2_n5'] = $row->image2_n5;
				$data['markah_n5'] = $row->markah_n5;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n5'] = $row->markah_n5;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n5',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n5_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n5' => $this->input->post('n5'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n5/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n5_proses()
	
	{	
	

		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
//                var_dump($this->upload->do_upload('picture'));die;
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n5' => $picture,
						
						);
		
		
		
                }else{
                  $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n5' => $picture,
						
						);
		
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n5' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n5/'.$id_projek,'refresh');		

		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n5_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n5' => $this->input->post('markah_n5'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n5_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n5' => $this->input->post('markah_n5'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n5_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n5' => $this->input->post('n5'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n5/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	
	
		function add_n6($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n6',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n6($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n6'] = $row->n6;
				$data['image1_n6'] = $row->image1_n6;
				$data['image2_n6'] = $row->image2_n6;
				$data['markah_n6'] = $row->markah_n6;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n6'] = $row->markah_n6;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n6',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n6_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n6' => $this->input->post('n6'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n6/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n6_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n6' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n6' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n6' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n6/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n6_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n6' => $this->input->post('markah_n6'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n6_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n6' => $this->input->post('markah_n6'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n6_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n6' => $this->input->post('n6'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n6/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	

		function add_n7($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n7',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n7($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n7'] = $row->n7;
				$data['image1_n7'] = $row->image1_n7;
				$data['image2_n7'] = $row->image2_n7;
				$data['markah_n7'] = $row->markah_n7;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n7'] = $row->markah_n7;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n7',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n7_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n7' => $this->input->post('n7'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n7/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n7_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n7' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n7' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n7' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n7/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n7_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n7' => $this->input->post('markah_n7'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n7_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n7' => $this->input->post('markah_n7'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n7_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n7' => $this->input->post('n7'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n7/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
//========================================================================================================================================	
		
	
		function add_n8($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n8',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n8($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n8'] = $row->n8;
				$data['image1_n8'] = $row->image1_n8;
				$data['image2_n8'] = $row->image2_n8;
				$data['markah_n8'] = $row->markah_n8;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n8'] = $row->markah_n8;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n8',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n8_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n8' => $this->input->post('n8'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n8/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n8_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n8' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n8' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n8' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n8/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n8_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n8' => $this->input->post('markah_n8'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n8_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n8' => $this->input->post('markah_n8'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n8_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n8' => $this->input->post('n8'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n8/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
		
		//========================================================================================================================================
		
		
	
		function add_n9($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n9',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n9($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n9'] = $row->n9;
				$data['image1_n9'] = $row->image1_n9;
				$data['image2_n9'] = $row->image2_n9;
				$data['markah_n9'] = $row->markah_n9;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n9'] = $row->markah_n9;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n9',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n9_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n9' => $this->input->post('n9'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n9/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n9_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n9' => $picture,
						
						);
		
		
		
                }else{
                   $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n9' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n9' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n9/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n9_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n9' => $this->input->post('markah_n9'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n9_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n9' => $this->input->post('markah_n9'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n9_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n9' => $this->input->post('n9'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n9/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
		
		
		function add_n10($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
				
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n10',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n10($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n10'] = $row->n10;
				$data['image1_n10'] = $row->image1_n10;
				$data['image2_n10'] = $row->image2_n10;
				$data['markah_n10'] = $row->markah_n10;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n10'] = $row->markah_n10;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n10',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n10_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n10' => $this->input->post('n10'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n10/'.$id_projek,'refresh');
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n10_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n10' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n10' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n10' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n10/'.$id_projek,'refresh');		

			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n10_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n10' => $this->input->post('markah_n10'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n10_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n10' => $this->input->post('markah_n10'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n10_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n10' => $this->input->post('n10'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			
			redirect('main/edit_n10/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
		

		function add_n11($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n11',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n11($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n11'] = $row->n11;
				$data['image1_n11'] = $row->image1_n11;
				$data['image2_n11'] = $row->image2_n11;
				$data['markah_n11'] = $row->markah_n11;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n11'] = $row->markah_n11;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n11',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n11_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n11' => $this->input->post('n11'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n11/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n11_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n11' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n11' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n11' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n11/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n11_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n11' => $this->input->post('markah_n11'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n11_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n11' => $this->input->post('markah_n11'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n11_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n11' => $this->input->post('n11'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n11/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	
	
		function add_n12($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n12',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n12($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n12'] = $row->n12;
				$data['image1_n12'] = $row->image1_n12;
				$data['image2_n12'] = $row->image2_n12;
				$data['markah_n12'] = $row->markah_n12;
				$data['status'] = $row->status;
					
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n12'] = $row->markah_n12;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n12',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n12_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n12' => $this->input->post('n12'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n12/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n12_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n12' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n12' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n12' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n12/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
		function edit_markah_n12_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n12' => $this->input->post('markah_n12'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n12_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n12' => $this->input->post('markah_n12'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n12_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n12' => $this->input->post('n12'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n12/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================

		function add_n13($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n13',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n13($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n13'] = $row->n13;
				$data['image1_n13'] = $row->image1_n13;
				$data['image2_n13'] = $row->image2_n13;
				$data['markah_n13'] = $row->markah_n13;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n13'] = $row->markah_n13;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n13',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n13_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n13' => $this->input->post('n13'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n13/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n13_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n13' => $picture,
						
						);
		
		
		
                }else{
                   $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n13' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n13' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n13/'.$id_projek,'refresh');		
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n13_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n13' => $this->input->post('markah_n13'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n13_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n13' => $this->input->post('markah_n13'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n13_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n13' => $this->input->post('n13'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n13/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	

		function add_n14($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n14',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n14($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n14'] = $row->n14;
				$data['image1_n14'] = $row->image1_n14;
				$data['image2_n14'] = $row->image2_n14;
				$data['markah_n14'] = $row->markah_n14;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n14'] = $row->markah_n14;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n14',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n14_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n14' => $this->input->post('n14'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n14/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n14_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n14' => $picture,
						
						);
		
		
		
                }else{
                   $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n14' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n14' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n14/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n14_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n14' => $this->input->post('markah_n14'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n14_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n14' => $this->input->post('markah_n14'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n14_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n14' => $this->input->post('n14'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n14/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	

		function add_n15($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n15',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n15($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n15'] = $row->n15;
				$data['image1_n15'] = $row->image1_n15;
				$data['image2_n15'] = $row->image2_n15;
				$data['markah_n15'] = $row->markah_n15;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n15'] = $row->markah_n15;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n15',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n15_proses()
	
{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n15' => $this->input->post('n15'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n15/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function edit_upload_n15_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n15' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n15' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n15' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		redirect('main/edit_n15/'.$id_projek,'refresh');
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n15_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n15' => $this->input->post('markah_n15'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n15_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n15' => $this->input->post('markah_n15'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n15_proses()
	{
		
		
		$id_projek = $this->input->post('key');
			
			//echo $password;
			$data = array(			
					
						'n15' => $this->input->post('n15'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n15/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	
	
		function add_n16($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM projek where id_projek = '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['status'] = $row->status;
			
				
				
			}
			
		
			
		$data['act'] = "add";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n16',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
		function edit_n16($id_projek)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		$query = $this->db->query("SELECT * FROM maklumat_inovasi join projek on projek.id_projek = maklumat_inovasi.id_projek 
		where projek.id_projek= '$id_projek'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['n16'] = $row->n16;
				$data['image1_n16'] = $row->image1_n16;
				$data['image2_n16'] = $row->image2_n16;
				$data['markah_n16'] = $row->markah_n16;
				$data['status'] = $row->status;
				
				
			}
			
			$query2 = $this->db->query("SELECT * FROM maklumat_inovasi join markah_inovasi on markah_inovasi.id_projek = maklumat_inovasi.id_projek 
		where markah_inovasi.id_projek= '$id_projek'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
							
				$data['id_projek'] = $row->id_projek;
				$data['id_markah_inovasi'] = $row->id_markah_inovasi;
				
				$data['markah_n16'] = $row->markah_n16;
			
				
				
			}
		
		
		
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('add_n16',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_n16_proses()
	
	{	
		$id_projek = $this->input->post('key');
		
		//define data from form for insert table
		$data = array(			
					
						'n16' => $this->input->post('n16'),
						
						'id_projek' => $this->input->post('key'),
						
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n16/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
function edit_upload_n16_proses()
	
	{	
	
	
		//Check whether user upload picture
            if(!empty($_FILES['picture']['name'] ) ){
                $config['upload_path'] = 'uploads/';
				$config['max_size'] = 20000;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|zip|pdf';
                $config['file_name'] = $_FILES['picture']['name'];
				//$config['file_name2'] = $_FILES['picture2']['name2'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture','picture2')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
					//$picture2= $uploadData['file_name2'];
					
					$data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n16' => $picture,
						
						);
		
		
		
                }else{
                    $data = array (		
		
						
						'id_projek' => $this->input->post('key'),
						'image1_n16' => $picture,
						
						);
                }
            }else{
					$data = array (		
		
					
					'id_projek' => $this->input->post('key'),
					
					'image1_n16' => $picture,
					//'n2' => $this->input->post('n2'),
					);
		
            }
			
			
			
				
		$id_projek = $this->input->post('key');
		//define data from form for insert table
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('maklumat_inovasi',$id_projek,$data,'id_projek');
		
		
	    
		//redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
		redirect('main/edit_n16/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_markah_n16_proses()
	
	{	
		$id_projek = $this->input->post('id_projek');
		$id_markah_inovasi = $this->input->post('key');
		//define data from form for insert table
		$data = array(			
					
						'markah_n16' => $this->input->post('markah_n16'),
						
						'id_projek' => $this->input->post('id_projek'),
						'id_markah_inovasi' => $this->input->post('key'),
										
					
					);		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Markah berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('markah_inovasi',$id_markah_inovasi,$data,'id_markah_inovasi');
	    
		redirect ('main/laporan_inovasi/'.$id_projek,'refresh');
				
				
			
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		//$this->load->view('add_kriteria',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function add_markah_n16_proses()
	{
		
		
		$id_projek = $this->input->post('id_projek');
			
			//echo $password;
			$data = array(			
					
						'markah_n16' => $this->input->post('markah_n16'),
					
						
						
						'id_projek' => $this->input->post('id_projek'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('markah_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	function add_n16_proses()
	{
		
		
		$id_projek = $this->input->post('key');

			
			//echo $password;
			$data = array(			
					
						'n16' => $this->input->post('n16'),
						
						'id_projek' => $this->input->post('key'),
					
						
						
						
					
					);		
			//insert ke table user
			$this->db->insert('maklumat_inovasi', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya kemaskini'); 
			
			
			//lepas simpan data terus ke page senarai
			//redirect('main/laporan_inovasi/'.$id_projek,'refresh');
			redirect('main/edit_n16/'.$id_projek,'refresh');
			//$this->output->enable_profiler(TRUE);
			
		}
	
	//========================================================================================================================================
	
	
	function kemaskini_projek()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		$this->db->select('*');
		$this->db->from('projek');
		$data['list'] = $this->db->get('');
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('kemaskini_projek',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	
	
	function senarai_ketua_organisasi()
	
	{	
		//$id = $this->session->userdata('sess_id');
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('level','1');
		
		
		$data['list'] = $this->db->get('');
			
		//$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('senarai_ketua_organisasi',$data);
		//$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function pengguna()
	
	{	
		//$id = $this->session->userdata('sess_id');
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->order_by('id_user','DESC');
		
		$data['list'] = $this->db->get('');
			
		//$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('pengguna',$data);
		//$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	function kemaskini_katalaluan($id_user)
	
	{
		$query = $this->db->query("SELECT * FROM user where id_user='$id_user'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				$data['nama_penuh'] = $row->nama_penuh;
				$data['kata_laluan'] = $row->kata_laluan;
				$data['id_user'] = $row->id_user;
					
			}
			
		$data['act'] = "edit";
		$this->load->view('kemaskini_katalaluan',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	function kemaskini_katalaluan_proses()
	
	{
		$level = $this->session->userdata('sess_level');
		$id_user = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		'kata_laluan' => md5($this->input->post('kata_laluan')),
		'id_user' => $this->input->post('key'),
		
			
		);
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id_user,$data,'id_user');
	    //$this->output->enable_profiler(TRUE);
		

	
		if($level == 4)
		{
			redirect ('main/pengguna','refresh');
		}	
		else if($level == 5)
		{
			redirect ('main/utama2','refresh');
		}
		else
		{
			redirect ('main/utama','refresh');	
		}

		//$this->output->enable_profiler(TRUE);	

	}
	
	function edit_senarai_ketua($id_user)
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		$query = $this->db->query("SELECT * FROM user where id_user= '$id_user'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
							
				
				$data['nama_penuh'] = $row->nama_penuh;
				$data['email'] = $row->email;
				$data['jawatan'] = $row->jawatan;
				$data['gred'] = $row->gred;
				$data['no_tel'] = $row->no_tel;
			    $data['id_user'] = $row->id_user;
				$data['id_ketua_organisasi'] = $row->id_ketua_organisasi;
			
				
				
			}
			
		
			
		$data['act'] = "edit";
		//$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('edit_senarai_ketua',$data);
		$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
		function edit_senarai_ketua_proses()
	{
		
		$id = $this->session->userdata('sess_id');
		//$id_user = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		
		'id_ketua_organisasi' => $this->input->post('key'),
		);
		
		
		
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id,$data,'id_user');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/ketua_organisasi','refresh');
	}
	
	function add_pengguna_proses()
	{
		
		
		//$password = $this->input->post('kata_laluan');
		$email = $this->input->post('email');

		$this->db->where('email',$email);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/pengguna','refresh');

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
						'no_tel_bimbit' => $this->input->post('no_tel_bimbit'),
						'level' => $this->input->post('level'),
						'id_jabatan' => $this->input->post('jabatan'),
						'kata_laluan' => '202cb962ac59075b964b07152d234b70',
						'cipta_pada' => $today,
						'date_range' => $today,
						
						//'nama_penuh' => $this->input->post('nama_penuh'),
						
						//'no_kp' => $this->input->post('no_kp'),					
					
					);		
			
			
			
			$this->db->insert('user', $data);	
			
			$this->session->set_flashdata('flash_success','Tahniah !.Maklumat berjaya didaftar');
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/pengguna','refresh');
		
			$this->output->enable_profiler(TRUE);
			
		}	
		
	}
	
	function laporan_markah()
	
	{	
		$id = $this->session->userdata('sess_id');
		
		
		
		
		if(isset($_POST['submit']))
		{
			
			$data['tajuk_projek']= $this->input->post('tajuk_projek');		
			$this->session->set_userdata('sess_tajuk_projek',$data['tajuk_projek']);
			
			$data['status']= $this->input->post('status');		
			$this->session->set_userdata('sess_status',$data['status']);
			
			$data['jabatan']= $this->input->post('jabatan');		
			$this->session->set_userdata('sess_jabatan',$data['jabatan']);
			
			$data['tahun']= $this->input->post('tahun');		
			$this->session->set_userdata('sess_tahun',$data['tahun']);
			
			
		} else {
				
				$data['tajuk_projek'] = $this->session->userdata('sess_tajuk_projek');
				$data['status'] = $this->session->userdata('sess_status');
				$data['jabatan'] = $this->session->userdata('sess_jabatan');
				$data['tahun'] = $this->session->userdata('sess_tahun');
				
		}
		
			
		$this->db->select('*');
		$this->db->from('projek');
		$this->db->join('markah_inovasi','markah_inovasi.id_projek=projek.id_projek','left');
		$this->db->order_by('markah_peratus','DESC');
						
		//$this->db->where('id_ketua_organisasi',$id);
		
		
		
		
		if(!empty($data['tajuk_projek'])){
			$this->db->where('tajuk_projek',$data['tajuk_projek']);
		}
		if(!empty($data['status'])){
			$this->db->where('status',$data['status']);
		}
		if(!empty($data['jabatan'])){
			$this->db->where('jabatan',$data['jabatan']);
		}
		if(!empty($data['tahun'])){
			$this->db->where('tahun',$data['tahun']);
		}
		$data['list2'] = $this->db->get('');
		
		
		$data['list_jabatan']=$this->db->get('adm_jabatan');
		$this->load->view('laporan_markah',$data);
		//$this->session->set_userdata($data);
		
		//$this->output->enable_profiler(TRUE);	
	}
	
	
	
	
	function logout(){
		
		$this->session->set_flashdata('flash_success','Anda telah log keluar daripada sistem.');
		redirect('main/login'); // sesudah logout di redirect ke halaman utama
		// Destroy all the session
		$this->session->unset_userdata('nama_penuh');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('id');
		$this->session->sess_destroy();
		//insert data ke audit trail
		
		
		
		
	}
	
	
	
}
	

	
	
	

			
			
		
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
