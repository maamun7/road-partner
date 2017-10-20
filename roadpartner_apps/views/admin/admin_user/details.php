<small>Change password</small>
<div class="box box-success">
	<div class="box-header with-border">
		<div class="pull-left">
			<div class="btn-toolbar">
				<a href="<?php echo base_url(); ?>admin/admin_user" class="btn btn-danger btn-primary">
					<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
				</a>
			</div>
		</div>
	</div><!-- /.box-header -->
	<form action="{action}" id="role" method="post"  name="role" enctype="multypart/formdata">
	<div class="box-body">
		<div class="col-md-12">
			<table class="table table-bordered">
				<tr>
					<th colspan="2" style="text-align:center">User Info</th>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right;width:50%"> Name</td>
					<td> {first_name} {last_name}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Designation</td>
					<td> {designation}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Mobile</td>
					<td> {mobile}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Email</td>
					<td> {email}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Role</td>
					<td> {user_role}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Created at</td>
					<td> {create_time}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Updated at</td>
					<td> {update_time}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Last login at</td>
					<td> {last_login_at}</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;font-weight:bold; text-align: right"> Login IP</td>
					<td> {ip}</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="box-footer clearfix">
		
	</div>
	</form>
</div>