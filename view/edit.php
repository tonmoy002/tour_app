<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour_view.php';
include '../inc/users.php';
$id = $_GET['id'];
$tour = get_tour_user($id);
if(!$tour){
  $flash->add("notification_msg","You Are Trying To Visit Un Authorised Page.");
  $flash->add("notification_type","error");
  ?>
  <script><?php echo("location.href = '".$site_config->admin_url."view'");?></script>
  <?php
  exit;

}
$users = get_users();

if(isset($_POST['update'])){
  $postedData = $_POST; 
  $tour_updates = update_tour_user($postedData);
  if($tour_updates){
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view'");?></script>
    <?php
    exit;
  }else{
    ?>
    <script><?php echo("location.href = '".$site_config->admin_url."view/edit.php?id=".$id."'");?></script>
    <?php
    exit;
  }
}

?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Pay By User</h3>
            </div>
            <div class="row">
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label>User</label>
                        <select class="form-control" disabled>
                          <option value="">Select User</option>
                          <?php foreach ($users as $user) { ?>
                            <option <?php if($tour[0]->user_id==$user->id){echo "selected";}?> value="<?php echo $user->id;?>"><?php echo $user->name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Pay</label>
                        <input type="text" class="form-control" name="payed" placeholder="Payed" value="">
                        <input type="hidden" class="form-control" name="tu_id" value="<?php echo $id;?>">
                      </div>

                      <div class="form-group">
                        <label>Notes</label>
                        <textarea class="form-control" name="notes" placeholder="Notes.."></textarea>
                       
                       
                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="update">Update</button>
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