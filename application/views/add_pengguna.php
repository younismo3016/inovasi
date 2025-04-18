<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:48:45 GMT -->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login.min.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mws-theme.css" media="screen">

<title><?php $this->load->view('nama_sistem');?></title>

</head>

<body>

 <!-- Start: HEADER -->
  <!-- <header>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="50%" td align="center"><img src ="<?php echo base_url();?>assets/images/core/bg/esurat_banner3b.jpg" style="position:absolute; top:0px; left:0px; width:100%; max-height:100%; border:0;">		
		</tr>
	</table>
            <div align="center"></div>
  </header> -->
    <!-- End: HEADER -->
 
   
    <div id="mws-login-wrapper">
    <div id="mws-login">
        <h2>Daftar Ketua Projek</h2>
        <div id="mws-login-form">
            <form class="mws-form" id="mws-validate" action="<?php echo base_url(); ?>index.php/login/add_daftar_proses" method="post" name="myForm" onsubmit="return validateForm()">
                
                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <label class="mws-form-label">Nama Penuh <span class="required">*</span></label>
                        <input type="text" name="nama_penuh" id="nama_penuh" class="required" onchange="this.value=this.value.toUpperCase();">
                    </div>
                </div>

                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <label class="mws-form-label">Katalaluan <span class="required">*</span></label>
                        <input type="password" name="kata_laluan" id="kata_laluan" class="required">
                        <div id="password-error" style="color: red; display: none; font-size: 12px;">Katalaluan mesti sekurang-kurangnya 8 aksara</div>
                    </div>
                </div>

                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <label class="mws-form-label">Sahkan Katalaluan <span class="required">*</span></label>
                        <input type="password" name="sahkan_kata_laluan" id="sahkan_kata_laluan" class="required">
                        <div id="confirm-error" style="color: red; display: none; font-size: 12px;">Katalaluan tidak sepadan</div>
                    </div>
                </div>

                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <label class="mws-form-label">Email (rasmi) <span class="required">*</span></label>
                        <input type="text" name="email" class="mws-textinput required email">
                    </div>
                </div>

                <?php if ($this->session->flashdata('flash_success')) { ?>
                    <div class="mws-form-message success">
                        <?php echo $this->session->flashdata('flash_success'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('flash_error')) { ?>
                    <div class="mws-form-message error">
                        <?php echo $this->session->flashdata('flash_error'); ?>
                    </div>
                <?php } ?>

                <div class="mws-form-row">
                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                    <input type="submit" value="Hantar" class="btn mws-login-button">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function validateForm() {
    var pw1 = document.getElementById("kata_laluan").value;
    var pw2 = document.getElementById("sahkan_kata_laluan").value;

    // Reset error messages
    document.getElementById("password-error").style.display = "none";
    document.getElementById("confirm-error").style.display = "none";

    var valid = true;

    if (pw1.length < 8) {
        document.getElementById("password-error").style.display = "block";
        valid = false;
    }

    if (pw1 !== pw2) {
        document.getElementById("confirm-error").style.display = "block";
        valid = false;
    }

    return valid;
}
</script>
	<!-- Start: FOOTER -->
	<header>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%" td align="center"><img class="fit" src ="<?php echo base_url();?>assets/images/core/bg/footer.jpg" >		
		</tr>
	</table>
            <div align="center"></div>
	</header>
    <!-- End: FOOTER -->
    </div>

    <!-- JavaScript Plugins -->
    <script src="<?php echo base_url();?>assets/js/libs/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/libs/jquery.placeholder.min.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="<?php echo base_url();?>assets/jui/js/jquery-ui-effects.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate-min.js"></script>

    <!-- Login Script -->
    <script src="<?php echo base_url();?>assets/js/core/login.js"></script>

</body>

<!-- Mirrored from www.youxithemes.com/live_previews/mws-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 26 Aug 2013 04:48:47 GMT -->
</html>
