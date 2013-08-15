<?php print displayStatus(); ?>
<h2><?php echo $header; ?></h2>

<?php print form_open_multipart($module.'/admin/form/'.$this->validation->id, array('class'=>'horizontal'))
?>
    <fieldset>
        <ol>
        	<li>
        	    <?php print form_label('File Dis *.pem','File Dis *.pem')?>
        	    <?php print form_input('pemdis',$this->validation->pemdis,'id="pemdis" class="text" style="width:500px;"')?>
        	</li>
        	<li>
        	    <?php print form_label('File Dev *.pem','File Dev *.pem')?>
        	    <?php print form_input('pemdev',$this->validation->pemdev,'id="pemdev" class="text" style="width:500px;"')?>
        	</li>
        	
        	<li>
        	    <?php print form_label('Alert','alert')?>
        	    <?php print form_input('alert',$this->validation->alert,'id="alert" class="text" style="width:500px;"')?>
        	</li>
        	<li>
        	    <?php print form_label('Badge','badge')?>
        	    <?php print form_input('badge',$this->validation->badge,'id="badge" class="text" style="width:100px;"')?>
        	</li>
        	<li>
        	    <?php print form_label('Sound','sound')?>
        	    <?php print form_input('sound',$this->validation->sound,'id="sound" class="text" style="width:100px;"')?>
        	</li>
        	<li>
        	    <?php print form_label('View button text','btntext')?>
        	    <?php print form_input('btntext',$this->validation->btntext,'id="btntext" class="text" style="width:100px;"')?>
        	</li>
            <li>
                <?php print form_label('Url','url')?>
                <?php print form_input('url',$this->validation->url,'id="url" class="text" style="width:500px;"')?>
            </li>
			<li>
			    <?php print form_label('Title','title')?>
			    <?php print form_input('title',$this->validation->title,'id="title" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('Description','description')?>
			    <?php print form_textarea('description',$this->validation->description,'id="title" class="text" style="width:500px;"')?>
			</li>
            <li class="submit">
                <?php print form_hidden('id',$this->validation->id)?>
                <div class="buttons">
	                <button type="submit" class="positive" name="submit" value="submit">
	                	<?php print $this->bep_assets->icon('disk'); ?>
	                	<?php print 'Send to all client'; ?>
	                </button>
	                <button type="reset" class="positive" name="reset" value="reset">
	                	<?php print $this->bep_assets->icon('arrow_refresh'); ?>
	                	<?php print "reset"; ?>
	                </button>
	                <a href="<?php print  site_url($module.'/admin/index/')?>" class="negative">
	                	<?php print  $this->bep_assets->icon('cross');?>
	                	<?php print $this->lang->line('general_cancel'); ?>
	                </a>
	           </div>
            </li>
        </ol>
    </fieldset>
    
    <?php if (count($pages)){ ?>
    <h2><?php echo 'Select app to send message'; ?></h2>
    <div id="demo">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    	<thead>
    		<tr>
    		<!--
    			<th width="5%">ID</th>
    			<th>Client ID</th>
    			-->
    			<th>App</th>
<!--    			<th>UDID</th>
    			<th>Created</th>
    			
    			<th width="5%">Model</th>
    			<th width="5%">Version</th>
    			<th width="5%">Badge</th>
    			<th width="5%">Alert</th>
    			<th width="5%">Sound</th>
    			<th width="5%" class="middle">Edit</th>
    			
    			<th width="5%" class="middle">Status</th>
    			-->
    			<th width="10%" class="middle"><?php print form_checkbox('all','select',TRUE); ?><?php echo "Select"; ?></th>
    		</tr>
    	</thead>
    	<tfoot>
    	    <tr>
    	        <td colspan="2" class="middle"><div class="buttons">
    	            <button type="submit" class="positive" name="submit" value="submit">
    	            	<?php print $this->bep_assets->icon('disk'); ?>
    	            	<?php print 'Send to selected app'; ?>
    	            </button>
    	            </div>
    	         </td>
    	    </tr>
    	</tfoot>
    	<tbody>
    	<?php
    		$count = 0;
    	
    		foreach ($pages as $key => $row) :
    			$delete  = form_checkbox('select[]',$row['appname'],TRUE);
    			/*
    			$active =  ($row['status'] == 'active' ? 'tick':'cross');
    			$activeTitle =  ($row['status'] == 'active' ? 'Change to uninstalled':'Change to active');
    			*/
    			$count++;
    	 	?>
    			<tr class="<?php echo ($count % 2 == 0 ? "even" : "odd"); ?>">
    			<!--
    				<td><?php echo $row['pid']; ?></td>
    				<td><?php echo $row['clientid']; ?></td>
    				-->
    				<td><?php echo $row['appname']; ?></td>
<!--    				<td><?php echo $row['deviceuid']; ?></td> 
    				<td><?php echo date_format(date_create($row['created']), "Y-m-d"); ?></td>
    				<td><?php echo $row['devicemodel']; ?></td>
    				<td><?php echo $row['deviceversion']; ?></td>
    				<td><?php echo ($row['pushbadge'] == 'active' ? 'YES' : 'NO'); ?></td>
    				<td><?php echo ($row['pushalert'] == 'active' ? 'YES' : 'NO'); ?></td>
    				<td><?php echo ($row['pushsound'] == 'active' ? 'YES' : 'NO'); ?></td>
    				<td class="middle"><a title="Edit this item" href="<?php print site_url($module.'/admin/form/'.$row['pid']); ?>"><?php print $this->bep_assets->icon('pencil'); ?></a></td>
    				<td class="middle"><?php print $this->bep_assets->icon($active); ?>
    				-->
					</td>
    				<td class="middle"><?php print $delete ?></td>
    			</tr>
    			<?php
    		endforeach;
    	?>
    	</tbody>
    </table>
    </div>
    <script type="text/javascript">
    			$(document).ready(function() {
    				$('#example').dataTable({ 
    						"aaSorting": [[ 0, "desc" ]], 
    						"bPaginate": false,
    						"bFilter": true,
    						"bSort": true,
    						"bInfo": false,
    						"bAutoWidth": false });
    			});
    </script>
    <?php } ?>
<?php print form_close(); ?>