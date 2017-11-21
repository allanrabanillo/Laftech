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
                                    <?php
                                            $images = explode(',',$job_images);
                                            $data = '';
                                            foreach($images as $image){
                                                $data .= '&lt;img src=&quot;../../../../upload/job_pic/'.$image.'&quot; width = &quot;200&quot; /&gt;&nbsp;&nbsp;';
                                            }
                                    
                                    ?>
                                    <h3 class="box-title"><span class = "label" style = "background:red;" title = "<?php echo $data; ?>"><?php echo $job_no?></span></h3>
                                </div>
                                
                                
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
                                    
                                 <!--<?php var_dump($traveller_items);?>-->
                                     <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_inandout')); ?>
                        
                                   <div class="col-md-6">
                                        <table class="table table-striped table-bordered display">

                                        <thead>
                                            <tr>
                                                <th>RQ-ID</th>
                                                <th>Desc</th>
                                                
                                                <th>Category</th>
                                                
                                                <th>Qty</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                         <?php foreach ($traveller_items as $item):?>
                                         <?php foreach ($item->parts as $part):?>
                                         <tr>

                                           
                                            <td>
                                                    <?php 
                                                        
                                                        echo anchor('admin/request/edit/'.$item->r_id, '<span class="label label-info">'.htmlspecialchars('RQ-'.$item->r_id, ENT_QUOTES, 'UTF-8').'</span>'); 
                                                            
                                                    ?>
                                            </td>
                                            <td>
                                                    <?php 
                                                        
                                                        echo anchor('admin/parts/edit/'.$part->p_id, '<span class="label" style="background:red;" >'.htmlspecialchars($part->p_desc, ENT_QUOTES, 'UTF-8').'</span>'); 
                                                            
                                                    ?>
                                            </td>
                                            
                                            
                                            <td>
                                                <?php foreach ($part->categories as $category):
                                                    echo anchor('admin/categories/edit/'.$category->cat_id, '<span class="label" style="background:orange;" >'.htmlspecialchars($category->cat_name, ENT_QUOTES, 'UTF-8').'</span>'); 

                                                 endforeach;?>
                                            </td> 
                                            <td><?php echo htmlspecialchars($item->qty, ENT_QUOTES, 'UTF-8'); ?></td>


                                         </tr>
                                          <?php endforeach;?>
                                         <?php endforeach;?>
                                        </tbody>

                                        </table>
                                        
                                        
                                        
                                        
                                        </div>
                                        <div class="col-md-6">
                                         <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_history')); ?>
                                         <?php echo form_fieldset('Traveller Info'); ?>
                                            
                                            
                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Test No:</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_input($test_no);?>
                                             
                                                 
                                                     
                                                    
                                                </div>
                                                <!--<div class="col-sm-2">
                                                         <?php echo anchor('admin/customers/create', '<i class="fa fa-plus"></i> '.'', array('class' => 'btn btn-block btn-primary btn-flat','title'=>'New Customer')); ?>
                                               </div>-->
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Error Code:</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_input($t_error_code);?>
                                             
                                                 
                                                     
                                                    
                                                </div>
                                               
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Remarks:</span>
                                                <div class="col-sm-10">
                                                   
                                                    
                                                <?php echo form_textarea($remarks);?>
                                             
                                                 
                                                     
                                                    
                                                </div>
                                            
                                            </div>

                                            


                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-10">
                                                    <div class="btn-group">
                                                        <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                        <?php echo anchor('admin/inandout/traveller/'.$job_no, lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
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
