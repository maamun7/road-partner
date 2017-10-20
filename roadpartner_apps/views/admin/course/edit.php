<small>New subject</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="<?php echo base_url(); ?>admin/course" class="btn btn-danger btn-primary">
                    <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                </a>
            </div>
        </div>
    </div><!-- /.box-header -->
    <form action="{action}" id="course" method="post"  name="course" enctype="multipart/form-data">
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group <?php if (isset($error_course_name) && $error_course_name != ''){ echo 'has-error'; } ?>">
                    <label>Course name</label>
                    <input type="text" tabindex="1" class="form-control" name="course_name" value="<?php if (isset($course_name_value)) { echo $course_name_value; } ?>" placeholder="Enter course name" />
                    <label class="error_txt_size"><?php if (isset($error_course_name)){ echo $error_course_name; } ?></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group <?php if (isset($error_course_key) && $error_course_key != ''){ echo 'has-error'; } ?>">
                    <label>Course key</label>
                    <input type="text" tabindex="2" class="form-control" name="course_key" value="<?php if (isset($course_key_value)) { echo $course_key_value; } ?>" placeholder="Enter course key" readonly="readonly" />
                    <label class="error_txt_size"><?php if (isset($error_course_key)){ echo $error_course_key; } ?></label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group <?php if (isset($error_description) && $error_description != ''){ echo 'has-error'; } ?>">
                    <label>Description</label>
                    <textarea tabindex="3" class="form-control" name="description" placeholder="Enter course key"><?php if (isset($description_value)) { echo $description_value; } ?></textarea>
                    <label class="error_txt_size"><?php if (isset($error_description)){ echo $error_description; } ?></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group <?php if (isset($error_class_name) && $error_class_name != ''){ echo 'has-error'; } ?>">
                    <label>Select Class</label>
                    <select name="class_name" class="form-control" tabindex="4">
                        <?php if (!empty($classes)) { ?>
                            <?php foreach($classes as $class) {  ?>
                                <option value="<?php echo $class['id']; ?>" <?php if (isset($class_name_value) && $class_name_value == $class['id']) {echo "selected='selected'"; } ?>> <?php echo $class['class_name']; ?> </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <label class="error_txt_size"><?php if (isset($error_class_name)){ echo $error_class_name; } ?></label>
                </div>
                <div class="form-group <?php if (isset($error_group_name) && $error_group_name != ''){ echo 'has-error'; } ?>">
                    <label>Select group</label>
                    <select name="group_name" class="form-control" tabindex="7">
                        <?php if (!empty($groups)) { ?>
                            <?php foreach($groups as $group) {  ?>
                                <option value="<?php echo $group['id']; ?>" <?php if (isset($group_name_value) && $group_name_value == $group['id']) {echo "selected='selected'"; } ?>> <?php echo $group['group_name']; ?> </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <label class="error_txt_size"><?php if (isset($error_group_name)){ echo $error_group_name; } ?></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group <?php if (isset($error_subject_name) && $error_subject_name != ''){ echo 'has-error'; } ?>">
                    <label>Select subject</label>
                    <select name="subject_name" class="form-control" tabindex="6">
                        <?php if (!empty($subjects)) { ?>
                            <?php foreach($subjects as $subject) {  ?>
                                <option value="<?php echo $subject['id']; ?>" <?php if (isset($subject_name_value) && $subject_name_value == $subject['id']) {echo "selected='selected'"; } ?>> <?php echo $subject['subject_name']; ?> </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <label class="error_txt_size"><?php if (isset($error_subject_name)){ echo $error_subject_name; } ?></label>
                </div>
                <div class="form-group <?php if (isset($error_course_image) && $error_course_image != ''){ echo 'has-error'; } ?>">
                    <label>Course picture</label>
                    <input id="uploadFile" type="file" name="course_image" />
                    <label class="error_txt_size"><?php if (isset($error_course_image)){ echo $error_course_image; } ?></label>
                    <input type="hidden" name="course_id" value="{course_id}">
                </div>
            </div>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-right">
                <input type="submit" class="btn btn-success" name="add-course" value="Save Changes" />
            </div>
        </div>
    </form>
</div>