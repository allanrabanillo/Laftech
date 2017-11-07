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
                                    <h3 class="box-title"><span class = "label" style = "background:red;"><?php echo $job_no?></span></h3>
                                </div>
                                <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="">Job Info</a></li>
                                <li role="presentation"><a href="">History</a></li>
                                <li role="presentation"><a href="">Traveller</a></li>
                                <li role="presentation"><a href="">Drawing</a></li>
                                </ul>
                                <div class="box-body">
                                    
                                    <?php
                                    if(!empty($message)):
                                    ?>
                                    <div class="alert alert-danger" role="alert"><?php echo $message;?></div>
                                    <?php
                                    endif;
                                    ?>
                                     <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_inandout')); ?>
                                    <div class="col-md-6">
                                       
                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Customer:</span>
                                                <div class="col-sm-10">
                                                    <?php echo form_dropdown($customer);?>
                                                </div>
                                            </div>
                                           
                                           
                                           
                                        </div>
                                        <div class="col-md-6">
                                        
                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Status:</span>
                                                <div class="col-sm-10">
                                                    <?php echo form_dropdown($status);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Remarks:</span>
                                                <div class="col-sm-10">
                                                    <?php echo form_textarea($remarks);?>
                                                </div>
                                            </div>

                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo anchor('admin/inandout', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
