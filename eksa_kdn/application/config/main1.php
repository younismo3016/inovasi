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
		
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		
		$user= $this->model_pengguna->check_user($username,$this->_prep_password($password));
		
		if($user == TRUE){
			
			$this->db->where('id_pengguna', $username);			
			$query =$this->db->get('pengguna');
			
			if ($query->num_rows() == 1) {
				foreach($query->result() as $row) {
					$id_pengguna = $row->id_pengguna;
					$level = $row->level;
					$id = $row->id;
					
				}
			}
			
			
		
			
			$data = array('sess_id_pengguna'=> $id_pengguna,'sess_level'=>$level,'sess_id'=> $id,'logged_in' => TRUE );
			
			$this->session->set_userdata($data);	
			if($level==2){			
				redirect('main/pemohon','refresh');
			}else{
				redirect('main/utama','refresh');
			}
			//$this->output->enable_data_lamaer(TRUE);
			
		}else{
			$this->session->set_flashdata('flash_error', 'Id Pengguna dan Katalaluan tidak sah.'); 
				
	        redirect('main/login','refresh');
			
		}
		
				
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
		
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['nama_ptj'])){
			$this->db->where('nama_ptj',$data['nama_ptj']);
			
			
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
		
		
		$data['list'] = $this->model_pengguna->surat_peringatan($data['kod_ptj'],$data['bulan_kkwt'],$data['tahun_terima']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('surat_peringatan',$data);
		//$this->output->enable_profiler(TRUE);
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
			
			
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				
				
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['bulan_kkwt'])){
			$this->db->where('bulan_kkwt',$data['bulan_kkwt']);
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
		$data['list'] = $this->model_pengguna->semakan($pagination['per_page'],$this->uri->segment(4,0),$data['kod_ptj'],$data['bulan_kkwt']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('semakan',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function mukadepan()
	{
		
		$data['act'] = "add";
		$this->load->view('mukadepan');
	}
	
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
		'tarikh_terima' => $this->input->post('tarikh_terima'),
		'tahun_terima' => $this->input->post('tahun_terima'),
		'id_ptj' => $this->input->post('id_ptj'),
		);

		
		//user = nama table
		$this->db->insert('penerimaan',$data);
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/penerimaan','refresh');
	
		
	}
		function surat_peringatan_todo($id)
	{
	
		
		$query = $this->db->query("SELECT * FROM penerimaan where id='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['sp1'] = $row->sp1;
				$data['sp2'] = $row->sp2;
				$data['id'] = $row->id;
					
			}
		$data['act'] = "add";
		$this->load->view('surat_peringatan_todo',$data);
		//$this->output->enable_profiler(TRUE);
		
	}
		function semakan_todo($id)
	{
		
		
		$query = $this->db->query("SELECT * FROM penerimaan where id_penerimaan='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['tarikh_terima'] = $row->tarikh_terima;
				$data['id_penerimaan'] = $row->id_penerimaan;
				$data['bil_resit'] = $row->bil_resit;
				$data['jumlah_hasil'] = $row->jumlah_hasil;
				$data['tarikh_semak'] = $row->tarikh_semak;
				$data['tarikh_siap_semak'] = $row->tarikh_siap_semak;
	
			}

		$data['act'] = "add";
		$this->load->view('semakan_todo',$data);
		//$this->output->enable_profiler(TRUE);
		
	}
	function surat_peringatan_proses(){
	
	$id = $this->input->post('id');
		//define data from form for insert table
		$data = array (		
		
		'sp1' => $this->input->post('sp1'),
		
		
		);

		
		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/surat_peringatan','refresh');
	
		
	}
	function semakan_proses(){
	
	$id = $this->input->post('id_penerimaan');
		//define data from form for insert table
		$data = array (		
		
		'tarikh_semak' => $this->input->post('tarikh_semak'),
		'bil_resit' => $this->input->post('bil_resit'),
		'jumlah_hasil' => $this->input->post('jumlah_hasil'),
		'tarikh_siap_semak' => $this->input->post('tarikh_siap_semak'),
		
		);

		
		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id_penerimaan');
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya disimpan dan disemak'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/semakan','refresh');
	
		
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
		
		$this->db->select('*');			
		$this->db->from('ptj');
		
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['nama_ptj'])){
			$this->db->where('nama_ptj',$data['nama_ptj']);
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_ptj/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
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
			
			$data['jawatan']= $this->input->post('jawatan');		
			$this->session->set_userdata('sess_jawatan',$data['jawatan']);
			
			
			
			
		} else {
				$data['nama'] = $this->session->userdata('sess_nama');
				$data['jawatan'] = $this->session->userdata('sess_jawatan');
				
				
		}
		
		$this->db->select('*');			
		$this->db->from('user');
		
		if(!empty($data['nama'])){
			$this->db->where('nama',$data['nama']);
		}
		if(!empty($data['jawatan'])){
			$this->db->where('jawatan',$data['jawatan']);
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pengemaskinian_pengguna/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pengemaskinian_pengguna($pagination['per_page'],$this->uri->segment(4,0),$data['nama'],$data['jawatan']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('pengemaskinian_pengguna',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	

	function edit_jenis_peralatan($id)
	{
		
		$query = $this->db->query("SELECT * FROM jenis_peralatan where id='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
								
				$data['jenis_peralatan'] = $row->jenis_peralatan;	
				$data['id'] = $row->id;	
				
					
			}
		
		$data['act'] = "edit";
		$this->load->view('add_jenis_peralatan',$data);
		//$this->output->enable_data_lamaer(TRUE);		
	}
	
	function edit_jenis_peralatan_process(){
		
		
		$key = $this->input->post('key');
		$data = array(			
				
						
						'jenis_peralatan' => $this->input->post('jenis'),
											
						
				);	
		//update table			
		$this->model_pengguna->update_data('jenis_peralatan',$key,$data,'id');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/jenis_peralatan','refresh');
				
	}
	
	function peralatan()
	{	
		$this->db->select('peralatan.id_peralatan as id_peralatan,peralatan.peralatan as peralatan,jenis_peralatan.jenis_peralatan as jenis_peralatan');			
		$this->db->from('peralatan');
		$this->db->join('jenis_peralatan', 'jenis_peralatan.id = peralatan.jenis_peralatan');
			
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/peralatan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->peralatan($pagination['per_page'],$this->uri->segment(4,0));
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('peralatan',$data);
	}
	
	function add_peralatan()
	{
		$data['act'] = "add";
		//list negeri
		$data['list_peralatan'] = $this->db->get('jenis_peralatan');
		
		
		$this->load->view('add_peralatan',$data);
	}
	
	function add_peralatan_process()
	{
		
		
		$jenis = $this->input->post('jenis');
		$peralatan = $this->input->post('peralatan');

		$this->db->where('peralatan', $peralatan);
		$this->db->from('peralatan');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/peralatan','refresh');

		}else{

			
			$data = array(			
					
						'jenis_peralatan' => $jenis,
						'peralatan' => $peralatan
						
					
					);		
			//insert ke table user
			$this->db->insert('peralatan', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di simpan'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/peralatan','refresh');
			//$this->output->enable_data_lamaer(TRUE);

		}				
	}
	
	function edit_peralatan($id)
	{
		
		$query = $this->db->query("SELECT * FROM peralatan where id_peralatan='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
								
				$data['jenis_peralatan'] = $row->jenis_peralatan;
				$data['peralatan'] = $row->peralatan;				
				$data['id'] = $row->id_peralatan;	
				
					
			}
		$data['list_peralatan'] = $this->db->get('jenis_peralatan');
		$data['act'] = "edit";
		$this->load->view('add_peralatan',$data);
		$this->output->enable_data_lamaer(TRUE);		
	}
	
	function edit_peralatan_process(){
		
		
		$key = $this->input->post('key');
		$data = array(			
				
						
						'jenis_peralatan' => $this->input->post('jenis'),
						'peralatan' => $this->input->post('peralatan'),
											
						
				);	
		//update table			
		$this->model_pengguna->update_data('peralatan',$key,$data,'id_peralatan');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/peralatan','refresh');
				
	}
	
	
	function kursus()
	{	
		$this->db->select('*');			
		$this->db->from('kursus');
			
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/kursus/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->kursus($pagination['per_page'],$this->uri->segment(4,0));
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$this->load->view('kursus',$data);
	}
	
	function add_kursus()
	{
		$data['act'] = "add";	
		$this->load->view('add_kursus',$data);
	}
	
	function add_kursus_process()
	{
		
		
		$kursus = $this->input->post('kursus');
		

		$this->db->where('kursus', $kursus);
		$this->db->from('kursus');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/kursus','refresh');

		}else{

			
			$data = array(			
					
						'kursus' => $kursus				
						
					
					);		
			//insert ke table user
			$this->db->insert('kursus', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di simpan'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/kursus','refresh');
			//$this->output->enable_data_lamaer(TRUE);

		}				
	}
	
	function edit_kursus($id)
	{
		
		$query = $this->db->query("SELECT * FROM kursus where id_kursus='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
								
				
				$data['kursus'] = $row->kursus;				
				$data['id'] = $row->id_kursus;	
				
					
			}
		
		$data['act'] = "edit";
		$this->load->view('add_kursus',$data);
		//$this->output->enable_data_lamaer(TRUE);		
	}
	
	function edit_kursus_process(){
		
		
		$key = $this->input->post('key');
		$data = array(			
				
						
						'kursus' => $this->input->post('kursus')
						
											
						
				);	
		//update table			
		$this->model_pengguna->update_data('kursus',$key,$data,'id_kursus');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/kursus','refresh');
				
	}


	function edit_pengguna($id)
	{
		$query = $this->db->query("SELECT * FROM user where id_user='$id'");					

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
		$this->load->view('edit_pengguna',$data);
		//$this->output->enable_profiler(TRUE);
	}



	
	function edit_pengguna_proses()
	{
		
		$id = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		
		'nama' => $this->input->post('nama'),
		'nama_penuh' => $this->input->post('nama_penuh'),
		'kata_laluan' => $this->input->post('kata_laluan'),
		'jawatan' => $this->input->post('jawatan'),
		'gred' => $this->input->post('gred'),
		'email' => $this->input->post('email'),
		'no_tel' => $this->input->post('no_tel'),
		'level' => $this->input->post('level'),
	
		
		
		);
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('user',$id,$data,'id_user');
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
				$data['level'] = $row->level;
				$data['status'] = $row->status;
				$data['id'] = $row->id;				
				
					
			}
		
		//$data['act'] = "edit";
		$this->load->view('view_pengguna',$data);
		//$this->output->enable_data_lamaer(TRUE);		
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
				$data['alamat2'] = $row->alamat3;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['nama_pegawai'] = $row->nama_pegawai;
				$data['no_telefon'] = $row->no_telefon;
				$data['saiz_ptj'] = $row->saiz_ptj;
				$data['negeri'] = $row->negeri;
				$data['id_ptj'] = $row->id_ptj;
					
			}
			
		$data['act'] = "edit";
		$this->load->view('edit_ptj',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function edit_ptj_proccess()
	{
		$id = $this->input->post('key');
		//define data from form for insert table
		$data = array (		
		'kod_ptj' => $this->input->post('kod_ptj'),
		'nama_ptj' => $this->input->post('nama_ptj'),
		'nama_jabatan' => $this->input->post('nama_jabatan'),
		'alamat' => $this->input->post('alamat'),
		'nama_pegawai' => $this->input->post('nama_pegawai'),
		'no_telefon' => $this->input->post('no_telefon'),
		'saiz_ptj' => $this->input->post('saiz_ptj'),
		'negeri' => $this->input->post('negeri'),
		'alamat' => $this->input->post('alamat'),
		'alamat2' => $this->input->post('alamat2'),		
		'alamat3' => $this->input->post('alamat3'),
		'poskod' => $this->input->post('poskod')

		
		
		);
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('ptj',$id,$data,'id_ptj');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_ptj','refresh');
	}
	function del_ptj($id)
	{
		
		
		$this->db->where('id', $id);
		$this->db->delete('ptj');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_ptj','refresh');
				
	}
	







	function add_pengguna_process()
	{
		
		
		$password = $this->input->post('password');
		$id_pengguna = $this->input->post('username');

		$this->db->where('id_user', $id_user);
		$this->db->from('user');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/utama','refresh');

		}else{

			$today = date('Y-m-d');
			//echo $password;
			$data = array(			
					
						'id_pengguna' => $id_pengguna,
						'katalaluan' => $this->_prep_password($password),
						'katalaluan' => MD5($password),
						'katalaluan' => $password,
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
			redirect('main/utama','refresh');
			//$this->output->enable_data_lamaer(TRUE);

		}				
	}
	
	function add_status_bancian_process()
	{
		
		
		$status = $this->input->post('status');
		

		$this->db->where('status_bancian', $status);
		$this->db->from('status_bancian');
		$check = $this->db->count_all_results();
		//semak data dari table telah wujud atau tidak
		if ($check){
			$this->session->set_flashdata('flash_error','Ralat !.Maklumat telah wujud');
			redirect('main/status_bancian','refresh');

		}else{

			
			$data = array(			
					
						'status_bancian' => $status,
						
					
					);		
			//insert ke table user
			$this->db->insert('status_bancian', $data);	
			
			$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di simpan'); 
			
			
			//lepas simpan data terus ke page senarai
			redirect('main/status_bancian','refresh');
			//$this->output->enable_data_lamaer(TRUE);

		}				
	}
	
	function edit_status_bancian($id)
	{
		
		$query = $this->db->query("SELECT * FROM status_bancian where id_status_bancian='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['status'] = $row->status_bancian;				
				$data['id'] = $row->id_status_bancian;	
				
					
			}
		
		$data['act'] = "edit";
		$this->load->view('add_status_bancian',$data);
		//$this->output->enable_data_lamaer(TRUE);		
	}
	
	function edit_status_bancian_process(){
		
		
		$key = $this->input->post('key');
		$data = array(			
				
						
						
						'status_bancian' => $this->input->post('status')					
						
				);	
		//update table			
		$this->model_pengguna->update_data('status_bancian',$key,$data,'id_status_bancian');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/status_bancian','refresh');
				
	}
	
	
	
	function pemohon()
	{	
	
		//Untuk Carian
		if(isset($_POST['submit']))
		{
			$data['negeri']= $this->input->post('negeri');		
			$this->session->set_userdata('sess_negeri',$data['negeri']);
			
			$data['daerah']= $this->input->post('daerah');		
			$this->session->set_userdata('sess_daerah',$data['daerah']);
			
			$data['parlimen']= $this->input->post('parlimen');		
			$this->session->set_userdata('sess_parlimen',$data['parlimen']);
			
			$data['dun']= $this->input->post('dun');		
			$this->session->set_userdata('sess_dun',$data['dun']);
			
			
		} else {
				$data['negeri'] = $this->session->userdata('sess_negeri');
				$data['daerah'] = $this->session->userdata('sess_daerah');
				$data['parlimen'] = $this->session->userdata('sess_parlimen');
				$data['dun'] = $this->session->userdata('sess_dun');
				
				
		}
		
		$this->db->select('*');			
		$this->db->from('pemohon');
		//$this->db->join('data_baru', 'data_baru.id = pemohon.id_data_baru');
		$this->db->join('status_bancian', 'status_bancian.id_status_bancian = pemohon.status_bancian','LEFT');
		$this->db->join('pengguna', 'pengguna.id = pemohon.id_pembanci','LEFT');
		$this->db->order_by('pemohon.nama','ASC');
		//$this->db->where('pemohon.id_pembanci',0);
		
		//if($data['negeri'] !=0){
			if(!empty($data['negeri'])){
				$this->db->where('pemohon.negeri',$data['negeri']);
			}
		//}
		
		if(!empty($data['daerah'])){
			$this->db->where('pemohon.daerah',$data['daerah']);
		}
		if(!empty($data['parlimen'])){
			$this->db->where('pemohon.parlimen',$data['parlimen']);
		}
		if(!empty($data['dun'])){
			$this->db->where('pemohon.dun',$data['dun']);
		}
			
		 $level = $this->session->userdata('sess_level');
		 $id = $this->session->userdata('sess_id');
		 //level pembanci
		if($level==2){
			$this->db->where('pemohon.id_pembanci',$id);
		}
			
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/pemohon/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->pemohon($pagination['per_page'],$this->uri->segment(4,0),$data['negeri'],$data['daerah'],$data['parlimen'],$data['dun']);
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		//senarai pengguna level pembanci
		$this->db->where('level',2);
		$data['list_pengguna'] = $this->db->get('pengguna');
		
		$this->db->select('distinct(negeri) as negeri');
		$data['list_negeri'] = $this->db->get('data_baru');
		
		$this->db->select('distinct(daerah) as daerah');
		$data['list_daerah'] = $this->db->get('data_baru');
		
		$this->db->select('distinct(parlimen) as parlimen');
		$data['list_parlimen'] = $this->db->get('data_baru');
		
		$this->db->select('distinct(dun) as dun');
		$data['list_dun'] = $this->db->get('data_baru');
		
		$this->load->view('pemohon',$data);
		$this->output->enable_profiler(TRUE);
	}
	
	function detail_pemohon($id)
	{
		
		$query = $this->db->query("SELECT * FROM pemohon where id_pemohon='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				//$data['status'] = $row->status_bancian;				
				$data['id'] = $row->id_pemohon;
				$data['photo'] = $row->photo;	
				$data['nama'] = $row->nama;	
				$data['no_kp'] = $row->no_kp;
				$data['no_tel_tetap'] = $row->no_tel_tetap;				
				$data['no_tel_bimbit'] = $row->no_tel_bimbit;
				$data['umur'] = $row->umur;	
				$data['jantina'] = $row->jantina;	
				$data['kaum'] = $row->kaum;
				$data['agama'] = $row->agama;
				$data['status_kahwin'] = $row->status_kahwin;
				$data['bil_tanggungan'] = $row->bil_anak;
				$data['alamat1'] = $row->alamat1;	
				$data['alamat2'] = $row->alamat2;
				$data['alamat3'] = $row->alamat3;
				$data['poskod'] = $row->poskod;
				$data['negeri'] = $row->negeri;
				$data['daerah'] = $row->daerah;
				$data['pekerjaan'] = $row->pekerjaan;
				$data['catatan_pekerjaan'] = $row->catatan_pekerjaan;
				
				$data['sp_pekerjaan'] = $row->sp_pekerjaan;
				$data['rm_sp_pekerjaan'] = $row->rm_sp_pekerjaan;
				$data['sp_bantuan_kebajikan'] = $row->sp_bantuan_kebajikan;
				$data['rm_sp_bantuan_kebajikan'] = $row->rm_sp_bantuan_kebajikan;
				
				$data['sp_lain'] = $row->sp_lain;
				$data['rm_sp_lain'] = $row->rm_sp_lain;
				$data['tahap_didik'] = $row->tahap_pendidikan;
				$data['membaca'] = $row->membaca;
				$data['menulis'] = $row->menulis;
				$data['status_sihat'] = $row->status_sihat;
				$data['desc_ksihatan'] = $row->desc_ksihatan;
				
				$data['status_bancian'] = $status_bancian= $row->status_bancian;
				
				
			}
		
		//Tangunggan
		$this->db->select('*');			
		$this->db->from('pengguna');
			
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/utama/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->list_tanggungan($pagination['per_page'],$this->uri->segment(4,0));
		//papar mesej bila berjaya 
		$data['flash_success'] = $this->session->flashdata('flash_success');	
			
		//papar mesej bila gagal 
		$data['flash_error'] = $this->session->flashdata('flash_error');
		
		$data['option_country'] = $this->model_pengguna->getcountry_edit($status_bancian);
		
		//$this->db->where('id_pemohon',$id);
		$data['pemohon_gallery'] = $this->model_pengguna->pemohon_gallery($id);
		
		
		$data['act'] = "edit";
		$this->load->view('detail_pemohon',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	function add_ptj_proses()
	
	{
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
		'nama_penyemak' => $this->input->post('nama_penyemak'),
		);

		
		//user = nama table
		$this->db->insert('ptj',$data);
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_ptj','refresh');	
				
	}
	function add_pengguna_proses()
	
	{
	$data = array (		
		'nama' => $this->input->post('nama'),
		'jawatan' => $this->input->post('jawatan'),
		'gred' => $this->input->post('gred'),
		
		);

		
		//user = nama table
		$this->db->insert('user',$data);
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian_pengguna','refresh');	
				
	}
	
	function add_pengguna()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_pengguna',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	function add_ptj()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_ptj',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	function add_pemohon_tanggungan()
	{
		
		
		
		
		$data['act'] = "add";
		$this->load->view('add_pemohon_tanggungan',$data);
		//$this->output->enable_profiler(TRUE);		
	}
	
	function pemohon_edit_process(){
		
		
		$key = $this->input->post('key');
		$data = array(			
						'nama' => $this->input->post('nama'),
						'no_kp' => $this->input->post('nokp'),
						'no_tel_tetap' => $this->input->post('no_tel_tetap'),
						'no_tel_bimbit' => $this->input->post('no_tel_bimbit'),
						'umur' => $this->input->post('umur'),
						'jantina' => $this->input->post('jantina'),
						'agama' => $this->input->post('agama'),
						'status_kahwin' => $this->input->post('status_kahwin'),
						'bil_anak' => $this->input->post('bil_tanggungan'),
						'alamat1' => $this->input->post('alamat1'),
						'alamat2' => $this->input->post('alamat2'),
						'alamat3' => $this->input->post('alamat3'),
						'poskod' => $this->input->post('poskod'),
						'negeri' => $this->input->post('negeri'),
						'daerah' => $this->input->post('daerah'),
						'pekerjaan' => $this->input->post('pekerjaan'),
						'catatan_pekerjaan' => $this->input->post('desc_kerja')
						
						
												
						
				);	
		//update table			
		$this->model_pengguna->update_data('pemohon',$key,$data,'id_pemohon');			
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 			
		redirect('main/pemohon/','refresh');
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
		$this->output->enable_profiler(TRUE);
	}
	
	function assign_pembanci()
	{		
		$data = $this->input->post('selected');	
		$id_pembanci = $this->input->post('id_pembanci');	
		if(!empty($data)){		
			foreach($data as $datas)
			{
				$data = array(			
				
						'id_pembanci' => $this->input->post('id_pembanci')					
						
				);	
				//update table			
				$this->model_pengguna->update_data('pemohon',$datas,$data,'id_pemohon');
				
				
			}
			$this->session->set_flashdata('flash_success', 'Maklumat berjaya di padam !'); 
		}else{
			$this->session->set_flashdata('flash_error', 'Ralat !. Sila pilih rekod.');
		}
		//$this->output->enable_data_lamaer(TRUE);
		redirect('main/pemohon','refresh');		
	}
	
	//Pembanci kemaskini status
	function bancian_todo($id)
	{
		$query = $this->db->query("SELECT * FROM pemohon WHERE pemohon.id_pemohon='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['id'] = $row->id_pemohon;		
				$data['nama'] = $row->nama;				
				$data['no_kp'] = $row->no_kp;
				$data['tarikh_bancian'] = $row->tarikh_bancian;				
				$data['status_bancian'] = $status_bancian = $row->status_bancian;
				$data['id_kod_masalah']  = $row->id_kod_masalah;
					
			}
		//$session_id = $this->session->userdata('ses_id_bancian');
		$data['act'] = "edit";
		//if($status_bancian !=''){
			$data['option_country'] = $this->model_pengguna->getcountry_edit($status_bancian=NULL);
		//}else{
			//$data['option_country'] = $this->model_pengguna->getcountry_edit();
		//}
		$data['list_masalah'] = $this->model_pengguna->get_kod_masalah($status_bancian);
		$data['list_kursus'] = $this->db->get('kursus');
		
		$this->load->view('bancian_todo',$data);
		$this->output->enable_profiler(TRUE);
	}
	
	function bancian_todo_process()
	{
		$id = $this->input->post('key');
		$status = $this->input->post('country_id');	
		$kod_masalah = $this->input->post('province_id');
		
		$tarikh_bancian = $this->input->post('tarikh_bancian');
			$explode = explode("-", $tarikh_bancian);
			 $a = $explode[0];
			 $b = $explode[1];
			 $c = $explode[2];
			 //echo $a;
		$gabung = $c."-".$b."-".$a;
		
		if($status !=0){
			//Jika memohon
			if($status==1){
				
			
				$query = $this->db->query("SELECT pemohon.id_pemohon as id_pemohon,data_baru.nama_peserta as nama_peserta,data_baru.no_kp_peserta as no_kp_peserta FROM pemohon join data_baru on data_baru.id=pemohon.id_data_baru where pemohon.id_pemohon='$id'");					

					if ($query->num_rows() > 0)
					{
						$row = $query->row(); 
						//umpukan variable  ke //field dari table
						$data['nama_peserta'] = $row->nama_peserta;				
						$data['no_kp_peserta'] = $row->no_kp_peserta;
						$data['id'] = $row->id_pemohon;				
						
							
					}
				//$session_id = $this->session->userdata('ses_id_bancian');
				$data['act'] = "edit";
				
				$data['option_country'] = $this->model_pengguna->getcountry_edit();
				$data['list_jenis_peralatan'] = $this->model_pengguna->get_list_jenis_peralatan();
				$data['list_kursus'] = $this->db->get('kursus');
				
				$data = array(			
					
							'tarikh_bancian' => $gabung,
							'status_bancian' => $this->input->post('country_id'),	
							'id_pembanci' => $this->session->userdata('sess_id')
							
					);	
					//update table			
					$this->model_pengguna->update_data('pemohon',$id,$data,'id_pemohon');
					
					
				$this->load->view('bancian_todo_memohon',$data);
			}else{ //jika tidak memohon
				
				$data = array(			
					
							'tarikh_bancian' => $gabung,
							'status_bancian' => $this->input->post('country_id'),
							'id_kod_masalah' => $this->input->post('province_id'),
							'id_pembanci' => $this->session->userdata('sess_id')	
							
					);	
					//update table			
					$this->model_pengguna->update_data('pemohon',$id,$data,'id_pemohon');
					$this->session->set_flashdata('flash_success', 'Maklumat Berjaya di Kemaskini.');
					redirect('main/pemohon/','refresh');
			}	
		}else{
			$this->session->set_flashdata('flash_error', 'Sila Isi maklumat.');
			//redirect('main/bancian_todo_memohon/'.$id,'refresh');	
			redirect('main/pemohon/','refresh');
		}
		$this->output->enable_profiler(TRUE);
		//redirect('main/bancian_todo_memohon/'.$id,'refresh');
	}
	
	
	function bancian_todo_memohon($id)
	{
		$query = $this->db->query("SELECT * FROM pemohon  where pemohon.id_pemohon='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['nama'] = $row->nama;				
				$data['no_kp'] = $row->no_kp;
				$data['id'] = $row->id_pemohon;	
				$data['tarikh_bancian'] = $row->tarikh_bancian;					
				
					
			}
		//$session_id = $this->session->userdata('ses_id_bancian');
		$data['act'] = "edit";
		
		$data['option_country'] = $this->model_pengguna->get_list_jenis_peralatan();
		
		$data['list_jenis_peralatan'] = $this->model_pengguna->get_list_jenis_peralatan();
		
		$data['list_kursus'] = $this->db->get('kursus');
		$data['list_jenis_peralatan'] = $this->db->get('jenis_peralatan');
		
		$this->load->view('bancian_todo_memohon',$data);
		
	}
	
	function bancian_todo_memohon_process()
	{
		
		$id = $this->input->post('key');
		
					$data = array(			
						'id_pemohon' => $id,
						'ikut_program' => $this->input->post('ikut_program'),
						'nama_program' => $this->input->post('nama_program'),
						'agensi' => $this->input->post('agensi'),
						'keupayaan_hadir' => $this->input->post('keupayaan_hadir'),
						'sebab_tidak_hadir' => $this->input->post('sebab_tidak_hadir'),
						'Kemudahan_pengangkutan' => $this->input->post('Kemudahan_pengangkutan'),
						'lokasi_pengambilan' => $this->input->post('lokasi_pengambilan'),
						'keupayaan_bermalam' => $this->input->post('keupayaan_bermalam'),
						'sebab_tidak_bermalam' => $this->input->post('sebab_tidak_bermalam'),
						'sebab_tidak_bermalam' => $this->input->post('sebab_tidak_bermalam')

					);		
					//insert ke table user
				$this->db->insert('pemohon_latihan', $data);
				
				//insert ke table pemohon_table
				$data = $this->input->post('peralatan');
				$this->db->where('id_pemohon', $id);
				$this->db->from('pemohon_peralatan');
				$check = $this->db->count_all_results();
				//semak data dari table telah wujud atau tidak
				if ($check){
		
					$this->db->where('id_pemohon', $id);
					$this->db->delete('pemohon_peralatan');
					if(!empty($data)){		
						foreach($data as $datas)
						{
							$data = array(			
							'id_pemohon' => $id,
							'id_peralatan' => $datas
							
							);
							$this->db->insert('pemohon_peralatan', $data);
							
							
						}
						$this->session->set_flashdata('flash_success', 'Maklumat berjaya di padam !'); 
					}
					
				}else{
						
					if(!empty($data)){		
						foreach($data as $datas)
						{
							$data = array(			
							'id_pemohon' => $id,
							'id_peralatan' => $datas
							
							);
							$this->db->insert('pemohon_peralatan', $data);
							
							
						}
						$this->session->set_flashdata('flash_success', 'Maklumat berjaya di padam !'); 
					}
				}
				$this->session->set_flashdata('flash_success', 'Maklumat Berjaya di Kemaskini.');
				
		//$this->load->view('pemohon',$data);
		redirect('main/pemohon','refresh');
		//$this->output->enable_profiler(TRUE);
	}
	
	function detail_bancian($id)
	{
		$query2 = $this->db->query("SELECT p.id_pemohon as id_pemohon,p.nama as nama,p.no_kp as no_kp,
		p.tarikh_bancian as tarikh_bancian,p.status_bancian,p.id_kod_masalah,km.masalah
		FROM pemohon p 
		JOIN kod_masalah km ON p.id_kod_masalah=km.id_kod_masalah 
		WHERE p.id_pemohon='$id'");					

			if ($query2->num_rows() > 0)
			{
				$row = $query2->row(); 
				//umpukan variable  ke //field dari table
				
				$data['id'] = $row->id_pemohon;		
				$data['nama'] = $row->nama;				
				$data['no_kp'] = $row->no_kp;
				$data['tarikh_bancian'] = $row->tarikh_bancian;				
				$data['status_bancian'] = $status_bancian = $row->status_bancian;
				$data['id_kod_masalah']  = $row->id_kod_masalah;
				$data['masalah']  = $row->masalah;
					
			}
		//$session_id = $this->session->userdata('ses_id_bancian');
		$data['act'] = "edit";
		//if($status_bancian !=''){
			$data['option_status'] = $this->model_pengguna->getcountry_edit($status_bancian=NULL);
		//}else{
			//$data['option_country'] = $this->model_pengguna->getcountry_edit();
		//}
		$data['list_masalah'] = $this->model_pengguna->get_kod_masalah($status_bancian);
		$data['list_kursus'] = $this->db->get('kursus');
		
		
		$query = $this->db->query("SELECT p.nama as nama,p.no_kp as no_kp,p.id_pemohon,
		p.tarikh_bancian as tarikh_bancian,pl.ikut_program as ikut_program,pl.nama_program as nama_program,
		pl.agensi as agensi,pl.keupayaan_hadir as keupayaan_hadir,pl.sebab_tidak_hadir as sebab_tidak_hadir,
		pl.Kemudahan_pengangkutan as Kemudahan_pengangkutan,pl.lokasi_pengambilan as lokasi_pengambilan,
		pl.keupayaan_bermalam as keupayaan_bermalam,pl.sebab_tidak_bermalam as sebab_tidak_bermalam,p.status_bancian as status_bancian
		FROM pemohon p 
		JOIN pemohon_latihan pl ON pl.id_pemohon=p.id_pemohon
		where p.id_pemohon='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['nama'] = $row->nama;				
				$data['no_kp'] = $row->no_kp;
				$data['id'] = $id = $row->id_pemohon;	
				$data['tarikh_bancian'] = $row->tarikh_bancian;	
				$data['status_bancian'] = $row->status_bancian;	
				$data['ikut_program'] = $row->ikut_program;	
				$data['nama_program'] = $row->nama_program;
				$data['agensi'] = $row->agensi;
				$data['keupayaan_hadir'] = $row->keupayaan_hadir;
				$data['sebab_tidak_hadir'] = $row->sebab_tidak_hadir;
				$data['Kemudahan_pengangkutan'] = $row->Kemudahan_pengangkutan;
				$data['lokasi_pengambilan'] = $row->lokasi_pengambilan;
				$data['keupayaan_bermalam'] = $row->keupayaan_bermalam;
				$data['sebab_tidak_bermalam'] = $row->sebab_tidak_bermalam;
				//$data['sebab_tidak_bermalam'] = $row->sebab_tidak_bermalam;
				
					
			}
		//$session_id = $this->session->userdata('ses_id_bancian');
		$data['act'] = "edit";
		
		$data['option_country'] = $this->model_pengguna->get_list_jenis_peralatan();
		
		$data['list_jenis_peralatan'] = $this->model_pengguna->get_list_jenis_peralatan();
		
		$data['list_kursus'] = $this->db->get('kursus');
		$data['pemohon_peralatan'] = $this->model_pengguna->pemohon_peralatan($id);
		$data['list_jenis_peralatan'] = $this->db->get('jenis_peralatan');
		
		
		$this->load->view('detail_bancian',$data);
		$this->output->enable_profiler(TRUE);
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
	
	function insert_data_pemohon(){
            
		$this->db->query("INSERT INTO pemohon 
		(batch,no_siri,nama,no_kp,jantina,kaum,umur,pekerjaan,
		tahap_pendidikan,status_kahwin,bil_anak,nama_kir,no_kp_kir,alamat1,alamat2,alamat3,
		bandar,poskod,daerah,negeri,parlimen,dun,no_tel_tetap,no_tel_bimbit,pendapatan,per_kapita,
		status_miskin,hub_dgn_kir,oku,tahun_rekod,status_latihan,kursus )
		
		SELECT batch,no_siri,nama_peserta,no_kp_peserta,jantina,keturunan,umur,pekerjaan_sblm_latihan,
		pendidikan,taraf_perkahwinan,bil_anak,nama_kir,no_kp_kir,alamat1,alamat2,alamat3,
		bandar,poskod,daerah,negeri,parlimen,dun,no_tel_tetap,no_tel_bimbit,pendapatan_sebelum,per_kapita,
		status_miskin,hubungan,oku,tahun_rekod,status_latihan,kursus 
		FROM data_baru WHERE status_migrate !=2;");
		redirect('main/pemohon','refresh');
    }
	
	function select_province(){
            if('IS_AJAX') {
				$data['option_province'] = $this->model_pengguna->getprovince();
				$this->load->view('selectprovince',$data);
			
			}
    }
	
	
	
	function select_peralatan(){
            if('IS_AJAX') {
				$data['option_province'] = $this->model_pengguna->select_peralatan();
				$this->load->view('select_peralatan',$data);
			
			}
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