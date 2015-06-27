<div class="row">
	<div class="col-xs-12">
		<h3>Student List</h3>
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
			<div class="col-xs-12">
				<table id="grid" style="width:100%" border="1" cellspacing="0">
					<tr id="header" style="background-color:#d3e0f5; text-align: center">
						<td>Registration Code</td>
						<td>Reference No</td>						
						<td>Family Code</td>
						<td>Date</td>
						<td>Student Name</td>
						<td>Class</td>
						<td>Section</td>
						<td>Father Name</td>
						<td>Father NIC NO</td>
						<td>Leaving Remarks</td>
						<td>Gender</td>
						<td>Religion</td>
					</tr>
					<?php foreach ($lists as $list): ?>
					<tr>
						<td><?php echo $list['registration_code']?></td>
						<td><?php echo $list['reference_no']?></td>
						<td><?php echo $list['family_code']?></td>
						<td><?php echo $list['registdate']?></td>
						<td><?php echo $list['studentname']?></td>
						<td><?php echo $list['current_class']?></td>
						<td><?php echo $list['section']?></td>
						<td><?php echo $list['fathername']?></td>
						<td><?php echo $list['father_nic_no']?></td>
						<td><?php echo $list['leaving_remarks']?></td>
						<td><?php echo $list['gender']?></td>
						<td><?php echo $list['religion']?></td>
					</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</form>
	</div>
</div>
