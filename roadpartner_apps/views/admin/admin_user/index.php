<small>All Users</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="<?php echo base_url(); ?>admin/admin_user/add" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;New user
                </a>
            </div>
        </div>
		<div class="box-tools" style="width:30%">
			<form method="post" action="{search_action}" name="search_action" id="search_action" >
				<div class="input-group">
						<input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
						<div class="input-group-btn">
							<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
						</div>
				</div>
			</form>
		</div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr class="info">
                <th>Sl.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Mobile</th>
                <th>Role</th>
                <th><center> Action </center></th>
            </tr>
            <?php if(count($user_lists)){ ?>
                {user_lists}
                <tr>
                    <td>{sl}</td>
                    <td>{first_name} {last_name}</td>
                    <td>{username}</td>
                    <td>{designation}</td>
                    <td>{mobile}</td>
                    <td>{role_name}</td>
                    <td>
                        <center>
                            <a href="<?php echo base_url(); ?>admin/admin_user/edit/{user_id}" class="btn btn-xs btn-success">
                                <i class="glyphicon glyphicon-edit glyphicon-white"></i> Edit
                            </a>
                            <a href="<?php echo base_url(); ?>admin/admin_user/change_password/{user_id}" class="btn btn-xs btn-info">
                                <i class="glyphicon glyphicon-edit glyphicon-white"></i> Change Password
                            </a>
                            <a href="<?php echo base_url(); ?>admin/admin_user/details/{user_id}" class="btn btn-xs btn-primary">
                                <i class="glyphicon glyphicon-eye-open glyphicon-white"></i> Details
                            </a>
                            <a href="<?php echo base_url(); ?>admin/admin_user/delete" class="btn btn-xs btn-danger">
                                <i class="glyphicon glyphicon-trash glyphicon-white"></i> Delete
                            </a>
                        </center>
                    </td>
                </tr>
               {/user_lists}
            <?php }else{ ?>
                <tr>
                    <td colspan="7" class="text-center text-danger">{"No data found"}</td>
                </tr>
            <?php } ?>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php if(isset($links)){ echo $links; } ?>
    </div>
</div>