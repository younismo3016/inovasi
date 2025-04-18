<?php $this->load->view('top');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/custom-plugins/wizard/wizard.css" media="screen">
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
                        <span><i class="icon-magic"></i> Vertical Wizard Form</span>
                    </div>
                     <div class="mws-panel-toolbar">
                        <div class="btn-toolbar">
                            <div class="btn-group dropup">
                             <?php if(!empty($n1))
                          {?>
                    <a href=" <?php echo base_url();?>index.php/main/laporan_inovasi/<?php echo $id_projek; ?>" class="btn"><i class="icol-cross"></i> Senarai Laporan</a>
                               
                            <?php } else {?>
                    
                             <?php } ?>
                            
              
                     
                            </div>
                        </div>
                  </div>
                        
                    <div class="mws-panel-body no-padding">
                        <?php if($act == "add"){ ?>
                        
                        <form class="mws-form wzd-vertical" action="<?php echo base_url(); ?>index.php/main/add_kriteria_proses/" method="post" name="myForm" onSubmit="return validateForm()">
                        <?php }else{ ?>
              <form class="mws-form wzd-vertical" action="<?php echo base_url(); ?>index.php/main/edit_kriteria_proses/" method="post" name="myForm" onSubmit="return validateForm()">
                        <?php } ?>
                          <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 1
                            </legend>
                                <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">TUJUAN INOVASI </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td> <textarea rows="" cols="" name="n1"  style="width: 667px; height: 200px;" value="" ><?php if(!empty($n1)){echo $n1;}?></textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                </fieldset>
                <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 2</legend>
                  <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                         <th width="157" height="41">KEDUDUKAN SEBELUM INOVASI&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n9"  style="width: 667px; height: 200px;" value="" ><?php if(!empty($n2)){echo $n2;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                  </table>
                
                  </fieldset>
                          <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 3</legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">MASALAH YANG DIHADAPI&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n10"  style="width: 667px; height: 200px;" value="" ><?php if(!empty($n3)){echo $n3;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                   
                          </fieldset>
                           <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 4</legend>
                                <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                         <th width="157" height="41">INOVASI YANG DILAKSANAKAN&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n11"  style="width: 667px; height: 200px;" value="" ><?php if(!empty($n4)){echo $n4;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                </fieldset>
                           <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 5</legend>
                                <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">KREATIVITI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n12"  style="width: 667px; height: 200px;" value="" ><?php if(!empty($n5)){echo $n5;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                  
                </fieldset>
                            
                <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 6</legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">EFISIENSI – PENJIMATAN MASA </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n13"  style="width: 667px; height: 200px;" value="" ><?php if(!empty($n6)){echo $n6;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                         
                         
                   
                </fieldset>
              </form>
                       
                   
                            </div>
                    
                            </div>
                        
                <div class="mws-panel grid_8">
                  <div class="mws-panel-body no-padding">
                      <form class="mws-form wzd-vertical">
                            
                          <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 7</legend>
                                <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">EFISIENSI – PENJIMATAN KOS&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td> <textarea rows="" cols="" name="n1"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n7)){echo $n7;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                            <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 8                              </legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">EFISIENSI – PENINGKATAN PRODUKTIVITI&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n2"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n8)){echo $n8;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                            <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 9                              </legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">EFISIENSI –MUDAH DIGUNAKAN (USER FRIENDLY)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n3"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n9)){echo $n9;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                           <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 10                             </legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">EFISIENSI – LAIN-LAIN FAEDAH&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n4"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n10)){echo $n10;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                           <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 11                             </legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">SIGNIFIKAN&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n5"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n11)){echo $n11;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                            
                           <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 12                             </legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">REPLICABILITY</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n6"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n12)){echo $n12;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                         
                           <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 13                             </legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">POTENSI PELAKSANAAN&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n7"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n13)){echo $n13;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                            
                            
                              </fieldset>
                         
                           <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 14                             </legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                         <th width="157" height="41">KOMITMEN PENGURUSAN  ATASAN&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n14"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n14)){echo $n14;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                              
                               <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 15</legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">HARTA INTELEK DAN KOMERSIAL&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n15"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n15)){echo $n15;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                         <fieldset class="wizard-step mws-form-inline">
                            <legend class="wizard-label"><i class="icol-accept"></i> Kriteria 16</legend>
                            <table class="mws-table">
                      <thead>
                        <tr>
                          
                          
                          <th width="157" height="41">SENTUHAN KEPADA RAKYAT&#13;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	
                         
         <td><textarea rows="" cols="" name="n8"  style="width: 667px; height: 400px;" value="" ><?php if(!empty($n16)){echo $n16;}?>
         </textarea></td>
                                    
                        </tr>
                      </tbody>
                    </table>
                    
                        </fieldset>
                         
                  
                    </form>
                  </div>
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
   

    <!-- Themer Script (Remove if not needed) -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/demo.wizard.js"></script>
</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/table.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:49:28 GMT -->
</html>
