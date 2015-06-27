<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<h3>Institute List <small>List of registered Institute in this application</small></h3>
	</div>
</div>
<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<form method="get" action="<?php echo site_url('admin/institute_list');?>">
			<div class="row">
				<div class="col-xs-2">
					Search Institute Name
				</div>
				<div class="col-xs-4">
					<div class="input-group">
						<input type="text" placeholder="Search Institute Name..." class="form-control" name="q" value="<?php echo $keyword;?>">
						<span class="input-group-btn">
							<button class="btn btn-flat" id="search-btn" type="submit"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</form>
		<div class="row top10">
			<div class="col-xs-12">
				<?php if(count($lists) > 0){ ?>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th style="width:40px">#</th>
							<th>Institute Name</th>
							<th>Registered Date</th>
							<th>Expired Date</th>
							<th>Status</th>
							<th style="width: 100px">&nbsp;</th>
						</tr>
						<?php
						$i = $offset;
						foreach($lists as $list){
							$i++;
							?>
						<tr>
							<td><?php echo $i;?>.</td>
							<td><?php echo $list['school_name'];?></td>
							<td><?php echo display_date_by_timezone($list['license_date']);?></td>
							<td><?php echo display_date_by_timezone($list['license_expired_date']);?></td>
							<td><?php if(strtotime($list['license_expired_date']) < time() && $list['license_expired_date'] != '0000-00-00 00:00:00') echo "Suspended"; else echo "Active";?></td>
							<td>
								<a title="View Detail" href="<?php echo site_url('admin/institute_detail/'.$list['license_id']);?>" class="btn btn-warning"><i class="fa fa-list-alt"></i></a>&nbsp;
								<a title="Delete" href="<?php echo site_url('admin/institute_delete/'.$list['license_id']);?>" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Institute?');"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php echo $pagination;?>
				<?php }else{ ?>
					No Registered Institute found.
				<?php } ?>
			</div>
		</div>
	</div>
</div>