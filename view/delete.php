<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour_view.php';
$id = $_GET['id'];

$user = delete_user_tour($id);
if($user){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view'");?></script>
    <?php
    exit;
  }else{
  	 ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view'");?></script>
    <?php
    exit;
  }
?>