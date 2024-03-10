<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour.php';
include '../inc/tour_view.php';
$page  = "view";
$id = $_SESSION['tour_id'];
$tour_users = get_tour_users($id);
$tour = get_tour($id);
$expense = get_total_expense($id);
$total = 0;
$payable = $expense/count($tour_users);
$payable = number_format($payable, 2);
// echo "<pre>";
// print_r($tour_users);
// echo "</pre>";exit;
?>
<style type="text/css">
  .custom-li-buttons{
    list-style: none;
  }
  .custom-li-buttons li{
    display: inline-block;
  }
</style>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <div class="infos">
                <h3 class="page-title"> <?php echo $tour[0]->title;?> - User List </h3>
                <br>
                Total Expense : <?php echo $expense;?>
                <br>
                Total Payeble Per User : <?php echo $payable;?>
              </div>
              
              <ul class="custom-li-buttons">
                <li><a href="<?php echo $site_config->admin_url.$page;?>/add_expense.php" class="btn btn-md btn-gradient-primary float-right">+ Add Expense</a></li>
                <li><a href="<?php echo $site_config->admin_url.$page;?>/view_expense.php" class="btn btn-md btn-gradient-primary float-right"> View Expense</a></li>
                <li><a href="<?php echo $site_config->admin_url.$page;?>/add_user.php" class="btn btn-md btn-gradient-primary float-right">+ Add User</a></li>
              </ul>
              
              
              
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th> ID</th>
                        <th> Name</th>
                        <th> Phone</th>
                        <th> Paid</th>
                        <th> Action </th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if($tour_users): $i=1;foreach ($tour_users as $tu) { 
                        $pd = get_total_payed($tu->id);
                        $total += $pd; ?>
                        <tr>
                          <td class="py-1">
                            <?php echo $i;?>
                          </td>
                          <td><?php echo $tu->name;?></td>
                          <td><?php echo $tu->phone;?></td>
                          <td><?php echo $pd;?></td>
                          <td>
                            <a href="<?php echo $site_config->admin_url.$page;?>/edit.php?id=<?php echo $tu->id;?>" class="btn btn-sm btn-inverse-info">Pay</a>
                            <a href="<?php echo $site_config->admin_url.$page;?>/history.php?id=<?php echo $tu->id;?>" class="btn btn-sm btn-inverse-info">History</a>
                            <a href="<?php echo $site_config->admin_url.$page;?>/delete.php?id=<?php echo $tu->id;?>" class="btn btn-sm btn-inverse-danger delete-btn">Delete</a>
                            
                          </td>
                        </tr>
                       <?php $i++;} endif;?>
                      
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3" style="text-align: right;">Total</th>
                          <th colspan="2"><?php echo $total;?></th>
                        </tr>
                      </tfoot>
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