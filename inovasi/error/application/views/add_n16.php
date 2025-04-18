<?php $this->load->view('top');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/ibutton/jquery.ibutton.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins//css/prettyPhoto.css" media="screen">
<link rel="stylesheet" type="text/css" href="plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="plugins/prettyphoto/css/prettyPhoto.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mws-style.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/themer.css" media="screen">
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
                	

                	
                  <?php 
		$level = $this->session->userdata('sess_level');	
		
 ?>       
                	
                    
                	
                
                <!-- Panels Start -->
                 <!-- Panels Start -->
                 
                 <a href="<?php echo base_url();?>index.php/main/laporan_inovasi/<?php echo $id_projek; ?>"<button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Kembali</button></a>
                  
                  </p>
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> <span><i class="icon-table"></i> Kemaskini Laporan</span> </div>
                  <div class="mws-panel-body no-padding">
                  
                    <table class="mws-table">
                      <thead>
                        
                           <?php if($act == "add"){ ?>
                        
                        <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/add_n16_proses/" method="post" name="myForm" onSubmit="return validateForm()" enctype="multipart/form-data">
                        <?php }else{ ?>
              <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_n16_proses/" method="post" name="myForm" onSubmit="return validateForm()" enctype="multipart/form-data">
                        <?php } ?>
                          <th width="139">KRITERIA</th>
                          <th width="436">Huraian</th>
                          
                          <th width="134">Tindakan</th>
                       
                        
                      
                      </thead>
                      
                      <tbody>
                        <tr>
                        	
                          <td><p> SENTUHAN KEPADA RAKYAT  </p></td>
                          <td>  <div class="mws-form-item">
                                	 <textarea rows="" id=""  cols=""  name="n16" style="width: 500px; height: 200px;"  ><?php if(!empty($n16)){echo $n16;}?></textarea>
                                </div>
                                
                                </td>
                                   <td>
                                 <?php if($level == "5" || $level == "4"  ){ ?>

                          <?php }else{  ?>
                          
                           <?php if(($status =='1')&&($level == "2")){  ?>
                          <div class="mws-button-row">
                                    											<?php if($act=='add'){  ?>
						 <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Simpan</button>
                               <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                               													<?php }else{  ?>
                               
                                  </div>
                                   <div class="mws-form-row">
                                    	
                            </div>
                                    
                          <div class="mws-button-row">
                           <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Kemaskini </button>
                                <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>"></a>
								<?php }  ?>
                                
                                 <?php }else{  ?>
               		
                   <?php }?>
                   
                   
                    
                               <?php }  ?> 
                               </td>
                
                          
                        </tr>
                         <tr>
                          
                          <td></td>
                          <td>  
                              
                            </td>
                            
                            </td>
                                
                                
                                
                                
                             </td> 
                               
                          
                        
                          <td> 
                          
                       
                               
                             </form>     
                                
                                
                                
                            </div>
                                
               		 </td>
                      <?php if(!empty($id_markah_inovasi)){  ?>
                  <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_markah_n16_proses/" method="post" name="myForm" onSubmit="return validateForm()" >
                           <?php }else{  ?>
                  <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/add_markah_n16_proses/" method="post" name="myForm" onSubmit="return validateForm()" >       
                           
                           <?php }  ?>
                        </tr>
                        <tr>
                        <?php if($level=='4'){  ?>    
                          <td><p>Markah</p></td>
                          <td><div class="mws-form-col-3-8">
                               
                                <div class="mws-form-item">
                                  <input type="number" name="markah_n16" value="<?php if(!empty($markah_n16)){echo $markah_n16;}?>" min="0" max="10">
                                /10</div>
                              </div>  </td> 
                               
                          
                        
                          <td> 
                            <?php if(!empty($id_markah_inovasi)){  ?>
                          <div class="mws-form-row">
                                    	
                            </div>
                                    
                          <div class="mws-button-row">
                               <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Kemaskini Markah</button>
                                <input  name="id_projek" id="id_projek" type="hidden" value="<?php echo $id_projek; ?>">
                                <input  name="key" id="key" type="hidden" value="<?php echo $id_markah_inovasi; ?>">
                              
                                <?php }else{  ?>
                               
                               <div class="mws-button-row">
                                 <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Simpan Markah</button>
                                
                            
                               <input  name="id_projek" id="id_projek" type="hidden" value="<?php echo $id_projek; ?>">
                                
                               
                               
                               <?php }  ?>
                               
                               
                               
                               
                               
                                <?php }
								
								else{  ?>          <?php }  ?>	
                                
                               
                                
                                
                                
                            </div>
                                
               		 </td>
                
                          
                        </tr>
                        
                      </tbody>
                      
                      
                     </form>    
                    </table>
                  </div>
                  
                </div>
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> <span><i class="icon-table"></i>Muat naik Lampiran</span></div>
                  <div class="mws-panel-body no-padding">
                    <table width="307" class="mws-table">
                      <thead>
                        
                          
                          <th width="218">Tindakan</th>
                          <th width="77">Lampiran</th>
                           
                        
                       
                        
                      
                      <?php if($act == "add"){ ?>
                        
                        <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/add_n16_proses/" method="post" name="myForm" onSubmit="return validateForm()" enctype="multipart/form-data">
                        <?php }else{ ?>
              <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_upload_n16_proses/" method="post" name="myForm" onSubmit="return validateForm()" enctype="multipart/form-data">
                        <?php } ?>
                      
                      <tbody>
                        <tr>
                        	
                          <td><div class="mws-form-row">
                            <label class="mws-form-label"></label>
                            <div class="mws-form-item">
                           <?php if($level == "5" || $level == "4"  ){ ?>
                          
                          
                          		<?php }else{  ?>
                            
                            <p>    <?php if(($status =='1')&&($level == "2")){  ?>
                              <input type="file" name="picture">
                            </div>
                          </div>                            
                           <div class="mws-button-row">
                                    <?php if($act=='add'){  ?>
					  <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Upload</button>
                               <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                              
                            </td>
                            
                            </td>
                                <?php }else{  ?>
                                
                                
                                
                                </div>
                                   <div class="mws-form-row">
                                    	
                            </div>
                                    
                          <div class="mws-button-row">
                           <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Upload</button>
                      
                                <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>"></a><?php }  ?>
                                
                                 <?php }else{  ?>
               		
                   <?php }?></td>
                   <?php }?>
                           <td>
        
        
          	 <a href="<?php echo base_url();?>uploads/<?php echo $image1_n16; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n16)){echo $image1_n16;}?></a>
                                 
                          </td>
                          
                          
                
                          
                        </tr>
                           
                         
                        </form> 
                
                          
                       
                       
                      </tbody>
                      
                      </form>
                    </table>
                  </div>
                   
                </div>
              
                
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
 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.table.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.xhtml.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.icon.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.formelements.js"></script>
       <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.gallery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.widget.js"></script>

</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
