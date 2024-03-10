<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour.php';
include '../inc/tour_view.php';
$page  = "view";
$id = $_GET['id'];
$payed_users_info = get_tour_user($id);
$payments = get_tour_user_payment($id);
// echo "<pre>";
// print_r($tour_users);
// echo "</pre>";exit;
?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> <?php echo $payed_users_info[0]->name;?> - Payments  </h3>
              <a href="<?php echo $site_config->admin_url.$page;?>/" class="btn btn-md btn-gradient-primary float-right">- Back</a>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th> ID</th>
                        <th> Payed</th>
                        <th> Notes</th>
                        <th> Date Time</th>
                        <th> Action </th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if($payments): $i=1;foreach ($payments as $payment) { ?>
                        <tr>
                          <td class="py-1">
                            <?php echo $i;?>
                          </td>
                          <td><?php echo $payment->payed;?></td>
                          <td><?php echo $payment->notes;?></td>
                          <td><?php echo $payment->added;?></td>
                          <td>
                            <a href="<?php echo $site_config->admin_url.$page;?>/delete_payment.php?id=<?php echo $payment->id;?>&b_id=<?php echo $id;?>" class="btn btn-sm btn-inverse-danger delete-btn">Delete</a>
                            
                          </td>
                        </tr>
                       <?php $i++;} endif;?>
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
    <!-- main-panel ends -->
  <?php include '../template-parts/footer.php';?>