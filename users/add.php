<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/users.php';
$postArray = array(
  'name' => '',
  'phone' => '',
);
if(isset($_POST['save'])){
  $postedData = $_POST; 
  $postArray = $postedData;
  $users_adds = add_users($postedData);
  //exit;
  if($users_adds){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."users'");?></script>
    <?php
    exit;
  }
}

?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Add User</h3>
            </div>
            <div class="row">
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $postArray['name'];?>">
                      </div>
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo $postArray['phone'];?>">
                      </div>
                      
                      
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="save">Save</button>
                      <a href="<?php echo $site_config->admin_url."users";?>" class="btn btn-light" name="cancel">Cancel</a>
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