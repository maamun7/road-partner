<div class="col-sm-12"  style="padding-top: 5px !important;">
    <div class="form-box">
        <div class="form-top">
            <div class="form-top-left">
                <h3>Your submitted info</h3>
                <!--<p>Transport Bidding System</p>-->
            </div>
            <div class="form-top-right">
                <i class="fa fa-pencil"></i>
            </div>
        </div>
        <div class="form-bottom r-form-8-box">
            <table class="table table-bordered table-responsive">
                <tbody>
                    <?php
                    if(!empty($rows)){
                        foreach ($rows as $key=>$val) {
                    ?>
                            <tr>
                                <td width="50%" style="text-align: right;color:#fff"> <?php echo "<strong>{$key}"; ?> </td>
                                <td style="color:#F8B820"> <?php echo "<strong>{$val}"; ?> </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?php echo base_url(); ?>" class="btn btn-info" style="float: right;">Start New Bidding</a>
                </div>
            </div>
        </div>
    </div>
</div>
