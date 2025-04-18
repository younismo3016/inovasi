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
                    	<span><i class="icon-table"></i> Maklumat Inovasi</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <tbody>
                            <tr>
                                    <td width="88"><strong>Nama Ketua Projek</strong></td>
                                    <td width="125"><?php echo $nama_ketua_projek; ?></td>
                                    <td width="68"><strong>Nama Ketua Organisasi</strong></td>
                                    <td width="226"><?php echo $nama_ketua_organisasi; ?></td>
                                    
                                    
                                    
                              </tr>
                                <tr>
                                    <td width="88"><strong>Tajuk Projek</strong></td>
                                    <td width="125"><?php echo $tajuk_projek; ?></td>
                                    <td width="68"><strong>Nama Kumpulan</strong></td>
                                    <td width="226"><?php echo $nama_kumpulan; ?></td>
                                    
                                    
                                    
                                </tr>
                                <tr>
                                  <td><strong>Jabatan</strong></td>
                                  <td><?php echo get_jabatan($jabatan) ; ?></td>
                                    <td><strong>Negeri</strong></td>
                                    <td><?php echo get_negeri($negeri) ; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td><strong>Pertandingan</strong></td>
                                    <td><?php echo get_pertandingan($pertandingan) ; ?></td>
                                    <td><strong>Alamat</strong></td>
                                    <td><?php echo $alamat1; ?><?php echo $alamat2; ?><?php echo $alamat3; ?></td>
                                   
                                </tr>
                                <tr>
                                    <td><strong>Cawangan</strong></td>
                                    <td><?php echo $cawangan; ?></td>
                                     <td><strong>Tindakan</strong></td>
                                    <td>
                                    
                             <?php if(($level == 1 || $level == 4) ){  ?>
                             
                    		
                    			<a href="<?php echo base_url();?>index.php/main/pengesahan_status/<?php echo $id_projek; ?>"<input type="submit" value="Pengesahan Projek" name="submit" class="btn btn-danger">Pengesahan Projek</a>
                                
                              <a href="<?php echo base_url();?>index.php/main/kemaskini_semula_laporan/<?php echo $id_projek; ?>""<input type="submit" value="Papar Laporan Projek" name="submit" class="btn btn-primary">Kemaskini Semula</a>
                    			
                               <?php }else{  ?>
                    
                                  
                                <?php }  ?>
                                <a href="<?php echo base_url();?>index.php/main/laporan_inovasi/<?php echo $id_projek; ?>"<input type="submit" value="Papar Laporan Projek" name="submit" class="btn btn-primary">Papar Laporan Projek</a>
                                  <a href="<?php echo base_url();?>index.php/main/ringkasan_projek/<?php echo $id_projek; ?>" target="_blank"<input type="submit" value="Cetak" name="submit" class="btn btn-primary"><i class="icol-printer"></i>Cetak</a>
                            </tbody>
                        </table>
                    
                    		
                </div> 	
               
              </div>
           
           
           
           
                	<div class="mws-panel-header">
                    	
                        
                         
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Senarai Ahli Pasukan</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
                                    <th width="19">Bil</th>
                                    <th width="58">Nama</th>
                                    <th width="68">Peranan</th>
                                    <th width="59">E-mail</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							
								<?php
								
							$bil=1;
							 foreach($list->result() as $row) {
							?>
							
                                <tr>
                                    <td><?php echo $bil++; ?></a></td>
                                    <td><?php echo $row->nama_ahli; ?></td>
                                    <td><?php echo get_status_peranan($row->level); ?></td>
                                    <td><?php echo $row->email; ?></td>
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
