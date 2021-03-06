<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <aside class="main-sidebar">
                <section class="sidebar">
<?php if ($is_admin == TRUE): ?>           
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/default.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo gmdate("Y-m-d H:i:s ", $user_login['lastlogin']); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    <!-- Search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">
                        <!--<li>
                            <a href="<?php echo site_url('/'); ?>">
                                <i class="fa fa-home text-primary"></i> <span><?php echo lang('menu_access_website'); ?></span>
                            </a>
                        </li>-->

                        <li class="header text-uppercase"><?php echo lang('menu_main_navigation'); ?></li>
                        <li class="<?=active_link_controller('dashboard')?>">
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="fa fa-dashboard"></i> <span><?php echo lang('menu_dashboard'); ?></span>
                            </a>
                        </li>

                        <li class="<?=active_link_controller('inandout')?>">
                            <a href="<?php echo site_url('admin/inandout'); ?>">
                                <i class="fa fa-files-o"></i> <span>In and Out</span>
                            </a>
                        </li>

                        <li class="<?=active_link_controller('request')?>">
                            <a href="<?php echo site_url('admin/request'); ?>">
                                <i class="fa fa-exchange"></i> <span>Requests</span>
                            </a>
                        </li>

                        <li class="<?=active_link_controller('stocks')?>">
                            <a href="<?php echo site_url('admin/stocks'); ?>">
                                <i class="fa fa-inbox"></i> <span>Stocks</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('receiving')?>">
                            <a href="<?php echo site_url('admin/receiving'); ?>">
                                <i class="fa fa-sign-in"></i> <span>Receiving</span>
                            </a>
                        </li>

                        <li class="header text-uppercase"><?php echo lang('menu_administration'); ?></li>
                         <li class="treeview <?=active_link_controller('prefs')?>">
                            <a href="#">
                                <i class="fa fa-archive"></i>
                                <span>File Maintenance</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_controller('parts')?>">
                            <a href="<?php echo site_url('admin/parts'); ?>">
                                <i class="fa fa-th-list"></i> <span>Parts</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('categories')?>">
                            <a href="<?php echo site_url('admin/categories'); ?>">
                                <i class="fa fa-cog"></i> <span>Categories</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('customers')?>">
                            <a href="<?php echo site_url('admin/customers'); ?>">
                                <i class="fa fa-users"></i> <span>Customers</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('users')?>">
                            <a href="<?php echo site_url('admin/users'); ?>">
                                <i class="fa fa-user"></i> <span><?php echo lang('menu_users'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('groups')?>">
                            <a href="<?php echo site_url('admin/groups'); ?>">
                                <i class="fa fa-shield"></i> <span><?php echo lang('menu_security_groups'); ?></span>
                            </a>
                        </li>
                            </ul>
                        </li>
                         
                        <!--<li class="treeview <?=active_link_controller('prefs')?>">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span><?php echo lang('menu_preferences'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_function('interfaces')?>"><a href="<?php echo site_url('admin/prefs/interfaces/admin'); ?>"><?php echo lang('menu_interfaces'); ?></a></li>
                            </ul>
                        </li>-->
                        <li class="<?=active_link_controller('audits')?>">
                            <a href="<?php echo site_url('admin/audits'); ?>">
                                <i class="fa fa-history"></i> <span>Audit Trail</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('announcements')?>">
                            <a href="<?php echo site_url('admin/announcements'); ?>">
                                <i class="fa fa-bullhorn"></i> <span>Announcements</span>
                            </a>
                        </li>
                        <!--<li class="<?=active_link_controller('database')?>">
                            <a href="<?php echo site_url('admin/database'); ?>">
                                <i class="fa fa-database"></i> <span><?php echo lang('menu_database_utility'); ?></span>
                            </a>
                        </li>-->


                        <li class="header text-uppercase"><?php echo $title; ?></li>
                        <!--<li class="<?=active_link_controller('license')?>">
                            <a href="<?php echo site_url('admin/license'); ?>">
                                <i class="fa fa-legal"></i> <span><?php echo lang('menu_license'); ?></span>
                            </a>
                        </li>-->
                        <li class="<?=active_link_controller('about')?>">
                            <a href="<?php echo site_url('admin/about'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_about'); ?></span>
                            </a>
                        </li>
                    </ul>
                    <?php else: ?>
                    <?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/default.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo gmdate("Y-m-d H:i:s ", $user_login['lastlogin']); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    <!-- Search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">
                        <!--<li>
                            <a href="<?php echo site_url('/'); ?>">
                                <i class="fa fa-home text-primary"></i> <span><?php echo lang('menu_access_website'); ?></span>
                            </a>
                        </li>-->

                        <li class="header text-uppercase"><?php echo lang('menu_main_navigation'); ?></li>
                        <li class="<?=active_link_controller('dashboard')?>">
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="fa fa-dashboard"></i> <span><?php echo lang('menu_dashboard'); ?></span>
                            </a>
                        </li>

                        <li class="<?=active_link_controller('inandout')?>">
                            <a href="<?php echo site_url('admin/inandout'); ?>">
                                <i class="fa fa-files-o"></i> <span>In and Out</span>
                            </a>
                        </li>

                        <li class="<?=active_link_controller('request')?>">
                            <a href="<?php echo site_url('admin/request'); ?>">
                                <i class="fa fa-exchange"></i> <span>Request</span>
                            </a>
                        </li>

                        <li class="header text-uppercase"><?php echo $title; ?></li>
                        <!--<li class="<?=active_link_controller('license')?>">
                            <a href="<?php echo site_url('admin/license'); ?>">
                                <i class="fa fa-legal"></i> <span><?php echo lang('menu_license'); ?></span>
                            </a>
                        </li>-->
                        <li class="<?=active_link_controller('about')?>">
                            <a href="<?php echo site_url('admin/about'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_about'); ?></span>
                            </a>
                        </li>
                    </ul>
                     <?php endif; ?>
                </section>
                
            </aside>
