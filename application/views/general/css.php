<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-3.3.4/css/bootstrap.min.css');?>">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome-4.3.0/css/font-awesome.min.css');?>">

<!-- Fonts --> 
<link type="text/css" href="<?php echo base_url('assets/plugins/select2-3.4.5/select2.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/plugins/jqueryui/themes/ui-lightness/jquery-ui.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css');?>" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">

<?php
if(isset($stylesheets) ){
	foreach($stylesheets as $css){ ?>
		<link type="text/css" href="<?php echo base_url('assets/css/'.$css);?>" rel="stylesheet" />
	<?php }
}
?>