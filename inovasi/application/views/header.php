<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<?php $this->load->view('header_logo');?>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
        	
            
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
            	<!-- User Photo -->
            	<div id="mws-user-photo">
                	<!--<img src="<?php //echo base_url(); ?>assets/example/KDN.png" alt="User Photo">-->
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Selamat Datang, (<?php echo $this->session->userdata('sess_nama_penuh'); ?>)
                    </div>
                    <ul>
                    	
                        <li><a href="<?php echo base_url();?>index.php/main/logout">Log Keluar</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>