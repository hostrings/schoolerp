<div class="row">
	<div class="col-xs-12">
		<h3>Employee Registration <small>You can register employee in your institute here.</small></h3>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
	<form method="post" action="" enctype="multipart/form-data">
		<?php if(isset($message_type) ){ ?>
		<div class="alert alert-<?php echo $message_type;?>">
			<?php echo $message;?>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-xs-9">
				<table class="table">
					<tr>
						<td>Registration Date</td>
						<td><?php echo display_date_by_timezone('',true,false);?></td>
						<td>Employee Code</td>
						<td>
							<input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $employee_code;?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Name</td>
						<td colspan="3">
							<input type="text" class="form-control required" name="name" maxlength="255" value="<?php echo isset($post['name'])?$post['name']:'';?>">
						</td>
						<td style="width:10px;"><span class="iconrequired">*</span></td>
					</tr>
					<tr>
						<td>C.N.I.C No</td>
						<td colspan="3">
							<input type="text" class="form-control mask-cnic" name="cnic_no" value="<?php echo isset($post['cnic_no'])?$post['cnic_no']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Father Name</td>
						<td colspan="3">
							<input type="text" class="form-control required" name="father_name" maxlength="255" value="<?php echo isset($post['father_name'])?$post['father_name']:'';?>">
						</td>
						<td style="width:10px;"><span class="iconrequired">*</span></td>
					</tr>
					<tr>
						<td>Father C.N.I.C No</td>
						<td colspan="3">
							<input type="text" class="form-control mask-cnic" name="father_cnic_no" value="<?php echo isset($post['father_cnic_no'])?$post['father_cnic_no']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td colspan="3">
							<div class="col-xs-6">
								<div class="radio" style="margin:0;">
									<label>
										<input type="radio" class="" name="gender" value="male" <?php echo isset($post['gender'])?($post['gender']=='male'?'checked="checked"':''):'';?>>
										Male
									</label>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="radio" style="margin:0;">
									<label>
										<input type="radio" class="" name="gender" value="female" <?php echo isset($post['gender'])?($post['gender']=='female'?'checked="checked"':''):'';?>>
										Female
									</label>
								</div>
							</div>
							<div class="clear"></div>
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Date of Birth</td>
						<td colspan="3">
							<input type="text" class="form-control datepicker datepicker-13-17" readonly="readonly" name="dateofbirth" value="<?php echo isset($post['dateofbirth'])?$post['dateofbirth']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Religion</td>
						<td>
							<select name="religion" class="select2" placeholder="Choose Religion">
								<option value=""></option>
								<option value="Christian" <?php echo isset($post['religion'])?($post['religion']=='Christian'?'selected="selected"':''):'';?>>Christian</option>
								<option value="Catholic" <?php echo isset($post['religion'])?($post['religion']=='Catholic'?'selected="selected"':''):'';?>>Catholic</option>
								<option value="Islam" <?php echo isset($post['religion'])?($post['religion']=='Islam'?'selected="selected"':''):'';?>>Islam</option>
								<option value="Buddha" <?php echo isset($post['religion'])?($post['religion']=='Buddha'?'selected="selected"':''):'';?>>Buddha</option>
								<option value="Hindu" <?php echo isset($post['religion'])?($post['religion']=='Hindu'?'selected="selected"':''):'';?>>Hindu</option>
								<option value="Other" <?php echo isset($post['religion'])?($post['religion']=='Other'?'selected="selected"':''):'';?>>Other</option>
							</select>
						</td>
						<td>Cell No.</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="phone" maxlength="255" value="<?php echo isset($post['phone'])?$post['phone']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Phone No.</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="home_phone" maxlength="255" value="<?php echo isset($post['home_phone'])?$post['home_phone']:'';?>">
						</td>
						<td>Other No.</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="other_phone" maxlength="255" value="<?php echo isset($post['other_phone'])?$post['other_phone']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Join Date</td>
						<td>
							<input type="text" class="form-control datepicker" name="join_date" placeholder="yyyy-mm-dd" value="<?php echo isset($post['join_date'])?$post['join_date']:'';?>">
						</td>
						<td>Salary</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="salary" maxlength="255" value="<?php echo isset($post['salary'])?$post['salary']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Designation</td>
						<td>
							<?php if(count($getGroup) == 0){
								echo "No Designation found in your institute";
							}else{ ?>
							<select name="group_id" class="select2" placeholder="Choose Designation">
								<option value=""></option>
								<?php foreach($getGroup as $g){ ?>
								<option value="<?php echo $g['group_id'];?>" <?php echo isset($post['group_id'])?($post['group_id']==$g['group_id']?'selected="selected"':''):'';?>><?php echo $g['group_name'];?></option>
								<?php } ?>
							</select>
							<?php } ?>
						</td>
						<td>Qualification</td>
						<td>
							<?php if(count($getQualification) == 0){
								echo "No Qualification found in your institute";
							}else{ ?>
							<select name="qualification_id" class="select2" placeholder="Choose Qualification">
								<option value=""></option>
								<?php foreach($getQualification as $g){ ?>
								<option value="<?php echo $g['qualification_id'];?>" <?php echo isset($post['qualification_id'])?($post['qualification_id']==$g['qualification_id']?'selected="selected"':''):'';?>><?php echo $g['qualification_name'];?></option>
								<?php } ?>
							</select>
							<?php } ?>
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Department</td>
						<td>
							<?php if(count($getDepartment) == 0){
								echo "No Department found in your institute";
							}else{ ?>
							<select name="department_id" class="select2" placeholder="Choose Department">
								<option value=""></option>
								<?php foreach($getDepartment as $g){ ?>
								<option value="<?php echo $g['department_id'];?>" <?php echo isset($post['department_id'])?($post['department_id']==$g['department_id']?'selected="selected"':''):'';?>><?php echo $g['department_name'];?></option>
								<?php } ?>
							</select>
							<?php } ?>
						</td>
						<td rowspan="3">Shift</td>
						<td rowspan="3">
							<textarea name="shift" style="height:120px;width:100%;"><?php echo isset($post['shift'])?$post['shift']:'';?></textarea>
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>
							<input type="email" class="form-control" name="email" maxlength="255" value="<?php echo isset($post['email'])?$post['email']:'';?>">
						</td>
					</tr>
					<tr>
						<td>Tag ID</td>
						<td>
							<input type="text" class="form-control" name="tag_id" maxlength="255" value="<?php echo isset($post['tag_id'])?$post['tag_id']:'';?>">
						</td>
					</tr>
					<tr>
						<td colspan="5">
							<table class="table" style="border:1px solid #ccc;">
								<tr>
									<td colspan="4"><b>Address:</b></td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
								<tr>
									<td style="width:120px;">Present</td>
									<td>
										<input type="text" class="form-control" name="address_present" maxlength="255" value="<?php echo isset($post['address_present'])?$post['address_present']:'';?>">
									</td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
								<tr>
									<td>Permanent</td>
									<td>
										<input type="text" class="form-control" name="address_permanent" maxlength="255" value="<?php echo isset($post['address_permanent'])?$post['address_permanent']:'';?>">
									</td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>Sort Order</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="sort_order" value="<?php echo isset($post['sort_order'])?$post['sort_order']:'';?>">
						</td>
						<td>Leave Date</td>
						<td>
							<input type="text" class="form-control datepicker" name="leave_date" placeholder="yyyy-mm-dd" style="width:70%;display:inline-block;" value="<?php echo isset($post['leave_date'])?$post['leave_date']:'';?>">
							<input type="checkbox" name="employeement_status" value="active" <?php echo isset($post['employeement_status'])?($post['employeement_status']=='active'?'checked="checked"':''):'checked="checked"';?>> Active
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Time From</td>
						<td>
							 <div class="bootstrap-timepicker">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="time_from" class="form-control timepicker" value="<?php echo isset($post['time_from'])?$post['time_from']:'';?>">
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div>
									</div><!-- /.input group -->
								</div><!-- /.form group -->
							</div>
						</td>
						<td>Time To</td>
						<td>
							<div class="bootstrap-timepicker">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="time_to" class="form-control timepicker" value="<?php echo isset($post['time_to'])?$post['time_to']:'';?>">
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div>
									</div><!-- /.input group -->
								</div><!-- /.form group -->
							</div>
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="5">
							<table class="table" style="border:1px solid #ccc;">
								<tr>
									<td colspan="4"><b>Message:</b></td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
								<tr>
									<td style="width:50px;">Name</td>
									<td>
										<input type="text" class="form-control required" name="name" maxlength="30" data-minlength="5" value="<?php echo isset($post['name'])?$post['name']:'';?>">
									</td>
									<td style="width:10px;"><span class="iconrequired">*</span></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>
										<input type="text" class="form-control required" name="email" id="txtpassword" maxlength="255" data-minlength="5" value="<?php echo isset($post['email'])?$post['email']:'';?>">
									</td>
									<td style="width:10px;"><span class="iconrequired">*</span></td>
								</tr>
								<tr>
									<td>Comment</td>
									<td>
										<input type="text" class="form-control required" name="message" id="txtpasswordconf" maxlength="255" data-minlength="5">
									</td>
									<td style="width:10px;"></td>	
								</tr>
								<tr>
									<div class="row">
										<div class="col-xs-12">
											<button type="submit" class="btn btn-primary btnsend">Send</button>
										</div>
									</div>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="5">
							<table class="table" style="border:1px solid #ccc;">
								<tr>
									<td colspan="4"><b>Login Information:</b></td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
								<tr>
									<td style="width:120px;">Username</td>
									<td>
										<input type="text" class="form-control required" name="username" maxlength="30" data-minlength="5" value="<?php echo isset($post['username'])?$post['username']:'';?>">
									</td>
									<td style="width:10px;"><span class="iconrequired">*</span></td>
								</tr>
								<tr>
									<td>Password</td>
									<td>
										<input type="password" class="form-control required" name="password" id="txtpassword" maxlength="255" data-minlength="5">
									</td>
									<td style="width:10px;"><span class="iconrequired">*</span></td>
								</tr>
								<tr>
									<td>Confirm Password</td>
									<td>
										<input type="password" class="form-control required" name="passwordconf" id="txtpasswordconf" maxlength="255" data-minlength="5">
									</td>
									<td style="width:10px;"><span class="iconrequired">*</span></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-xs-3">
				<div class="row">
					<div class="col-xs-12">
						<img src="<?php echo base_url('assets/images/no_photo.jpg');?>" class="col-xs-8">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<input type="file" name="user_employee_photo" class="col-xs-12">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<button type="reset" class="btn btnreset">Reset</button>
				<button type="submit" class="btn btn-primary btnsubmit">Save</button>
			</div>
		</div>
	</form>
	</div>
</div>
<script>
$(function(){
	$('.btnreset').click(function(event) {
		event.preventDefault();
		$(this).closest('form').get(0).reset();
		$('.select2').select2('val','');
	});
	$(".mask-cnic").mask("99999-9999999-9", {completed:function(){}});
	$( ".datepicker-13-17" ).datepicker( "option", "maxDate", new Date( <?php echo date('Y',strtotime('-13years'));?>, 11, 31 ) );
	$( ".datepicker-13-17" ).datepicker( "option", "yearRange", "<?php echo date('Y',strtotime('-70years'));?>:<?php echo date('Y',strtotime('-13years'));?>" );
	$(".btnsubmit").click(function(){
		var valid = true;
		$(".required").each(function(){
			if($.trim($(this).val()).length == 0){
				valid = false;
				if(!$(this).parents('.panel-collapse').hasClass('in')){
					var id = $(this).parents('.panel-collapse').attr('id');
					$('a[href=#'+id+']').trigger('click');
				}
				$(this).css({'border':'1px solid #f00'});
				$(this).focus();
				return valid;
			}else{
				var attr = $(this).attr('data-minlength');
				if (typeof attr !== typeof undefined && attr !== false) {
					if($.trim($(this).val()).length < attr){
						valid = false;
						if(!$(this).parents('.panel-collapse').hasClass('in')){
							var id = $(this).parents('.panel-collapse').attr('id');
							$('a[href=#'+id+']').trigger('click');
						}
						$(this).css({'border':'1px solid #f00'});
						$(this).focus();
						return valid;
					}
				}
			}
		});
		if($("#txtpassword").val() != $("#txtpasswordconf").val()){
			valid = false;
			$('.alert_error_message').show();
			$("#txtpasswordconf").focus();
			$("#txtpasswordconf").css({'border':'1px solid #f00'});
		}
		return valid;
	});

	$(".btnsend").click(function(){
		var valid = true;

	});
});
</script>