<small>New Role</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="<?php echo base_url(); ?>admin/role" class="btn btn-danger btn-primary">
                    <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                </a>
            </div>
        </div>
    </div><!-- /.box-header -->
    <form action="{action}" id="role" method="post"  name="role" enctype="multypart/formdata">
    <div class="box-body">
        <div class="col-md-12">
            <div class="form-group <?php if ($error_role_name != ''){ echo 'has-error'; } ?>">
                <label>Role Name</label>
                <input type="text" tabindex="1" class="form-control" name="role_name" value="<?php if (isset($role_name_value)) { echo $role_name_value; } ?>" placeholder="Enter role name" />
                <label class="error_txt_size"><?php if (isset($error_role_name)){ echo $error_role_name; } ?></label>
            </div>
        </div>
        <div class="col-md-12">
            {permissions}
        </div>
    </div>
    <div class="box-footer clearfix">
        <div class="pull-left">
            <input type="submit" class='btn btn-success' value="Save">
        </div>
    </div>
    </form>
</div>