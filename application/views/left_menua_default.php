 <?php 
		$peranan = $this->session->userdata('sess_id_adm_peranan');	
		
 ?>
<div id="mws-navigation">
                <ul>
                <?php
				if($peranan=='3'){// 3 untuk pemohon
				?>
                    <li><a href="<?php echo base_url(); ?>index.php/modul"><i class="icon-home"></i> Utama</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/mohon/permohonan"><i class="icon-folder-closed"></i> Permohonan Baru</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/mohon/semak_permohonan"><i class="icon-table"></i>Semakan Permohonan</a></li>
                  
            <?php
			}
			?>	
			<?php
				if($peranan=='1'){// 1 super admin
				?>
                 <li><a href="<?php echo base_url(); ?>index.php/modul"><i class="icon-home"></i> Utama</a></li>
					<li>
                        <a href="#"><i class="icon-list"></i> Pengurusan Pengguna</a>
                        <ul>
						    <li><a href="<?php echo base_url(); ?>index.php/pengguna/add_pengguna">Tambah Pengguna</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/pengguna/index">Senarai Pengguna</a></li>
                        </ul>
                    </li>
                    <li><a href="charts.html"><i class="icon-list"></i> Pengurusan Bahagian</a>
						<ul>
						    <li><a href="<?php echo base_url(); ?>index.php/bahagian/tambah_bahagian">Tambah Bahagian</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/bahagian/index">Senarai Bahagian</a></li>
                        </ul>
					</li>
                    <li><a href="files.html"><i class="icon-list"></i> Pengurusan Peralatan</a>
						<ul>
						    <li><a href="<?php echo base_url(); ?>index.php/peralatan/tambah_peralatan">Tambah Peralatan</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/peralatan">Senarai Peralatan</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/peralatan/tambah_jenama">Tambah Jenis dan Jenama</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/peralatan/senarai_jenis_peralatan">Senarai Jenis Peralatan</a></li>
                             <li><a href="<?php echo base_url(); ?>index.php/peralatan/semak_peralatan">Semakan Peralatan</a></li>
                        </ul>
					</li>
                    <li class="active"><a href="table.html"><i class="icon-table"></i> Permohonan</a>
                    <ul>
						    <li><a href="<?php echo base_url(); ?>index.php/mohon/semak_permohonan">Semakan Permohonan</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/mohon/lulus_permohonan">Kelulusan</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/mohon/list_pengambilan_alatan">Pengambilan Peralatan</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/peralatan/list_pemulangan">Pemulangan Peralatan</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/mohon/permohonan_melebihi_had_tarikh">Permohonan Melebihi Had Tarikh</a></li>
                        </ul>
                        </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> Laporan</a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php/main/statistik_mengikut_bulan">Permohonan Mengikut Bulan</a></li>
                            <li><a href="form_elements.html">Permohonan Mengikut Bahagian</a></li>
                          <?php
			}
			?>
                        </ul>
                    </li>
					<li><a href="<?php echo base_url();?>/index.php/pengguna/logout"><i class="icon-warning-sign"></i> Log Keluar</a></li>
                   
                </ul>
            </div>