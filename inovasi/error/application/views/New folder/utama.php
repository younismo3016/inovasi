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
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jui/css/jquery.ui.timepicker.css" media="screen">
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
                
            	
            	  	 <!-- ########################################### Start Panel carian ################################################ -->
                
                <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Statistik Surat Terbuka / Sulit</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="<?php //echo base_url();?>index.php/statistik" method="post">
                    		<div class="mws-form-inline">
                    			
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">Tarikh Mula <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                    	<input type="text" class="mws-datepicker" name="tarikh_terima_mula" readonly="readonly">
                                    </div>
                                </div>
								<div class="mws-form-row">
                                    <label class="mws-form-label">Tarikh Hingga <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                    	<input type="text" class="mws-datepicker" name="tarikh_terima_hingga" readonly="readonly">
                                    </div>
                                </div>
                                
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Tarikh</label>
                                    <div class="mws-form-item">
                                    	<input type="text" class="mws-datepicker large" name="tarikh_mohon" readonly="readonly">
                                    </div>
                                </div>
                                
                          
								
                               
                    		<div class="mws-button-row">
                    			<input type="submit" value="Carian" name="carian" class="btn btn-danger">
                    			<a class="btn btn-primary" target="blank" href="<?php //echo base_url();?>index.php/statistik/cetak_statistik_surat_terbuka/<?php //echo $tarikh_terima_mula; ?>/<?php //echo $tarikh_terima_hingga; ?>"><i class="icon-print icon-white"></i><span class="hidden-tablet"> Cetak </span></a>
                               
                    </div>
                    		
                    	</form>
                    </div>    	
                </div>
                  </div>
	 <!-- ########################################### End Panel carian ################################################ -->
     
      <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> STATISTIK PENDAFTARAN SURAT TERBUKA/SULIT</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th align="left">STATISTIK</th>
                                    <th width="600">BILANGAN</th>
                                </tr>
                            </thead>
                                   <tbody>
           
                                <tr>
                                    <td>Surat Terbuka</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                                 <tr>
                                    <td>Surat Sulit</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                                 <tr>
                                    <td>Surat Rahsia</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Surat Rahsia Besar</td>
                                    <td align="center">&nbsp;</td>
                                </tr> 
                                <tr>
                                    <td>Surat Terhad</td>
                                    <td align="center">&nbsp;</td>
                                </tr>                                  
                                <tr>
                                      <td>Jumlah Keseluruhan</td>
                                      <td align="center">&nbsp;</td>
                                     </tr>
                       
           
                            </tbody>
                            
                        </table>
                    </div>
                </div>
				
                <div class="mws-panel grid_4 mws-collapsible">
                	<div class="mws-panel-header">
                    	<span>Collapsible Panel</span>
                    </div>
                    <div class="mws-panel-body">
                        <p>Lorem </p>
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
