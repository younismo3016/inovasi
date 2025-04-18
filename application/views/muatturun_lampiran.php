<?php $this->load->view('top');?>

<title><?php $this->load->view('nama_sistem');?></title>

</head>

<body>

	
<!-- Header -->
	
           
     
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	
                	

                	
                <p>
                  <?php 
		$level = $this->session->userdata('sess_level');	
		
 ?>    
                </p>
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> 
                    <p><span><i class="icon-table"></i> Maklumat Inovasi</span> </p>
                  
                  </div>
                  <div class="mws-panel-toolbar">
                    <div class="btn-toolbar">
     <div class="btn-group"> 
     				<a href="<?php echo base_url();?>index.php/main/view_projek/<?php echo $id_projek; ?>" class="btn"><i class="icon-arrow-left"></i> kembali</a> 
         		    <a href="javascript:window.print()" class="btn"><i class="icol-printer"></i> Print</a> 
                    <a href="<?php echo base_url();?>index.php/main/view_projek/<?php echo $id_projek; ?>" class="btn"><i class="icon-arrow-left"></i> Muat Turun Lampiran</a> 
                     </div> 
                    </div>
                  </div>
<div class="mws-panel-body no-padding"></div>
                </div>
              <p>
                </p>
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> <span><i class="icon-table"></i> Lampiran</span> </div>
                  
                  <div class="mws-panel-body no-padding">
                    <table class="mws-table">
                      <thead>
                        <tr>
                                                   
                        </tr>
                      </thead>
                      <tbody>
                       
                          
                          
                          
                          
                                              
                          
                          
                       
                          
                         
                         
                        
                            
                        
                      </tbody>
                    </table>
                    <table width="918" border="1">
                      <tr>
                        <th width="20" scope="row">No</th>
                        <th width="290" scope="row">Kriteria</th>
                         <th width="586" scope="row">Lampiran</th>
                      </tr>
                      <tr>
                        <th scope="row">&nbsp;</th>
                        <td>RINGKASAN PROJEK</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n1)){echo $image1_n1;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">1</th>
                        <td>TUJUAN INOVASI&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n1)){echo $image1_n1;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>KEDUDUKAN SEBELUM INOVASI&#13;</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n2)){echo $image1_n2;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>MASALAH YANG DIHADAPI&#13;</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n3)){echo $image1_n3;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>INOVASI YANG DILAKSANAKAN&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n4)){echo $image1_n4;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td>KREATIVITI</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n5)){echo $image1_n5;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">6</th>
                        <td>EFISIENSI – PENJIMATAN MASA&#13;</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n6)){echo $image1_n6;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">6.2</th>
                        <td>EFISIENSI – PENJIMATAN KOS&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n7)){echo $image1_n7;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">6.3</th>
                        <td>EFISIENSI – PENINGKATAN PRODUKTIVITI&#13;</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n8)){echo $image1_n8;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">6.4</th>
                        <td>EFISIENSI –MUDAH DIGUNAKAN (USER FRIENDLY)</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n9)){echo $image1_n9;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">6.5</th>
                        <td>EFISIENSI – LAIN-LAIN FAEDAH&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n10)){echo $image1_n10;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">7</th>
                        <td>SIGNIFIKAN&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n11)){echo $image1_n11;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">8</th>
                        <td>REPLICABILITI</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n12)){echo $image1_n12;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">9</th>
                        <td>POTENSI PELAKSANAAN&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n13)){echo $image1_n13;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">10</th>
                        <td>KOMITMEN PENGURUSAN  ATASAN&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n14)){echo $image1_n14;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">11</th>
                        <td>HARTA INTELEK DAN KOMERSIAL&#13;</td>
                        <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n15)){echo $image1_n15;}?></a></td>
                      </tr>
                      <tr>
                        <th scope="row">12</th>
                        <td>SENTUHAN KEPADA RAKYAT&#13;</td>
                        <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n16)){echo $image1_n16;}?></a></td>
                      </tr>
                    </table>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
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
 
    <script src="<?php echo base_url();?>assets/jui/js/timepicker/jquery-ui-timepicker.min.js"></script>

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
<script language='javascript' type='text/javascript'>


function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}





</script>