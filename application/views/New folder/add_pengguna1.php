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
						<?php if($act == "add"){ ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>index.php/main/add_pengguna1_proses/" method="post" name="myForm" onSubmit="return validateForm()">
						<?php }else{ ?>
						<form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_pengguna_proses" method="post" name="myForm" >
						<?php } ?>
                            <div class="mws-form-inline">					         
                            </div>
                          <div class="mws-form-row">
                              <div class="mws-form-cols">
                                <div class="mws-form-col-4-8">
                                  <label class="mws-form-label">Nama<span class="required"></span></label>
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
                                <label class="mws-form-label">No.Telefon Bimbit<span class="required">*</span></label>
                                <div class="mws-form-item">
                                  <input type="text" name="no_tel_bimbit" value="<?php if(!empty($no_tel_bimbit)){echo $no_tel_bimbit;}?>">
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
                          
                          <div class="mws-form-row bordered">
                    <label class="mws-form-label">Peranan <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                       
                                      <input type="text" name="email_ketua" value="<?php $level = $this->session->userdata('sess_level');
						if($level==1){ echo "Ketua Jabatan"; }
							
							else if($level==2){ echo "Ketua Projek"; }
							
									else if($level==3){ echo "Ahli Pasukan"; }
											
											else if($level==4){ echo "Urusetia"; }
												
												else if($level==5){ echo "Administrator"; }
							
											else{ echo "Ralat"; } ?>">
                                       
</div>
                          </div>
                               
                               
                            
<div class="mws-button-row">
                    			<input type="submit" value="Hantar" class="btn btn-danger">
								<input type="hidden"  name="key" value="<?php if(!empty($id_user)){echo $id_user;}?>" >
                    			<input type="reset" value="Batal" class="btn ">
                                 <a href="<?php echo base_url();?>/index.php/main/add_pengguna"> <input type="submit" value="Pendaftaran Projek" class="btn  mws-login-button"></a>
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
