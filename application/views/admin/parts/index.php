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
                                    <h3 class="box-title"><?php echo anchor('admin/parts/create', '<i class="fa fa-plus"></i> '. 'New Part', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Descrption</th>
                                                <th>Box No</th>
                                                <th>Type</th>
                                                <th>Critical Lvl</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($parts as $part):?>
                                            <tr>
                                                <td>
                                                <?php foreach ($part->categories as $category):?>
                                                    <?php echo anchor('admin/categories/edit/'.$category->cat_id, '<span class="label" style="background:orange;">'.htmlspecialchars($category->cat_name, ENT_QUOTES, 'UTF-8').'</span>'); ?>
                                                <?php endforeach?>
                                                </td>
                                                <td><?php echo htmlspecialchars($part->p_desc, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($part->p_boxno, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($part->p_type, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($part->p_c_level, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    
                                                    <?php echo anchor('admin/parts/edit/'.$part->p_id, '<i class="fa fa-edit"></i> Edit',array('class' => 'btn btn-primary btn-flat')); ?> 
                                                    <!--<?php echo anchor('admin/parts/profile/'.$part->p_id, '<i class="fa fa-user-o"></i> Profile',array('class' => 'btn btn-warning btn-flat')); ?>-->
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
