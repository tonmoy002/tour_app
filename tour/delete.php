<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour.php';
$id = $_GET['id'];
$tour = delete_tour($id);
if($tour){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."tour'");?></script>
    <?php
    exit;
  }else{
  	 ?>
    <script><?php echo("location.href = '".$site_config->admin_url."tour'");?></script>
    <?php
    exit;
  }
?>