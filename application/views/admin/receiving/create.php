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
                                    <h3 class="box-title">New Stock</h3>
                                </div>
                                <div class="box-body">


                                    <?php
                                    if(!empty($message)):
                                    ?>
                                    <div class="alert alert-danger" role="alert"><?php echo $message;?></div>
                                    <?php
                                    endif;
                                    ?>


                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_stocks')); ?>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Part Desc:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_input($p_name);?>
                                                <?php echo form_input($p_id);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Supplier:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_input($p_supplier);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class = 'col-sm-2 control-label'>Quantity:</span>
                                            <div class="col-sm-10">
                                                <?php echo form_input($qty);?>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/receiving', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
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
