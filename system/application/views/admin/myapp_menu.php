<?php if(check('Data Management',NULL,FALSE)):?>
    <li id="menu_bep_system"><span class="icon_application"><?php print $this->lang->line('app_data_management')?></span>
        <ul>
        	<?php if(check('Category',NULL,FALSE)):?><li><?php print anchor('category/admin',$this->lang->line('app_category'),array('class'=>'icon_application'))?></li><?php endif;?>
        	            
            <?php if(check('Video',NULL,FALSE)):?><li><?php print anchor('video/admin',$this->lang->line('app_video'),array('class'=>'icon_application'))?></li><?php endif;?>
            
            <?php if(check('Devices',NULL,FALSE)):?><li><?php print anchor('devices/admin',$this->lang->line('app_devices'),array('class'=>'icon_application'))?></li><?php endif;?>
            
            <?php if(check('Messages',NULL,FALSE)):?><li><?php print anchor('messages/admin',$this->lang->line('app_messages'),array('class'=>'icon_application'))?></li><?php endif;?>            
            
        </ul>
    </li>
<?php endif;?>