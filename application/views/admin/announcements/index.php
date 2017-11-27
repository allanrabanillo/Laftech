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
                                    <h3 class="box-title"><?php echo anchor('admin/announcements/create', '<i class="fa fa-plus"></i> '. 'New Announcement', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Message</th>
                                                <th>Date Created</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($announcements as $announcement):?>
                                            <tr>
                                                 <td>
                                                    <?php echo anchor('admin/announcements/edit/'.$announcement->a_id, '<i class="fa fa-edit"></i>',array('class' => 'btn btn-primary btn-circle','title'=>'Edit')); ?>
                                                    | <button type="button" class = "btn btn-danger btn-circle" title="Delete" id ="btnDeleteAnnoucement" data-id="<?php echo $announcement->a_id;?>"><i class="fa fa-remove"></i></button> 
                                                    
                                                </td>
                                                <td><?php echo htmlspecialchars($announcement->a_title, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($announcement->a_message, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($announcement->a_date, ENT_QUOTES, 'UTF-8'); ?></td>
                                               
                                                   
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
