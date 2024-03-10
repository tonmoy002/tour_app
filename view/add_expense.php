<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour_view.php';
$tour_id = $_SESSION['tour_id'];
$postArray = array(
  'tour_id' => $tour_id,
  'detail' => '',
  'amount' => '',
);

if(isset($_POST['save'])){
  $postedData = $_POST; 
  $postArray = $postedData;
  $tour_adds = add_expense($postedData);
  //exit;
  if($tour_adds){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view'");?></script>
    <?php
    exit;
  }
}

?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Add Expense </h3>
            </div>
            <div class="row">
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label>Detail</label>
                        <textarea class="form-control" name="detail" placeholder="Detail.."><?php echo $postArray['detail'];?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" value="<?php echo $postArray['amount'];?>">
                        <input type="hidden" class="form-control" name="tour_id" value="<?php echo $postArray['tour_id'];?>">
                      </div>
                      
                      
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="save">Save</button>
                      <a href="<?php echo $site_config->admin_url."view";?>" class="btn btn-light" name="cancel">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
  
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
    <!-- main-panel ends -->
  <?php include '../template-parts/footer.php';?>