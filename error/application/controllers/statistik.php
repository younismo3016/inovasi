<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends MY_Controller {

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
		//sekiranya ada butang reset, boleh guna coding ini.
		/*if(isset($_POST['refresh'])) { 
			$array_items=array('sess_tarikh_terima_mula' => '','sess_tarikh_terima_hingga' => '');
			$this->session->unset_userdata($array_items);
		}*/
		
		 //Untuk Carian 
		if(isset($_POST['carian'])) { 
			$data['tarikh_terima_mula']= convert_date_formattodb($this->input->post('tarikh_terima_mula')); 
			$data['tarikh_terima_hingga']= convert_date_formattodb($this->input->post('tarikh_terima_hingga')); 
			
		} else {
			$data['tarikh_terima_mula'] = $this->session->userdata('sess_tarikh_terima_mula');	
			$data['tarikh_terima_hingga'] = $this->session->userdata('sess_tarikh_terima_hingga');
		}
		
		$tarikh_terima_mula= $data['tarikh_terima_mula'];
		$tarikh_terima_hingga= $data['tarikh_terima_hingga'];
	
		/*$this->db->select('surat.tarikh_terima,
SUM(CASE WHEN surat.id_kategori = 1 then 1 else 0 end ) as TERBUKA,
SUM(CASE WHEN surat.id_kategori = 2 then 1 else 0 end ) as SULIT,
SUM(CASE WHEN surat.id_kategori = 3 then 1 else 0 end ) as RAHSIA,
SUM(CASE WHEN surat.id_kategori = 4 then 1 else 0 end ) as RAHSIA_BESAR,
SUM(CASE WHEN surat.id_kategori = 5 then 1 else 0 end ) as TERHAD,
count(*) as JUMLAH');
		$this->db->from('surat');
		$this->db->GROUP_by('surat.tarikh_terima');*/
		
		$q="SELECT tarikh_terima,
SUM(CASE WHEN id_kategori = '1' then 1 else 0 end ) as TERBUKA,
SUM(CASE WHEN id_kategori = '2' then 1 else 0 end ) as SULIT,
SUM(CASE WHEN id_kategori = '3' then 1 else 0 end ) as RAHSIA,
SUM(CASE WHEN id_kategori = '4' then 1 else 0 end ) as RAHSIA_BESAR,
SUM(CASE WHEN id_kategori = '5' then 1 else 0 end ) as TERHAD,
count(*) as JUMLAH
FROM surat";


		if(($data['tarikh_terima_mula'] != '')&&($data['tarikh_terima_hingga'] != '')){
$q .= " where tarikh_terima>='$tarikh_terima_mula' AND tarikh_terima<='$tarikh_terima_hingga'";
}

$q .= " GROUP BY tarikh_terima";
		$data["list"]=$q=$this->db->query($q);
		//papar mesej bila berjaya
		$data['flash_success'] = $this->session->flashdata('flash_success');

		//papar mesej bila gagal
		$data['flash_error'] = $this->session->flashdata('flash_error');


		$this->load->view('statistik_surat_terbuka',$data);
		//$this->output->enable_profiler(TRUE);
	
	}
	
	public function cetak_statistik_surat_terbuka($tarikh_terima_mula,$tarikh_terima_hingga)
	{
		$data['tarikh_a'] = $tarikh_terima_mula; //umpukan tarikh_terima_mula ke tarikh_a tuuan untuk dipapar kat view
		$data['tarikh_b'] = $tarikh_terima_hingga;
		//convert_date_formattodb($this->input->post('$tarikh_terima_mula'))
		//$tarikh_a= $data['tarikh_terima_mula'];
		//$tarikh_b= $data['tarikh_terima_hingga'];
		
		$q="SELECT tarikh_terima,
		SUM(CASE WHEN id_kategori = '1' then 1 else 0 end ) as TERBUKA,
		SUM(CASE WHEN id_kategori = '2' then 1 else 0 end ) as SULIT,
		SUM(CASE WHEN id_kategori = '3' then 1 else 0 end ) as RAHSIA,
		SUM(CASE WHEN id_kategori = '4' then 1 else 0 end ) as RAHSIA_BESAR,
		SUM(CASE WHEN id_kategori = '5' then 1 else 0 end ) as TERHAD,
		count(*) as JUMLAH
		FROM surat where tarikh_terima >= '$tarikh_terima_mula' and tarikh_terima <='$tarikh_terima_hingga'
		group by tarikh_terima";


		
		$data["list"]=$q=$this->db->query($q);
		$this->load->view('cetak_statistik_surat_terbuka',$data);
		//$this->output->enable_profiler(TRUE);
	
	}
	
	public function statistik_surat_peribadi()
	{
	
		 //Untuk Carian 
		if(isset($_POST['carian'])) { 
			
			$data['tarikh_terima_mula']= convert_date_formattodb($this->input->post('tarikh_terima_mula')); 
			$data['tarikh_terima_hingga']= convert_date_formattodb($this->input->post('tarikh_terima_hingga')); 
			
		} else {
			$data['tarikh_terima_mula'] = $this->session->userdata('sess_tarikh_terima_mula');	
			$data['tarikh_terima_hingga'] = $this->session->userdata('sess_tarikh_terima_hingga');
		}
		
		$tarikh_terima_mula= $data['tarikh_terima_mula'];
		$tarikh_terima_hingga= $data['tarikh_terima_hingga'];
		
		$q="SELECT tarikh_terima,
count(*) as PERIBADI, count(*) as JUMLAH
FROM surat_peribadi";


		if(($data['tarikh_terima_mula'] != '')&&($data['tarikh_terima_hingga'] != '')){
$q .= " where tarikh_terima>='$tarikh_terima_mula' AND tarikh_terima<='$tarikh_terima_hingga'";
}

$q .= " GROUP BY tarikh_terima";
		$data["list"]=$q=$this->db->query($q);
		//papar mesej bila berjaya
		$data['flash_success'] = $this->session->flashdata('flash_success');

		//papar mesej bila gagal
		$data['flash_error'] = $this->session->flashdata('flash_error');


		$this->load->view('statistik_surat_peribadi',$data);
		//$this->output->enable_profiler(TRUE);
	
	}
	
	public function cetak_statistik_surat_peribadi($tarikh_terima_mula,$tarikh_terima_hingga)
	{
		$data['tarikh_a'] = $tarikh_terima_mula; //umpukan tarikh_terima_mula ke tarikh_a tuuan untuk dipapar kat view
		$data['tarikh_b'] = $tarikh_terima_hingga;
		//convert_date_formattodb($this->input->post('$tarikh_terima_mula'))
		//$tarikh_a= $data['tarikh_terima_mula'];
		//$tarikh_b= $data['tarikh_terima_hingga'];
		
		$q="SELECT tarikh_terima,
			count(*) as PERIBADI, count(*) as JUMLAH
			FROM surat_peribadi
			 where tarikh_terima >= '$tarikh_terima_mula' and tarikh_terima <='$tarikh_terima_hingga'
			group by tarikh_terima";


		
		$data["list"]=$q=$this->db->query($q);
		$this->load->view('cetak_statistik_surat_peribadi',$data);
		//$this->output->enable_profiler(TRUE);
	
	}
	function statistik_bahagian()
	{
		
		 //Untuk Carian 
		if(isset($_POST['carian'])) { 
			$data['tarikh_terima']= convert_date_formattodb($this->input->post('tarikh_terima')); 
			//$data['tarikh_terima_hingga']= convert_date_formattodb($this->input->post('tarikh_terima_hingga')); 
			
		} else {
			$data['tarikh_terima'] = $this->session->userdata('sess_tarikh_terima');	
			//$data['tarikh_terima_hingga'] = $this->session->userdata('sess_tarikh_terima_hingga');
		}
		
		$tarikh_terima= $data['tarikh_terima'];
		
		$q="select a.id_bahagian, b.kod_bahagian, b.nama_bahagian, a.tarikh_terima, count(a.tarikh_terima) as JUMLAH
from surat a
inner join adm_bahagian b on a.id_bahagian=b.id_bahagian
where a.tarikh_terima LIKE '".$tarikh_terima."'
group by kod_bahagian";

		$data["list"]=$q=$this->db->query($q);
		
		$this->load->view('statistik_bahagian',$data);
		//$this->output->enable_profiler(TRUE);
	
	}
}
