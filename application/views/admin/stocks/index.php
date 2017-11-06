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
                                    <h3 class="box-title"><?php echo anchor('admin/receiving/create', '<i class="fa fa-plus"></i> '. 'New Stock', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Descrption</th>
                                                <th>Critical Level</th>
                                                <th>Quantity</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($stocks as $stock):?>
                                            <tr>
                                                
                                                <?php foreach ($stock->parts as $part):?>
                                                <td>
                                                    <?php foreach ($part->categories as $category):?>
                                                        <?php echo anchor('admin/categories/edit/'.$category->cat_id, '<span class="label" style="background:orange;">'.htmlspecialchars($category->cat_name, ENT_QUOTES, 'UTF-8').'</span>'); ?>
                                                    <?php endforeach?>
                                                </td>
                                                <td>
                                                    <?php echo anchor('admin/parts/edit/'.$part->p_id, '<span class="label" style="background:orange;">'.htmlspecialchars($part->p_desc, ENT_QUOTES, 'UTF-8').'</span>'); ?>
                                                </td>
                                                 <td><?php echo htmlspecialchars($part->p_c_level, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php endforeach?>
                                                
                                                <td><?php echo htmlspecialchars($stock->balance, ENT_QUOTES, 'UTF-8'); ?></td>
                                        
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
