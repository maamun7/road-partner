<small>Search App Users</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left">
            <div class="btn-toolbar">
                &nbsp;
            </div>
        </div>
		<div class="box-tools" style="width:30%">
			<form method="post" action="{search_action}" name="search_action" id="search_action" >
				<div class="input-group">
					<input type="text" name="key_word" class="form-control input-sm pull-right" placeholder="Search by user name or mobile no.">
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
                <th>User name</th>
                <th>Mobile number</th>
                <th>Last login</th>
                <th>Registered at</th>
            </tr>
            <?php if(!empty($user_lists)){ ?>
                {user_lists}
                <tr>
                    <td>{sl}</td>
                    <td>{user_name}</td>
                    <td>{mobile_number}</td>
                    <td>{last_login_at}</td>
                    <td>{registered_at}</td>
                </tr>
               {/user_lists}
            <?php }else{ ?>
                <tr>
                    <td colspan="5" class="text-center text-danger"><?php echo "No data found"; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php if(isset($links)){ echo $links; } ?>
    </div>
</div>