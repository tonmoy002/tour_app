<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour_view.php';
$id = $_GET['id'];
$bid = $_GET['b_id'];

$user = delete_payment($id);
if($user){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view/history.php?id=".$bid."'");?></script>
    <?php
    exit;
  }else{
  	 ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view/history.php?id=".$bid."'");?></script>
    <?php
    exit;
  }
?>