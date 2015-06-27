<div class="row">
	<div class="col-xs-12">
		<h3>Student Class Strength</h3>
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
				<table id="grid" style="width:250px" border="1" cellspacing="0">
					<tr id="header" style="background-color:#d3e0f5; text-align: center">
						<td>Section</td>
						<td>Strength</td>						
					</tr>
					<?php for($i=0;$i<count($lists);$i++) {?>
					<tr>
						<td><?php echo $lists[$i]['section']?></td>
						<td><?php echo $lists[$i]['strength']?></td>
					</tr>
					<?php }//endforeach;?>
				</table>
			</div>
		</div>
	</form>
	</div>
</div>
