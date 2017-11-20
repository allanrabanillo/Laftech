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
                                                $data .= '&lt;img src=&quot;../../../upload/job_pic/'.$image.'&quot; width = &quot;200;&quot; /&gt;&nbsp;&nbsp;';
                                            }
                                    
                                    ?>
                                    <h3 class="box-title"><span class = "label" style = "background:red;" title = "<?php echo $data; ?>"><?php echo $job_no?></span></h3>
                                </div>
                                
                                <ul class="nav nav-tabs">
                                <li role="presentation"><a href="../edit/<?php echo $job_no; ?>">Job Info</a></li>
                                <li role="presentation"><a href="../history/<?php echo $job_no; ?>">History</a></li>
                                <li role="presentation"><a href="../traveller/<?php echo $job_no; ?>">Traveller</a></li>
                                <li role="presentation" class="active"><a href="">Drawing</a></li>
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
                                     <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_drawing')); ?>
                                     <?php if($is_admin): ?>
                                                   
                                               
                                    <div class="alert alert-warning" role="alert">
                                                <strong>Note:</strong> Please make sure that the file name does not have a space.
                                    </div>
                                            <div class="form-group">
                                                <span class = 'col-sm-2 control-label'>Images:</span>
                                                <div class="col-sm-9">
                                                    <?php echo form_upload($upload);?>
                                                    <br>
                                                   
                                                </div>
                                                 
                                            </div>
                                    <?php endif;?>
                                            <div class="gallery" class = "col-md-9">
                                                     
                                                         <?php
                                                            $images = explode(',',$job_drawing);
                                                            $data = '';
                                                            
                                                            foreach($images as $image){
                                                                ?>

                                                                
                                                                   
                                                                            <img src="../../../upload/drawing/<?php echo $image; ?>" class="magnify col-sm-4"  data-action="zoom" data-original="../../../upload/drawing/<?php echo $image; ?>"/>
	                                                            
                                                                        
                                                                <!--<img src = "../../../upload/job_pic/<?php echo $image; ?>" />-->
                                                            
                                                            <?php
                                                            }
                                    
                                                        ?>
                                                       
                                                    </div>

                                        <div class="form-group">
                                             <div class="col-sm-offset-3 col-sm-10" style="padding:20px;">
                                                <div class="btn-group">
                                                <?php if($is_admin): ?>
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                <?php endif;?>
                                                    
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
