<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour.php';
$id = $_GET['id'];
$tour = get_tour($id);
if(!$tour){
  $flash->add("notification_msg","You Are Trying To Visit Un Authorised Page.");
  $flash->add("notification_type","error");
  ?>
  <script><?php echo("location.href = '".$site_config->admin_url."tour'");?></script>
  <?php
  exit;

}

if(isset($_POST['update'])){
  $postedData = $_POST; 
  $tour_updates = update_tour($postedData,$id);
  if($tour_updates){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."tour'");?></script>
    <?php
    exit;
  }else{
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."tour/edit.php?id=".$id."'");?></script>
    <?php
    exit;
  }
}

?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Edit Tour</h3>
            </div>
            <div class="row">
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label>Tilte</label>
                        <input type="text" class="form-control" name="title" placeholder="Tilte" value="<?php echo $tour[0]->title;?>">
                      </div>
                      <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" name="detail" placeholder="Detail" value="<?php echo $tour[0]->detail;?>">
                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="update">Update</button>
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