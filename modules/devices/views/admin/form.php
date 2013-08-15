<?php print displayStatus(); ?>
<h2><?php echo $header; ?></h2>

<?php print form_open_multipart($module.'/admin/form/'.$this->validation->pid, array('class'=>'horizontal'))
?>
    <fieldset>
        <ol>
			<li>
			    <?php print form_label('Client ID','clientid')?>
			    <?php print form_input('clientid',$this->validation->clientid,'id="clientid" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('App name','appname')?>
			    <?php print form_input('appname',$this->validation->appname,'id="appname" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('App version','appversion')?>
			    <?php print form_input('appversion',$this->validation->appversion,'id="appversion" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('Device UDID','deviceuid')?>
			    <?php print form_input('deviceuid',$this->validation->deviceuid,'id="deviceuid" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('Device token','devicetoken')?>
			    <?php print form_input('devicetoken',$this->validation->devicetoken,'id="devicetoken" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('Device name','devicename')?>
			    <?php print form_input('devicename',$this->validation->devicename,'id="devicename" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('Device model','devicemodel')?>
			    <?php print form_input('devicemodel',$this->validation->devicemodel,'id="devicemodel" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('Device version','deviceversion')?>
			    <?php print form_input('deviceversion',$this->validation->deviceversion,'id="deviceversion" class="text" style="width:500px;"')?>
			</li>
			<li>
			    <?php print form_label('Push badge','pushbadge')?>
			    <?php print form_dropdown('pushbadge',array('disabled'=>'disabled', 'enabled'=>'enabled'), $this->validation->pushbadge)?>
			</li>
			<li>
			    <?php print form_label('Push alert','pushalert')?>
			    <?php print form_dropdown('pushalert',array('disabled'=>'disabled', 'enabled'=>'enabled'), $this->validation->pushalert)?>
			</li>
			<li>
			    <?php print form_label('Push sound','pushsound')?>
			    <?php print form_dropdown('pushsound',array('disabled'=>'disabled', 'enabled'=>'enabled'), $this->validation->pushsound)?>
			</li>
			<li>
			    <?php print form_label('Development','development')?>
			    <?php print form_dropdown('development',array('sandbox'=>'sandbox', 'production'=>'production'), $this->validation->development)?>
			</li>
			<li>
			    <?php print form_label('Status','status')?>
			    <?php print form_dropdown('status',array('active'=>'active', 'uninstalled'=>'uninstalled'), $this->validation->status)?>
			</li>
			<!--
			<li>
			    <?php print form_label('Created','created')?>
			    <?php print form_input('created',date_format(date_create($this->validation->created), "Y-m-d"),'id="created" class="text" style="width:500px;" readonly="readonly"')?>
			</li>
			<li>
			    <?php print form_label('Modified','modified')?>
			    <?php print form_input('modified',date_format(date_create($this->validation->modified), "Y-m-d"),'id="modified" class="text" style="width:500px;" readonly="readonly"')?>
			</li>
			-->
            <li class="submit">
                <?php print form_hidden('id',$this->validation->pid)?>
                <div class="buttons">
	                <button type="submit" class="positive" name="submit" value="submit">
	                	<?php print $this->bep_assets->icon('disk'); ?>
	                	<?php print $this->lang->line('general_save'); ?>
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
<?php print form_close(); ?>
<?php
/*
echo ('<script type="text/javascript">
			$(function() {
					$( "#pub_date" ).datepicker({
						showOn: "button",
						buttonImage: "'. image_url('calendar.gif') .'",
						buttonImageOnly: true,
						changeMonth: true,
						changeYear: true,
						showOtherMonths: true,
						selectOtherMonths: true,
						showButtonPanel: true,
						dateFormat: "yy-mm-dd"
					});
				});
</script>')
*/
?>