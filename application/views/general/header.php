<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
	<meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="<?php echo $this->config->item('suffix_web_title');?>" />
	<title><?php echo isset($web_title)?$web_title.' - ':'';?> <?php echo $this->config->item('suffix_web_title');?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<?php $this->load->view('general/css');?>
	<?php $this->load->view('general/javascript');?>
</head>
<body class="skin-blue wysihtml5-supported pace-done">
	<!-- header logo: style can be found in header.less -->
	<header class="header">
		<a class="logo" href="<?php echo site_url();?>">
			LOGO
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav role="navigation" class="navbar navbar-static-top">
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="glyphicon glyphicon-user"></i>
							<span><?php echo $this->session->userdata('name');?> <i class="caret"></i></span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header bg-light-blue">
								<?php
								$profpic = 'assets/uploads/employee_photo/'.$this->session->userdata("license_id").'/'.$this->session->userdata("user_employee_photo");
								if(file_exists($profpic) && $this->session->userdata("user_employee_photo") != ''){
								?>
								<img alt="User Image" class="img-circle" src="<?php echo base_url($profpic);?>">
								<?php } ?>
								<p>
									<?php echo $this->session->userdata('name');?>
									<small>
									<?php 
									if($this->session->userdata('roles') == "backend"){
										echo "Application Owner / Back-end";
									}else{
										echo get_group_name($this->session->userdata('group_id'));
									}
									?>
									</small>
								</p>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a class="btn btn-default btn-flat" href="<?php echo site_url('home/profile');?>">Profile</a>
								</div>
								<div class="pull-right">
									<a class="btn btn-default btn-flat" href="<?php echo site_url('home/logout');?>">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 404px;">
		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side strech">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<?php 
				if($this->session->userdata('roles') == "backend"){
					$this->load->view('general/menu_backend');
				}else{
					?>
					<ul class="top-menu">
						<?php 
						$sidebar_menu_parent_id = array();
						$get_group_module = get_group_module($this->session->userdata('group_id'),'0','top');
						foreach($get_group_module as $module){
							$get_group_module_dropdown = get_group_module($this->session->userdata('group_id'),$module['module_id'],'dropdown-top');
							if(count($get_group_module_dropdown) == 0){
								$sidebar_menu_parent_id[] = array('module_id'=>$module['module_id'],'module_name'=>$module['module_name']);
							?>
							<li>
								<a href="#div_side_menu_<?php echo $module['module_id'];?>" class="changemodule">
									<div><?php echo ucwords($module['module_name']);?></div>
								</a>
							</li>
							<?php }else{ ?>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href=""><?php echo ucwords($module['module_name']);?> <span class="arrow">&#9660;</span></a>
								<ul class="dropdown-menu">
									<?php foreach($get_group_module_dropdown as $dd){ 
										$sidebar_menu_parent_id[] = array('module_id'=>$dd['module_id'],'module_name'=>$dd['module_name']);
									?>
									<li><a href="#div_side_menu_<?php echo $dd['module_id'];?>" class="changemodule"><?php echo ucwords($dd['module_name']);?></a></li>
									<?php } ?>
								</ul>
							</li>
							<?php }
						} ?>
					</ul>
					<?php
				}
				?>
			</section>

			<!-- Main content -->
			<section class="content">
				<?php 
				if($this->session->userdata('roles') == "backend"){
				}else{ ?>
				<div class="menu-sub-item">
					<?php foreach($sidebar_menu_parent_id as $module){ 
						if($active_module_parent_id == '') $active_module_parent_id = $module['module_id'];
					?>
					<div id="div_side_menu_<?php echo $module['module_id'];?>" class="div_side_menu" style="<?php echo $module['module_id']==$active_module_parent_id?'display:block;':'display:none;';?>">
						<div class="flag-sub-item">
							<div class="flag-sub-item-title"><?php echo ucwords($module['module_name']);?></div>
						</div>
						<div class="flag-sub-item-content">
							<ul class="side-menu">
								<?php 
								$child_group_module = get_group_module($this->session->userdata('group_id'),$module['module_id'],'side');
								foreach($child_group_module as $childmodule){
								?>
								<li>
									<a href="<?php echo site_url($childmodule['module_link']);?>">
										<div class="side_menu_module_text" <?php echo $childmodule['module_icon']==''?'style="width:100%;"':'';?>><?php echo ucwords($childmodule['module_name']);?></div>
										<?php if($childmodule['module_icon']!=''){ ?>
										<div class="side_menu_module_icon">
											<img src="<?php echo base_url('assets/images/module_icon/'.$childmodule['module_icon']);?>">
										</div>
										<?php } ?>
									</a>
									<div class="clear"></div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="contentuser">
				<?php } ?>