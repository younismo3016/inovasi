<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendmails extends CI_Controller {

    public function email_mohon(){
        $config = Array(        
            'protocol' => 'sendmail',
            'smtp_host' => 'smtp.moha.gov.my',
            'smtp_port' => 25,
            'smtp_user' => 'myfile@moha.gov.my',
            'smtp_pass' => '',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
		
		$userEmail = 'yunizar@moha.gov.my';
		$subject = 'Permohonan STBM';
        $this->load->library('email', $config);
    	$this->email->set_newline("\r\n");
    
        $this->email->from('yunizar@moha.gov.my', 'yunizar');
        $data = array(
             'userName'=> 'yunizar'
                 );
        $this->email->to($userEmail);  // replace it with receiver mail id
    $this->email->subject($subject); // replace it with relevant subject 
    
        $body = $this->load->view('email_mohon.php',$data,TRUE);
    $this->email->message($body);   
        $this->email->send();
    }
       
}