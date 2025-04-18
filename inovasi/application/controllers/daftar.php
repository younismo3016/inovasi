<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends MY_Controller {

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
		$sess_id_penguna = $this->session->userdata('sess_id_penguna');//pegang id_pengguna yg log in
		$form = $this->input->post('form'); //define variable
		
		$data['form'] ="add";//form tambah
		$query=$this->db->query("SELECT * FROM pengguna WHERE id_pengguna='$sess_id_penguna'");
			if ($query->num_rows()>0)
			{
				$row=$query->row();
				$data['id_pengguna']=$row->id_pengguna;
				//$data['id_bahagian']=$row->id_bahagian;	
				
			}
			
		//$data['senarai_bahagian']=$this->db->get('adm_bahagian'); // select * from adm_bahagian	
		$data['senarai_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		$data['senarai_kategori']=$this->db->get('adm_kategori'); // select * from adm_kategori	
		
		$this->load->view('daftar_surat',$data);
	}
	function daftarsurat_proses()
	{
			
			$data = array(
				'id_pengguna' => $this->input->post('id_pengguna'),
				'tarikh_terima' => convert_date_formattodb($this->input->post('tarikh_terima')),
				'no_rujukan' => $this->input->post('no_rujukan'),
				'tarikh_surat' => convert_date_formattodb($this->input->post('tarikh_surat')),
				'daripada' => $this->input->post('daripada'),
				'tajuk' => $this->input->post('tajuk'),
				'kepada' => $this->input->post('kepada'),
				'id_bahagian' => $this->input->post('id_bahagian'),
				'id_kategori' => $this->input->post('id_kategori'),
				
				);	
			
			//insert ke table surat
			$this->db->insert('surat',$data);
			
			//msg pop up berjaya disimpan
			$this->session->set_flashdata('flash_success','Terima kasih. Maklumat anda telah berjaya disimpan.');
			
			
		//$this->load->view('daftar_surat');
		redirect('daftar','refresh');
		//$this->output->enable_profiler(TRUE);
	
	}	
	function daftar_suratperibadi()
	{
		$sess_id_penguna = $this->session->userdata('sess_id_penguna');//pegang id_pengguna yg log in
		$query=$this->db->query("SELECT * FROM pengguna WHERE id_pengguna='$sess_id_penguna'");
			if ($query->num_rows()>0)
			{
				$row=$query->row();
				$data['id_pengguna']=$row->id_pengguna;
				//$data['id_bahagian']=$row->id_bahagian;	
				
			}
			
		//$data['senarai_bahagian']=$this->db->get('adm_bahagian'); // select * from adm_bahagian	
			$data['senarai_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		
		$this->load->view('daftar_suratperibadi',$data);
		//$this->output->enable_profiler(TRUE);
	}
	function daftarsuratperibadi_proses()
	{
			
			$data = array(
				//'id_pengguna' => $this->input->post('id_pengguna'),
				'tarikh_terima' => convert_date_formattodb($this->input->post('tarikh_terima')),
				'no_rujukan' => $this->input->post('no_rujukan'),
				'daripada' => $this->input->post('daripada'),
				'kepada' => $this->input->post('kepada'),
				'id_bahagian' => $this->input->post('id_bahagian'),
				
				);	
			
			//insert ke table surat
			$this->db->insert('surat_peribadi',$data);
			
			//msg pop up berjaya disimpan
			$this->session->set_flashdata('flash_success','Terima kasih. Maklumat anda telah berjaya disimpan.');
			
			
		//$this->load->view('senarai/senarai_surat_peribadi');
		redirect('daftar/daftar_suratperibadi','refresh');
		//$this->output->enable_profiler(TRUE);
	
	}
	function edit_surat($id_surat)
	{
		$form = $this->input->post('form'); //define variable
		
		$id_pengguna = $this->input->post('id_pengguna'); //define variable
		$data['form'] ="edit";//form edit
		$query=$this->db->query("SELECT * FROM surat WHERE id_surat='$id_surat'");
			if ($query->num_rows()>0)
			{
				$row=$query->row();
				$data['id_pengguna']=$row->id_pengguna;
				$data['id_surat']=$row->id_surat;
				$data['tarikh_terima']=$row->tarikh_terima;
				$data['no_rujukan']=$row->no_rujukan;
				$data['tarikh_surat']=$row->tarikh_surat;
				$data['daripada']=$row->daripada;
				$data['tajuk']=$row->tajuk;
				$data['kepada']=$row->kepada;
				$data['id_bahagian']=$row->id_bahagian;
				$data['id_kategori']=$row->id_kategori;
							
			}	
			
		$data['senarai_bahagian']=$this->db->get('adm_bahagian'); // select * from adm_bahagian	
		$data['senarai_kategori']=$this->db->get('adm_kategori'); // select * from adm_kategori	
		
		$this->load->view('daftar_surat',$data); 

	}
	function edit_surat_proses()
	{
				
		$id_surat = $this->input->post('id_surat');
		$editData = array(
		
			'tarikh_terima'=>convert_date_formattodb($this->input->post('tarikh_terima')),
			'no_rujukan'=>$this->input->post('no_rujukan'),
			'tarikh_surat'=>convert_date_formattodb($this->input->post('tarikh_surat')),
			'daripada'=>$this->input->post('daripada'),
			'tajuk'=>$this->input->post('tajuk'),
			'kepada'=>$this->input->post('kepada'),
			'id_bahagian'=>$this->input->post('id_bahagian'),
			'id_kategori'=>$this->input->post('id_kategori'),
			
			);
			
			//kemaskini
			//$this->model_main->update_data('adm_bahagian',$id_surat,$data,'id_surat');
			$this->db->where('id_surat',$id_surat);
			$this->db->update('surat',$editData);
			
		
		//2nd msg berjaya disimpan
		$this->session->set_flashdata('flash_success','Tahniah !.Maklumat Telah Berjaya Dikemaskini');
		redirect('senarai','refresh');
		//$this->output->enable_profiler(TRUE);
	}
	
}
