<?php 
define('lang' ,'tr');
include('../panel/important/security.php');
 ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>List View - Vuexy - Bootstrap HTML admin template</title>
    <?php 

    $state=filter(filter_input(INPUT_GET, 'state', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $page=filter(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if($state=='add' && $page=='product_image')
    {

        ?>
        <link href="<?php echo apath; ?>template/app-assets/dropzone/dropzone.css" rel="stylesheet" type="text/css">
        <script src="<?php echo apath; ?>template/app-assets/dropzone/dropzone.js" type="text/javascript"></script>
        <?php  
    }

    if($state=='list' && $page=='product_image')
    {

        ?>

        <link rel="stylesheet" href="<?php echo apath; ?>template/app-assets/nestable/css/jquery.nestable.css">
        <link rel="stylesheet" href="<?php echo apath; ?>template/app-assets/nestable/css/style.css">
        <?php  
    }

    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="apple-touch-icon" href="<?php echo apath; ?>template/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo apath; ?>template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/themes/semi-dark-layout.css">

    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/assets/toastr/toastr2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/assets/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/assets/toastr/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.7/sweetalert2.min.css" integrity="sha512-qZl4JQ3EiQuvTo3ccVPELbEdBQToJs6T40BSBYHBHGJUpf2f7J4DuOIRzREH9v8OguLY3SgFHULfF+Kf4wGRxw==" crossorigin="anonymous" />


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo apath; ?>template/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

