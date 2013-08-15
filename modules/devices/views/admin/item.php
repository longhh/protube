<?php print displayStatus(); ?>
<h2><?php echo $header; ?></h2>

<?php if (isset($item['pid'])){ ?>
<?php print form_open_multipart($module.'/admin/item/'.$item['pid'], array('class'=>'horizontal'))
?>
    <fieldset>
        <ol>
            <li>
                <?php print form_label('ID','pid')?>
                <?php print form_input('pid',$item['pid'],'id="pid" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Client ID','clientid')?>
                <?php print form_input('clientid',$item['clientid'],'id="clientid" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('App name','appname')?>
                <?php print form_input('appname',$item['appname'],'id="appname" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('App version','appversion')?>
                <?php print form_input('appversion',$item['appversion'],'id="appversion" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Device UDID','deviceuid')?>
                <?php print form_input('deviceuid',$item['deviceuid'],'id="deviceuid" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Device token','devicetoken')?>
                <?php print form_input('devicetoken',$item['devicetoken'],'id="devicetoken" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Device name','devicename')?>
                <?php print form_input('devicename',$item['devicename'],'id="devicename" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Device model','devicemodel')?>
                <?php print form_input('devicemodel',$item['devicemodel'],'id="devicemodel" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Device version','deviceversion')?>
                <?php print form_input('deviceversion',$item['deviceversion'],'id="deviceversion" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Push badge','pushbadge')?>
                <?php print form_input('pushbadge',$item['pushbadge'],'id="pushbadge" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Push alert','pushalert')?>
                <?php print form_input('pushalert',$item['pushalert'],'id="pushalert" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Push sound','pushsound')?>
                <?php print form_input('pushsound',$item['pushsound'],'id="pushsound" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Development','development')?>
                <?php print form_input('development',$item['development'],'id="development" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Status','status')?>
                <?php print form_input('status',$item['status'],'id="status" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Created','created')?>
                <?php print form_input('created',date_format(date_create($item['created']), "Y-m-d h:m:s"),'id="created" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Modified','modified')?>
                <?php print form_input('delivery',
                ($item['modified'] == '0000-00-00 00:00:00' ? 'None' : date_format(date_create($item['modified']), "Y-m-d h:m:s"))
                ,'id="modified" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li class="submit">
                <div class="buttons">
	                <a href="<?php print site_url($module.'/admin/') ?>">
	                	<?php print $this->bep_assets->icon('arrow_left') ?>
	                	<?php print $this->lang->line('general_back')?>
	                </a>
  					<a href="<?php print site_url($module.'/admin/form/'.$item['pid']) ?>">
  						<?php print $this->bep_assets->icon('pencil') ?>
  						<?php print $this->lang->line('general_edit')?>
  					</a>				
               </div>
            </li>
        </ol>
    </fieldset>
<?php print form_close(); ?>
<?php } ?>