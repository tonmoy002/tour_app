<?php  
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
$_SESSION['tour_id'] = $_GET['tid'];
?>
    <script><?php echo("location.href = '".$site_config->admin_url."view'");?></script>
    <?php
    exit; 
?>