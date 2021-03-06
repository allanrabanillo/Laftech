<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b><?php echo lang('footer_version'); ?></b> 1.0.0
                </div>
                <strong><?php echo lang('footer_copyright'); ?> &copy; <?php echo date('Y'); ?> <a href="#" target="_blank">Laftech</a> &amp; <a href="#" target="_blank">AAF Softwareworks</a>.</strong> <?php echo lang('footer_all_rights_reserved'); ?>.
            </footer>
        </div>

        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery-1.12.4.js'); ?>"></script>

        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/jqueryui1.12/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/jquery/dataTables.rowReorder.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/jquery/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/jquery/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/slimscroll/slimscroll.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/easyautocomplete/js/jquery.easy-autocomplete.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/tooltipster/tooltipster.bundle.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/sweetalert/sweetalert2.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/sweetalert/sweetalert2.all.js'); ?>"></script>
        
        <script src="<?php echo base_url($plugins_dir . '/zooming/zooming.js'); ?>"></script>
        <!-- <script src="<?php echo base_url($plugins_dir . '/zooming/custom.js'); ?>"></script> -->
        
        
       
<?php if ($mobile == TRUE): ?>
        <script src="<?php echo base_url($plugins_dir . '/fastclick/fastclick.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($admin_prefs['transition_page'] == TRUE): ?>
        <script src="<?php echo base_url($plugins_dir . '/animsition/animsition.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength.min.js'); ?>"></script>
<?php endif; ?>
<?php if (($this->router->fetch_class() == 'groups' || $this->router->fetch_class() == 'categories') && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <script src="<?php echo base_url($plugins_dir . '/tinycolor/tinycolor.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'dashboard' && ($this->router->fetch_method() == 'notification')): ?>
        <script src="<?php echo base_url($frameworks_dir . '/domprojects/js/notification.js'); ?>"></script>
<?php endif; ?>
        <script src="<?php echo base_url($frameworks_dir . '/adminlte/js/adminlte.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/domprojects/js/dp.min.js'); ?>"></script>
    </body>
</html>