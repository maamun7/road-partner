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
			</table>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php if (isset($error_password) && $error_password != ''){ echo 'has-error'; } ?>">
				<label>Password</label>
                <input type="password" tabindex="1" class="form-control" name="password" value="<?php if (isset($password_value)) { echo $password_value; } ?>" placeholder="Enter password" />
				<label class="error_txt_size"><?php if (isset($error_password)){ echo $error_password; } ?></label>
			</div>
		</div>
		<div class="col-md-6">			
			<div class="form-group <?php if (isset($error_conf_password) && $error_conf_password != ''){ echo 'has-error'; } ?>">
				<label>Confrim password</label>
                <input type="password" tabindex="2" class="form-control" name="conf_password" placeholder="Enter confirm password" />
				<label class="error_txt_size"><?php if (isset($error_conf_password)){ echo $error_conf_password; } ?></label>
				<input type="hidden" name="user_id" value="{user_id}">
			</div>
		</div>
	</div>
	<div class="box-footer clearfix">
		<div class="pull-right">
			<input type="submit" class="btn btn-success" value="Changes Password" />
		</div>
	</div>
	</form>
</div>