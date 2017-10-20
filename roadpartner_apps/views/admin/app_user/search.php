<link href="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
<small>All App Users</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left col-md-12">
            <div class="btn-toolbar">
                <div class="col-md-1">
                    <a href="<?php echo base_url(); ?>admin/app_user" class="btn btn-danger btn-primary">
                        <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                    </a>
                </div>
                <form method="post" class="form-inline" action="{search_date_action}" name="search_action" id="search_action" role="form" >
                    <!--<label class="select">Search: </label>-->
                    <?php
                    $from_date = isset($from_date) ? $from_date : "";
                    $to_date = isset($to_date) ? $to_date : "";
                    $to_date = isset($to_date) ? $to_date : "";
                    $key_word = isset($key_word) ? $key_word : "";
                    ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="select">From</label>
                            <input type="text" name="from_date" value="<?php echo $from_date; ?>" class="date_picker form-control" style="padding: 6px 25px;"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="width: 100%">
                            <label class="select">To</label>
                            <input type="text" name="to_date" value="<?php echo $to_date; ?>" class="date_picker form-control" style="padding: 6px 26px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success"><i class="fa fa-search"></i> Search !</button>
                    </div>
                </form>

                <form method="post" action="{search_action}" name="search_action" id="search_action" class="form-inline" >
                    <div class="col-md-4">
                        <div class="form-group" style="width: 100%">
                            <label class="select" style="width: 27%">By username/mobile:</label>
                            <input type="text" name="key_word" class="form-control" value="<?php echo $key_word; ?>" placeholder="Enter username or mobile number" style="width: 70%">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success"><i class="fa fa-search"></i> Search !</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr class="info">
                <th>Sl.</th>
                <th>User name</th>
                <th>Mobile number</th>
                <th colspan="2" style="text-align: center">Class</th>
                <th>Last login</th>
                <th>Registered at</th>
                <th>Total Studied</th>
            </tr>
            <?php if(!empty($user_lists)){ ?>
                {user_lists}
                <tr>
                    <td>{sl}</td>
                    <td><a href="<?php echo base_url();?>admin/app_user/details/{mobile_number}">{user_name}</a></td>
                    <td>{mobile_number}</td>
                    <td style="text-align: right">{class}</td>
                    <td>{class_in_en}</td>
                    <td>{last_login_at}</td>
                    <td>{registered_at}</td>
                    <td>{total_study}</td>
                </tr>
                {/user_lists}
            <?php }else{ ?>
                <tr>
                    <td colspan="6" class="text-center text-danger"><?php echo "No data found"; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php if(isset($links)){ echo $links; } ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.date_picker').Zebra_DatePicker({
            format: 'Y-m-d'
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.min.js"></script>