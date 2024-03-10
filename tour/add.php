<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour.php';
$postArray = array(
  'title' => '',
  'detail' => '',
);
if(isset($_POST['save'])){
  $postedData = $_POST; 
  $postArray = $postedData;
  $tour_adds = add_tour($postedData);
  //exit;
  if($tour_adds){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."tour'");?></script>
    <?php
    exit;
  }
}

?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Add Tour</h3>
            </div>
            <div class="row">
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $postArray['title'];?>">
                      </div>
                      <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" name="detail" placeholder="Detail" value="<?php echo $postArray['detail'];?>">
                      </div>
                      
                      
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="save">Save</button>
                      <a href="<?php echo $site_config->admin_url."tour";?>" class="btn btn-light" name="cancel">Cancel</a>
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