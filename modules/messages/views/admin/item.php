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
                <?php print form_label('FK device','fk_device')?>
                <?php print form_input('fk_device',$item['fk_device'],'id="fk_device" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Message','message')?>
                <?php print form_textarea('message',$item['message'],'id="message" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
            <li>
                <?php print form_label('Delivery','delivery')?>
                <?php print form_input('delivery',
                ($item['delivery'] == '0000-00-00 00:00:00' ? 'None' : date_format(date_create($item['delivery']), "Y-m-d h:m:s"))
                ,'id="delivery" class="text" style="width:500px;" readonly="readonly"')?>
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
                <?php print form_input('modified',
                ($item['delivery'] == '0000-00-00 00:00:00' ? 'None' : date_format(date_create($item['modified']), "Y-m-d h:m:s"))
                ,'id="modified" class="text" style="width:500px;" readonly="readonly"')?>
            </li>
        </ol>
    </fieldset>
<?php print form_close(); ?>
<?php } ?>
<div class="buttons">
	<a href="<?php print site_url($module.'/admin/') ?>">
		<?php print $this->bep_assets->icon('arrow_left') ?>
		<?php print $this->lang->line('general_back')?>
	</a>
</div>