<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller {

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
		
		//$data['senarai_bahagian']=$this->db->get('adm_bahagian'); // select * from adm_bahagian	
		$data['senarai_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		$data['senarai_peranan']=$this->db->get('adm_peranan'); // select * from adm_peranan	
		
		$this->load->view('tambah_pengguna',$data);
	}
	function tambah_pengguna_proses()
	{
		
		
		//utk checx samada id sudah wujud
		$no_kp=$this->input->post('no_kp');
		
		$query = $this->db->get_where('pengguna', array('no_kp' => $no_kp)); 
        $count= $query->num_rows();   
        if ($count > 0)
        {  
		 //sekiranya id wujud
		 $this->session->set_flashdata('flash_error','Ralat !.Maklumat ini Telah Wujud');
		 redirect('pengguna/senarai_pengguna','refresh');
		} else {
			
		 //sekiranya id TIDAK wujud
		 
			$katalaluan = ($this->input->post('katalaluan'));
			$data = array(
				'id_pengguna' => $this->input->post('id_pengguna'),
				'katalaluan' => $katalaluan,
				'nama' => $this->input->post('nama'),
				'no_kp' => $this->input->post('no_kp'),
				'id_bahagian' => $this->input->post('id_bahagian'),
				'id_peranan' => $this->input->post('id_peranan'),
				'jawatan' => $this->input->post('jawatan'),
				'email' => $this->input->post('email'),
				'no_telefon' => $this->input->post('no_telefon'),
			);	
			//simpan table pengguna
			$this->db->insert('pengguna',$data);
			
			
			//mesej berjaya disimpan
			$this->session->set_flashdata('flash_success','Tahniah !.Maklumat telah berjaya disimpan');
			
			
     	}
		redirect('pengguna/senarai_pengguna','refresh');
		//$this->output->enable_profiler(TRUE);
		
	}	
	function senarai_pengguna()
	{
		$this->db->select('pengguna.id_pengguna,pengguna.nama,pengguna.no_kp,adm_bahagian.nama_bahagian,pengguna.email');
		$this->db->from('pengguna');
		$this->db->join('adm_bahagian','adm_bahagian.id_bahagian=pengguna.id_bahagian');
		$this->db->where('status_pengguna','1');
		
		$data['list_pengguna'] = $this->db->get('');
		
		$this->load->view('senarai_pengguna',$data);
		
		$data['flash_success']=$this->session->flashdata('flash_success');
		$data['flash_error']=$this->session->flashdata('flash_error');
		//$this->output->enable_profiler(TRUE);
		
		
		
		
	}
	function edit_pengguna($id)
	{
		$data['act'] ="edit";//form edit
		$query=$this->db->query("SELECT * FROM pengguna WHERE id_pengguna='$id'");
			if ($query->num_rows()>0)
			{
				$row=$query->row();
				$data['id_pengguna']=$row->id_pengguna;
				$data['nama']=$row->nama;
				$data['no_kp']=$row->no_kp;
				$data['katalaluan']=$row->katalaluan;
				$data['jawatan']=$row->jawatan;
				$data['id_bahagian']=$row->id_bahagian;
				$data['email']=$row->email;
				$data['id_peranan']=$row->id_peranan;
				$data['no_telefon']=$row->no_telefon;	
			}	
			
		//select * from bahagian
		//$data['senarai_bahagian']=$this->db->get('adm_bahagian');
		$data['senarai_bahagian'] = $this->db->query("SELECT *
												FROM adm_bahagian
												WHERE status_bahagian = 1
												ORDER BY kod_bahagian ASC");
		
		$data['senarai_peranan']=$this->db->get('adm_peranan');

		$data['peranan'] = $this->session->userdata('sess_id_adm_peranan');
		$this->load->view('tambah_pengguna',$data); 

	}
	function edit_pengguna_proses()
	{
		$katalaluan = ($this->input->post('katalaluan'));
		$key=$this->input->post('key');
		
		$data=array(
			'nama'=>$this->input->post('nama'),
			'no_kp'=>$this->input->post('no_kp'),
			'katalaluan' => $katalaluan,
			'jawatan'=>$this->input->post('jawatan'),
			'id_bahagian'=>$this->input->post('id_bahagian'),
			'id_peranan'=>$this->input->post('id_peranan'),
			'email'=>$this->input->post('email'),
			'no_telefon'=>$this->input->post('no_telefon'),
			);
			
		//kemaskini data table pengguna
		$this->model_user->update_data('pengguna',$key,$data,'id_pengguna');
		
		//mesej berjaya disimpan
		$this->session->set_flashdata('flash_success','Tahniah !.Maklumat telah berjaya dikemaskini');
		
		redirect('pengguna/senarai_pengguna','refresh');
		//$this->output->enable_profiler(TRUE);
	}
	function delete_pengguna($id) //salah 1 cara lain utk delete
	{
		$this->db->where('id_pengguna',$id);
		$this->db->delete('pengguna');
		
		redirect('pengguna/senarai_pengguna','refresh');
	}
	function del_pengguna($id_pengguna) //cara delete yang diguna utk esurat
	{
		$updateData = array(
				
			'status_pengguna' => 0,
					
			);
		
		$this->db->where('id_pengguna',$id_pengguna);
		$this->db->update('pengguna',$updateData);
			
		redirect('pengguna/senarai_pengguna','refresh');
		//$this->output->enable_profiler(TRUE); 
	}
}
