<link href="<?php echo base_url(); ?>assets/backend/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
<small>All services</small>
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
                <th>Start</th>
                <th>Duration</th>
                <th>Vehicle type</th>
                <th>Vehicle name</th>
                <th>Pickup</th>
                <th>Drop</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Distance</th>
                <th>Cost</th>
                <th>Expire</th>
                <th>Total bids</th>
            </tr>
            <?php if(!empty($user_lists)){ ?>
                {user_lists}
                <tr>
                    <td>{sl}</td>
                    <td>{id}</td>
                    <td>{current_time}</td>
                    <td>{timer}</td>
                    <td>{vehicletype}</td>
                    <td>{vehiclename}</td>
                    <td>{pickup}</td>
                    <td>{drop_city}</td>
                    <td>{name}</td>
                    <td>{cell}</td>
                    <td>{distance} KM</td>
                    <td>{cost}</td>
                    <td>{status}</td>
                    <td>{total_bid}</td>
                {/user_lists}
            <?php }else{ ?>
                <tr>
                    <td colspan="13" class="text-center text-danger"><?php echo "No data found"; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php if(isset($links)){ echo $links; } ?>
    </div>
</div>