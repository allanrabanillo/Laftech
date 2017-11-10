<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="<?php echo $charset; ?>">
        <title><?php echo $title; ?></title>
<?php if ($mobile === FALSE): ?>
        <!--[if IE 8]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
<?php else: ?>
        <meta name="HandheldFriendly" content="true">
<?php endif; ?>
<?php if ($mobile == TRUE && $mobile_ie == TRUE): ?>
        <meta http-equiv="cleartype" content="on">
<?php endif; ?>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">
<?php if ($mobile == TRUE && $ios == TRUE): ?>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="<?php echo $title; ?>">
<?php endif; ?>
<?php if ($mobile == TRUE && $android == TRUE): ?>
        <meta name="mobile-web-app-capable" content="yes">
<?php endif; ?>
        <link rel="icon" href="<?php echo base_url($avatar_dir . '/icon.png'); ?>">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/dataTables.bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/rowReorder.dataTables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/responsive.dataTables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/ionicons/css/ionicons.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/skins/skin-red.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/easyautocomplete/css/easy-autocomplete.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/tooltipster/tooltipster.bundle.min.css'); ?>">
        <!-- <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/zoomjs/zoom.css'); ?>"> -->
         
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/jqueryui1.12/jquery-ui.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/jqueryui1.12/jquery-ui.theme.min.css'); ?>">

<?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/animsition/animsition.min.css'); ?>">
        
<?php endif; ?>
<?php if (($this->router->fetch_class() == 'groups' || $this->router->fetch_class() == 'categories') && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.css'); ?>">
<?php endif; ?>
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/domprojects/css/dp.min.css'); ?>">
<?php if ($mobile === FALSE): ?>
        <!--[if lt IE 9]>
            <script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
        <![endif]-->
<?php endif; ?>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
<?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
        <div class="wrapper animsition">
<?php else: ?>
        <div class="wrapper">
<?php endif; ?>
