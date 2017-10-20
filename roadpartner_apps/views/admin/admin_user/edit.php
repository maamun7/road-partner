<small>New User</small>
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
		<div class="col-md-6">
			<div class="form-group <?php if (isset($error_first_name) && $error_first_name != ''){ echo 'has-error'; } ?>">
				<label>First Name</label>
                <input type="text" tabindex="1" class="form-control" name="first_name" value="<?php if (isset($first_name_value)) { echo $first_name_value; } ?>" placeholder="Enter first name" />
				<label class="error_txt_size"><?php if (isset($error_first_name)){ echo $error_first_name; } ?></label>
			</div>
			<div class="form-group <?php if (isset($error_designation) && $error_designation != ''){ echo 'has-error'; } ?>">
				<label>Designation</label>
                <input type="text" tabindex="3" class="form-control" name="designation" value="<?php if (isset($designation_value)) { echo $designation_value; } ?>" placeholder="Enter designation" />
				<label class="error_txt_size"><?php if (isset($error_designation)){ echo $error_designation; } ?></label>
			</div>
			<div class="form-group <?php if (isset($error_email) && $error_email != ''){ echo 'has-error'; } ?>">
				<label>Email</label>
                <input type="text" tabindex="5" class="form-control" name="email" value="<?php if (isset($email_value)) { echo $email_value; } ?>" placeholder="Enter email" />
				<label class="error_txt_size"><?php if (isset($error_email)){ echo $error_email; } ?></label>
			</div>
			<div class="form-group <?php if (isset($error_can_login) && $error_can_login != ''){ echo 'has-error'; } ?>">
				<label>Can login</label>
				<select name="can_login" class="form-control" tabindex="7">
					<option value="1" <?php if (isset($can_login_value) && $can_login_value == 1) {echo "selected='selected'"; } ?>> Yes </option>
					<option value="0" <?php if (isset($can_login_value) && $can_login_value == 0) {echo "selected='selected'"; } ?>> No </option>
				</select>
				<label class="error_txt_size"><?php if (isset($error_can_login)){ echo $error_can_login; } ?></label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php if (isset($error_last_name) && $error_last_name != ''){ echo 'has-error'; } ?>">
				<label>Last Name</label>
                <input type="text" tabindex="2" class="form-control" name="last_name" value="<?php if (isset($last_name_value)) { echo $last_name_value; } ?>" placeholder="Enter last name" />
				<label class="error_txt_size"><?php if (isset($error_last_name)){ echo $error_last_name; } ?></label>
			</div>
			<div class="form-group <?php if (isset($error_mobile) && $error_mobile != ''){ echo 'has-error'; } ?>">
				<label>Mobile</label>
                <input type="text" tabindex="4" class="form-control" name="mobile" value="<?php if (isset($mobile_value)) { echo $mobile_value; } ?>" placeholder="Enter mobile" />
				<label class="error_txt_size"><?php if (isset($error_mobile)){ echo $error_mobile; } ?></label>
			</div>
			<div class="form-group <?php if (isset($error_user_role) && $error_user_role != ''){ echo 'has-error'; } ?>">
				<label>Select user role</label>
				<select name="user_role" class="form-control" tabindex="8">
					<?php if (!empty($roles)) { ?>
					<?php $i = 0; ?>
					<?php foreach($roles as $role) {  ?>
						<option value="<?php echo $role['role_id']; ?>" <?php if (isset($user_role_value) && $user_role_value == $role['role_id']) {echo "selected='selected'"; } ?>> <?php echo $role['role_name']; ?> </option>
					<?php } ?>
					<?php } ?>
				</select>
				<label class="error_txt_size"><?php if (isset($error_user_role)){ echo $error_user_role; } ?></label>
				<input type="hidden" name="user_id" value="{user_id}">
			</div>
		</div>
	</div>
	<div class="box-footer clearfix">
		<div class="pull-left">
			<input type="submit" class="btn btn-success" value="Save Changes" />
		</div>
	</div>
	</form>
</div>