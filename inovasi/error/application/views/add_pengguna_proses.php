<?php $this->load->view('top');?>

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
                <div class="mws-panel grid_8">
                	<div class="mws-panel-header"></div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="<?php echo base_url();?>index.php/main/add_pengguna_proses" method="post">
                    		<div class="mws-form-inline">
                    			
                    			<div class="mws-form-row">
                                <div class="mws-form-cols">
                                   
                                  <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Nama : <span class="required">*</span></label>
                              <div class="mws-form-item">
                                            <input type="text" name="jawatan" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
								<div class="mws-form-row">
                                <div class="mws-form-cols">
                                   
                                  <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Emel<span class="required">*</span></label>
                              <div class="mws-form-item">
                                            <input type="text" name="emel" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
								
                               
                    		<div class="mws-button-row">
                    			<input type="submit" value="Carian" name="carian" class="btn btn-danger">
                 <a class="btn btn-primary" target="blank" href="" <i class="icon-print icon-white"></i><span class="hidden-tablet"> Cetak </span></a>
                               
                    </div>
                    		
                    	</form>
                    </div>    	
                </div>
                  </div>
                  
	 <!-- ########################################### End Panel carian ################################################ -->
     
      
                	<div class="mws-panel-header">
                    	
                        
                         
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Senarai Projek</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
                                    <th width="19">Bil</th>
                                    <th width="44">Nama Pegawai</th>
                                    <th width="68">Jawatan</th>
                                    <th width="42">Emel</th>
                                    <th width="77">Tindakan</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							
								<?php
								
							$bil=1;
							 foreach($list->result() as $row) {
							?>
							
                                <tr>
                                    <td><?php echo $bil++; ?></a></td>
                                    <td><?php //echo $row->nama_penuh; ?></td>
                                    <td><?php echo $row->jawatan; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                   
                                  
                                    <td class="actions" ><center>
									<a href="<?php echo base_url();?>index.php/main/edit_daftar_projek/<?php //echo $row->id_projek; ?>"><img src="<?php echo base_url();?>assets/images/edit.ico" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                                    <a href="<?php echo base_url();?>index.php/main/view_projek/<?php //echo $row->id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
									
									</td>
                                </tr>
                                
                                  <?php } ?>
                             
                               
                            </tbody>
                            
                        </table>
                        
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fileinput.js"></script>

<!-- jQuery-UI Dependent Scripts -->
<script type="text/javascript" src="<?php echo base_url();?>assets/jui/js/jquery-ui-1.8.20.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jui/js/jquery.ui.timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jui/js/jquery.ui.touch-punch.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/spinner/ui.spinner.min.js"></script>

<!-- Plugin Scripts -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/duallistbox/jquery.dualListBox-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jgrowl/jquery.jgrowl-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/prettyphoto/js/jquery.prettyPhoto.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="plugins/flot/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.stack.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/colorpicker/colorpicker-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/tipsy/jquery.tipsy-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/sourcerer/Sourcerer-1.2-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/validate/jquery.validate-min.js"></script>

<!-- Core Script -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/mws.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/mws.wizard.js"></script>

<!-- Themer Script (Remove if not needed) -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/themer.js"></script>

<!-- Demo Scripts (remove if not needed) -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.js"></script>


</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
