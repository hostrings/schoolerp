<div class="row">
	<div class="col-xs-12">
		<h3>Student Admission Form</h3>
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
						<td>Date</td>
						<td><?php echo display_date_by_timezone('',true,false);?></td>
					</tr>
					<tr>
						<td>Student Name</td>
						<td colspan="3">
							<input type="text" class="form-control required" name="studentname" maxlength="255" value="<?php echo isset($post['studentname'])?$post['studentname']:'';?>">
						</td>
						<td style="width:10px;"><span class="iconrequired">*</span></td>
					</tr>
					<tr>
						<td>N.I.C No/ B-Form</td>
						<td colspan="3">
							<input type="text" class="form-control mask-nic" name="nic_no" value="<?php echo isset($post['nic_no'])?$post['nic_no']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Father's Name</td>
						<td colspan="3">
							<input type="text" class="form-control required" name="fathername" maxlength="255" value="<?php echo isset($post['fathername'])?$post['fathername']:'';?>">
						</td>
						<td style="width:10px;"><span class="iconrequired">*</span></td>
					</tr>
					<tr>
						<td>Father's N.I.C No.</td>
						<td colspan="3">
							<input type="text" class="form-control mask-nic" name="father_nic_no" value="<?php echo isset($post['father_nic_no'])?$post['father_nic_no']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Date of Birth</td>
						<td>
							<select name="byear" class="byearselect">
								<script type="text/javascript">
									var myDate = new Date();
									var year = myDate.getFullYear();
									for(var i = year; i > 1900; i--){
										document.write('<option value="'+i+'">'+i+'</option>');
									}
  								</script>
							</select>&nbsp&nbsp
							<select name="bmonth" class="bmonthselect">
								<?php
									for($i=1; $i<=12; $i++){
										echo '<option value='.$i.'>'.$i.'</option>';
									}
								?>
							</select>&nbsp&nbsp
							<select name="bday" class="bdayselect">
								<?php
									for($i=1; $i<=31; $i++){
										echo '<option value='.$i.'>'.$i.'</option>';
									}
								?>
							</select>
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
						<td>Email</td>
						<td>
							<input type="text" class="form-control" name="email" maxlength="255" value="<?php echo isset($post['email'])?$post['email']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Phone(Father)</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="phone_father" maxlength="255" value="<?php echo isset($post['phone_father'])?$post['phone_father']:'';?>">
						</td>
						<td>Phone(Mother)</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="phone_mother" maxlength="255" value="<?php echo isset($post['phone_mother'])?$post['phone_mother']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td>Previous School Name</td>
						<td>
							<input type="text" class="form-control" name="prev_school_name" maxlength="255" value="<?php echo isset($post['prev_school_name'])?$post['prev_school_name']:'';?>">	
						</td>
					</tr>
					<tr>
						<td>Admission Class</td>
						<td>
							<select name="admission_class" class="select2" placeholder="....Select Any....">
								<option value=""></option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">Pre-Kindergarten</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">Kindergarten</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">1st Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">2nd Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">3rd Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">4th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">5th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">6th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">7th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">8th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">9th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">10th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">11th Grade</option>
								<option value="<?php echo isset($post['admission_class'])?$post['admission_class']:'';?>">12th Grade</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="3"><b>Name of Brother and Sisters already study in this school:</b></td>
						<td>
							<input type="checkbox" name="student_status" value="active" <?php echo isset($post['student_status'])?($post['student_status']=='active'?'checked="checked"':''):'checked="checked"';?>> Active
						</td>
					</tr>
					<tr>
						<td colspan="2">Name</td>
						<td colspan="2">Class</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" class="form-control" name="brothername" value="<?php echo isset($post['brothername'])?$post['brothername']:'';?>">
						</td>
						<td colspan="2">
							<input type="text" class="form-control" name="brother_class" value="<?php echo isset($post['brother_class'])?$post['brother_class']:'';?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" class="form-control" name="sistername" value="<?php echo isset($post['sistername'])?$post['sistername']:'';?>">
						</td>
						<td colspan="2">
							<input type="text" class="form-control" name="sister_class" value="<?php echo isset($post['sister_class'])?$post['sister_class']:'';?>">
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
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
	$(".mask-nic").mask("99999-9999999-9", {completed:function(){}});
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
		return valid;
	});
});
</script>