<div class="row">
	<div class="col-xs-10">
		<h3>Class Promotion</h3>
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
		<div class="contact-info-select">
			<div class="col-xs-5">
				<table class="table">
					<tr>
						<td id="promotiondate" style="width:120px">Promotion Date :</td>
						<td style="width:250px">
							<input type="text" class="form-control datepicker datepicker-13-17" readonly="readonly" name="promotiondate" value="<?php echo isset($post['promotiondate'])?$post['promotiondate']:'';?>">
						</td>
					</tr>
					<tr>
						<td id="from_class" style="width:120px">From Class :</td>
						<td id="from_class_value" style="width:250px">
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
						<td id="to_class" style="width:120px">To Class :</td>
						<td id="to_class_value" style="width:250px">
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
						<td id="from_section" style="width:120px">From Section :</td>
						<td id="from_section_value" style="width:250px">
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
						<td id="to_section" style="width:120px">To Section :</td>
						<td id="to_section_value" style="width:250px">
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
							<button type="submit" id="btn btnSubmit" style="width:100px; height:30px; float: right">Load</button>	
						</td>
					</tr>
				</table>
			
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<table id="grid" style="width:450px" border="1" cellspacing="0">
					<tr id="header" style="background-color:#d3e0f5; text-align: center">
						<td>Registration Code</td>
						<td>Reference No</td>						
						<td>Student Name</td>
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
			$( ".datepicker-13-17" ).datepicker( "option", "maxDate", new Date( <?php echo date('Y',strtotime('-13years'));?>, 11, 31 ) );
		});
	});
</script>