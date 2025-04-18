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
            
            	
                	

                	
                <?php 
		$level = $this->session->userdata('sess_level');	
		
 ?>    

                    
                	
               
                <!-- Panels Start -->
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> <span><i class="icon-table"></i> Laporan Inovasi Projek <?php echo $tajuk_projek; ?></span> </div>
                  <div class="mws-panel-toolbar">
                        <div class="btn-toolbar">
                            <div class="btn-group dropup">
                             
                            
              
                    
                                 
                            </div>
                        </div>
                  </div>
                  <div class="mws-panel-body no-padding">
                  
                    <table class="mws-table">
                      <thead>
                        <tr>
                          <th width="20">No</th>
                          <th width="351">KRITERIA</th>
                          <th width="535">Huraian</th>
                          <th width="102">Lampiran</th>
                          <?php if($level=='4'){  ?><th width="97">Markah</th><?php }else{  ?>    <?php }  ?>
                          <th width="150">tindakan</th>
                        </tr>
                      </thead>
                      <tbody>
                       <tr>
                        	<td>1</td>
                          <td><p>TAJUK PROJEK</p></td>
                          <td height="1"><?php $ringkasan = "$ringkasan";echo substr($ringkasan,0,160);?>...</td>
                          <td><p>&nbsp;</p></td>
                          
                          <?php if($level=='4'){  ?><td>&nbsp;</td><?php }else{  ?>    <?php }  ?>
                          <td>
                           <?php if(!empty($id_projek))
                          {?>
                          <a href="<?php echo base_url();?>index.php/main/edit_ringkasan/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                           <?php } else {?>
                          <a href="<?php echo base_url();?>index.php/main/add_ringkasan/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                          
                          <?php } ?></td>
                        </tr>
                        <tr>
                        	<td>2.</td>
                          <td><p>RINGKASAN</p></td>
                          <td height="1"><?php $n1 = "$n1";echo substr($n1,0,160);?>...</td>
                          <td> <a href="<?php echo base_url();?>uploads/<?php echo $image1_n1; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n1)){echo $image1_n1;}?></a><p><?php if(!empty($image2_n1)){echo $image2_n1;}?></p></td>
                          
                          <?php if($level=='4'){  ?><td> </td><?php }else{  ?>    <?php }  ?>
                          <td>
                           <?php if(!empty($id_projek))
                          {?>
                          <a href="<?php echo base_url();?>index.php/main/edit_n1/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                           <?php } else {?>
                          <a href="<?php echo base_url();?>index.php/main/add_n1/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                          
                          <?php } ?></td>
                        </tr>
                        <tr>
                          <td>3.</td>
                          <td>LATAR BELAKANG</td>
                          <td><?php $n5 = "$n5";echo substr($n5,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n5; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n5)){echo $image1_n5;}?></a>
                            <p>
                              <?php if(!empty($image2_n5)){echo $image2_n5;}?>
                          </p></td>
                           <?php if($level=='4'){  ?>
                           <!--<td><?php// if(!empty($markah_n5)){echo $markah_n5;}?>/25</td><?php// }else{  ?>    <?php// }  ?> -->
                           <td><?php echo $markah_n5;?>/5</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n5/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n5/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                        <tr>
                          <td>4.</td>
                          <td><p>KUMPULAN SASARAN DAN SKOP LIPUTAN</p></td>
                          <td><?php $n6 = "$n6";echo substr($n6,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n6; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n6)){echo $image1_n6;}?></a>
                            <p>
                              <?php if(!empty($image2_n6)){echo $image2_n6;}?>
                          </p></td>
                           <?php if($level=='4'){  ?>
                           <td><?php echo $markah_n6;?>/5</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n6/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n6/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td><p>OBJEKTIF / TUJUAN INISIATIF</p></td>
                          <td><?php $n7 = "$n7";echo substr($n7,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n7; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n7)){echo $image1_n7;}?></a>
                            <p>
                              <?php if(!empty($image2_n7)){echo $image2_n7;}?>
                          </p></td>
                          <?php if($level=='4'){  ?>
                          <td><?php echo $markah_n7;?>/5</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n7/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n7/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                        
                         <tr>
                        	<td>6</td>
                          <td height="1" colspan="5"><p>PENERANGAN DAN KRITERIA
                           </p></td>
                          <?php if($level=='4'){  ?><?php }else{  ?>    <?php }  ?>
                        </tr>
                        <tr>
                          <td>(a)</td>
                          <td><p>KREATIVITI</p></td>
                          <td><?php $n8 = "$n8";echo substr($n8,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n8; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n8)){echo $image1_n8;}?></a>
                            <p>
                              <?php if(!empty($image2_n8)){echo $image2_n8;}?>
                          </p></td>
                          <?php if($level=='4'){  ?>
                          <td><?php echo $markah_n8;?>/20</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n8/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n8/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                        <tr>
                          <td>(b)</td>
                          <td><p>KEBERKESANAN</p></td>
                          <td><?php $n9 = "$n9";echo substr($n9,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n9; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n9)){echo $image1_n9;}?></a>
                            <p>
                              <?php if(!empty($image2_n9)){echo $image2_n9;}?>
                          </p></td>
                          <?php if($level=='4'){  ?>
                          <td><?php echo $markah_n9;?>/20</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n9/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n9/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                        <tr>
                          <td>(c)</td>
                          <td><p>RELEVAN</p></td>
                          <td><?php $n11 = "$n11";echo substr($n11,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n11; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n11)){echo $image1_n11;}?></a>
                            <p>
                              <?php if(!empty($image2_n11)){echo $image2_n11;}?>
                          </p></td>
                           <?php if($level=='4'){  ?>
                           <td><?php echo $markah_n11;?>/20</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n11/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n11/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                         <tr>
                          <td>(d)</td>
                          <td><p>SIGNIFIKAN&#13;</p></td>
                          <td><?php $n12 = "$n12";echo substr($n12,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n12; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n12)){echo $image1_n12;}?></a>
                            <p>
                              <?php if(!empty($image2_n12)){echo $image2_n12;}?>
                           </p></td>
                          <?php if($level=='4'){  ?>
                          <td><?php {echo $markah_n12 ;}?>/20</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n12/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n12/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                         <tr>
                          <td>7</td>
                          <td><p>PENCAPAIAN DAN PENGIKTIRAFAN</p></td>
                          <td><?php $n13 = "$n13";echo substr($n13,0,160);?>...</td>
                          <td><a href="<?php echo base_url();?>uploads/<?php echo $image1_n13; ?>" target="_blank" class="mws-gallery-btn"><?php if(!empty($image1_n13)){echo $image1_n13;}?></a>
                            <p>
                              <?php if(!empty($image2_n13)){echo $image2_n13;}?>
                           </p></td>
                           <?php if($level=='4'){  ?>
                           <td><?php echo $markah_n13; ?>/5</td><?php }else{  ?>    <?php }  ?>
                          <td><?php if(!empty($id_projek))
                          {?>
                            <a href="<?php echo base_url();?>index.php/main/edit_n13/<?php echo $id_projek; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/magnifier_zoom_in.png" width="20" height="20" alt="kemaskini" title="kemaskini"/></a>
                            <?php } else {?>
                            <a href="<?php echo base_url();?>index.php/main/add_n13/<?php echo $key; ?>"><img src="<?php echo base_url();?>assets/css/icons/32/add.png" width="20" height="20" alt="Tambah" title="Tambah"/></a>
                            <?php } ?></td>
                        </tr>
                          <?php if($level=='4') {?>
                          <tr>
                          <td>.</td>
                           <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/simpan_markah/<?php echo $id_markah_inovasi; ?>" method="post" name="myForm" onSubmit="return validateForm()" >
                          
                          <td><p>MARKAH KESELURUHAN</p></td>
                          <td>&nbsp;</td>
                          <td><p>&nbsp;</p></td>
                           <?php if($level=='4'){  ?>
                           <td> <?php $total= $markah_n5 + $markah_n6 + $markah_n7 + $markah_n8 + $markah_n9 + $markah_n11 + $markah_n12 + $markah_n13 ;   
						   
						   
						   echo   $total; 
						   
						   
						   
						   ?>  </td><?php }else{  ?>    <?php }  ?>
                          <td>
                          
                          
                          
                           
                          
                          </tr>
                         <?php }  ?>
                           <tr>
                          <td></td>
                          <td> </td>
                          <td><?php if((!empty($n1) && !empty($n2))  && !empty($n3) && !empty($n4) && !empty($n5) && !empty($n6) && !empty($n7) && !empty($n8) && !empty($n9) && !empty($n10) && !empty($n11) && !empty($n12) && !empty($n13) && !empty($n14) && !empty($n15) && !empty($n16) ){?>
                          
                           <?php }else{ ?>
                            
                            <?php } ?>   </td>
                          <td>&nbsp;</td>
                         <?php if($level=='4'){  ?><td>
                         
                    <!--     <?php// if(!empty($markah_n5) && !empty($markah_n6) && !empty($markah_n7) && !empty($markah_n8) && !empty($markah_n9) && !empty($markah_n11) && !empty($markah_n12) && !empty($markah_n13) && !empty($markah_n14) && !empty($markah_n15) && !empty($markah_n16)){?>
                         <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Simpan Markah</button>
                       <?php// }?> -->
                       
                            <?php if(($markah_n5 >= '0') && ($markah_n6 >= '0') && ($markah_n7 >= '0') && ($markah_n8 >= '0') && ($markah_n9 >= '0') && ($markah_n11 >= '0') && ($markah_n12 >= '0') && ($markah_n13 >= '0')){?>
                         <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Simpan Markah</button>
                       <?php  }?>                    
                       
                           <input  name="peratus" id="peratus" type="hidden" value="<?php echo $peratus; ?>">
                           <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                            <input  name="id_markah_inovasi" id="id_markah_inovasi" type="hidden" value="<?php echo $id_markah_inovasi; ?>"></td><?php }else{  ?>    <?php }  ?>
                            
                            
                            </form> 
                          <td>
                             
                         <?php if((!empty($n1))   && !empty($n5) && !empty($n6) && !empty($n7) && !empty($n8) && !empty($n9)  && !empty($n11) && !empty($n12) && !empty($n13) && ($status =="1")){?>
                             <form class="mws-form" action="<?php echo base_url(); ?>index.php/main/edit_laporan_status/" method="post" name="myForm" onSubmit="return validateForm()" >
      
                    
                    <?php if($level=='2') {?>
                    <div class="mws-button-row">
                                 <button type="submit" class="btn btn-primary" id="validateButton" name="validateButton">Hantar</button>
                       <?php         }?>
                            
                               <input  name="key" id="key" type="hidden" value="<?php echo $id_projek; ?>">
                                 <input  name="id_markah_inovasi" id="id_markah_inovasi" type="hidden" value="<?php echo $id_markah_inovasi; ?>">
                               
                          </div>   
                               <?php } ?>   
                       </td>
                       
                         </form> 
                          </tr>
                      </tbody>
                    </table>
            
                    
                              
                           
                              
                   				
                          
                            
                  </div>
                  <?php if(($level == 1 || $level == 4) ){  ?>
                             
                    		
                    			<a href="<?php echo base_url();?>index.php/main/pengesahan_status/<?php echo $id_projek; ?>"<input type="submit" value="Pengesahan Projek" name="submit" class="btn btn-danger">Pengesahan Projek</a>
                                
                                <a href="<?php echo base_url();?>index.php/main/kemaskini_semula_laporan/<?php echo $id_projek; ?>""<input type="submit" value="Papar Laporan Projek" name="submit" class="btn btn-primary">Kemaskini Semula</a>
                               
                               
                               
                               <?php }else{  ?>
                    
                                  
                                <?php }  ?>
                   
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