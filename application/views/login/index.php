<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
	<meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="<?php echo $this->config->item('suffix_web_title');?>" />
	<title>Sign In - <?php echo $this->config->item('suffix_web_title');?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php $this->load->view('general/css');?>
	<?php $this->load->view('general/javascript');?>
</head>
<body id="login">
	<div class="container">
		<div class="row vertical-center-row">
			<div class="col-lg-12">
				<div class="row loginlogo">
					<div class="col-sm-4 col-sm-offset-4 col-xs-11 col-xs-offset-1">
						<h3 class="logo text-center">
							<a href="<?php echo site_url();?>">Logo</a>
						</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4 col-xs-11 col-xs-offset-1 boxwhite">
						<div class="row">
							<div class="col-lg-12 logiheader">
								<h4>Sign in to start your session</h4>
							</div>
						</div>
						<form method="post" action="<?php echo site_url('login/verify');?>" id="formlogin">
							<input type="hidden" name="usertimezoneoffset" id="usertimezoneoffset" value="">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="text" name="username" class="form-control" placeholder="Username" maxlength="30">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="alert alert-danger" id="loginerror"><i class="fa fa-warning"></i> Your username or password is incorrect.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 pull-right col-lg-3">
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-signin">Sign In</button>
									</div>
								</div>
								<div class="col-md-2 pull-right">
									<div class="loginloader">
										<img src="<?php echo base_url('assets/images/loaders/circular/003.gif');?>">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
        // document ready function
        $(function() {
			var offset = new Date().getTimezoneOffset();
			offset = 0 - offset;
			$("#usertimezoneoffset").val(offset);
			$("#loginerror").hide();
			$(".loginloader").hide();
			var options = { 
				beforeSubmit: function(formData, jqForm, options) { 
					$(".loginloader").show();
					$(".btn-signin").attr('disabled','disabled');
				},
				dataType: 'json',
				success: function(responseText, statusText, xhr, $form){
					if(responseText.type == false){
						$(".btn-signin").removeAttr('disabled');
						$(".loginloader").hide();
						var html = '<i class="fa fa-warning"></i> ';
						html = html + responseText.message;
						$("#loginerror").html(html);
						$("#loginerror").show();
						$("#formlogin").find('input[name=password]').val('');
					}else{
						window.location.href = responseText.message;
					}
				}
			}; 
			$("#formlogin").ajaxForm(options);
        });
    </script>
</body>
</html>
