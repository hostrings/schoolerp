<div class="row">
	<div class="col-xs-12">
		<h3>Student Registration</h3>
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
						<td><a rel="prev" type="text/css" href="#" style="text-decoration: underline;">Previous</a></td>
						<td><a rel="next" type="text/css" href="#" style="text-decoration: underline;">Next</a></td>
					</tr>
					<tr>
						<td>Registration Code</td>
						<td>
							<input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $registration_code;?>">
						</td>
						<td>Reference No</td>
						<td>
							<input type="text" class="form-control" name="reference_no" value="<?php echo isset($post['reference_no'])?$post['reference_no']:'';?>">
						</td>
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
						<td><p>Current Class<span class="iconrequired">*</span></p></td>
						<td>
							<select name="current_class" class="select2" placeholder="....Select Any....">
								<option value=""></option>
								<option value="Pre-Kindergarten" <?php echo isset($post['current_class'])?($post['current_class']=='Pre-Kindergarten'?'selected="selected"':''):'';?>>Pre-Kindergarten</option>
								<option value="Kindergarten" <?php echo isset($post['current_class'])?($post['current_class']=='Kindergarten'?'selected="selected"':''):'';?>>Kindergarten</option>
								<option value="1st Grade" <?php echo isset($post['current_class'])?($post['current_class']=='1st Grade'?'selected="selected"':''):'';?>>1st Grade</option>
								<option value="2nd Grade" <?php echo isset($post['current_class'])?($post['current_class']=='2nd Grade'?'selected="selected"':''):'';?>>2nd Grade</option>
								<option value="3rd Grade" <?php echo isset($post['current_class'])?($post['current_class']=='3rd Grade'?'selected="selected"':''):'';?>>3rd Grade</option>
								<option value="4th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='4th Grade'?'selected="selected"':''):'';?>>4th Grade</option>
								<option value="5th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='5th Grade'?'selected="selected"':''):'';?>>5th Grade</option>
								<option value="6th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='6th Grade'?'selected="selected"':''):'';?>>6th Grade</option>
								<option value="7th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='7th Grade'?'selected="selected"':''):'';?>>7th Grade</option>
								<option value="8th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='8th Grade'?'selected="selected"':''):'';?>>8th Grade</option>
								<option value="9th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='9th Grade'?'selected="selected"':''):'';?>>9th Grade</option>
								<option value="10th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='10th Grade'?'selected="selected"':''):'';?>>10th Grade</option>
								<option value="11th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='11th Grade'?'selected="selected"':''):'';?>>11th Grade</option>
								<option value="12th Grade" <?php echo isset($post['current_class'])?($post['current_class']=='12th Grade'?'selected="selected"':''):'';?>>12th Grade</option>
							</select>
						</td>
						<td>Section</td>
						<td>
							<select name="section" class="select2" placeholder="....Select Any....">
								<option value=""></option>
								<option value="1" <?php echo isset($post['section'])?($post['section']=='1'?'selected="selected"':''):'';?>>1</option>
								<option value="2" <?php echo isset($post['section'])?($post['section']=='2'?'selected="selected"':''):'';?>>2</option>
								<option value="3" <?php echo isset($post['section'])?($post['section']=='3'?'selected="selected"':''):'';?>>3</option>
								<option value="4" <?php echo isset($post['section'])?($post['section']=='4'?'selected="selected"':''):'';?>>4</option>
								<option value="5" <?php echo isset($post['section'])?($post['section']=='5'?'selected="selected"':''):'';?>>5</option>
								<option value="6" <?php echo isset($post['section'])?($post['section']=='6'?'selected="selected"':''):'';?>>6</option>
								<option value="7" <?php echo isset($post['section'])?($post['section']=='7'?'selected="selected"':''):'';?>>7</option>
								<option value="8" <?php echo isset($post['section'])?($post['section']=='8'?'selected="selected"':''):'';?>>8</option>
							</select>
						</td>
						<td style="width:10px;"><span class="iconrequired">*</span></td>
					</tr>
					<tr>
						<td>Registration Class</td>
						<td>
							<select name="registration_class" class="select2" placeholder="....Select Any....">
								<option value=""></option>
								<option value="Pre-Kindergarten" <?php echo isset($post['registration_class'])?($post['registration_class']=='Pre-Kindergarten'?'selected="selected"':''):'';?>>Pre-Kindergarten</option>
								<option value="Kindergarten" <?php echo isset($post['registration_class'])?($post['registration_class']=='Kindergarten'?'selected="selected"':''):'';?>>Kindergarten</option>
								<option value="1st Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='1st Grade'?'selected="selected"':''):'';?>>1st Grade</option>
								<option value="2nd Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='2nd Grade'?'selected="selected"':''):'';?>>2nd Grade</option>
								<option value="3rd Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='3rd Grade'?'selected="selected"':''):'';?>>3rd Grade</option>
								<option value="4th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='4th Grade'?'selected="selected"':''):'';?>>4th Grade</option>
								<option value="5th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='5th Grade'?'selected="selected"':''):'';?>>5th Grade</option>
								<option value="6th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='6th Grade'?'selected="selected"':''):'';?>>6th Grade</option>
								<option value="7th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='7th Grade'?'selected="selected"':''):'';?>>7th Grade</option>
								<option value="8th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='8th Grade'?'selected="selected"':''):'';?>>8th Grade</option>
								<option value="9th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='9th Grade'?'selected="selected"':''):'';?>>9th Grade</option>
								<option value="10th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='10th Grade'?'selected="selected"':''):'';?>>10th Grade</option>
								<option value="11th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='11th Grade'?'selected="selected"':''):'';?>>11th Grade</option>
								<option value="12th Grade" <?php echo isset($post['registration_class'])?($post['registration_class']=='12th Grade'?'selected="selected"':''):'';?>>12th Grade</option>
							</select>
						</td>
						<td>Family Code</td>
						<td>
							<input type="text" class="form-control family_code" name="phone_mother" maxlength="255" value="<?php echo isset($post['family_code'])?$post['family_code']:'';?>">
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td><p>Fee Package<span class="iconrequired">*</span></p></td>
						<td>
							<select name="fee_package" class="select2" placeholder="....Select Any....">
								<option value=""></option>
								<option value="Fee Package" <?php echo isset($post['fee_package'])?($post['fee_package']=='Fee Package'?'selected="selected"':''):'';?>>Fee Package</option>
							</select>
						</td>
						<td>Discount</td>
						<td>
							<div class="discount" style="width: 100%;">
								<div class="col-md-6">
									<input type="text" class="form-control discount" name="discount" value="<?php echo isset($post['discount'])?$post['discount']:'';?>">	
								</div>
								<div class="col-md-6">
									<select name="checkselect" class="select2" placeholder="choose anyone">
										<option value="flat">Flat</option>
										<option value=""></option>
										<option value=""></option>
										<option value=""></option>
									</select>
								</div>
							</div>
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="5">
							<table class="table" style="border:1px solid #ccc;">
								<tr>
									<td colspan="4"><b>Address:</b></td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
								<tr>
									<td>Present</td>
									<td colspan="3">
										<input type="text" class="form-control present_address" name="present_address" maxlength="255" value="<?php echo isset($post['present_address'])?$post['present_address']:'';?>">
									</td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
								<tr>
									<td>Permanent</td>
									<td colspan="3">
										<input type="text" class="form-control permanent_address" name="permanent_address" maxlength="255" value="<?php echo isset($post['permanent_address'])?$post['permanent_address']:'';?>">
									</td>
									<td style="width:10px;">&nbsp;</td>
								</tr>
								<tr>
									<td>Nationality</td>
									<td>
										<select name="nationality" class="select2">
											<option value="United States">United States</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="France">France</option>
											<option value="Sweden">Sweden</option>
											<option value="Germany">Germany</option>
											<option value="Belgium">Belgium</option>
											<option value="Netherland">Netherland</option>
											<option value="Norway">Norway</option>
											<option value="Japan">Japan</option>
											<option value="South Africa">South Africa</option>
											<option value="Poland">Poland</option>
										</select>
									</td>
									<td>Ethnicity</td>
									<td>
										<select name="ethnicity" class="select2">
											<option value="European">European</option>
											<option value="North American">North American</option>
											<option value="South American">South American</option>
											<option value="Asian">Asian</option>
											<option value="African">African</option>
										</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>Sort Order</td>
						<td>
							<input type="text" class="form-control onlyNumbers" name="sort_order" value="<?php echo isset($post['sort_order'])?$post['sort_order']:'';?>">
						</td>
						<td></td>
						<td>
							<input type="checkbox" name="student_status" value="active" <?php echo isset($post['student_status'])?($post['student_status']=='active'?'checked="checked"':''):'checked="checked"';?>> Active
						</td>
						<td style="width:10px;">&nbsp;</td>
					</tr>
				</table>
			</div>
			<div class="col-xs-3">
				<div class="row">
					<div class="col-xs-12">
						<img src="<?php echo base_url('assets/uploads/employee_photo/no_photo.jpg');?>" class="col-xs-8">
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
	$(".mask-nic").mask("99999-9999999-9", {completed:function(){}});
	// $( ".datepicker-13-17" ).datepicker( "option", "maxDate", new Date( <?php echo date('Y',strtotime('-13years'));?>, 11, 31 ) );
	// $( ".datepicker-13-17" ).datepicker( "option", "yearRange", "<?php echo date('Y',strtotime('-70years'));?>:<?php echo date('Y',strtotime('-13years'));?>" );
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