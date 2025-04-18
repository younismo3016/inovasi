 
 
 <?php 
		$level = $this->session->userdata('sess_level');	
		
 ?>





		
			<div id="mws-navigation">
           
            
             

                <ul>
                <li>
                     <a href=""><i class="icon-user"></i><?php $level = $this->session->userdata('sess_level');
						if($level==1){ echo "Ketua Organisasi"; }
							
							else if($level==2){ echo "Ketua Projek"; }
							
									else if($level==3){ echo "Ahli Pasukan"; }
											
											else if($level==4){ echo "Urusetia"; }
												
												else if($level==5){ echo "Penyelaras Jabatan"; }
							
											else{ echo "Ralat"; } ?> </a>
                       
                    </li>
                <?php
				if($level=='1'){// 3 untuk pemohon
				?>
                    <li>
                     <a href="<?php echo base_url(); ?>index.php/main/utama/"><i class="icon-home-3"></i> Utama</a>
                       
                    </li>
                    <li>
                    
                        <a href="#"><i class="icon-pencil-2"></i> Kemaskini</a>
                        <ul>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/kemaskini_katalaluan/<?php echo $this->session->userdata('sess_id'); ?>">Kata Laluan</a></li>
                      
                            
                        
                            
                            
                        </ul>
                  
            <?php
			}
			
			?>
             <?php
				if($level=='5'){// 3 untuk pemohon
				?>
                    <li>
                     <a href="<?php echo base_url(); ?>index.php/main/utama2/"><i class="icon-home-3"></i> Utama</a>
                       
                    </li>
                    <li>
                    
                        <a href="#"><i class="icon-pencil-2"></i> Kemaskini</a>
                        <ul>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/kemaskini_katalaluan/<?php echo $this->session->userdata('sess_id'); ?>">Kata Laluan</a></li>
                      
                            
                        
                            
                            
                        </ul>
                  
            <?php
			}
			
			?>
             <?php
				if($level=='2'){// 3 untuk pemohon
				?>
                    <li>
                     <a href="<?php echo base_url(); ?>index.php/main/utama/"><i class="icon-home-3"></i> Utama</a>
                        <a href="#"><i class="icon-list"></i> Pendaftaran</a>
                        <ul>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/add_pengguna1/">Maklumat Ketua Projek</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main/ketua_organisasi/">Ketua Organisasi</a></li>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/daftar_projek">Tambah Projek</a></li>
						    <li><a href="<?php echo base_url(); ?>index.php/main/add_ahli_pasukan">Tambah Ahli Pasukan</a></li>
                            
                        </ul>
                    </li>
                     <li>
                    
                        <a href="#"><i class="icon-pencil-2"></i> Kemaskini</a>
                        <ul>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/kemaskini_katalaluan/<?php echo $this->session->userdata('sess_id'); ?>">Kata Laluan</a></li>
                      
                            
                        
                            
                            
                        </ul>
                           
                <li>
                 <li><a href="<?php echo base_url(); ?>index.php/main/senarai_projek/"><i class="icon-list-2"></i>Laporan Inovasi</a></li>
                  
            <?php
			}
			
			?>	
            	
			<?php
				if($level=='4'){// 3 untuk pemohon
				?>
                <li>
                     <a href="<?php echo base_url(); ?>index.php/main/utama/"><i class="icon-home-3"></i> Utama</a>
                        <a href="#"><i class="icon-list"></i> Pendaftaran</a>
                        <ul>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/add_pengguna1/">Maklumat Ketua Projek</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main/ketua_organisasi/">Ketua Organisasi</a></li>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/daftar_projek">Tambah Projek</a></li>
						    <li><a href="<?php echo base_url(); ?>index.php/main/add_ahli_pasukan">Tambah Ahli Pasukan</a></li>
                            
                        </ul>
                    </li>
                           
                <li>
                    
                        <a href="#"><i class="icon-pencil-2"></i> Kemaskini</a>
                        <ul>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/pengguna/">Pengguna</a></li>
                        	<li><a href="<?php echo base_url(); ?>index.php/main/kemaskini_projek/">Projek</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/main/add_tarikh_tutup/">Tarikh tutup penyertaan</a></li>
                            
                        
                            
                            
                        </ul>
</li>
                     <li><a href="<?php echo base_url(); ?>index.php/main/senarai_projek/"><i class="icon-list-2"></i>Laporan Inovasi</a></li>
                     <li><a href="<?php echo base_url(); ?>index.php/main/laporan_markah/"><i class="icon-bars"></i>Laporan Markah</a></li>
                    
			 <?php
			}
			?>	
			
                       
                    
                    
					<li><a href="<?php echo base_url();?>/index.php/main/logout"><i class="icon-warning-sign"></i> Log Keluar</a></li>
              
              
              
                   
       </div>         
         
             