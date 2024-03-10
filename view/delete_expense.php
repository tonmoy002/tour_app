<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour_view.php';
$id = $_GET['id'];


$user = delete_expense($id);
if($user){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view/view_expense.php'");?></script>
    <?php
    exit;
  }else{
  	 ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view/view_expense.php'");?></script>
    <?php
    exit;
  }
?>