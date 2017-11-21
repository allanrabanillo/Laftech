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
                                    
                                    <h3 class="box-title"><span class = "label label-primary">RQ-<?php echo $id?></span></h3>
                                </div>
                                
                                <div class="progress">
                                <?php foreach($requests as $request):?>
                                
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
                                <li role="presentation"><a href="../edit/<?php echo $id; ?>">Info</a></li>
                                <li role="presentation"><a href="../item_list/<?php echo $id; ?>">Item List</a></li>
                                <li role="presentation" class="active"><a href="">Approval</a></li>
            
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
                                    <?php if($is_admin) : ?>
                                    
                                        <h4 class="box-title">Do you want to approve <span class = "label label-primary">RQ-<?php echo $id?></span>?</h4>
                                    
                                    <?php echo form_open('admin/request/approval/'. $id, array('class' => 'form-horizontal', 'id' => 'form-status_user')); ?>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <label class="radio-inline">
                                                    <input type="radio" name="confirm" id="confirm1" value="yes" checked="checked"> <?php echo strtoupper(lang('actions_yes', 'confirm')); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="confirm" id="confirm0" value="no"> <?php echo strtoupper(lang('actions_no', 'confirm')); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <?php echo form_hidden($csrf); ?>
                                                <?php echo form_hidden(array('id'=>$id)); ?>
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo anchor('admin/request/edit/'.$id, lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                    <?php else:?>
                                    <?php if($tech_id == $user_login['id']):?>
                                    <h4 class="box-title">Do you want to approve <span class = "label label-primary">RQ-<?php echo $id?></span>?</h4>
                                    
                                    <?php echo form_open('admin/request/approval/'. $id, array('class' => 'form-horizontal', 'id' => 'form-status_user')); ?>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <label class="radio-inline">
                                                    <input type="radio" name="confirm" id="confirm1" value="yes" checked="checked"> <?php echo strtoupper(lang('actions_yes', 'confirm')); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="confirm" id="confirm0" value="no"> <?php echo strtoupper(lang('actions_no', 'confirm')); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <?php echo form_hidden($csrf); ?>
                                                <?php echo form_hidden(array('id'=>$id)); ?>
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo anchor('admin/request/edit/'.$id, lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                    <?php else:?>
                                     <div class="alert alert-warning" role="alert">
                                       
                                    <h4 class="box-title"> <i class="fa fa-warning"></i> Your not the owner of this request.</h4>
                                    </div>
                                    <?php endif;?>
                                    
                                     
                                    <?php endif;?>
                                    
                        
                                   
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>



