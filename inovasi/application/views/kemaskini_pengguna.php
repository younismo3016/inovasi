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
                	<div class="mws-panel-header">
                   	  <span><?php if($level == "1"){ ?>Kemaskini Pengguna<?php }else{ ?> Tambah Pengguna<?php } ?></span></div>
                    <div class="mws-panel-body no-padding">
						<?php if($act == "add"){ ?>
                    	<form class="mws-form" form id="mws-validate" action="<?php echo base_url(); ?>index.php/main/add_pengguna_proses/" method="post" name="myForm" onSubmit="return validateForm()">
						<?php }else{ ?>
						<form class="mws-form" form id="mws-validate" action="<?php echo base_url(); ?>index.php/main/edit_pengguna_proses2" method="post" name="myForm" >
						<?php } ?>
                            <div class="mws-form-inline">					         
                            </div>
                          <div class="mws-form-row">
                              <div class="mws-form-cols">
                                <div class="mws-form-col-4-8">
                                  <label class="mws-form-label">Nama<span class="required"></span></label>
                                  <div class="mws-form-item">
                                    <input type="text" name="nama_penuh"  value="<?php if(!empty($nama_penuh)){echo $nama_penuh;}?>" class="required">
                                  </div>
                                </div>
                                <div class="mws-form-col-3-8">
                                  <label class="mws-form-label">Email <span class="required">*</span></label>
                                  <div class="mws-form-item">
                                    <input type="text" name="email" value="<?php if(!empty($email)){echo $email;}?>" class="required">
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-4-8">
                                <label class="mws-form-label">Jawatan</label>
                                <div class="mws-form-item">
                                  <input type="text" name="jawatan" value="<?php if(!empty($jawatan)){echo $jawatan;}?>" class="required">
                                </div>
                              </div>
                              <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Skim/Gred<span class="required"></span></label>
                                <div class="mws-form-item">
                                  <input type="text" name="gred" placeholder="Contoh : M41" value="<?php if(!empty($gred)){echo $gred;}?>" class="required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-3-8">
                                <label class="mws-form-label">No.Telefon Bimbit<span class="required">*</span></label>
                                <div class="mws-form-item">
                                  <input type="number" name="no_tel_bimbit" value="<?php if(!empty($no_tel_bimbit)){echo $no_tel_bimbit;}?>" class="required" maxlength="11">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mws-form-row">
                                <div class="mws-form-cols">
                                  <div class="mws-form-col-3-8">
                                    <label class="mws-form-label">No.Telefon Pejabat<span class="required">*</span></label>
                                        <div class="mws-form-item">
                                            <input type="text" name="no_tel" value="<?php if(!empty($no_tel)){echo $no_tel;}?>" class="required">
                                        </div>
                                  </div>
                            </div>
                          </div>
                          
                          <div class="mws-form-row">
                    <label class="mws-form-label">Peranan <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                       
                                  <select class="required"  name="level" id="level">
                                            <option></option>
                                            
                                       <option value="1"<?php if ($act=='edit'){  if($level=='1') { echo "selected"; } } ?>>Ketua  Organisasi</option>
                                       <option value="2"<?php if ($act=='edit'){  if($level=='2') { echo "selected"; } } ?>>Ketua Projek</option>
                                       <option value="4"<?php if ($act=='edit'){  if($level=='4') { echo "selected"; } } ?>>Urusetia</option>
                                       <option value="5"<?php if ($act=='edit'){  if($level=='5') { echo "selected"; } } ?>>Penyelaras Jabatan</option>
  
                                         
							       
                                     
                                 
                                    </select>
</div>
                          </div>
                          
                                  <div class="mws-form-row">
                     <label class="mws-form-label">Jabatan <span class="required">*</span></label>
                              <div class="mws-form-item">
                                           <select class="mws-select2 small" name="jabatan" id="jabatan">
                                           <option value=""></option>
                                                <?php foreach($list_jabatan->result() as $row):?>
							     <option value="<?php echo $row->id_jabatan; ?>" <?php //if ($act=='edit')
										  {  if($id_jabatan==$row->id_jabatan) { echo "selected"; } } ?>  ><?php echo $row->nama_jabatan; ?>  
                                 </option>
									<?php endforeach; echo id_jabatan?> 	
                                            </select>
</div>
                          </div>
                         
                            
<div class="mws-button-row">
                    			<input type="submit" value="Hantar" class="btn btn-danger">
								<input type="hidden"  name="key" value="<?php if(!empty($id_user)){echo $id_user;}?>" >
                    			<input type="reset" value="Batal" class="btn ">
                                
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

<script type="text/javascript">
 $(document).ready(function() {
  $.viewMap = {
    '0' : $([]),
    'view1' : $('#view1'),
    'view2' : $('#view2a, #view2b'),
    'view3' : $('#view3')
  };

  $('#viewSelector').change(function() {
    // hide all
    $.each($.viewMap, function() { this.hide(); });
    // show current
    $.viewMap[$(this).val()].show();
  }).change();
});

</script>

</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
