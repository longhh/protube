<?php print displayStatus(); ?>
<h2><?php echo $header; ?></h2>
<div class="buttons">                
    <a href="<?php print site_url($module . '/admin/form') ?>">
        <?php print $this->bep_assets->icon('add'); ?>
        <?php print "Send message"; ?>
    </a>
</div>
<?php if (count($pages)) { ?>
    <?php print form_open($module . '/admin/dellist'); ?>
    <div id="demo">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th>Client ID</th>
                    <th>FK device</th>
                    <th>Delivery</th>
                    <th>Created</th>
                    <th width="5%" class="middle">Status</th>
                    <th width="5%" class="middle">View</th>
                    <th width="5%" class="middle">Delete</th>
                    <th width="10%" class="middle"><?php print form_checkbox('all', 'select', FALSE); ?><?php echo "Select"; ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="8">&nbsp;</td>
                    <td>
                        <?php print form_submit('delete', 'Delete', 'onClick="return confirm(\'' . 'Do you want to delete selected items?' . '\');"'); ?>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $count = 0;

                foreach ($pages as $key => $row) :
                    $delete = form_checkbox('select[]', $row['pid'], FALSE);
                    $count++;
                    ?>
                    <tr class="<?php echo ($count % 2 == 0 ? "even" : "odd"); ?>">
                        <td><?php echo $row['pid']; ?></td>
                        <td><?php echo $row['clientid']; ?></td>
                        <td><?php echo $row['fk_device']; ?></td>
                        <td><?php echo ($row['delivery'] == '0000-00-00 00:00:00' ? 'None' : date_format(date_create($row['delivery']), "d/m/Y h:m")); ?></td>
                        <td><?php echo date_format(date_create($row['created']), "d/m/Y h:m"); ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><a title="View this item" href="<?php print site_url($module . '/admin/item/' . $row['pid']); ?>"><?php echo 'View'; ?></a></td>
                        <td class="middle"><a title="Delete this item" onclick="return confirm('Are you sure you want to delete?')" href="<?php print site_url($module . '/admin/delete/' . $row['pid']); ?>"><?php print $this->bep_assets->icon('delete'); ?></a></td>
                        <td class="middle"><?php print $delete ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php print form_close() ?>
    </div>
    <br><br>
    <div style="float:right;">
        <?php print $paging; ?>
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
                                $('#example').dataTable({
                                    "aaSorting": [[0, "desc"]],
                                    "bPaginate": false,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": false,
                                    "bAutoWidth": true});
                            });
</script>