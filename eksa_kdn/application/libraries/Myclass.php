<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/******************************************************
	Mohd Norizi Bin Abd Manah
	NRZ GLOBAL SOLUTION
	nrzsolution@gmail.com

*******************************************************/



class Myclass {

    public function check_login()
    {
		$CI =& get_instance();	
		$CI->load->library('session');
		
		$logged_in = $CI->session->userdata('logged_in');
			
		//jika belum login ke page login
		if($logged_in==FALSE){
			redirect('main/login');
			$CI->session->set_flashdata('flash_error', 'Sila login terlebih dahulu!');
				 
			//jika telah login check  capaian modul yang boleh dicapai
		}
    }
	
	function create_combobox($name,$dbobj,$key,$value,$extra='',$edit='')
		{
			$select = '<select class="select" name="'.$name.'" '.$extra.'>';
			$select .= '<option value="">-Sila Pilih-</option>';
			foreach($dbobj->result() as $row)
			{
				$selected = '';
				if($edit!='')
				{
					if($row->$key == $edit)
					{
						$selected = "selected='selected'";
					}
				}
				$select .= '<option value="'.$row->$key.'" '.$selected.'>'.$row->$value.'</option>';
			}
			$select .= '</select>';
			return $select;
		}
}



/* End of file Someclass.php */