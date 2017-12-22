<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <?php if($is_admin): ?>
                                    <h3 class="box-title"><?php echo anchor('admin/inandout/create', '<i class="fa fa-plus"></i> '. 'New Job', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                    <?php else:?>
                                    <h3 class="box-title"><button class = "btn btn-block btn-primary btn-flat" disabled><i class="fa fa-plus"></i> New Job</button></h3>
                                    <?php endif;?>
                                </div>
                                <div class="box-body">
                              
                                    <table class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>Job No</th>
                                                <th>Customer</th>
                                                <th>Item Desc</th>
                                                <th>Part No</th>
                                                <th>Date In</th>
                                                <th>Status</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($jobs as $job):?>
                                            <tr>
                                                
                                                <td>
                                                    <?php 
                                                            // $images = explode(',',$job->images);
                                                            // $data = '';
                                                            // foreach($images as $image){
                                                            //     $data .= '&lt;img src=&quot;../upload/job_pic/'.$image.'&quot; width = &quot;100&#37;&quot; /&gt;&nbsp;&nbsp;';
                                                            // }
                                                            echo anchor('admin/inandout/edit/'.$job->job_no, '<span class="label" style="background:red;">'.htmlspecialchars($job->job_no, ENT_QUOTES, 'UTF-8').'</span>'); 
                                                            
                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    <?php if($is_admin): ?>
                                                        <?php echo anchor('admin/customers/edit/'.$job->c_id, '<span class="label" style="background:orange;">'.htmlspecialchars($job->c_name, ENT_QUOTES, 'UTF-8').'</span>'); ?>
                                                    <?php else:?>
                                                        <span class="label" style="background:orange"><?php echo htmlspecialchars($job->c_name, ENT_QUOTES, 'UTF-8'); ?></span>
                                                    <?php endif;?>
                                                    
                                                    
                                                </td>
                                                <td><?php echo htmlspecialchars($job->item_desc, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($job->partno, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($job->date_in, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><span class="label" style="background:<?php echo $job->color; ?>"><?php echo htmlspecialchars($job->status, ENT_QUOTES, 'UTF-8'); ?></span></td>
                                                
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>

                                   
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
