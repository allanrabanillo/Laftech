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
                                    <h3 class="box-title">Create part</h3>
                                </div>
                                <div class="box-body">


                                    <?php
                                    if(!empty($message)):
                                    ?>
                                    <div class="alert alert-danger" role="alert"><?php echo $message;?></div>
                                    <?php
                                    endif;
                                    ?>


                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_parts')); ?>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Category:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_dropdown('p_category',$category,array(),array('class'=>'form-control'));?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Description:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_input($p_desc);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Box No:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_input($p_boxno);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Type:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_input($p_type);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Critical Lvl:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_input($p_critical);?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/parts', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
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
