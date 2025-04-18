<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahagian extends MY_Controller {

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
		$act = $this->input->post('act');
		
		$data['act'] ="add";//form tambah
		$this->load->view('tambah_bahagian',$data);
	}
	function tambah_bahagian_proses()
	{
	
	$kod_bahagian=$this->input->post('kod_bahagian');
	$nama_bahagian=$this->input->post('nama_bahagian');
	$id_bahagian=$this->input->post('id_bahagian');
	
	//$query = mysql_query("SELECT * FROM adm_bahagian WHERE nama_bahagian='$nama_bahagian'");
    //$count = mysql_num_rows($query);
	 
	//$query2 = mysql_query("SELECT * FROM adm_bahagian WHERE kod_bahagian='$kod_bahagian'");
    //$count2 = mysql_num_rows($query2);
	// if($count!=0 || $count2!=0){
	
	$query=$this->db->query("SELECT * FROM adm_bahagian WHERE id_bahagian='$id_bahagian'");
	if ($query->num_rows()!=0) {
    
     // bahagian wujud
	 $this->session->set_flashdata('flash_error','Ralat !.Maklumat ini Telah Wujud');
	 redirect('bahagian/senarai_bahagian','refresh');
		} else {
		
		$data = array(
			'kod_bahagian' => $this->input->post('kod_bahagian'),
			'nama_bahagian' => $this->input->post('nama_bahagian'),	
			);
			
		//simpan table bahagian
		$this->db->insert('adm_bahagian',$data);
		
		//mesej berjaya disimpan
		$this->session->set_flashdata('flash_success','Tahniah !.Maklumat telah berjaya disimpan');
		redirect('bahagian/senarai_bahagian','refresh');
		}
	}
	function senarai_bahagian()
	{
		
		$this->db->select('*');
		$this->db->from('adm_bahagian');
		$this->db->where('status_bahagian','1');
		$data['list_bahagian'] = $this->db->get('');
		
		$this->load->view('senarai_bahagian',$data);
		//$this->output->enable_profiler(TRUE);
		
	}
	function edit_bahagian($id)
	{
		$act = $this->input->post('act');
		
		$data['act'] ="edit";//form edit
		$query=$this->db->query("SELECT * FROM adm_bahagian WHERE id_bahagian='$id'");
			if ($query->num_rows()>0)
			{
				$row=$query->row();
				$data['id_bahagian']=$row->id_bahagian;
				$data['kod_bahagian']=$row->kod_bahagian;
				$data['nama_bahagian']=$row->nama_bahagian;
				
			}	
			
		//select * from bahagian
		$data['list_bahagian']=$this->db->get('adm_bahagian');
		
		$this->load->view('tambah_bahagian',$data); 

	}
	function edit_bahagian_proses()
	{
		$id_bahagian = $this->input->post('id_bahagian');
		$editData = array(
		
			'kod_bahagian'=>$this->input->post('kod_bahagian'),
			'nama_bahagian'=>$this->input->post('nama_bahagian'),
			);
			
			//kemaskini
			//$this->model_main->update_data('adm_bahagian',$id_bahagian,$data,'id_bahagian');
			$this->db->where('id_bahagian',$id_bahagian);
			$this->db->update('adm_bahagian',$editData);
			
		
		//2nd msg berjaya disimpan
		$this->session->set_flashdata('flash_success','Tahniah !.Maklumat telah berjaya dikemaskini');
		redirect('bahagian/senarai_bahagian','refresh');
		//$this->output->enable_profiler(TRUE);
	}
	function del_bahagian($id_bahagian)
	{
		$updateData = array(
				
			'status_bahagian' => 0,
					
			);
		
		$this->db->where('id_bahagian',$id_bahagian);
		$this->db->update('adm_bahagian',$updateData);
			
		redirect('bahagian/senarai_bahagian','refresh');
		//$this->output->enable_profiler(TRUE); 
	}
}
