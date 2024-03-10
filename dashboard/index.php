<?php include '../template-parts/header.php';?>
<?php include '../template-parts/side-bar.php';?>
<?php 
include '../inc/tour.php';
include '../inc/tour_view.php';
if(!isset($_SESSION['tour_id'])){
  ?>
    <script><?php echo("location.href = '".$site_config->admin_url."tour'");?></script>
    <?php
    exit;
}
$id = $_SESSION['tour_id'];
$tour_users = get_tour_users($id);
$tour = get_tour($id);
$expense = get_total_expense($id);
$total = 0;
$payable = $expense/count($tour_users);
$payable = number_format($payable, 2);
?>

   
      
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard </h3>
                <a href="<?php echo $site_config->admin_url;?>view" class="btn btn-md btn-gradient-primary float-right"> View </a>
            </div>
            <div class="row">
              <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class="text-center">Total Expense</h2> 
                    <br>
                    <h2 class="text-center"><?php echo $expense;?></strong>
                    
                  </div>
                </div>
              </div>
              <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class="text-center">Total User</h2> 
                    <br>
                    <h2 class="text-center"><?php echo count($tour_users);?></h2>
                    
                  </div>
                </div>
              </div>
              <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class="text-center">Total Payable Per User</h2> 
                    <br>
                    <h2 class="text-center"><?php echo $payable;?></h2>
                    
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- main-panel ends -->
<?php include '../template-parts/footer.php';?>