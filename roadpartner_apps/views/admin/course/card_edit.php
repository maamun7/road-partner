<small>Edit card</small>
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
			<table class="table table-bordered table-condensed table-striped ">
				<tr class="">                
					<th width="20%">Course ID</th>
					<th width="40%">Question</th>
					<th width="40%">Answer</th>
				</tr>
				{cards}
				<tr>
					<td>
						<div class="form-group">
							<input type="text" class="form-control" name="deck_key[]" value="{deck_key}" placeholder="Enter course id" />
							<input type="hidden" name="course_id[]" value="{id}" />
						</div>
					</td>
					<td>					
						<div class="form-group">
							<input type="text" class="form-control" name="question[]" value="{question}" placeholder="Enter question" />
						</div>
					</td>
					<td>
						<div class="form-group">
							<input type="text" class="form-control" name="answer[]" value="{answer}" placeholder="Enter answer" />		   
						</div>
					</td>
				</tr>
				{/cards}
			</table>
		</div>
		<div class="box-footer clearfix">
			<div class="pull-right">
				<input type="submit" class="btn btn-success" name="edit-cards" value="Save Changes" />
			</div>
		</div>
    </form>
</div>