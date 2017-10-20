<link href="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
<small>All bid winners</small>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="pull-left col-md-12">
            <div class="btn-toolbar">
            </div>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr class="info">
                <th>Sl.</th>
                <th>Order no.</th>
                <th>Bid rate</th>
                <th>Cnic</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Confirm</th>
            </tr>
            <?php if(!empty($user_lists)){ ?>
                {user_lists}
                <tr>
                    <td>{sl}</td>
                    <td>{order_no}</td>
                    <td>{bid_rate}</td>
                    <td>{cnic}</td>
                    <td>{name}</td>
                    <td>{mobile}</td>
                    <td>{city}</td>
                    <td>{status}</td>
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