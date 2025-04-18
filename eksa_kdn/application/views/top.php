<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Garis Panduan EKSA KDN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content=">
	<meta name="author" content="">

	<!-- The styles -->
	<link id="bs-css" href="<?php echo base_url();?>css/bootstrap-united.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	
	<link href='<?php echo base_url();?>css/chosen.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo base_url();?>css/uploadify.css' rel='stylesheet'>
    
    

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php //echo base_url();?>img/favicon.ico">
    
    <style type="text/css">



label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }

</style>
		
</head>

<body>
<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
		  <div class="container-fluid" btn-group pull-right theme-container>
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
				<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>	
				</a><!-- theme selector starts -->
                <img src="<?php echo base_url();?>img/bannerEKSA.jpg"/>
                 
				<div class="btn-group pull-right theme-container" >
					
						
						
					
					
			</div>
				<!-- theme selector ends -->
                
				<!-- user dropdown starts -->
				
					<ul class="dropdown-menu">
						
						<li class="divider"></li>
						<li><a href="<?php echo base_url();?>index.php/main/logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				
		  </div>
		</div>
	</div>
	<!-- topbar ends -->
    
    <div>
				<ul class="">
					<H4> <?php echo $this->session->userdata('sess_nama_penuh');?></H4>
				</ul>
			</div>