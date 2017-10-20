<link href="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
<small>App Users History</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left">
            <div class="btn-toolbar">
                &nbsp;
            </div>
        </div>
		<div class="box-tools" style="width:30%">

		</div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="user_history_table" class="table table-bordered table-condensed table-striped table-hover">
            <thead>
                <tr class="info">
                    <th>Sl.</th>
                    <th>User name</th>
                    <th>Mobile number</th>
                    <th>Course name</th>
                    <th>Total card</th>
                    <th>Total correct</th>
                    <th>Total incorrect</th>
                    <th>Study duration</th>
                    <th>Reading Status</th>
                    <th>History time</th>
                </tr>
            </thead>
            <?php if(!empty($user_history)){ ?>
                {user_history}
                <tr>
                    <td>{sl}</td>
                    <td><a href="<?php echo base_url();?>admin/app_user/details/{mobile_number}">{user_name}</a></td>
                    <td>{mobile_number}</td>
                    <td>{name}</td>
                    <td>{history_deck_length}</td>
                    <td>{history_correct_cnt}</td>
                    <td>{history_incorrect_cnt}</td>
                    <td>{stay_time}</td>
                    <td>{reading_status}</td>
                    <td>{history_time}</td>
                </tr>
                {/user_history}
            <?php }else{ ?>
                <tr>
                    <td colspan="10" class="text-center text-danger"><?php echo "No data found"; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php if(isset($links)){ echo $links; } ?>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php if(!empty($user_history)){ ?>
    <script>
        $(function () {
            // $("#example1").DataTable();
            $('#user_history_table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0,2,3,4,5,6,7,8,9]
                }]
            });
        });
    </script>
<?php } ?>