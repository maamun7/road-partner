<small>All App Users</small>
<div class="box box-warning">
    <div class="box-header with-border">
        <div class="pull-left col-md-12">
            <div class="btn-toolbar">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue">
                        <a href="{back_link}" class="btn btn-danger btn-primary pull-right">
                            <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                        </a>
                        <h3 class="widget-user-username"><?php if (isset($user_name)){ echo $user_name; }?></h3>
                        <h5 class="widget-user-desc"><?php if (isset($class)){ echo $class; }?></h5>
                        <h5 class="widget-user-desc"><?php if (isset($mobile)){ echo $mobile; }?></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="<?php echo base_url();?>assets/backend/dist/img/app_user_avatar.png" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php if (isset($registration)){ echo $registration; }?></h5>
                                    <span class="description-text">REGISTERED AT</span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php if (isset($last_login)){ echo $last_login; }?></h5>
                                    <span class="description-text">LAST LOGIN</span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php if (isset($last_study)){ echo $last_study; }?></h5>
                                    <span class="description-text">LAST STUDY</span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header"><?php if (isset($total_study)){ echo $total_study; }?></h5>
                                    <span class="description-text">TOTAL STUDY</span>
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>
                </div><!-- /.widget-user -->
            </div>
        </div>
    </div><!-- /.box-header -->

    <div class="box-body">
        <h1> Study details </h1>
        <table id="user_history_table" class="table table-bordered table-condensed table-striped table-hover">
            <thead>
            <tr class="info">
                <th>Sl.</th>
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