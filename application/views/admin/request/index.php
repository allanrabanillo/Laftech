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
                                    <h3 class="box-title"><?php echo anchor('admin/request/create', '<i class="fa fa-plus"></i> '. 'New Request', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>RQ-ID</th>
                                                <th>Job No</th>
                                                <th>Test No</th>
                                                <th>Technician</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--<?php var_dump($requests); ?>-->
                                             <?php foreach ($requests as $request):?>
                                                <tr>

                                                    <td><?php  echo anchor('admin/request/edit/'.$request->r_id, '<span class="label label-info" >'.htmlspecialchars('RQ-'.$request->r_id, ENT_QUOTES, 'UTF-8').'</span>'); ?></td>
                                                    
                                                    <td>
                                                            <?php 
                                                                
                                                                echo anchor('admin/inandout/edit/'.$request->job_no,'<span class="label" style="background:red;" >'.htmlspecialchars($request->job_no, ENT_QUOTES, 'UTF-8').'</span>'); 
                                                                    
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            
                                                            echo anchor('admin/inandout/travellertest/'.$request->job_no.'/'.$request->test_no, '<span class="label" style="background:red;" >'.htmlspecialchars($request->test_no, ENT_QUOTES, 'UTF-8').'</span>'); 
                                                                
                                                        ?>
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                        <?php foreach ($request->tech as $user):
                                                            echo anchor('admin/users/profile/'.$user->id, '<span class="label label-default"  >'.htmlspecialchars(ucwords($user->username), ENT_QUOTES, 'UTF-8').'</span>'); 

                                                        endforeach;?>
                                                    </td> 
                                                   <td><span class="label" style="background:<?php echo $request->color; ?>"><?php echo htmlspecialchars($request->status, ENT_QUOTES, 'UTF-8'); ?></span></td>


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
