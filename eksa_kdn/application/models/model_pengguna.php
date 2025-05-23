<?php

class model_pengguna extends CI_Model {



	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
		function penerimaan($perPage,$uri,$kod_ptj,$nama_ptj)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('user','user.id_user = ptj.id_user');
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function baki_semakan($perPage,$uri,$kod_ptj,$bulan_kkwt)
	{
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		$this->db->join('user','user.id_user = penerimaan.cipta_penerimaan');
		$this->db->where('penerimaan.tarikh_siap_semak' ,'0000-00-00');
		$this->db->or_where('penerimaan.tarikh_siap_semak' ,'');
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj.id_user',$id_sess_pengguna);
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function semakan($perPage,$uri,$kod_ptj,$bulan_kkwt,$tahun_terima,$nama_ptj)
	{
		
		
		if(empty($kod_ptj) && empty($bulan_kkwt) && empty($tahun_terima) && empty($nama_ptj))
		{
			return null;
		}
		else
		{
			
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj.id_user',$id_sess_pengguna);
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		
			
		}

		

  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function semakan_kuiri($perPage,$uri,$kod_ptj,$bulan_kkwt,$tahun_terima,$nama_ptj,$tarikh_surat_pemerhatian,$status_kuiri,$tarikh_maklumbalas_kuiri)
	{
		
		/*
		$this->db->select('A.bulan_kkwt, A.tahun_terima,C.kod_ptj, 	C.nama_ptj,C.nama_jabatan,B.tarikh_surat_pemerhatian,B.tarikh_maklumbalas_kuiri, B.status_kuiri ,A.id_penerimaan');
		$this->db->from('penerimaan A');
		$this->db->join('surat_peringatan_kuiri B','A.id_penerimaan = B.id_penerimaan','left');
		$this->db->join('ptj C','A.id_ptj = C.id_ptj','left');
		*/
		
		/*yg betul
		$this->db->select('*');
		$this->db->from('penerimaan A');
		$this->db->join('surat_peringatan_kuiri B','A.id_penerimaan = B.id_penerimaan','left');
		$this->db->join('ptj C','A.id_ptj = C.id_ptj','left');
		$this->db->where('A.tarikh_siap_semak !=',"0000-00-00");
		//('name !=', $name);
		*/
		
				$this->db->select('A.id_penerimaan,A.id_ptj, A.bulan_kkwt, A.tahun_terima, C.nama_ptj, B.tarikh_surat_pemerhatian, B.tarikh_maklumbalas_kuiri, B.status_kuiri, C.id_user, C.kod_ptj, C.nama_ptj, C.nama_jabatan, A.tarikh_siap_semak');
		$this->db->from('penerimaan A');
		$this->db->join('surat_peringatan_kuiri B','A.id_penerimaan = B.id_penerimaan','left');
		$this->db->join('ptj C','A.id_ptj = C.id_ptj','left');
		$this->db->where('A.tarikh_siap_semak !=',"0000-00-00");
		$this->db->order_by('A.id_penerimaan','DESC');
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('C.id_user',$id_sess_pengguna);
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		//if ada tarikh_surat_pemerhatian
		if(!empty($tarikh_surat_pemerhatian) && ($tarikh_surat_pemerhatian)==1){
			$this->db->where('B.tarikh_surat_pemerhatian is NOT NULL', NULL, FALSE);
		}
		//if tiada tarikh_surat_pemerhatian
		if(!empty($tarikh_surat_pemerhatian) && ($tarikh_surat_pemerhatian)==2){
			$this->db->where('B.tarikh_surat_pemerhatian is NULL', NULL, FALSE);
		}
		//if ada tarikh_maklumbalas_kuiri
		if(!empty($tarikh_maklumbalas_kuiri) && ($tarikh_maklumbalas_kuiri)==1){
			$this->db->where('B.tarikh_maklumbalas_kuiri !=', 0000-00-00);
		}
		//if tiada tarikh_maklumbalas_kuiri
		if(!empty($tarikh_maklumbalas_kuiri) && ($tarikh_maklumbalas_kuiri)==2){
			$this->db->where('B.tarikh_maklumbalas_kuiri', 0000-00-00);
		}
		
		//if pilih Ada kuiri
		if(!empty($status_kuiri) && ($status_kuiri)==1){
			$this->db->where('B.status_kuiri', 1);
		}
		//if pilih tiada kuiri
		if(!empty($status_kuiri) && ($status_kuiri)==2){
			$this->db->where('B.status_kuiri', 2);
		}
		//if penerimaan mmg tiada dlm table surat_peringatan_kuiri
		if(!empty($status_kuiri) && ($status_kuiri)==3){
			$this->db->where('B.status_kuiri is NULL', NULL, FALSE);
		}


  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function status_dat($perPage,$uri,$kod_ptj,$bulan_kkwt,$tahun_terima,$nama_ptj)
	{
		//list kan semua data di table surat_peringatan_kuiri yang ada kuiri (status kuiri = 1)
		$this->db->select('*');			
		$this->db->from('surat_peringatan_kuiri');
		$this->db->join('penerimaan','surat_peringatan_kuiri.id_penerimaan = penerimaan.id_penerimaan');
		$this->db->join('ptj','penerimaan.id_ptj = ptj.id_ptj');
		$this->db->where('surat_peringatan_kuiri.status_kuiri',1);
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj.id_user',$id_sess_pengguna);
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}



  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
	
	
	function semakan_kuiri_xjadi($perPage,$uri,$kod_ptj,$bulan_kkwt,$tahun_terima,$nama_ptj)
	{
		
		
		/*
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		//$this->db->join('surat_peringatan_kuiri','penerimaan.id_penerimaan = surat_peringatan_kuiri.id_penerimaan');
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj.id_user',$id_sess_pengguna);
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		} */
		
			$q = "SELECT
				penerimaan.id_penerimaan AS id_penerimaan,
				penerimaan.tarikh_terima AS tarikh_terima,
				penerimaan.bulan_kkwt AS bulan_kkwt,
				penerimaan.tahun_terima AS tahun_terima,
				NULL as tarikh_surat_pemerhatian,
				NULL as tarikh_maklumbalas_kuiri,
				ptj.kod_ptj AS kod_ptj,
				ptj.nama_ptj AS nama_ptj,
				ptj.nama_jabatan AS nama_jabatan
				FROM penerimaan
				LEFT JOIN ptj ON penerimaan.id_ptj = ptj.id_ptj
				
				UNION

				SELECT
				surat_peringatan_kuiri.id_penerimaan AS id_penerimaan,
				penerimaan.tarikh_terima AS tarikh_terima,
				penerimaan.bulan_kkwt AS bulan_kkwt,
				penerimaan.tahun_terima AS tahun_terima,
				tarikh_surat_pemerhatian AS tarikh_surat_pemerhatian,
				tarikh_maklumbalas_kuiri AS tarikh_maklumbalas_kuiri,
				ptj.kod_ptj AS kod_ptj,
				ptj.nama_ptj AS nama_ptj,
				ptj.nama_jabatan AS nama_jabatan
				FROM surat_peringatan_kuiri
				LEFT JOIN
				penerimaan on surat_peringatan_kuiri.id_penerimaan = penerimaan.id_penerimaan
				LEFT JOIN
				ptj ON penerimaan.id_ptj = ptj.id_ptj";

		$query = $this->db->query($q);
		//$this->db->from($q);
		//$this->db->get();
		//$this->db->get()->result();
		
		//$getData = $query->get->('', $perPage, $uri);
		//$data['list'] = [$query][$perPage][$uri];
		
		//$this->db->get();
		
		/*if($q->num_rows() > 0)
			return $q->result_array();
		else
			return null;*/

		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	
	
	function surat_peringatan($kod_ptj,$bulan_kkwt,$tahun_terima)
	{
		if(isset($_POST['submit']))
		{
		
			if($bulan_kkwt != 'ALL' && !empty($tahun_terima)){
				$query = "select id_ptj,kod_ptj,nama_ptj,negeri from ptj p1 where p1.id_ptj not in (
				SELECT ptj.id_ptj FROM ptj
				inner join penerimaan ON ptj.id_ptj = penerimaan.id_ptj where bulan_kkwt='".$bulan_kkwt."' and tahun_terima='".$tahun_terima."')";	
				
			}
		}else{
			$query = "select id_ptj,kod_ptj,nama_ptj,negeri from ptj p1 where p1.id_ptj not in (
			SELECT ptj.id_ptj FROM ptj
			inner join penerimaan ON ptj.id_ptj = penerimaan.id_ptj)";	
		}
		$q = $this->db->query($query);
		  
		//$getData = $this->db->get('');

		if($q->num_rows() > 0)
			return $q->result_array();
		else
			return null;
	}
		function surat_pertanyaan($perPage,$uri,$nama_ptj,$bulan_kkwt,$tahun_terima)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		
		
		//carian
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->like('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->like('tahun_terima',$tahun_terima);
		}
		
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function surat_pertanyaan_todo($perPage,$uri,$id_ptj,$bulan,$tahun_kuiri)
	{
		
		
		 
		$this->db->select('*');			
		$this->db->from('senarai_kuiri');
		$this->db->where('senarai_kuiri.id_ptj',$id_ptj);
		$this->db->where('senarai_kuiri.bulan_kkwt_kuiri',$bulan);
		$this->db->where('senarai_kuiri.tahun_kuiri',$tahun_kuiri);
		$this->db->join('kuiri1','senarai_kuiri.id_q1 = kuiri1.id_q1');
		$this->db->join('kuiri2','senarai_kuiri.id_q2 = kuiri2.id_q2');
		$this->db->join('kuiri3','senarai_kuiri.id_q3 = kuiri3.id_q3');
		
		//carian
	
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function maklumbalas_kuiri($perPage,$uri,$tahun_kuiri,$bulan_kkwt_kuiri,$kod_ptj)
	{
		
		
		 
		 
        $this->db->select('*');			
		$this->db->from('senarai_kuiri');
		$this->db->join('kuiri1','senarai_kuiri.id_q1 = kuiri1.id_q1');
		$this->db->join('kuiri2','senarai_kuiri.id_q2 = kuiri2.id_q2');
		$this->db->join('kuiri3','senarai_kuiri.id_q3 = kuiri3.id_q3');
		$this->db->join('ptj','ptj.id_ptj = senarai_kuiri.id_ptj');
		
		if(!empty($tahun_kuiri)){
			$this->db->where('tahun_kuiri',$tahun_kuiri);
		}
		if(!empty($bulan_kkwt_kuiri)){
			$this->db->where('bulan_kkwt_kuiri',$bulan_kkwt_kuiri);
		}
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}else{
			$this->db->where('kod_ptj','x');
		}
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
	

	function senarai_pejabat_pemungut($perPage,$uri,$nama_penuh,$saiz_ptj,$nama_jabatan)
	{
		
		$this->db->select('*');			
		$this->db->from('user');	
		$this->db->join('ptj','ptj.id_user = user.id_user');
		
		if($nama_penuh != 'Pilih'){
			$this->db->where('nama_penuh',$nama_penuh);
		}
		else if($saiz_ptj != 'Pilih'){
			$this->db->where('saiz_ptj',$saiz_ptj);
		}
		else if(($nama_jabatan != '')){
					$this->db->like('nama_jabatan',$nama_jabatan);		
				}else{
					
				}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
		function jumlah_pejabat_pemungut($perPage,$uri,$nama,$saiz_ptj,$nama_jabatan)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('ptj','ptj.id_user = user.id_user');
		
		if($nama != 'Pilih'){
			$this->db->where('nama',$nama);
		}
		else if($saiz_ptj != 'Pilih'){
			$this->db->where('saiz_ptj',$saiz_ptj);
		}
		else if(($nama_jabatan != '')){
					$this->db->like('nama_jabatan',$nama_jabatan);		
				}else{
					
				}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	//-----------------------PENERIMAAN KKWT------------------------------------------
	function penerimaan_zon_all($perPage,$uri,$zon)
	{
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('ptj','ptj.cipta_oleh = user.id_user');
		
		if($nama != 'Pilih'){
			$this->db->where('zon',$zon);
		}
		//else if($saiz_ptj != 'Pilih'){
			//$this->db->where('saiz_ptj',$saiz_ptj);
		//}
		//else if(($nama_jabatan != '')){
					//$this->db->like('nama_jabatan',$nama_jabatan);		
				//}
				else{
					
				}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function keseluruhan_penerimaan()
	{
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('ptj','ptj.cipta_oleh = user.id_user');
		
		
		$getData = $this->db->get('');

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function convert_date_db($date)//00-00-0000
	{
		$explode_mula = explode("-", $date);
			$d = $explode_mula[0];
			$m = $explode_mula[1];
			$y = $explode_mula[2];
			 //echo $a;
			return  $y."-".$m."-".$d;
		
		
		
	}
	
	
		function laporan_semakan($perPage,$uri,$nama,$saiz_ptj,$nama_jabatan)
	{
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('ptj','ptj.cipta_oleh = user.id_user');
		
		if($nama != 'Pilih'){
			$this->db->where('nama',$nama);
		}
		else if($saiz_ptj != 'Pilih'){
			$this->db->where('saiz_ptj',$saiz_ptj);
		}
		else if(($nama_jabatan != '')){
					$this->db->like('nama_jabatan',$nama_jabatan);		
				}else{
					
				}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function penerimaan_jumlah_pejabat_pemungut($perPage,$uri,$nama,$saiz_ptj,$nama_jabatan)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('user');
		$this->db->join('ptj','ptj.cipta_oleh = user.id_user');
		
		if($nama != 'Pilih'){
			$this->db->where('nama',$nama);
		}
		else if($saiz_ptj != 'Pilih'){
			$this->db->where('saiz_ptj',$saiz_ptj);
		}
		else if(($nama_jabatan != '')){
					$this->db->like('nama_jabatan',$nama_jabatan);		
				}else{
					
				}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	//--------------------END PENERIMAAN KKWT------------------
	
	function cetak_surat_peringatan ($perPage,$uri,$nama_ptj,$bulan_kkwt,$tahun_terima,$nama_penyemak)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('surat_peringatan','surat_peringatan.id_ptj = ptj.id_ptj');
		$this->db->order_by('surat_peringatan.id_surat_peringatan','DESC');	
		
		//carian
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->like('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->like('tahun_terima',$tahun_terima);
		}
		
		if(!empty($nama_penyemak)){
			$this->db->like('nama_penyemak',$nama_penyemak);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function cetak_surat_peringatan_maklumbalas_ketidakpatuhan($perPage,$uri,$kod_ptj,$bulan_kkwt,$tahun_terima,$nama_ptj,$tarikh_surat_pemerhatian,$status_kuiri,$tarikh_maklumbalas_kuiri)
	{
		
		/*
		$this->db->select('A.bulan_kkwt, A.tahun_terima,C.kod_ptj, 	C.nama_ptj,C.nama_jabatan,B.tarikh_surat_pemerhatian,B.tarikh_maklumbalas_kuiri, B.status_kuiri ,A.id_penerimaan');
		$this->db->from('penerimaan A');
		$this->db->join('surat_peringatan_kuiri B','A.id_penerimaan = B.id_penerimaan','left');
		$this->db->join('ptj C','A.id_ptj = C.id_ptj','left');
		*/
		
		/*yg betul
		$this->db->select('*');
		$this->db->from('penerimaan A');
		$this->db->join('surat_peringatan_kuiri B','A.id_penerimaan = B.id_penerimaan','left');
		$this->db->join('ptj C','A.id_ptj = C.id_ptj','left');
		$this->db->where('A.tarikh_siap_semak !=',"0000-00-00");
		//('name !=', $name);
		*/
		
		$this->db->select('A.id_penerimaan,A.id_ptj, A.bulan_kkwt, A.tahun_terima, C.nama_ptj, B.tarikh_surat_pemerhatian, B.tarikh_maklumbalas_kuiri, B.id_surat_peringatan_kuiri, B.status_kuiri, A.id_user, C.kod_ptj, C.nama_ptj, C.nama_jabatan, A.tarikh_siap_semak, C.nama_penyemak, B.spk1, B.spk2, B.spk3, B.catatan');
		$this->db->from('penerimaan A');
		$this->db->join('surat_peringatan_kuiri B','A.id_penerimaan = B.id_penerimaan','left');
		$this->db->join('ptj C','A.id_ptj = C.id_ptj','left');
		$this->db->join('user D','A.id_user = D.id_user','left');
		$this->db->where('A.tarikh_siap_semak !=',"0000-00-00");
		$this->db->order_by('A.id_penerimaan','DESC');
		
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('A.id_user',$id_sess_pengguna);
			
			
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		//if ada tarikh_surat_pemerhatian
		if(!empty($tarikh_surat_pemerhatian) && ($tarikh_surat_pemerhatian)==1){
			$this->db->where('B.tarikh_surat_pemerhatian is NOT NULL', NULL, FALSE);
		}
		//if tiada tarikh_surat_pemerhatian
		if(!empty($tarikh_surat_pemerhatian) && ($tarikh_surat_pemerhatian)==2){
			$this->db->where('B.tarikh_surat_pemerhatian is NULL', NULL, FALSE);
		}
		//if ada tarikh_maklumbalas_kuiri
		if(!empty($tarikh_maklumbalas_kuiri) && ($tarikh_maklumbalas_kuiri)==1){
			$this->db->where('B.tarikh_maklumbalas_kuiri !=', 0000-00-00);
		}
		//if tiada tarikh_maklumbalas_kuiri
		if(!empty($tarikh_maklumbalas_kuiri) && ($tarikh_maklumbalas_kuiri)==2){
			$this->db->where('B.tarikh_maklumbalas_kuiri', 0000-00-00);
		}
		
		//if pilih Ada kuiri
		if(!empty($status_kuiri) && ($status_kuiri)==1){
			$this->db->where('B.status_kuiri', 1);
		}
		//if pilih tiada kuiri
		if(!empty($status_kuiri) && ($status_kuiri)==2){
			$this->db->where('B.status_kuiri', 2);
		}
		//if penerimaan mmg tiada dlm table surat_peringatan_kuiri
		if(!empty($status_kuiri) && ($status_kuiri)==3){
			$this->db->where('B.status_kuiri is NULL', NULL, FALSE);
		}


  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
	
	
	
	
	
	function pengemaskinian_penerimaan($perPage,$uri,$bulan_kkwt,$tahun_terima,$nama_ptj,$kod_ptj)
	{
		
		
		
		$this->db->select('*');
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		//carian
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
	
	function pengemaskinian_ptj($perPage,$uri,$kod_ptj,$nama_ptj)
	{
		
		
		
		$this->db->select('ptj.kod_ptj as kod_ptj,ptj.nama_ptj as nama_ptj,ptj.id_ptj as id_ptj,ptj.status_aktif as status_aktif,user.nama_penuh as nama_penuh');			
		$this->db->from('ptj');
		$this->db->join('user','ptj.id_user = user.id_user','left');
		
		
		
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function pengemaskinian_pengguna($perPage,$uri,$nama,$level,$status)
	{
		
	
		$this->db->select('*');			
		$this->db->from('user');
		//$this->db->join('ptj','ptj.id_user = user.id_user');
		//carian
		if(!empty($nama)){
			$this->db->like('nama',$nama);
		}
		if(!empty($level)){
			$this->db->where('level',$level);
		}
		if($status != 'pilih'){
			$this->db->where('status',$status);
		}
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function pengemaskinian_kuiri($perPage,$uri,$q1)
	{
		
	
		$this->db->select('*');			
		$this->db->from('kuiri1');
		//$this->db->join('ptj','ptj.id_user = user.id_user');
		//carian
		
		if(!empty($q1)){
			$this->db->like('q1',$q1);
		}
		
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function pengemaskinian_jenis_kuiri($perPage,$uri,$q2,$id_q1)
	{
		
	
		$this->db->select('*');			
		$this->db->from('kuiri2');
		$this->db->where('id_q1',$id_q1);
		
		
		if(!empty($q2)){
			$this->db->like('q2',$q2);
		}
		
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function pengemaskinian_sub_kuiri($perPage,$uri,$q3,$id_q2)
	{
		
	
		$this->db->select('*');			
		$this->db->from('kuiri3');
		$this->db->where('id_q2',$id_q2);
		
		
		if(!empty($q2)){
			$this->db->like('q2',$q2);
		}
		
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function senarai_penerimaan($perPage,$uri,$kod_ptj,$bulan_kkwt,$tahun_terima)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->join('penerimaan','penerimaan.id_ptj = ptj.id_ptj');
		
		
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function senarai_PP($perPage,$uri,$nama,$level)
	{
		
	
		$this->db->select('*');			
		$this->db->from('user');
		//$this->db->join('ptj','ptj.id_user = user.id_user');
		//carian
		if(!empty($nama)){
			$this->db->like('nama',$nama);
		}
		if(!empty($level)){
			$this->db->where('level',$level);
		}
		
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function list_user_ptj($id_user)
	{
		
		
		$this->db->select('*');			
		$this->db->from('ptj');
		$this->db->where('ptj.id_user',$id_user);
		//$this->db->join('user','user.id_user = ptj.id_user');
	
		
		
		$getData = $this->db->get('');

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function senarai_assign_pengguna($perPage,$uri,$nama_assign)
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
			
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;		
		
	} 

	function assign_pengguna_ptj($perPage,$uri,$kod_jabatan)
	{
		
		
			
		$this->db->select('*');			
		$this->db->from('ptj');
		
		
			
		//carian
		if(!empty($kod_jabatan)){
			$this->db->where('kod_jabatan',$kod_jabatan);
		}
		
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
	
	function list_kod_masalah($perPage,$uri)
	{
		
		
		
		$this->db->select('status_bancian.status_bancian as status_bancian,kod_masalah.masalah as masalah,kod_masalah.id_kod_masalah as id_kod_masalah');			
		$this->db->from('kod_masalah');
		$this->db->join('status_bancian', 'status_bancian.id_status_bancian = kod_masalah.status_bancian');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function jenis_peralatan($perPage,$uri)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('jenis_peralatan');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function peralatan($perPage,$uri)
	{
		
		
		
		$this->db->select('peralatan.id_peralatan as id_peralatan,peralatan.peralatan as peralatan,jenis_peralatan.jenis_peralatan as jenis_peralatan');			
		$this->db->from('peralatan');
		$this->db->join('jenis_peralatan', 'jenis_peralatan.id = peralatan.jenis_peralatan');
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function kursus($perPage,$uri)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('kursus');
		
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function pemohon($perPage,$uri,$negeri,$daerah,$parlimen,$dun)
	{
		
		$this->db->select('*');			
		$this->db->from('pemohon');
		//$this->db->join('data_baru', 'data_baru.id = pemohon.id_data_baru');
		$this->db->join('status_bancian', 'status_bancian.id_status_bancian = pemohon.status_bancian','LEFT');
		$this->db->join('pengguna', 'pengguna.id = pemohon.id_pembanci','LEFT');
		$this->db->order_by('pemohon.nama','ASC');
		//$this->db->where('pemohon.status_bancian',4);
		//$this->db->where('pemohon.id_pembanci',0);
		//if($negeri !=0){
			if(!empty($negeri)){
				$this->db->where('pemohon.negeri',$negeri);
			}
		//}
		
		if(!empty($daerah)){
			$this->db->where('pemohon.daerah',$daerah);
		}
		if(!empty($parlimen)){
			$this->db->where('pemohon.parlimen',$parlimen);
		}
		if(!empty($dun)){
			$this->db->where('pemohon.dun',$dun);
		}
		//$this->db->where('pemohon.id_pembanci',0);
		$level = $this->session->userdata('sess_level');
		 $id = $this->session->userdata('sess_id');
		if($level==2){
			$this->db->where('pemohon.id_pembanci',$id);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function update_data($table,$id,$data,$field_key)
	{
		$this->db->where($field_key,$id);
		$this->db->update($table, $data); 
	}
	
	function check_user($username, $password) 
	{
		$this->db->where('nama',$username);
		$this->db->where('kata_laluan',$password);
		//$this->db->where('status',1);
		$query = $this->db->get('user');
		
		if($query->num_rows() > 0) {		
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function getcountry_edit(){
		$result = array();
		$this->db->select('*');
		$this->db->from('status_bancian');
		//$this->db->order_by('negeri','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
			
            $result[0]= '-Pilih Status-';
            $result[$row->id_status_bancian]= $row->status_bancian;
        }

        return $result;
	}
	
	
	
	function get_list_jenis_peralatan(){
		$result = array();
		$this->db->select('*');
		$this->db->from('jenis_peralatan');
		//$this->db->order_by('negeri','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
			
            $result[0]= '-Pilih Status-';
            $result[$row->id]= $row->jenis_peralatan;
        }

        return $result;
	}
	
	function pemohon_peralatan($id){
		$result = array();
		$this->db->select('*');
		$this->db->from('pemohon_peralatan');
		$this->db->join('peralatan','pemohon_peralatan.id_peralatan=peralatan.id_peralatan');
		$this->db->where('id_pemohon',$id);
		$this->db->where('id_pemohon',$id);
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
			
            //$result[0]= '-Pilih Status-';
            $result[$row->id]= $row->peralatan;
        }

        return $result;
	}
	
	function list_jenis_peralatan()
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('jenis_peralatan');
		
		  
		$getData = $this->db->get('');

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
	function get_kod_masalah($status_bancian){
		//$country_id = $this->input->post('country_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('kod_masalah');
		$this->db->where('status_bancian',$status_bancian);
		$this->db->order_by('status_bancian','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Kod Status-';
            $result[$row->id_kod_masalah]= $row->masalah;
        }

        return $result;
	}
	
	function select_peralatan(){
		$country_id = $this->input->post('country_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('peralatan');
		$this->db->where('jenis_peralatan',$country_id);
		//$this->db->order_by('daerah','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            //$result[0]= '-Pilih Peralatan-';
            $result[$row->id_peralatan]= $row->peralatan;
        }

        return $result;
	}
	
	
	function pemohon_gallery($id)
	{
		
		
		
		$this->db->select('*');	
		$this->db->where('id_pemohon',$id);			
		$this->db->from('pemohon_gallery');
		
		  
		$getData = $this->db->get('');

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function getprovince(){
		$country_id = $this->input->post('country_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('kuiri2');
		$this->db->where('id_kuiri1',$country_id);
		$this->db->order_by('q1','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Kuiri-';
            $result[$row->id_q1]= $row->quiri1;
        }

        return $result;
	}

	//------------------------------------------------------------model pengguna PPH------------------------------------------------------
	
	
	function penerimaan_pph($perPage,$uri,$kod_ptj,$nama_ptj)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj_pph');
		$this->db->join('user','user.id_user = ptj_pph.id_user');
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
	
	
			function pengemaskinian_penerimaan_pph($perPage,$uri,$bulan_kkwt,$tahun_terima,$nama_ptj)
	{
		
		
		
		$this->db->select('*');
		$this->db->from('ptj_pph');
		$this->db->join('penerimaan_pph','penerimaan_pph.id_ptj = ptj_pph.id_ptj');
		//carian
		if(!empty($bulan_kkwt)){
			$this->db->like('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
		function semakan_pph($perPage,$uri,$kod_ptj,$tahun_terima,$bulan_kkwt,$nama_ptj)
	{
		$this->db->select('*');
		$this->db->from('penerimaan_pph');
		$this->db->join('ptj_pph','penerimaan_pph.id_ptj = ptj_pph.id_ptj','left');
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj_pph.id_user',$id_sess_pengguna);
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}



  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
			function surat_peringatan_pph($kod_ptj,$bulan_kkwt,$tahun_terima)
	{
		if(isset($_POST['submit']))
		{
		
			if($bulan_kkwt != 'ALL' && !empty($tahun_terima)){
				$query = "select id_ptj,kod_ptj,nama_ptj,negeri from ptj_pph p1 where p1.id_ptj not in (
				SELECT ptj_pph.id_ptj FROM ptj_pph
				inner join penerimaan_pph ON ptj_pph.id_ptj = penerimaan_pph.id_ptj where bulan_kkwt='".$bulan_kkwt."' and tahun_terima='".$tahun_terima."')";	
				
			}
		}else{
			$query = "select id_ptj,kod_ptj,nama_ptj,negeri from ptj_pph p1 where p1.id_ptj not in (
			SELECT ptj_pph.id_ptj FROM ptj_pph
			inner join penerimaan_pph ON ptj_pph.id_ptj = penerimaan_pph.id_ptj)";	
		}
		$q = $this->db->query($query);
		  
		//$getData = $this->db->get('');

		if($q->num_rows() > 0)
			return $q->result_array();
		else
			return null;
	}
	
		function cetak_surat_peringatan_pph($perPage,$uri,$nama_ptj,$bulan_kkwt,$tahun_terima)
	{
		
		
		
		$this->db->select('*');			
		$this->db->from('ptj_pph');
		$this->db->join('surat_peringatan_pph','surat_peringatan_pph.id_ptj = ptj_pph.id_ptj');
		
		//carian
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		if(!empty($bulan_kkwt)){
			$this->db->like('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($tahun_terima)){
			$this->db->like('tahun_terima',$tahun_terima);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}


	
	
		function pengemaskinian_kod_hasil_pph($perPage,$uri,$id_jabatan,$kod_hasil)
	{
		
		
		
		$this->db->select('*');
		$this->db->from('kod_hasil_pph');
		
		//carian
		if(!empty($id_jabatan)){
			$this->db->where('id_jabatan',$id_jabatan);
		}
		if(!empty($kod_hasil)){
			$this->db->where('kod_hasil',$kod_hasil);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
		function pengemaskinian_ptj_pph($perPage,$uri,$kod_ptj,$nama_ptj)
	{
		
		
		
		$this->db->select('ptj_pph.kod_ptj as kod_ptj,ptj_pph.nama_ptj as nama_ptj,ptj_pph.id_ptj as id_ptj,ptj_pph.status_aktif as status_aktif,user.nama_penuh as nama_penuh');			
		$this->db->from('ptj_pph');
		$this->db->join('user','ptj_pph.id_user = user.id_user','left');
		
		
		
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->where('kod_ptj',$kod_ptj);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	
			function semakan_todo_pph($perPage,$uri,$id)
	{
		
		$this->db->select('*');    
		$this->db->from('semakan_kod_hasil_pph');
		$this->db->join('kod_hasil_pph', 'semakan_kod_hasil_pph.id_kod_hasil = kod_hasil_pph.id_kod_hasil');
		//$this->db->join('permohonan', 'jilid.id_permohonan = permohonan.id_permohonan');
		$this->db->where('semakan_kod_hasil_pph.id_penerimaan', $id);
		$this->db->order_by('semakan_kod_hasil_pph.id_semakan_kod_hasil_pph');	
		  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function list_daerah(){
		$id_negeri = $this->input->post('id_negeri');
		$result = array();
		$this->db->select('*');
		$this->db->from('kod_hasil');
		$this->db->where('kod_hasil',$id_negeri);
		$this->db->order_by('kod_hasil','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Keterangan-';
            $result[$row->keterangan]= $row->keterangan;
        }

        return $result;
	}
	
	
	function kuiri_pph($perPage,$uri,$kod_ptj,$tahun_terima,$bulan_kkwt,$nama_ptj)
	
	{
		$this->db->select('*');			
		$this->db->from('ptj_pph');
		$this->db->join('penerimaan_pph','penerimaan_pph.id_ptj = ptj_pph.id_ptj');
		
		if( $this->session->userdata('sess_level') != 1){
			$id_sess_pengguna = $this->session->userdata('sess_id');
			$this->db->where('ptj_pph.id_user',$id_sess_pengguna);
		}
		
		//carian
		if(!empty($kod_ptj)){
			$this->db->like('kod_ptj',$kod_ptj);
		}
		if(!empty($tahun_terima)){
			$this->db->where('tahun_terima',$tahun_terima);
		}
		if(!empty($bulan_kkwt)){
			$this->db->where('bulan_kkwt',$bulan_kkwt);
		}
		if(!empty($nama_ptj)){
			$this->db->like('nama_ptj',$nama_ptj);
		}



  
		$getData = $this->db->get('',$perPage, $uri);

		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
		
	function list_kod_hasil($id_jab){
		$result = array();
		$this->db->select('*');
		$this->db->from('kod_hasil');
		$this->db->where('id_jabatan',$id_jab);
		$this->db->order_by('kod_hasil','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
			
            $result[0]= '-Pilih Kod Hasil-';
            $result[$row->kod_hasil]= $row->kod_hasil;
        }

        return $result;
	}

	
//------------------------------------------------------------model pengguna PPH------------------------------------------------------


}

