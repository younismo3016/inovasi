<?php

class MY_Controller extends CI_Controller
{

	function __construct()
	{
		// call the model constructor
		parent::__construct();
		$CI=& get_instance();
		
		$sess_nama_penuh=$this->session->userdata('sess_nama_penuh');
		if (empty($sess_nama_penuh)){
			//$this->session->set_flashdata('flash_error','Harap maaf!! Sila login semula untuk capaian ke sistem ini. Terima Kasih');
			redirect('/login/');
		}
	}
}