<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/charts.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:48:47 GMT -->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/imgareaselect/css/imgareaselect-default.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jgrowl/jquery.jgrowl.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mws-style.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jui/css/jquery.ui.timepicker.css" media="screen">
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
            
            	
                	

                	
                    
                	
                     <?php 
		$level = $this->session->userdata('sess_level');	
		
 ?>    
                	
                
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
                	<div class="mws-panel-header"><span><i class="icon-table"></i>Utama</span></label></span></label></div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="<?php echo base_url();?>index.php/main/utama" method="post">
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
                             <?php if($level=='1'){  ?>      
							 
							 
							 
                             
							 <?php }else{  ?>     
                               <?php if($level == 4) { ?>     
                          <div class="mws-form-row">
                                <div class="mws-form-cols">
                                 
                                  <div class="mws-form-row bordered">
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
                                
                                </div>
                            </div>
                                <?php   } ?>
                 <?php }  ?> 
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
                                   <option value="4">Selesai Markah</option>
                                     <option value="7">Tidak Lulus Oleh Ketua Organisasi</option>
                                     
                                 
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
                    	
                        
                         
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Senarai Projek</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
                                    <th width="19">Bil</th>
                                    <th width="59">Tajuk Projek</th>
                                    <th width="88">Nama   Kumpulan</th>
                                    <th width="42">Status</th>
                                    <th width="70">Kemaskini</th>
                                    <th width="70">Tindakan </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							
								<?php
								
							$bil=1;
							 foreach($list2->result() as $row) {
							?>
							
                                <tr>
                                    <td><?php echo $bil++; ?></a></td>
                                    <td><?php echo $row->tajuk_projek; ?> </td>
                                    <td><?php echo $row->nama_kumpulan; ?></td>
					 <td align="center"><span class="badge badge-success"><?php echo get_status_projek($row->status); ?></span></td>
                                   
                                  
                                    <td class="actions" >
									
                                   <?php $status = $row->status; ?>
                                   <?php $level = $this->session->userdata('sess_level');?>


				
					<span class="btn-group">
   <a href="<?php echo base_url();?>index.php/main/view_projek/<?php echo $row->id_projek; ?>" class="btn btn-small" title="papar"><i class="icon-search"></i></a><?php if( $status =='1' && $level == "2"){  ?> 
   <a href="<?php echo base_url();?>index.php/main/edit_daftar_projek/<?php echo $row->id_projek; ?>" class="btn btn-small" title="kemaskini"><i class="icon-pencil"></i></a>
   				 
                   <a onclick="return confirm('Adakah anda pasti')" href="<?php echo base_url();?>index.php/main/del_projek/<?php echo $row->id_projek; ?>" class="btn btn-small "><i class="icon-trash"></i></a>
                                        </span>
                                         <?php }else{  ?>
                                     
                                     <?php }?>
									</td> 
                                    
                                    <td class="actions" >
                                     <?php if($level == "1" ){ ?>
                          
                          
                          			
                                    
									<?php   $status  = $row->status; ?>
                                    
                                   
									 				 			<?php if( $status =='2'){  ?> 
                                   
									 							<?php }else{  ?>
                                     
                                     							<?php }?>
                                       <?php }else{  ?>
                                                                
                                                                
                                      <?php }?>                          
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
