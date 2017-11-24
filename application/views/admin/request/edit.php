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
                                    
                                    <h3 class="box-title"><span class = "label label-primary">RQ-<?php echo $rqno?></span></h3>
                                    <?php foreach($requests as $request):?>
                                    <?php  if($request->tech_approval != 1):?>
                                    <h3 class="box-title pull-right"><button class="label label-danger" data-id=<?php echo $rqno?> id="btnCancelRequest"><i class="fa fa-close"></i> Cancel Request</button></h3>
                                    <?php endif;?>
                                </div>
                                <!--<?php var_dump($requests); ?>-->
                                <div class="progress">
                                
                                
                                <?php
                                if($request->tech_approval == 1){
                                    if($request->admin_approval == 1){
                                        ?>
                                         <div class="progress-bar progress-bar-success" role="progressbar" style="width:50%">
                                            Tech <i class = "fa fa-check" title="<?php echo $request->tech;?>"></i>
                                        </div>
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width:50%">
                                            Admin <i class = "fa fa-check" title="<?php echo $request->admin;?>"></i>
                                        </div>
                                       


                                <?php
                                        
                                    }else{
                                        ?>
                                        
                                        <div class="progress-bar progress-bar-success " role="progressbar" style="width:50%">
                                            Tech <i class = "fa fa-check" title="<?php echo $request->tech;?>"></i>
                                        </div>
                                        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:50%">
                                            Admin ***
                                        </div>


                                        <?php
                                    }
                                }else{
                                ?>

                                
                                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:50%">
                                    Tech ***
                                </div>
                                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:50%">
                                    Admin ***
                                </div>
                                <?php
                                }
                                ?>
                                
                               <?php endforeach;?>
                                </div>
                                <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="">Info</a></li>
                                <li role="presentation"><a href="../item_list/<?php echo $rqno; ?>">Item List</a></li>
                                <li role="presentation"><a href="../approval/<?php echo $rqno; ?>">Approval</a></li>
            
                                </ul>
                                <div class="box-body">
                                    
                                    <?php
                                    if(!empty($message)):
                                    ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $message;?>
                                    </div>
                                    <?php
                                    endif;
                                    ?>
                                    <?php
                                    if(!empty($message_suc)):
                                    ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $message_suc;?>
                                    </div>
                                     <?php
                                    endif;
                                    ?>
                                    
                        
                                  
                                        
                                         <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_request')); ?>
                                         <?php echo form_fieldset('Request Info'); ?>
                                            
                                            
                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Job No:</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_input($job_no);?>

                                                </div>
                                               
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Test No:</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_input($test_no);?>

                                                </div>
                                               
                                            </div>

                                            <!--<div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Technician</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_input($tech);?>
                                                </div>
                                               
                                            </div>-->


                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-10">
                                                    <div class="btn-group">
                                                        <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                        <?php echo anchor('admin/request', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo form_fieldset_close(); ?>
                                           
                                            <?php echo form_close();?>
                                        
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
