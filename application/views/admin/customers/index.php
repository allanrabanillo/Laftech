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
                                    <h3 class="box-title"><?php echo anchor('admin/customers/create', '<i class="fa fa-plus"></i> '. 'New Customer', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-bordered display" cellspacing="0" width="100%" id = 'customer_tbl'>
                                        <thead>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Contact Person</th>
                                                <th>Contact No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Contact Person</th>
                                                <th>Contact No</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($customers as $customer):?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($customer->c_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($customer->c_person, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($customer->c_contactno, ENT_QUOTES, 'UTF-8'); ?></td>
                                                
                                                <td>
                                                    
                                                    <?php echo anchor('admin/customers/edit/'.$customer->c_id, '<i class="fa fa-edit"></i>',array('class' => 'btn btn-primary btn-circle','title'=>'Edit')); ?> 
                                                    <!--<?php echo anchor('admin/parts/profile/'.$customer->c_id, '<i class="fa fa-user-o"></i> Profile',array('class' => 'btn btn-warning btn-flat')); ?>-->
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

