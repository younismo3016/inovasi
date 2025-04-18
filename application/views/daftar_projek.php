<?php $this->load->view('top');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/custom-plugins/wizard/wizard.css" media="screen">
<link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/custom-plugins/picklist/picklist.css" media="screen">
<link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/plugins/select2/select2.css" media="screen">

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
                    	<?php if($act == "add"){ ?>
                    	<span>Tambah Projek</span>
                        <?php }else{ ?>
                        <span>Kemaskini Projek</span>
                       <?php } ?>
                    </div>
                    <div class="mws-panel-body no-padding">
						
                    	 <?php if($act == "add"){ ?>
	          <form class="mws-form" form id="mws-validate" action="<?php echo base_url(); ?>index.php/main/daftar_projek_proses" method="post" name="myForm"  >
	          <?php }else{ ?>
	          <form class="mws-form" form id="mws-validate" action="<?php echo base_url(); ?>index.php/main/edit_projek_proses" method="post" name="myForm" >
	            <?php } ?>
						
						
						
                            
                                                          
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Nama Ketua Jabatan<span class="required">* sila buat carian</span></label>
                                        <div class="mws-form-item">
                                            <select class="mws-select2 small" name="id_ketua_organisasi" id="id_ketua_organisasi" >
                                            <option value = "">---Carian Ketua Jabatan---</option>
                                                <?php foreach($ketua_organisasi->result() as $row):?>
                                                
							     <option value="<?php echo $row->id_user; ?>" <?php if ($act=='edit')
										  {  if($id_user==$row->id_user) { echo "selected"; } } ?>  ><?php echo $row->nama_penuh; ?>  
                                 </option>
									<?php endforeach; echo id_user?> 	
                                            </select>
                                        </div>
                                    </div>
                                  
                            <div class="mws-form-inline">					         
                            </div>
                          <div class="mws-form-row">
                              <div class="mws-form-cols">
                                <div class="mws-form-col-4-8">
                                  <label class="mws-form-label">Tajuk Projek<span class="required">*</span></label>
                                  <div class="mws-form-item">
                                    <input type="text" name="tajuk_projek" id="tajuk_projek"  value="<?php if(!empty($tajuk_projek)){echo $tajuk_projek;}?>" class="required" >
                                  </div>
                                </div>
                                <div class="mws-form-col-3-8">
                                  <label class="mws-form-label">Pertandingan<span class="required">*</span></label>
                                  <div class="mws-form-item">
                                    <select class="required" name="pertandingan" id="pertandingan">
										
                                        
							        <option value="1"<?php if ($act=='edit'){  if($pertandingan=='1') { echo "selected"; } } ?>>Anugerah Inovasi KDN</option>
								 
                                    </select>
                                  </div>
                                </div>
                              </div>
                          </div>
                        
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-4-8">
                                <label class="mws-form-label">Nama Kumpulan<span class="required">*</span></label>
                                <div class="mws-form-item"> 
                                  <input type="text" name="nama_kumpulan" id="nama_kumpulan" value="<?php if(!empty($nama_kumpulan)){echo $nama_kumpulan;}?>" class="required" >
                                </div>
                              </div>
                               <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Jabatan<span class="required">*</span></label>
                                <div class="mws-form-item">
                            <select class="required" name="jabatan">
										<option value="">---Sila Pilih---</option>
                    <option value="1"  <?php if ($act=='edit'){  if($jabatan=='1') { echo "selected"; } } ?>>PDRM</option>
                    <option value="2"  <?php if ($act=='edit'){  if($jabatan=='2') { echo "selected"; } } ?>>JIM</option>
                    <option value="3"  <?php if ($act=='edit'){  if($jabatan=='3') { echo "selected"; } } ?>>JPPM</option>
                    <option value="4"  <?php if ($act=='edit'){  if($jabatan=='4') { echo "selected"; } } ?>>JPN</option>
                    <option value="5"  <?php if ($act=='edit'){  if($jabatan=='5') { echo "selected"; } } ?>>JPM</option>
                    <option value="6"  <?php if ($act=='edit'){  if($jabatan=='6') { echo "selected"; } } ?>>KDN</option>
                    <option value="7"  <?php if ($act=='edit'){  if($jabatan=='7') { echo "selected"; } } ?>>AADK</option>
                    <option value="9"  <?php if ($act=='edit'){  if($jabatan=='9') { echo "selected"; } } ?>>RELA</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                </div>
                             
                          
                         <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-4-8">
                                <label class="mws-form-label">Cawangan</label>
                                <div class="mws-form-item">
                                  <input type="text" name="cawangan" id="cawangan" value="<?php if(!empty($cawangan)){echo $cawangan;}?>" >
                                </div>
                              </div>
                              
                               <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Negeri<span class="required"></span></label>
                                <div class="mws-form-item">
                            <select class="required" name="negeri" id="negeri">
										<option value="">---Sila Pilih---</option>
                    <option value="1"  <?php if ($act=='edit'){  if($negeri=='1') { echo "selected"; } } ?>>JOHOR</option>
                    <option value="2"  <?php if ($act=='edit'){  if($negeri=='2') { echo "selected"; } } ?>>KEDAH</option>
                    <option value="3"  <?php if ($act=='edit'){  if($negeri=='3') { echo "selected"; } } ?>>KELANTAN</option>
                    <option value="4"  <?php if ($act=='edit'){  if($negeri=='4') { echo "selected"; } } ?>>MELAKA</option>
                    <option value="5"  <?php if ($act=='edit'){  if($negeri=='5') { echo "selected"; } } ?>>NEGERI SEMBILAN</option>
                    <option value="6"  <?php if ($act=='edit'){  if($negeri=='6') { echo "selected"; } } ?>>PAHANG</option>
                    <option value="7"  <?php if ($act=='edit'){  if($negeri=='7') { echo "selected"; } } ?>>PULAU PINANG</option>
                    <option value="8"  <?php if ($act=='edit'){  if($negeri=='8') { echo "selected"; } } ?>>PERAK</option>
                    <option value="9"  <?php if ($act=='edit'){  if($negeri=='9') { echo "selected"; } } ?>>PERLIS</option>
                    <option value="10"  <?php if ($act=='edit'){  if($negeri=='10') { echo "selected"; } } ?>>SELANGOR</option>
                    <option value="12"  <?php if ($act=='edit'){  if($negeri=='12') { echo "selected"; } } ?>>SABAH</option>
                    <option value="13"  <?php if ($act=='edit'){  if($negeri=='13') { echo "selected"; } } ?>>SARAWAK</option>
                    <option value="14"  <?php if ($act=='edit'){  if($negeri=='14') { echo "selected"; } } ?>>W.P. KUALA LUMPUR</option>   
                    <option value="16"  <?php if ($act=='edit'){  if($negeri=='16') { echo "selected"; } } ?>>W.P. PUTRAJAYA</option>
                    <option value="127"  <?php if ($act=='edit'){  if($negeri=='127') { echo "selected"; } } ?>>TERENGGANU</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                            
                              
                         <div class="mws-form-row">
                            <div class="mws-form-cols">
                               <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Alamat 1<span class="required">*</span></label>
                                <div class="mws-form-item">
                                 <input type="text" name="alamat1" id="alamat1" value="<?php if(!empty($alamat1)){echo $alamat1;}?>" class="required" >
                                </div>
                              </div>
                              
                               <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Poskod<span class="required">*</span></label>
                                <div class="mws-form-item">
                              <input type="text" name="poskod" id="poskod" value="<?php if(!empty($poskod)){echo $poskod;}?>" class="required digits large" >
                                </div>
                              </div>
                            </div>
                          </div>
                            
                        
                          <div class="mws-form-row">
                                <div class="mws-form-cols">
                                  <div class="mws-form-col-3-8">
                                    <label class="mws-form-label">Alamat 2<span class="required"></span></label>
                                    <div class="mws-form-item">
                                        <input type="text" name="alamat2" value="<?php if(!empty($alamat2)){echo $alamat2;}?>">
                                    </div>
                                  </div>
                            </div>
                          </div>
                <div class="mws-form-row">
                                <div class="mws-form-cols">
                                  <div class="mws-form-col-3-8">
                                    <label class="mws-form-label">Alamat 3<span class="required"></span></label>
                                    <div class="mws-form-item">
                                        <input type="text" name="alamat3" value="<?php if(!empty($alamat3)){echo $alamat3;}?>">
                                    </div>
                                  </div>
                            </div>
                          </div>
                          
                          
                          
                          
                         
                <div class="mws-button-row">
               
							<?php if($act == "add"){ ?>
                             <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                                <input type="submit" value="Simpan" class="btn  btn-primary">
								<input type="hidden"  name="key" value="<?php if(!empty($id_user)){echo $id_user;}?>" >
                                
                    			<input type="reset" value="Batal" class="btn ">
                             <?php }else{ ?>  
                              <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                   				<input type="submit" value="Kemaskini" class="btn  btn-danger">
								<input type="hidden"  name="key" value="<?php if(!empty($id_projek)){echo $id_projek;}?>" >
                    			<input type="reset" value="Batal" class="btn ">
                             <?php } ?>
       		    </div>
                  </form>
                    </div>
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
<!-- Wizard Plugin -->
<script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugins/wizard/wizard.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugins/wizard/jquery.form.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugins/fileinput.min.js"></script>









 <!-- JavaScript Plugins -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/libs/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/libs/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/libs/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugins/fileinput.min.js"></script>

    <!-- jQuery-UI Dependent Scripts -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/jui/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/jui/js/jquery.ui.touch-punch.min.js"></script>

    <!-- Plugin Scripts -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/colorpicker/colorpicker-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/validate/jquery.validate-min.js"></script>

    <!-- Wizard Plugin -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugins/wizard/wizard.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugins/wizard/jquery.form.min.js"></script>

    <!-- Core Script -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
   
	 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.formelements.js"></script>
    <!-- Themer Script (Remove if not needed) -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.wizard.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.table.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.xhtml.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.icon.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.formelements.js"></script>
   <script src="<?php echo base_url();?>assets/jui/js/jquery-ui-effects.min.js"></script>

    <!-- Plugin Scripts -->
  
</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
   <script language="JavaScript" type="text/javascript">

	var frmvalidator = new Validator("myForm");
	
	frmvalidator.addValidation("id_ketua_organisasi","req","Sila buat cari nama Ketua Organisasi!");
	
	

	
		 	

</script> 