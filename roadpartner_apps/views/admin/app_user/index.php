<small>All App Users</small>
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
                <th>Name</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Cnic</th>
                <th>Address</th>
                <th>Car type</th>
                <th>Vehicle type</th>
                <th>Status</th>
            </tr>
            <?php if(!empty($user_lists)){ ?>
                {user_lists}
                <tr>
                    <td>{sl}</td>
                    <td>{name}</td>
                    <td>{mobile}</td>
                    <td>{city}</td>
                    <td>{cnic}</td>
                    <td>{address}</td>
                    <td>{mTypeOfCar}</td>
                    <td>{mTypeOfVehicle}</td>
                    <td>
                        <center>
                            <i class="fa {sts_class} fa-lg userStatusChange" name="{id}"></i>
                        </center>
                    </td>
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

<script>
    $(document).ready(function(){
        var baseUrl = "<?php echo base_url(); ?>";

        //Status Change
        $(".userStatusChange").click(function()
        {
            var id=$(this).attr('name');
            var dataString = 'app_user_id='+ id;
            //alert(dataString);
            $.ajax
            ({
                type: "POST",
                url: baseUrl+"admin/app_user/change_status",
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