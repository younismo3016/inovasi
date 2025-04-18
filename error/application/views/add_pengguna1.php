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
                    
                    
                    <?php if($level=='1'){  ?> 
                    
                    
                      <div class="mws-panel grid_8">
                	<div class="mws-panel-header"><span><i class="icon-table"></i>Utama</span></label></span></label></div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="<?php echo base_url();?>index.php/main/utama" method="post">
                        <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                    		<div class="mws-form-inline">
                    			
                    			<div class="mws-form-row">
                                <div class="mws-form-cols">
                                   
                                  <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Tajuk Projek : <span class="required">*</span></label>
                              <div class="mws-form-item">
                                            <input type="text" name="tajuk_projek" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mws-form-row">
                                <div class="mws-form-cols">
                                   
                                  <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Tahun : <span class="required">*</span></label>
                              <div class="mws-form-item">
                                            <input type="text" name="tahun" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
								<div class="mws-form-row">
                                <div class="mws-form-cols">
                                   
                                  <div class="mws-form-row bordered">
                                    <label class="mws-form-label">Status Projek <span class="required">*</span></label>
                              <div class="mws-form-item">
                                            <select class="required" name="status">
                                            <option></option>
							        <option value="1">Projek Baru</option>
								 <option value="2">Pengesahan Ketua Organisasi</option>
                                  <option value="3">Telah Disahkan</option>
                                   <option value="4">Menunggu Kelulusan Laporan Ketua Organisasi</option>
                                    <option value="5">Menunggu Kelulusan Laporan Urusetia</option>
                                     <option value="6">Telah Dihantar ke Urusetia</option>
                                     
                                 
                                    </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
								
                               
                    		<div class="mws-button-row">
                    			<input type="submit" value="Hantar" name="submit" class="btn btn-danger">
                    			
                               
                    </div>
                    		
                    	</form>
                    </div>    	
                </div>
                  </div>
                  
	 <!-- ########################################### End Panel carian ################################################ -->
     
      
                	<div class="mws-panel-header">
                	  <div class="mws-panel-header">
                	    <div class="mws-panel grid_8">
                	      <div class="mws-panel-header"> <span><i class="icon-table"></i> Senarai Projek</span> </div>
                	      <div class="mws-panel-body no-padding">
                	        <table class="mws-datatable-fn mws-table">
                	          <thead>
                	            <tr>
                	              <th width="19">Bil</th>
                	              <th width="59">Tajuk Projek</th>
                	              <th width="88">Nama   Kumpulan</th>
                	              <th width="42">Status</th>
                	              <th width="70">Tindakan</th>
                	              <th width="70">Kemaskini Semula</th>
              	              </tr>
              	            </thead>
                	          <tbody>
                	            <?php
								
							$bil=1;
							 foreach($list2->result() as $row) {
							?>
                	            <tr>
                	              <td><?php echo $bil++; ?></a></td>
                	              <td><?php echo $row->tajuk_projek; ?></td>
                	              <td><?php echo $row->nama_kumpulan; ?></td>
                	              <td align="center"><span class="badge badge-success"><?php echo get_status_projek($row->status); ?></span></td>
                	              <td class="actions" ><center>
                	                <span class="btn-group"> <a href="<?php echo base_url();?>index.php/main/view_projek/<?php echo $row->id_projek; ?>" class="btn btn-small" title="papar"><i class="icon-search"></i></a> <a href="<?php echo base_url();?>index.php/main/edit_daftar_projek/<?php echo $row->id_projek; ?>" class="btn btn-small" title="kemaskini"><i class="icon-pencil"></i></a> <a href="#" class="btn btn-small"><i class="icon-trash"></i></a> </span></td>
                	              <td class="actions" ><center>
                	                <a href="<?php echo base_url();?>index.php/main/kemaskini_semula_laporan/<?php echo $row->id_projek; ?>"> Hantar</a></td>
              	              </tr>
                	            <?php } ?>
              	            </tbody>
              	          </table>
              	        </div>
              	      </div>
                	    <!-- Panels End -->
              	    </div>
                	  <?php }else{  ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
				
			  <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                   	  <span><?php if($level == "1"){ ?>Maklumat Ketua Organisasi<?php }else{ ?> Maklumat Ketua Projek<?php } ?></span></div>
                    <div class="mws-panel-body no-padding">
						<?php if($act == "add"){ ?>
                    	<form class="mws-form" form id="mws-validate" action="<?php echo base_url(); ?>index.php/main/add_pengguna_proses/" method="post" name="myForm" onSubmit="return validateForm()">
						<?php }else{ ?>
						<form class="mws-form" form id="mws-validate" action="<?php echo base_url(); ?>index.php/main/edit_pengguna_proses" method="post" name="myForm" onSubmit="return validateForm()" >
						<?php } ?>
                        <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                            <div class="mws-form-inline">					         
                            </div>
                          <div class="mws-form-row">
                              <div class="mws-form-cols">
                                <div class="mws-form-col-4-8">
                                  <label class="mws-form-label">Nama<span class="required">*</span></label>
                                  <div class="mws-form-item">
               <input type="text" name="nama_penuh" id="nama_penuh"  value="<?php if(!empty($nama_penuh)){echo $nama_penuh;}?>" onChange="javascript:this.value=this.value.toUpperCase();" class="required">
                                  </div>
                                </div>
                                <div class="mws-form-col-3-8">
                                  <label class="mws-form-label">Email <span class="required">*</span></label>
                                  <div class="mws-form-item">
                                 <input type="text" name="email" value="<?php if(!empty($email)){echo $email;}?>" class="required email large" >
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-4-8">
                                <label class="mws-form-label">Jawatan<span class="required">*</span></label>
                                <div class="mws-form-item">
                       <input type="text" name="jawatan" id="jawatan" onChange="javascript:this.value=this.value.toUpperCase();" value="<?php if(!empty($jawatan)){echo $jawatan;}?>" class="required">
                                </div>
                              </div>
                              <div class="mws-form-col-3-8">
                                <label class="mws-form-label">Skim/Gred<span class="required">*</span></label>
                                <div class="mws-form-item">
                                  <input type="text" name="gred" id="gred" onChange="javascript:this.value=this.value.toUpperCase();" placeholder="Contoh : M41" value="<?php if(!empty($gred)){echo $gred;}?>" class="required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mws-form-row">
                            <div class="mws-form-cols">
                              <div class="mws-form-col-3-8">
                                <label class="mws-form-label">No.Telefon Bimbit<span class="required">*</span></label>
                                <div class="mws-form-item">
                                  <input type="text" name="no_tel_bimbit" value="<?php if(!empty($no_tel_bimbit)){echo $no_tel_bimbit;}?>" class="required digits large">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mws-form-row">
                                <div class="mws-form-cols">
                                  <div class="mws-form-col-3-8">
                                    <label class="mws-form-label">No.Telefon Pejabat<span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <input type="text" name="no_tel" value="<?php if(!empty($no_tel)){echo $no_tel;}?>" class="required digits large">
                                    </div>
                                  </div>
                            </div>
                          </div>
                          
                          <div class="mws-form-row bordered">
                    <label class="mws-form-label">Peranan <span class="required"></span></label>
                                    <div class="mws-form-item">
                                       
                                      <input type="text" name="peranan" readonly="readonly" value="<?php $level = $this->session->userdata('sess_level');
						if($level==1){ echo "Ketua Organisasi"; }
							
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
                                
                   		  </div>
                        </form>
                    </div>
                </div>
                 <?php }  ?>
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
