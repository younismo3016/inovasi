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
                    <a href="<?php echo base_url();?>index.php/main/muatturun_lampiran/<?php echo $id_projek; ?>" class="btn"><i class="icon-arrow-left"></i> Muat Turun Lampiran</a> 
                     </div> 
                    </div>
                  </div>
                  
<div class="mws-panel-body no-padding">
        <table class="mws-table" border="1px"
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
                          <td><strong>Poskod</strong></td>
                          <td><?php echo $poskod; ?></td>
                        </tr>
                       <tr>
                          <td><strong>Email Ketua Projek</strong></td>
                          <td><?php echo $email_ketua_projek; ?></td>
                          <td><strong>Email Ketua Organisasi</strong></td>
                          <td><?php echo $email_ketua_organisasi; ?></td>
                          
                        </tr>
                        <tr>
                          <td><strong>No. Telefon Ketua Projek</strong></td>
                          <td><?php echo $no_tel_ketua_projek; ?></td>
                          <td><strong>No. Telefon Ketua Organisasi</strong></td>
                          <td><?php echo $no_tel_ketua_organisasi; ?></td>
                         
                        </tr>
                      </tbody>
        </table>
                  </div>
                </div>
                <p>
                <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Senarai Ahli Pasukan</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table" border="1px">
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
				
                
                </p>
                <div class="mws-panel grid_8">
                  <div class="mws-panel-header"> <span><i class="icon-table"></i> Ringkasan Projek</span> </div>
                  
                  <div class="mws-panel-body no-padding">
                    <table class="mws-table">
                      <thead>
                        <tr>
                                                   
                        </tr>
                      </thead>
                      <tbody>
                       
                          
                          
                          
                          
                                              
                          
                          
                       
                          
                         
                         
                        
                            
                        
                      </tbody>
                    </table>
                    <table  class="mws-datatable-fn mws-table" width="918" border="1px">
                      <tr>
                        <th width="20" scope="row">No</th>
                        <th width="290" scope="row">Kriteria</th>
                         <th width="586" scope="row">Huraian</th>
                      </tr>
                      <tr>
                        <th scope="row">1</th>
                        <td>TAJUK PROJEK</td>
                        <td><?php if(!empty($ringkasan)){echo $ringkasan;}?></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>RINGKASAN</td>
                        <td>
                                	 <textarea disabled rows="" id=""  cols=""  name="n1" style="width: 820px; height: 200px;"  ><?php if(!empty($n1)){echo $n1;}?></textarea>
                                </td></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>LATAR BELAKANG</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""   name="n5" style="width: 820px; height: 200px;"  ><?php if(!empty($n5)){echo $n5;}?></textarea>
                                </div></td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>KUMPULAN SASARAN DAN SKOP LIPUTAN</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""   name="n5" style="width: 820px; height: 200px;"  ><?php if(!empty($n6)){echo $n6;}?></textarea>
                                </div></td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td>OBJEKTIF / TUJUAN INISIATIF</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""  name="n7" style="width: 820px; height: 200px;"  ><?php if(!empty($n7)){echo $n7;}?></textarea>
                                </div></td>
                      </tr>
                      <tr>
                        <th scope="row">6</th>
                        <td>PENERANGAN DAN KRITERIA</td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row">a</th>
                        <td>KREATIVITI</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""  name="n8" style="width: 820px; height: 200px;"  ><?php if(!empty($n8)){echo $n8;}?></textarea>
                                </div></td>
                      </tr>
                      <tr>
                        <th scope="row">b</th>
                        <td>KEBERKESANAN</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""  name="n9" style="width: 820px; height: 200px;"  ><?php if(!empty($n9)){echo $n9;}?></textarea>
                                </div></td>
                      </tr>
                      <tr>
                        <th scope="row">c</th>
                        <td>RELEVAN</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""  name="n11" style="width: 820px; height: 200px;"  ><?php if(!empty($n11)){echo $n11;}?></textarea>
                                </div></td>
                      </tr>
                      <tr>
                        <th scope="row">d</th>
                        <td>SIGNIFIKAN</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""  name="n12" style="width: 820px; height: 200px;"  ><?php if(!empty($n12)){echo $n12;}?></textarea>
                                </div></td>
                      </tr>
                      <tr>
                        <th scope="row">7</th>
                        <td>PENCAPAIAN DAN PENGIKTIRAFAN</td>
                        <td><div class="mws-form-item">
                                	 <textarea disabled rows="" id=""  cols=""  name="n13" style="width: 820px; height: 200px;"  ><?php if(!empty($n13)){echo $n13;}?></textarea>
                                </div></td>
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