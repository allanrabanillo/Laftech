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
                                    <h3 class="box-title">New Job</h3>
                                </div>
                
                                <div class="box-body">
                                    
                                    <?php
                                    if(!empty($message)):
                                    ?>
                                    <div class="alert alert-danger" role="alert"><?php echo $message;?></div>
                                    <?php
                                    endif;
                                    ?>
                                     <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_inandout')); ?>
                        
                        
                        <div id="tabs">
                            <ul>
                                <li><a href="#tabs-1">Job Info</a></li>
                                <li><a href="#tabs-2">Pictures</a></li>
                            </ul>
                                <div id="tabs-1">
                                    <div class="col-md-6">


                                    
                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Job No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($job_no);?>
                                                </div>
                                            </div>
                                            
                                       
                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Customer:</span>
                                                <div class="col-sm-7">
                                                    <?php echo form_input($customer);?>
                                                    <?php echo form_input($c_id);?>
                                                </div>
                                                <div class="col-sm-2">
                                                    <?php echo anchor('admin/customers/create', '<i class="fa fa-plus"></i> '.' Add', array('class' => 'btn btn-block btn-primary btn-flat')); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Item Desc:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($item_desc);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Part No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($partno);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Serial No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($serialno);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Model No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($modelno);?>
                                                </div>
                                            </div>
                                           
                                           
                                           
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Date In:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($date_in);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Ref No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($refno);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>DR No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($drno);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>DN No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($dn_no);?>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Status:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_dropdown($status);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Remarks:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_textarea($remarks);?>
                                                </div>
                                            </div>

                                        </div>
                                        </div>
                                        <div id="tabs-2">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Images:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_upload($upload);?>
                                                    <div class="gallery"></div>
                                                </div>
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
