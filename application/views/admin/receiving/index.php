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
                                    <h3 class="box-title"><?php echo anchor('admin/receiving/create', '<i class="fa fa-plus"></i> '. 'Receive Part', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    
                                    <table class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Received Date</th>
                                                <th>Received By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($receives as $receive):?>
                                            <tr>
                                                
                                                <?php foreach ($receive->parts as $part):?>
                                                <td>
                                                    <?php foreach ($part->categories as $category):?>
                                                        <?php echo anchor('admin/categories/edit/'.$category->cat_id, '<span class="label" style="background:'.$category->cat_color.';">'.htmlspecialchars($category->cat_name, ENT_QUOTES, 'UTF-8').'</span>'); ?>
                                                    <?php endforeach?>
                                                </td>
                                                <td>
                                                    <?php echo anchor('admin/parts/edit/'.$part->p_id, '<span class="label" style="background:orange;">'.htmlspecialchars($part->p_desc, ENT_QUOTES, 'UTF-8').'</span>'); ?>
                                                </td>
                                                <?php endforeach?>
                                                
                                                <td><?php echo htmlspecialchars($receive->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($receive->s_date, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($receive->s_by, ENT_QUOTES, 'UTF-8'); ?></td>
                                                
                                                <td>
                                                    
                                                    <?php echo anchor('admin/receiving/edit/'.$receive->s_id, '<i class="fa fa-edit"></i> Edit',array('class' => 'btn btn-primary btn-flat')); ?> 
                                                    <!--<?php echo anchor('admin/receiving/profile/'.$category->cat_id, '<i class="fa fa-user-o"></i> Profile',array('class' => 'btn btn-warning btn-flat')); ?>-->
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
