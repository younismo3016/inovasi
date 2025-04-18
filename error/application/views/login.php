<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:48:45 GMT -->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login.min.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mws-theme.css" media="screen">

<title><?php $this->load->view('nama_sistem');?></title>

</head>

<body>

 <!-- Start: HEADER -->
  <header>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="50%" td align="center"><img src ="<?php echo base_url();?>assets/images/core/bg/esurat_banner3b.jpg" style="position:absolute; top:0px; left:0px; width:100%; max-height:100%; border:0;">		
		</tr>
	</table>
            <div align="center"></div>
  </header>
    <!-- End: HEADER -->
 
   
    <div id="mws-login-wrapper" align="left">
        <div id="mws-login" align="">
            <h1>Log Sistem</h1>
            <div class="mws-login-lock"><i class="icon-lock"></i></div>
            <div id="mws-login-form">
                <form class="mws-form" action="<?php echo base_url();?>index.php/login/login_proses" method="post">
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="text" name="email" name="email" placeholder="email" class="mws-login-username required">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="password" name="kata_laluan" name="kata_laluan"  placeholder="kata laluan" class="mws-login-password required">
                        </div>
                    </div>
                    <div id="mws-login-remember" class="mws-form-row mws-inset">
                      <ul class="mws-form-list inline">
                            <li>
                                <input id="remember" type="checkbox"> 
                                <label for="remember">Kekal Log Masuk</label>
                            </li>
                      </ul>
                        
                       <?php 
					if($this->session->flashdata('flash_success')){
					?>
					<div class="mws-form-message success">
                        <?php echo $this->session->flashdata('flash_success'); ?>
                                
                      </div>
					
					<?php } ?>
					
					<?php 
					if($this->session->flashdata('flash_error')){
					?>
				<div class="mws-form-message error">
                            	<?php echo $this->session->flashdata('flash_error'); ?>
                                
                      </div>
					
					<?php } ?>
                     
                     
                     
          
                     
         
            
                        
                </div>
                    <div class="mws-form-row">
                        <input type="submit" value="Log Masuk" class="btn btn-success mws-login-button">
                    </div>
                    
                  
                </form>
                <div class="mws-form-row">
                        <a href="<?php echo base_url();?>/index.php/login/add_pengguna"> <input type="submit" value="Pendaftaran Projek" class="btn  mws-login-button"></a>
                    </div>
            </div>
        </div>
    </div>
	<!-- Start: FOOTER -->
	<header>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%" td align="center"><img class="fit" src ="<?php echo base_url();?>assets/images/core/bg/footer.jpg" >		
		</tr>
	</table>
            <div align="center"></div>
	</header>
    <!-- End: FOOTER -->
    </div>

    <!-- JavaScript Plugins -->
    <script src="<?php echo base_url();?>assets/js/libs/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/libs/jquery.placeholder.min.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="<?php echo base_url();?>assets/jui/js/jquery-ui-effects.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate-min.js"></script>

    <!-- Login Script -->
    <script src="<?php echo base_url();?>assets/js/core/login.js"></script>

</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:48:47 GMT -->
</html>
