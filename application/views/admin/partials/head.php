<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title;?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/dist/img/favicon.ico')?>" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php  echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php  echo base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <?php if($active == 'call-conference'):?>
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="<?php  echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css');?>">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php  echo base_url('assets/plugins/select2/select2.min.css');?>">
    <?php endif;?>
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php  echo base_url('assets/dist/css/AdminLTE.min.css');?>">
    <link rel="stylesheet" href="<?php  echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
    <link rel="stylesheet" href="<?php  echo base_url('assets/css/style.css');?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>