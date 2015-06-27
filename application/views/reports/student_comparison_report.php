<div class="row">
	<div class="col-xs-10">
		<h3>Student Comparison Report</h3>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
	<form method="post" action="Student.php" enctype="multipart/form-data">
		<?php if(isset($message_type) ){ ?>
		<div class="alert alert-<?php echo $message_type;?>">
			<?php echo $message;?>
		</div>
		<?php } ?>
		<div class="student-comparison-report-select">
			<div class="col-xs-5">
				<table class="table">
					<tr>
						<td id="registration_class" style="width:120px">Class</td>
						<td id="registration_class_value" style="width:250px">
							<select name="registration_class" class="select2" placeholder="....Select Any....">
								<option value=""></option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">Pre-Kindergarten</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">Kindergarten</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">1st Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">2nd Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">3rd Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">4th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">5th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">6th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">7th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">8th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">9th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">10th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">11th Grade</option>
								<option value="<?php echo isset($post['registration_class'])?$post['registration_class']:'';?>">12th Grade</option>
							</select>
						</td>
					</tr>					
					<tr>
						<td id="section" style="width:120px">Section</td>
						<td id="sectionvalue" style="width:250px">
							<select name="current_class" class="select2" placeholder="....Select Any....">
								<option value=""></option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">1</option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">2</option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">3</option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">4</option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">5</option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">6</option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">7</option>
								<option value="<?php echo isset($post['section'])?$post['section']:'';?>">8</option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button type="submit" id="btn btnSubmit" style="width:100px; height:30px; float: right">Generate</button>	
						</td>
					</tr>
				</table>
			
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<table id="grid" style="width:100%" border="1" cellspacing="0">
					<tr id="header" style="background-color:#d3e0f5; text-align: center">
						<td>Registration Code</td>
						<td>Reference No</td>						
						<td>Student Name</td>
						<td>Father Name</td>
						<td>Class Name</td>
						<td>Section Name</td>
						<td>Phone No(Father)</td>
						<td>Phone No(Mother)</td>
						<td>Present Address</td>
						<td>Permanent Address</td>
						<td>Nationality</td>
						<td>Ethnicity</td>
						<td>Active</td>
					</tr>
					<tr>
						<td>
							<input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo isset($post['registration_code'])?$post['registration_code']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo isset($post['reference_no'])?$post['reference_no']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" name="studentname" maxlength="255" readonly="readonly" disabled="disabled" value="<?php echo isset($post['studentname'])?$post['studentname']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" name="fathername" readonly="readonly" disabled="disabled" value="<?php echo isset($post['fathername'])?$post['fathername']:'';?>">
						</td>
						<td>
							<input type="text" name="current_class" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo isset($post['current_class'])?$post['current_class']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" name="section" readonly="readonly" disabled="disabled" value="<?php echo isset($post['section'])?$post['section']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" readonly="readonly" name="phone_father" value="<?php echo isset($post['phone_father'])?$post['phone_father']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" name="phone_mother" readonly="readonly" disabled="disabled" value="<?php echo isset($post['phone_mother'])?$post['phone_mother']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" readonly="readonly" name="present_address" value="<?php echo isset($post['present_address'])?$post['present_address']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" name="permanent_address" readonly="readonly" disabled="disabled" value="<?php echo isset($post['permanent_address'])?$post['permanent_address']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" readonly="readonly" name="nationality" value="<?php echo isset($post['nationality'])?$post['nationality']:'';?>">
						</td>
						<td>
							<input type="text" class="form-control" name="ethnicity" readonly="readonly" disabled="disabled" value="<?php echo isset($post['ethnicity'])?$post['ethnicity']:'';?>">
						</td>
						<td>
							<input type="checkbox" class="form-control" name="student_status" readonly="readonly" disabled="disabled" value="active "<?php echo isset($post['student_status'])?($post['student_status']=='active'?'checked="checked"':''):'checked="checked"';?>>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnSubmit').bind("click", function(event){
			event.preventDefault();
			$(this).closest('form').get(0).submit();
			$('.select2').select2('val','');
		});
	});
</script>