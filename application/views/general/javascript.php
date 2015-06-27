<script>
	var base_url = "<?php echo base_url();?>";
	var site_url = "<?php echo site_url();?>";
</script>
	
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-1.11.0.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-migrate-1.0.0.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-ui-1.9.2.custom.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery.scrollTo.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/select2-3.4.5/select2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery.mousewheel.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/globalize.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/cultures/globalize.culture.id.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap-3.3.4/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery.easing-1.3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap-select.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/maskedinput/jquery.maskedinput-1.3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/general.js');?>"></script>

<?php 
if(isset($javascripts) ){
	foreach($javascripts as $js){
	?>
		<script type="text/javascript" src="<?php echo base_url('assets/js/'.$js);?>"></script>
	<?php }
}
?>