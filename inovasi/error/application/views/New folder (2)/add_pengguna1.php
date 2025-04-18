<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:26 GMT -->
 <?php $this->load->view('top');?>

<body>

	
    <!-- Themer End -->
  <?php $this->load->view('header');?>

    
  <?php $this->load->view('left_menu');?>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	<!-- Statistics Button Container -->
            	<div class="mws-stat-container clearfix">
                	
                   
                
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
                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
            	Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="<?php echo base_url(); ?>js/libs/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>js/libs/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url(); ?>js/libs/jquery.placeholder.min.js"></script>
    <script src="<?php echo base_url(); ?>custom-plugins/fileinput.min.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="<?php echo base_url(); ?>jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="<?php echo base_url(); ?>jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>jui/js/jquery.ui.touch-punch.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/colorpicker/colorpicker-min.js"></script>

    <!-- Core Script -->
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="<?php echo base_url(); ?>js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="js/demo/demo.table.js"></script>

</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
