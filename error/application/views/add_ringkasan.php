<?php $this->load->view('top');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/ibutton/jquery.ibutton.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins//css/prettyPhoto.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" media="screen">
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
		$level = $this->session->userdata('sess_level');?>       
                	

                 
               <a href="<?php echo base_url();?>index.php/main/laporan_inovasi/<?php echo $id_projek; ?>"<button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Kembali</button></a>
                  
                  </p>
                 
                <div class="mws-panel grid_8">
            <div class="mws-panel-header"> <span><i class="icon-table"></i> Kemaskini Laporan</span> </div>
                <div class="mws-panel-body no-padding">
                  
                  <table class="mws-table">
                    <thead>
                        
                         <?php if($act == "add"){ ?>
                        
                      <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/add_ringkasan_proses/" method="post" name="myForm" onSubmit="return validateForm()">
                      <?php }else{ ?>
              <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_ringkasan_proses/" method="post" name="myForm" onSubmit="return validateForm()" >
                        <?php } ?>
                          <th width="139">KRITERIA</th>
                          <th width="436">Huraian</th>
                          
                          <th width="134">Tindakan</th>
                       
                        
                      
                      </thead>
                      
                      <tbody>
                        <tr>
                        	<?php $level = $this->session->userdata('sess_level');?>
                            
                          <td><p>RINGKASAN PROJEK <?php //echo// $level; ?></p></td>
                          <td>  <div class="mws-form-item">
                                	 <textarea rows="" id="ringkasan"  cols=""  name="ringkasan" style="width: 500px; height: 200px;"  ><?php if(!empty($ringkasan)){echo $ringkasan;}?></textarea>
                                </div>
                                
                                <br>
						<input type="text" id="counterBox" disabled="disabled" style="color: grey; background-color: #F0F0F0;"/>
                               
                                </td>
                          
                                 <td>
                         <?php if($level == "5" || $level == "4"  ){ ?>

                          <?php }else{  ?>
                          
                          <?php if(($status =='1')&&($level == "2")){  ?>
                           <div class="mws-button-row">
                             <?php if($act=='add' ){  ?>
					  <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Simpan</button>
                               <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                              
                            </td>
                            
                          
                               
                                 <?php }else{  ?>
                                
                                
                                
                                   <div class="mws-form-row">
                                    	
                            </div>
                                    
                          
                           <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Kemaskini </button>
                      
                                <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
								<?php }  ?>
                        <?php }  ?>
                         <?php }  ?>
                               
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

<script>
 var txtBoxRef = document.querySelector("#ringkasan");
 var counterRef = document.querySelector("#counterBox");
 txtBoxRef.addEventListener("keyup",function(){
  var remLength = 0;
  remLength = 3000 - parseInt(txtBoxRef.value.length);
  if(remLength < 0)
   {
    txtBoxRef.value = txtBoxRef.value.substring(0, 3000);
    return false;
   }
  counterRef.value = remLength + " characters remaining...";
 },true);
</script> 



</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
