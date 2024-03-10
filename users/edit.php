<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/users.php';
$id = $_GET['id'];
$user = get_user($id);
if(!$user){
  $flash->add("notification_msg","You Are Trying To Visit Un Authorised Page.");
  $flash->add("notification_type","error");
  ?>
  <script><?php echo("location.href = '".$site_config->admin_url."users'");?></script>
  <?php
  exit;

}

if(isset($_POST['update'])){
  $postedData = $_POST; 
  $user_updates = update_user($postedData,$id);
  if($user_updates){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."users'");?></script>
    <?php
    exit;
  }else{
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."users/edit.php?id=".$id."'");?></script>
    <?php
    exit;
  }
}

?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Edit Users</h3>
            </div>
            <div class="row">
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $user[0]->name;?>">
                      </div>
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo $user[0]->phone;?>">
                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="update">Update</button>
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