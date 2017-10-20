<small>All Role</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="<?php echo base_url(); ?>admin/role/add" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;New role
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
                <th>Role name</th>
                <th>Created at</th>
                <th><center> Action </center></th>
            </tr>
            <?php if(count($role_lists)){ ?>
                {role_lists}
                <tr>
                    <td>{sl}</td>
                    <td>{role_name}</td>
                    <td>{created_at}</td>
                    <td>
                        <center>
                            <a href="<?php echo base_url(); ?>admin/role/edit/{role_id}" class="btn btn-xs btn-success">
                                <i class="glyphicon glyphicon-edit glyphicon-white"></i> Edit
                            </a>
                        </center>
                    </td>
                </tr>
               {/role_lists}
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