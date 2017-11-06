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
                                    <h3 class="box-title"><?php echo anchor('admin/categories/create', '<i class="fa fa-plus"></i> '. 'New Category', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Desc</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($categories as $category):?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($category->cat_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($category->cat_desc, ENT_QUOTES, 'UTF-8'); ?></td>
                                                
                                                <td>
                                                    
                                                    <?php echo anchor('admin/categories/edit/'.$category->cat_id, '<i class="fa fa-edit"></i> Edit',array('class' => 'btn btn-primary btn-flat')); ?> 
                                                    <!--<?php echo anchor('admin/categories/profile/'.$category->cat_id, '<i class="fa fa-user-o"></i> Profile',array('class' => 'btn btn-warning btn-flat')); ?>-->
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
