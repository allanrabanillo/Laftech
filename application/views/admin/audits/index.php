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
                                
                                <div class="box-body">
                                <table class="table table-striped table-bordered display">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Action</th>
                                                <th>Module</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($audits as $audit):?>
                                            <tr>
                                                
                                               
                                                
                                                <td><?php echo htmlspecialchars($audit->first_name.' '.$audit->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($audit->message, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($audit->module, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($audit->created_at, ENT_QUOTES, 'UTF-8'); ?></td>
                                                
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
