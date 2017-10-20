<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <!--<div class="pull-left image">
            <img src="#" class="img-circle" alt="User Image">
        </div>-->
        <!--<div class="pull-left info">
            <p>{full_name}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>-->
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <!--<li class="header">MAIN NAVIGATION</li>-->
        <li class="<?php if ($active=="dashboard"){echo"active";}?>">
            <a href="<?php echo base_url(); ?>admin">
                <i class="fa fa-dashboard  text-yellow"></i> <span> Dashboard </span>
            </a>
        </li>
        <li class="treeview <?php if ($active=="admin_user" || $active=="role" ){echo"active";}?>">
            <a href="#">
                <i class="fa fa-users"></i>
                <span>Manage admin User</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/admin_user"><i class="fa fa-user text-aqua"></i> <span> Admin User </span></a></li>
                <li><a href="<?php echo base_url(); ?>admin/role"><i class="fa fa-circle-o text-red"></i> <span> Role </span></a></li>
            </ul>
        </li>
        <li class="<?php if ($active=="app_user"){echo"active";}?>">
            <a href="<?php echo base_url(); ?>admin/app_user">
                <i class="fa fa-mobile text-green"></i> <span>Manage app users </span>
            </a>
        </li>
        <li class="treeview <?php if ($active=="bid_win" || $active=="service"){echo"active";}?>">
            <a href="#">
                <i class="fa fa-list"></i>
                <span>Manage bids</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>admin/service"><i class="fa fa-list-alt text-blue"></i> <span> Services </span></a></li>
                <li><a href="<?php echo base_url(); ?>admin/bid_win"><i class="fa fa-user text-aqua"></i> <span> Bid winner </span></a></li>
            </ul>
        </li>
    </ul>
</section>
<!-- /.sidebar -->