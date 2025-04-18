<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:26 GMT -->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/imgareaselect/css/imgareaselect-default.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/jgrowl/jquery.jgrowl.css" media="screen">


<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mws-style.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>jui/css/jquery.ui.timepicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themer.css" media="screen">



<title><?php $this->load->view('nama_sistem');?></title>

</head>

<body>

	
	
	<!-- Header -->
	<?php $this->load->view('header');?>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
        	
            
             <!-- Main Navigation -->
            <?php $this->load->view('left_menu');?>
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	
                	

                	
                    
                	
                    
                	
                
                <!-- Panels Start -->
                
                
					
				<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Maklumat Ketua Organisasi</span>
                    </div>
                    <div class="mws-panel-body no-padding">
						<?php if(!empty($id_user))
                          {?>
                          <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_senarai_ketua_proses" method="post" name="myForm" >
                    	
						<?php }else{ ?>
                        <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/add_ketua_organisasi/" method="post" name="myForm" onSubmit="return validateForm()">
						
						<?php } ?>
                            <div class="mws-form-inline">					         
                            </div>
                          <div class="mws-form-row">
                              <div class="mws-form-cols">
                                <div class="mws-form-col-4-8">
                                  <label class="mws-form-label">Nama Ketua Organisasi<span class="required"></span></label>
                                  <div class="mws-form-item">
                                    <input type="text" name="nama_penuh"  value="<?php if(!empty($nama_penuh)){echo $nama_penuh;}?>">
                                  </div>
                                </div>
                                <div class="mws-form-col-3-8">
                                  <label class="mws-form-label">Email <span class="required">*</span></label>
                                  <div class="mws-form-item">
                                    <input type="text" name="email" value="<?php if(!empty($email)){echo $email;}?>">
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-4-8">
                                <label class="mws-form-label">Jawatan</label>
                                <div class="mws-form-item">
                                  <input type="text" name="jawatan" value="<?php if(!empty($jawatan)){echo $jawatan;}?>">
                                </div>
                              </div>
                              <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Gred<span class="required"></span></label>
                                <div class="mws-form-item">
                                  <input type="text" name="gred" value="<?php if(!empty($gred)){echo $gred;}?>">
                                </div>
                              </div>
                            </div>
                          </div>
                         
                      <div class="mws-form-row">
                                <div class="mws-form-cols">
                                  <div class="mws-form-col-3-8">
                                    <label class="mws-form-label">No.Telefon Pejabat<span class="required">*</span></label>
                                        <div class="mws-form-item">
                                            <input type="text" name="no_tel" value="<?php if(!empty($no_tel)){echo $no_tel;}?>">
                                        </div>
                                  </div>
                            </div>
                          </div>
                          <div class="mws-button-row">
                            <?php if(!empty($id_user))
                          {?>
                   			    
     							<input type="submit" value="Kemaskini" class="btn btn-danger">     
								<input type="hidden"  name="key" value="<?php if(!empty($id_user)){echo $id_user;}?>" >
                    			<input type="reset" value="Batal" class="btn ">
                                
                                
                                <?php } else {?> 
                                
                               
                                
                                
                                <input type="submit" value="Simpan" class="btn btn-primary">
								<input type="hidden"  name="key" value="<?php if(!empty($id_user)){echo $id_user;}?>" >
                    			<input type="reset" value="Batal" class="btn ">
                              <?php } ?>
                              
                              
                          </div>
                        </form>
                    </div>
                </div>
				
                
                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
            	<?php $this->load->view('footer');?>
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.placeholder.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom-plugins/fileinput.min.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery.ui.touch-punch.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/colorpicker/colorpicker-min.js"></script>

    <!-- Core Script -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="<?php echo base_url(); ?>assets/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="<?php echo base_url(); ?>assets/js/demo/demo.table.js"></script>
	
	 <!-- JavaScript Plugins -->
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.placeholder.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom-plugins/fileinput.min.js"></script>

    <!-- jQuery-UI Dependent Scripts -->
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/js/timepicker/jquery-ui-timepicker.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="<?php echo base_url(); ?>assets/plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jgrowl/jquery.jgrowl-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/validate/jquery.validate-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/colorpicker/colorpicker-min.js"></script>

    <!-- Core Script -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="<?php echo base_url(); ?>assets/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="<?php echo base_url(); ?>assets/js/demo/demo.widget.js"></script>

</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
