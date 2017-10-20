<table class="table table-bordered">
    <tr>
        <th style="width:20%">Module/Group Name</th>
        <th style="width:70%;text-align: center">Permission Display Name / Permission Slug</th>
    </tr>
    <?php if (!empty($groups)) { ?>
    <?php $i = 0; ?>
    <?php foreach($groups as $group) {$i++;  ?>
    <tr>
        <td style="vertical-align: middle;font-weight:bold; text-align: right">
            <?php echo $group['group']; ?>
        </td>
        <td>
            <table class="table table-bordered">
                <?php if (count($group['permissions'])) { ?>
                <?php foreach($group['permissions'] as $permission) {?>
                    <tr>
                        <td style="width:5%;text-align: right">
                            <input name="permission_slug[]" type="checkbox" value="<?php echo $permission['name']; ?>" <?php if ($i == 1){ echo "onclick='return false'"; } ?> <?php echo $permission['is_checked']; ?>>
                        </td>
                        <td style="width:45%"><?php echo $permission['display_name']; ?></td>
                        <td style="width:45%"><?php echo $permission['name']; ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </td>
    </tr>
    <?php } ?>
    <?php } ?>
</table>