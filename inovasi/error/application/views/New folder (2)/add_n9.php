<?php $this->load->view('top');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/ibutton/jquery.ibutton.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/cleditor/jquery.cleditor.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins//css/prettyPhoto.css" media="screen">

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
                 <!-- Panels Start -->
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> <span><i class="icon-table"></i> Kemaskini Laporan</span> </div>
                  <div class="mws-panel-body no-padding">
                  
                    <table class="mws-table">
                      <thead>
                        
                           <?php if($act == "add"){ ?>
                        
                        <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/add_n1_proses/" method="post" name="myForm" onSubmit="return validateForm()">
                        <?php }else{ ?>
              <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_n1_proses/" method="post" name="myForm" onSubmit="return validateForm()">
                        <?php } ?>
                          <th width="139">KRITERIA</th>
                          <th width="436">Huraian</th>
                          
                          <th width="134">Tindakan</th>
                       
                        
                      
                      </thead>
                      
                      <tbody>
                        <tr>
                        	
                          <td><p>TUJUAN INOVASI </p></td>
                          <td>  <div class="mws-form-item">
                                	 <textarea rows="" id=""  cols=""  name="n1" style="width: 500px; height: 200px;"  ><?php if(!empty($n1)){echo $n1;}?></textarea>
                                </div>
                                
                                </td>
                          
                          <td> 
                          
                          <div class="mws-form-row">
                                    	<label class="mws-form-label"></label>
                                    	<div class="mws-form-item">
                                        	<input type="file">
                                        </div>
                                    </div>
                                    
                          <div class="mws-button-row">
                                    <?php if($act=='add'){  ?>
								<button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Simpan</button>
                               <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                                <?php }else{  ?>
                                
                                
                                
                                </div>
                                
               		 </td>
                
                          
                        </tr>
                         <tr>
                        <?php if($level=='4'){  ?>    
                          <td><p>Markah</p></td>
                          <td><div class="mws-form-col-3-8">
                               
                                <div class="mws-form-item">
                                  <input type="text" name="gred" value="<?php if(!empty($markah_n1)){echo $markah_n1;}?>">
                                </div>
                              </div>
                                <?php }else{  ?>   <?php }  ?>	
                            </td>
                        
                          <td> 
                          
                          <div class="mws-form-row">
                                    	
                            </div>
                                    
                          <div class="mws-button-row">
                              <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Kemaskini</button>
                                <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                               
                                <?php }  ?>
                                
                                
                                
                            </div>
                                
               		 </td>
                
                          
                        </tr>
                        
                      </tbody>
                      
                      
                      </form>
                    </table>
                  </div>
                  
                </div>
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> <span><i class="icon-table"></i>Nama fail</span></div>
                  <div class="mws-panel-body no-padding">
                    <table class="mws-table">
                      <thead>
                        
                          
                          <th width="139">KRITERIA</th>
                          <th width="436">Huraian</th>
                           
                          <th width="134">Tindakan</th>
                       
                        
                      
                      </thead>
                      
                      <tbody>
                        <tr>
                        	
                          <td><p>Lampiran 1</p></td>
                          <td>
                            <div id="mws-jui-dialog">
                        		<div class="mws-dialog-inner"  >
                            		<p><?php if(!empty($image1_n1)){echo $image1_n1;}?><img src="<?php echo base_url();?>assets/example/cyan_hawk.jpg" alt=""></p>
                                </div>
                            </div></td>
                          
                          <td> 
                          
                          <div class="mws-form-row">
                                    	<label class="mws-form-label"></label>
                                    	<div class="mws-form-item"></div>
                            </div>
                                    
                          <div class="mws-button-row">
                                  <input type="button" id="mws-jui-dialog-btn"  class="btn btn-danger" value="Show Dialog">
								<button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Papar</button>
                                
                               <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                               
                                
                                
                            </div>
                                
               		 </td>
                
                          
                        </tr>
                        
                        <tr>
                        	
                          <td><p>Lampiran 2</p></td>
                          <td><?php if(!empty($image2_n1)){echo $image2_n1;}?>
                          
                          	<ul class="thumbnails mws-gallery">
                                   <li>
                                   <span class="thumbnail"><img src="<?php echo base_url();?>assets/example/scottwills_underwater5.jpg" alt=""></span>
                                   <span class="mws-gallery-overlay">
                                    <a href="<?php echo base_url();?>assets/example/cyan_hawk.jpg" rel="prettyPhoto[gallery1]" class="mws-gallery-btn"><i class="icon-search"></i></a>
                                    
                                </span></td>
                          
                           </li>
                           
                          <td> 
                          
                          <div class="mws-form-row">
                                    	<label class="mws-form-label"></label>
                                    	<div class="mws-form-item"></div>
                            </div>
                                    
                          <div class="mws-button-row">
                                   
                                  <div id="mws-jui-dialog">
                        		<div class="mws-dialog-inner"  >
                            		<p><?php if(!empty($image1_n1)){echo $image1_n1;}?><img src="<?php echo base_url();?>assets/example/cyan_hawk.jpg" alt=""></p>
                                </div>
                            </div>
								<button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Papar</button>
                               <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                              
                                
                                </div>
                                
               		 </td>
                
                          
                        </tr>
                       
                      </tbody>
                      
                      </form>
                    </table>
                  </div>
                  
                </div>
                <div class="mws-panel grid_8">
               	  <div class="mws-panel-header">
                    	<span><i class="icon-pictures"></i> Image Gallery</span>
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
