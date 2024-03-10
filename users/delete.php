<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/users.php';
$id = $_GET['id'];
$user = delete_user($id);
if($user){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."users'");?></script>
    <?php
    exit;
  }else{
  	 ?>
    <script><?php echo("location.href = '".$site_config->admin_url."users'");?></script>
    <?php
    exit;
  }
?>