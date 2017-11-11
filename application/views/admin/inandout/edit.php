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
                                                $data .= '&lt;img src=&quot;../../../upload/job_pic/'.$image.'&quot; width = &quot;200&quot; /&gt;&nbsp;&nbsp;';
                                            }
                                    
                                    ?>
                                    <h3 class="box-title"><span class = "label" style = "background:red;" title = "<?php echo $data; ?>"><?php echo $job_no?></span></h3>
                                </div>
                                
                                <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="">Job Info</a></li>
                                <li role="presentation"><a href="../history/<?php echo $job_no; ?>">History</a></li>
                                <li role="presentation"><a href="../traveller/<?php echo $job_no; ?>">Traveller</a></li>
                                <li role="presentation"><a href="../drawing/<?php echo $job_no; ?>">Drawing</a></li>
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
                                     <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_inandout')); ?>
                        <div id="tabs">
                            <ul>
                                <li><a href="#tabs-1">Info</a></li>
                                <li><a href="#tabs-2">Pictures</a></li>
                            </ul>
                                <div id="tabs-1">
                                    <div class="col-md-6">
                                       
                                             <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Customer:</span>
                                                <div class="col-sm-9">
                                                   
                                                    
                                                    <?php echo form_input($customer2);?>
                                                    <?php echo form_input($c_id);?>
                                                     
                                                    
                                                </div>
                                                <!--<div class="col-sm-2">
                                                         <?php echo anchor('admin/customers/create', '<i class="fa fa-plus"></i> '.'', array('class' => 'btn btn-block btn-primary btn-flat','title'=>'New Customer')); ?>
                                               </div>-->
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

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Date In:</span>
                                                <div class="col-sm-4">
                                                    <?php echo form_input($date_in);?>
                                                </div>
                                                <span class = 'col-sm-1 control-label'>Out:</span>
                                                 <div class="col-sm-4">
                                                    <?php echo form_input($date_out);?>
                                                </div>
                                            </div>
                                           
                                           
                                           
                                        </div>
                                        <div class="col-md-6">

                                           
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
                                                <span class = 'col-sm-3 control-label'>Status:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_dropdown($status);?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>DN No:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($dn_no);?>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Inv No:</span>
                                                <div class="col-sm-4">
                                                    <?php echo form_input($invno);?>
                                                </div>
                                
                                                <div class="col-sm-5">
                                                <div class="input-group">
                                                 <span class="input-group-addon" id="sizing-addon1"><i class = "fa fa-calendar"></i></span>
                                                    <?php echo form_input($date_inv);?>
                                                </div>
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
                                            
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Note:</strong> Please make sure that the file name does not have a space.
                                            </div>
                                            <div class="form-group">
                                                <span class = 'col-sm-3 control-label'>Images:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_upload($upload);?>
                                                    <br>
                                                    
                                                </div>
                                            </div>

                                            <div class="gallery" class = "col-md-9">
                                                         <?php
                                                            $images = explode(',',$job_images);
                                                            $data = '';
                                                            foreach($images as $image){
                                                                ?>

                                                                
                                                               <img src="../../../upload/job_pic/<?php echo $image; ?>" class="magnify col-md-4"  data-action="zoom" data-original="../../../upload/job_pic/<?php echo $image; ?>"/>
	                                                            
                                                                
                                                                <!--<img src = "../../../upload/job_pic/<?php echo $image; ?>" />-->
                                                            
                                                            <?php
                                                            }
                                    
                                                        ?>
                                                    </div>

                                         
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10" style="padding:20px;">
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
