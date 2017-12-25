<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <?php echo $dashboard_alert_file_install; ?>
                    <div class="row">
                       
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            
                            <div class="info-box">
                                <a href="./inandout/forinv">
                                <span class="info-box-icon bg-blue"><i class="fa fa-files-o"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jobs for INVOICE</span>
                                    <span class="info-box-number"><?php echo ($count_forinv_jobs)  ?></span>
                                </div>
                            </div>
                           
                        </div>
                         
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href="./inandout/fortest">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-cogs"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jobs for <br> TEST</span>
                                    <span class="info-box-number"><?php echo ($count_fortest_jobs)  ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href="./inandout/fortest">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-sort-amount-desc"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Critical<br> Part(s)</span>
                                    <span class="info-box-number"><?php echo ($count_critical_parts)  ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href="./stocks/outofstock">
                                <span class="info-box-icon bg-red"><i class="fa fa-exclamation-triangle"></i></span>
                                </a>
                                <div class="info-box-content">
                                     <span class="info-box-text">Out of <br>Stock(s)</span>
                                    <span class="info-box-number"><?php echo ($count_outofstock_parts)  ?></span>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href="./request/pending">
                                <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-copy"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Peding Request(s)</span>
                                    <span class="info-box-number"><?php echo $count_pending_requests; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Announcement(s)</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            <div class="box-body">
                            <ul class="media-list">

                            <?php foreach ($announcements as $announcement):?>
                            <li class="media">
                            <div class="media-left">
                                <a href="#">
                                <i class="fa fa-bullhorn"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $announcement->a_title;?> | <small ><?php $date=strtotime($announcement->a_date);echo date('Y-m-d',$date ); ;?></small></h4>
                              
                                <?php echo $announcement->a_message;?>
                               
                            </div>
                            </li>
                              <?php endforeach;?>
                             </ul>
                           </div>
                        </div>
                        </div>
                        <div class="col-md-9">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">System Info</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-center text-uppercase"><strong>Last Login</strong></p>
                                             <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Last Login</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               <?php foreach ($users as $user):?>
                                               <tr>
                                                    <td><?php echo htmlspecialchars($user->first_name.' '.$user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php $now = time();echo htmlspecialchars(timespan($user->last_login, $now).' ago', ENT_QUOTES, 'UTF-8'); ?></td>
                                                </tr>
                                               <?php endforeach;?>
                                                    
                                                </tbody>
                                             
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-center text-uppercase"><strong>Resources</strong></p>
                                            <div class="progress-group">
                                                <span class="progress-text">Disk use space</span>
                                                <span class="progress-number"><strong><?php echo byte_format($disk_usespace, 2); ?></strong>/<?php echo byte_format($disk_totalspace, 2); ?></span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="<?php echo $disk_usepercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $disk_usepercent; ?>%"></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                <span class="progress-text">Memory usage</span>
                                                <span class="progress-number"><strong><?php echo byte_format($memory_usage, 2); ?></strong>/<?php echo byte_format($memory_peak_usage, 2); ?></span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="<?php echo $memory_usepercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $memory_usepercent; ?>%"></div>
                                                </div>
                                            </div>
                                            <!--<p class="text-center text-uppercase"><strong>Login History</strong></p>
                                             <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Last Login</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               <?php foreach ($users as $user):?>
                                               <tr>
                                                    <td><?php echo htmlspecialchars($user->first_name.' '.$user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php $now = time();echo htmlspecialchars(timespan($user->last_login, $now).' ago', ENT_QUOTES, 'UTF-8'); ?></td>
                                                </tr>
                                               <?php endforeach;?>
                                                    
                                                </tbody>
                                             
                                            </table>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
