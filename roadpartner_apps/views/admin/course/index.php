<small>All Courses</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="<?php echo base_url(); ?>admin/course/add" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;New Courses
                </a>
                <a href="<?php echo base_url(); ?>admin/course/refresh" class="btn btn-success">
                    <span class="glyphicon glyphicon-refresh"></span>&nbsp; Refresh
                </a>
            </div>
        </div>
		<div class="box-tools" style="width:30%">
			<form method="post" action="{search_action}" name="search_action" id="search_action" >
				<div class="input-group">
                    <input type="text" name="key_word" class="form-control input-sm pull-right" placeholder="Search">
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
				<th>#</th>
				<th>Name</th>
				<th>Image</th>
				<th>Deck Key</th>
				<th>Class</th>
				<th>Course type</th>
				<th>Subject</th>
                <th>Total cards</th>
                <th>Total Down.</th>
                <th>Rating avg.</th>
                <th>Total rated</th>
                <th><center>Published</center></th>
				<th><center>Actions</center></th>
            </tr>
			<?php if(!empty($course_lists)){ ?>
				{course_lists}
					<tr>
						<td>{sl}</td>
						<td>{name}</td>
                        <td><img src="<?php echo base_url(); ?>uploads/admin/course_icon/{image}" height="45px" width="50px"></td>
						<td>{deck_key}</td>
						<td>{class_name}</td>
						<td>{group_name}</td>
						<td>{subject_name}</td>
                        <td>{total_cards}</td>
                        <td>{total_download}</td>
                        <td>{rating_average}</td>
                        <td>{no_of_rated}</td>
                        <td>
                            <center>
                                <i class="glyphicon {sts_class} glyphicon-white courseStatusChange" name="{id}"></i>
                            </center>
                        </td>
						<td>
							<center>
                                <a href="<?php echo base_url(); ?>admin/course/card_edit/{deck_key}" class="btn btn-xs btn-success">
                                    <i class="glyphicon glyphicon-edit glyphicon-white"></i> Edit Card
                                </a>
								<a href="<?php echo base_url(); ?>admin/course/edit/{id}" class="btn btn-xs btn-success">
									<i class="glyphicon glyphicon-edit glyphicon-white"></i> Edit
								</a>
                                <a href="<?php echo base_url(); ?>admin/course/delete/{id}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete?')" >
                                    Delete
                                </a>
							</center>
						</td>
					</tr>
				{/course_lists}
				<?php }else{ ?>
                <tr>
                    <td colspan="7" class="text-center text-danger"><?php echo "No data found"; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php if(isset($links)){ echo $links; } ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        var baseUrl = "<?php echo base_url(); ?>";

        //Status Change
        $(".courseStatusChange").click(function()
        {
            var id=$(this).attr('name');
            var dataString = 'course_id='+ id;
            //alert(dataString);
            $.ajax
            ({
                type: "POST",
                url: baseUrl+"admin/course/change_status",
                data: dataString,
                cache: false,
                success: function(datas)
                {
                    location.reload();
                }
            });
        });
    });
</script>

