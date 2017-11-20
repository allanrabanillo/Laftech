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
                                </div>
                                
                                <div class="progress">
                                <?php
                                if($request->admin_approval == 1){
                                    if($request->tech_approval == 1){
                                        ?>
                                      
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width:50%">
                                            Admin <i class = "fa fa-check"></i>
                                        </div>
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width:50%">
                                            Tech <i class = "fa fa-check"></i>
                                        </div>


                                <?php
                                        
                                    }else{
                                        ?>
                                        
                                        <div class="progress-bar progress-bar-success " role="progressbar" style="width:50%">
                                            Admin <i class = "fa fa-check"></i>
                                        </div>
                                        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:50%">
                                            Tech ***
                                        </div>


                                        <?php
                                    }
                                }else{
                                ?>

                                
                                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:50%">
                                    Admin ***
                                </div>
                                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:50%">
                                    Tech ***
                                </div>
                                <?php
                                }
                                ?>
                                
                               
                                </div>
                                <ul class="nav nav-tabs">
                                <li role="presentation"><a href="../edit/<?php echo $rqno; ?>">Info</a></li>
                                <li role="presentation" class="active"><a href="">Item List</a></li>
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
                                    
                        
                                   <div class="col-md-6">
                                        <?php echo form_fieldset('Item List'); ?>
                                       <!--<?php var_dump($request);?>-->
                                        <table class="table table-striped table-bordered display" id ="tblItemList">

                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Qty</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!--<?php var_dump($travellers);?>-->
                                         <?php foreach ($request_items as $request_item):?>
                                         <tr>
                                         <?php foreach ($request_item->parts as $part):?>
                                         
                                            

                                            <td>

                                                <?php  echo anchor('admin/parts/edit/'.$part->p_id, '<span class="label" style="background:orange;" >'.htmlspecialchars($part->p_desc, ENT_QUOTES, 'UTF-8').'</span>'); ?>

                                                    
                                            </td> 

                                            <td>
                                                <?php foreach ($part->categories as $category):?>
                                                    <?php  echo anchor('admin/categories/edit/'.$category->cat_id, '<span class="label" style="background:orange;" >'.htmlspecialchars($category->cat_name, ENT_QUOTES, 'UTF-8').'</span>'); ?>
                                                 <?php endforeach;?>
                                                    
                                            </td> 

                                        <?php endforeach;?>
                                            <td><?php echo htmlspecialchars($request_item->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><button data-id = "<?php echo $request_item->r_item_id?>" data-jobno = "<?php echo $rqno?>"  class = "btn btn-danger btn-circle" id ="btnRemoveItem"><i class="glyphicon glyphicon-remove"></i></button></td>
                                            
                                         </tr>
                                         <?php endforeach;?>
                                        </tbody>

                                        </table>
                                        
                                        <?php echo form_fieldset_close(); ?>
                                       
                                        
                                        </div>
                                        <div class="col-md-6">
                                         <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_request')); ?>
                                         <?php echo form_fieldset('Add Parts'); ?>
                                            
                                            
                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Desc:</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_input($p_name);?>
                                                <?php echo form_input($p_id);?>

                                                </div>
                                               
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Qty:</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_input($p_qty);?>

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
                    </div>
                </section>
            </div>
