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
                
            	      
				
				<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Maklumat Ketua Projek</span>
                    </div>
                    <div class="mws-panel-body no-padding">
						
                    	<form class="mws-form" action="">
						
						
						
                            <div class="mws-form-inline">					         
                            </div>
                          <div class="mws-form-row">
                              <div class="mws-form-cols">
                                <div class="mws-form-col-4-8">
                                  <label class="mws-form-label">Tajuk Projek<span class="required"></span></label>
                                  <div class="mws-form-item">
                                    <input type="text" name="tajuk_projek"  value="<?php if(!empty($tajuk_projek)){echo $tajuk_projek;}?>">
                                  </div>
                                </div>
                                <div class="mws-form-col-3-8">
                                  <label class="mws-form-label">Pertandingan<span class="required">*</span></label>
                                  <div class="mws-form-item">
                                    <select class="required" name="pertandingan">
										<option value="1">Anugerah Inovasi KDN</option>
                                        <option value="2">KIK KDN</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-4-8">
                                <label class="mws-form-label">Bidang</label>
                                <div class="mws-form-item">
                                  <select class="required" name="bidang">
										<option value="1">Inovasi Sosial</option>
                                        <option value="2">Inovasi Penyampaian Perkihidmatan</option>
                                  </select>
                                </div>
                              </div>
                              <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Kategori<span class="required"></span></label>
                                <div class="mws-form-item">
                                  <select class="required" name="kategori">
									<option value="1">Inovasi Penciptaan</option>
                                    <option value="2">Inovasi Penambahbaikan</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-4-8">
                                <label class="mws-form-label">Nama Kumpulan</label>
                                <div class="mws-form-item">
                                  <input type="text" name="nama_kumpulan" value="<?php if(!empty($bidang)){echo $bidang;}?>">
                                </div>
                              </div>
                              <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Negeri<span class="required"></span></label>
                                <div class="mws-form-item">
                            <select class="required" name="negeri">
										<option value="">---Sila Pilih---</option>
                                            <?php foreach ($list_negeri->result() as $row){ ?>
                                            <option value="<?php echo $row->id_adm_negeri; ?>"<?php if(!empty($id_adm_negeri)){ if($id_adm_negeri == $row->id_adm_negeri){echo "selected";}}?>><?php echo $row->negeri; ?></option>
                                            <?php } ?>
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
                                  <input type="text" name="cawangan" value="<?php if(!empty($cawangan)){echo $cawangan;}?>">
                                </div>
                              </div>
                             <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Jabatan<span class="required"></span></label>
                                <div class="mws-form-item">
                            <select class="required" name="jabatan">
										<option value="">---Sila Pilih---</option>
                                            <?php foreach ($list_jabatan->result() as $row){ ?>
                                            <option value="<?php echo $row->id_jabatan; ?>"<?php if(!empty($id_jabatan)){ if($id_jabatan == $row->id_jabatan){echo "selected";}}?>><?php echo $row->nama_jabatan; ?></option>
                                            <?php } ?>
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
                                            <input type="text" name="alamat1" value="<?php if(!empty($alamat1)){echo $alamat1;}?>">
                                        </div>
                                  </div>
                            </div>
                          </div>
                          <div class="mws-form-row">
                                <div class="mws-form-cols">
                                  <div class="mws-form-col-3-8">
                                    <label class="mws-form-label">Alamat 2<span class="required">*</span></label>
                                        <div class="mws-form-item">
                                            <input type="text" name="alamat2" value="<?php if(!empty($alamat2)){echo $alamat2;}?>">
                                        </div>
                                  </div>
                            </div>
                          </div>
                          <div class="mws-form-row">
                                <div class="mws-form-cols">
                                  <div class="mws-form-col-3-8">
                                    <label class="mws-form-label">Alamat 3<span class="required">*</span></label>
                                        <div class="mws-form-item">
                                            <input type="text" name="alamat3" value="<?php if(!empty($alamat3)){echo $alamat3;}?>">
                                        </div>
                                  </div>
                            </div>
                          </div>
                          
                          
                               
                               
                            
<div class="mws-button-row">
								  <?php if(!empty($id_projek))
                          {?>
                  <a href="<?php echo base_url();?>/index.php/main/daftar_projek_proses"> <input type="submit" value="Simpan" class="btn  btn-primary"></a>
								<input type="hidden"  name="key" value="<?php if(!empty($id_user)){echo $id_user;}?>" >
                    			<input type="reset" value="Batal" class="btn ">
                                 
                                 <?php } else {?>
                                 
                                 
                  <a href="<?php echo base_url();?>/index.php/main/edit_projek_proses"> <input type="submit" value="Kemaskini" class="btn  btn-danger"></a>
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
