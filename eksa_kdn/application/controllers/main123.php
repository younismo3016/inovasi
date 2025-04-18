<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	
	 
	public function index()
	{
		$this->mukadepan();
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
			
			$data['bulan_kkwt']= $this->input->post('bulan_kkwt');		
			$this->session->set_userdata('sess_bulan_kkwt',$data['bulan_kkwt']);
			
			
			
			
		} else {
				$data['kod_ptj'] = $this->session->userdata('sess_kod_ptj');
				$data['bulan_kkwt'] = $this->session->userdata('sess_bulan_kkwt');
				
				
		}
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('laporan_kewangan','laporan_kewangan.id_laporan_kewangan = ptj.id_ptj');
		
		if(!empty($data['kod_ptj'])){
			$this->db->where('kod_ptj',$data['kod_ptj']);
		}
		if(!empty($data['bulan_kkwt'])){
			$this->db->where('bulan_kkwt',$data['bulan_kkwt']);
		}
		
		//Pagination init
		$pagination['base_url'] 	= base_url().'index.php/main/surat_peringatan/page/';
		$pagination['total_rows'] 	= $this->db->count_all_results();
		$pagination['full_tag_open'] = "<p><div class=\"pagination\">";
		$pagination['full_tag_close'] = "</div></p>";			
		$pagination['per_page'] 	= "25";
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] 	= 4;
			
		$this->pagination->initialize($pagination);
		$data['list'] = $this->model_pengguna->surat_peringatan($pagination['per_page'],$this->uri->segment(4,0),$data['kod_ptj'],$data['bulan_kkwt']);
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
		$this->db->join('laporan_kewangan','laporan_kewangan.id_laporan_kewangan = ptj.id_ptj');
		
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
		
		$query = $this->db->query("SELECT * FROM ptj where id_ptj='$id_ptj'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['kod_ptj'] = $row->kod_ptj;				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['nama_jabatan'] = $row->nama_jabatan;
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
	function penerimaan_proses(){
		//define data from form for insert table
		$data = array (		
		'bulan_kkwt' => $this->input->post('bulan_kkwt'),
		'tarikh_terima' => $this->input->post('tarikh_terima'),
		'id_ptj' => $this->input->post('id_ptj'),
		);

		
		//user = nama table
		$this->db->insert('laporan_kewangan',$data);
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		//$this->output->enable_profiler(TRUE);
		redirect ('main/penerimaan','refresh');
	
		
	}
		function surat_peringatan_todo($id)
	{
		
		
		$query = $this->db->query("SELECT * FROM laporan_kewangan where id='$id_laporan_kewangan'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['no_surat_perintan_1'] = $row->no_surat_perintan_1;
				$data['no_surat_perintan_2'] = $row->no_surat_perintan_2;
				$data['id'] = $row->id;
					
			}
		$data['act'] = "add";
		$this->load->view('surat_peringatan_todo',$data);
		//$this->output->enable_profiler(TRUE);
		
	}
		function semakan_todo($id)
	{
		
		
		$query = $this->db->query("SELECT * FROM laporan_kewangan where id='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				
				$data['tarikh_terima'] = $row->tarikh_terima;
				$data['id'] = $row->id;
					
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
	
	$id = $this->input->post('id');
		//define data from form for insert table
		$data = array (		
		
		'tarikh_semak' => $this->input->post('tarikh_semak'),
		'bil_resit' => $this->input->post('bil_resit'),
		'jumlah_hasil' => $this->input->post('jumlah_hasil'),
		
		);

		
		//user = nama table
		$this->model_pengguna->update_data('penerimaan',$id,$data,'id');
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

	function edit_ptj($id)
	{
		$query = $this->db->query("SELECT * FROM ptj where id='$id'");					

			if ($query->num_rows() > 0)
			{
				$row = $query->row(); 
				//umpukan variable  ke //field dari table
				$data['kod_ptj'] = $row->kod_ptj;				
				$data['nama_ptj'] = $row->nama_ptj;
				$data['nama_jabatan'] = $row->nama_jabatan;
				$data['alamat'] = $row->alamat;
				$data['nama_pegawai'] = $row->nama_pegawai;
				$data['no_telefon'] = $row->no_telefon;
				$data['saiz_ptj'] = $row->saiz_ptj;
				$data['id'] = $row->id;
					
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
		'alamat' => $this->input->post('alamat')
		
		
		);
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di kemaskini'); 
		//user = nama table
		$this->model_pengguna->update_data('ptj',$id,$data,'id');
	    //$this->output->enable_profiler(TRUE);
		redirect ('main/pengemaskinian','refresh');
	}
	function del_ptj($id)
	{
		
		
		$this->db->where('id', $id);
		$this->db->delete('ptj');
		
		$this->session->set_flashdata('flash_success', 'Tahniah !. Maklumat berjaya di padam'); 
		//$this->output->enable_profiler(TRUE);
		redirect('main/pengemaskinian_ptj','refresh');
				
	}
	

	function add_ptj_proses()
	
	{
	$data = array (		
		'nama_ptj' => $this->input->post('nama_ptj'),
		'kod_ptj' => $this->input->post('kod_ptj'),
		'nama_jabatan' => $this->input->post('nama_jabatan'),
		'alamat' => $this->input->post('alamat'),
		'negeri' => $this->input->post('negeri'),
		'no_telefon' => $this->input->post('no_telefon'),
		'saiz_ptj' => $this->input->post('saiz_ptj'),
		'nama_pegawai' => $this->input->post('nama_pegawai'),
		);

		
		//user = nama table
		$this->db->insert('ptj',$data);
		$this->session->set_flashdata('flash_success', ' Maklumat telah berjaya di simpan'); 
			
		$this->output->enable_profiler(TRUE);
		//redirect ('main/pengemaskinian_ptj','refresh');	
				
	}
	function add_ptj()
	
	{
		
		$data['act'] = "add";
		$this->load->view('add_ptj',$data);
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