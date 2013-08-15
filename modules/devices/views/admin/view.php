<?php print displayStatus();?>
<h2><?php echo $header;?></h2>
<!--
<div class="buttons">                
	<a href="<?php print site_url($module.'/admin/form')?>">
    <?php print  $this->bep_assets->icon('add');?>
    <?php print "Create new"; ?>
    </a>
</div>

<div class="buttons">                
	<a href="<?php print site_url($module.'/admin/import')?>">
    <?php print  $this->bep_assets->icon('disk');?>
    <?php print "Import"; ?>
    </a>
</div>
-->
<?php if (count($pages)){ ?>
<?php print form_open($module.'/admin/dellist'); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th width="5%">ID</th>
			<th>Client ID</th>
			<th>App</th>
			<th>UDID</th>
			<th>Device Name</th>
			<th>Created</th>
			<!--
			<th width="5%">Model</th>
			<th width="5%">Version</th>
			-->
			<th width="5%">Badge</th>
			<th width="5%">Alert</th>
			<th width="5%">Sound</th>
			<th width="5%">Enable</th>
			<th width="5%" class="middle">Count</th>
			<th width="5%" class="middle">Status</th>
			<th width="5%" class="middle">View</th>
			<th width="5%" class="middle">Edit</th>
			<th width="5%" class="middle">Delete</th>
			<th width="7%" class="middle"><?php print form_checkbox('all','select',FALSE); ?><?php echo "Select"; ?></th>
		</tr>
	</thead>
	<tfoot>
	    <tr>
	        <td colspan="14">&nbsp;</td>
	        <td colspan="2">
		        <?php print form_submit('delete', 'Delete','onClick="return confirm(\''.'Do you want to delete selected items?'.'\');"'); ?>
	        </td>
	    </tr>
	</tfoot>
	<tbody>
	<?php
		$count = 0;
	
		foreach ($pages as $key => $row) :
			$delete  = form_checkbox('select[]',$row['pid'],FALSE);
			
			$active =  ($row['status'] == 'active' ? 'tick':'cross');
			$activeTitle =  ($row['status'] == 'active' ? 'Change to uninstalled':'Change to active');
			
			$count++;
	 	?>
			<tr class="<?php echo ($count % 2 == 0 ? "even" : "odd"); ?>">
				<td><?php echo $row['pid']; ?></td>
				<td><?php echo $row['clientid']; ?></td>
				<td><?php echo $row['appname']; ?></td>
				<td><?php echo $row['deviceuid']; ?></td>
				<td><?php echo $row['devicename']; ?></td>
				<td><?php echo date_format(date_create($row['created']), "d/m/Y"); ?></td>
				<!--
				<td><?php echo $row['devicemodel']; ?></td>
				<td><?php echo $row['deviceversion']; ?></td>
				-->
				<td><?php echo ($row['pushbadge'] == 'enabled' ? 'YES' : 'NO'); ?></td>
				<td><?php echo ($row['pushalert'] == 'enabled' ? 'YES' : 'NO'); ?></td>
				<td><?php echo ($row['pushsound'] == 'enabled' ? 'YES' : 'NO'); ?></td>
				<td><?php echo (
				($row['pushsound'] == 'enabled' && $row['pushalert'] == 'enabled' && $row['pushbadge'] == 'enabled') ? 'YES' : 
				(
				($row['pushsound'] == 'disabled' && $row['pushalert'] == 'disabled' && $row['pushbadge'] == 'disabled') ? 'NO' : '' 
				)
				); ?></td>
                                <td><?php echo $row['count']; ?></td>
				<td class="middle"><a title="<?php echo $activeTitle; ?>" href="<?php print site_url($module.'/admin/changeStatus/'.$row['pid']); ?>"><?php print $this->bep_assets->icon($active); ?></a>
				</td>
				<td><a title="View this item" href="<?php print site_url($module.'/admin/item/'.$row['pid']); ?>"><?php echo 'View' ?></a></td>
				<td class="middle"><a title="Edit this item" href="<?php print site_url($module.'/admin/form/'.$row['pid']); ?>"><?php print $this->bep_assets->icon('pencil'); ?></a></td>
				<td class="middle"><a title="Delete this item" onclick="return confirm('Are you sure you want to delete?')" href="<?php print site_url($module.'/admin/delete/'.$row['pid']); ?>"><?php print $this->bep_assets->icon('delete'); ?></a></td>
				<td colspan="2" class="middle"><?php print $delete ?></td>
			</tr>
			<?php
		endforeach;
	?>
	</tbody>
</table>
<?php print form_close()?>
</div>
<br><br>
<div style="float:right;">
<?php print $paging; ?>
</div>
<?php } ?>
<script type="text/javascript">
	
			$(document).ready(function() {
				$('#example').dataTable({ 
						"aaSorting": [[ 0, "desc" ]], 
						"bPaginate": false,
						"bFilter": true,
						"bSort": true,
						"bInfo": false,
						"bAutoWidth": true });
						
				$('.dataTables_wrapper').css('min-height',0);
			});
			
</script>