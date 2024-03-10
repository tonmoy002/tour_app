<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour.php';
include '../inc/tour_view.php';
$page  = "view";
$id = $_SESSION['tour_id'];
$tour = get_tour($id);
$expenses = get_tour_expenses($id);
$total = 0;
// echo "<pre>";
// print_r($tour_users);
// echo "</pre>";exit;
?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> <?php echo $tour[0]->title;?> - Expense  </h3>
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
                        <th> Detail</th>
                        <th> Amount</th>
                        <th> Time</th>
                        <th> Action </th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if($expenses): $i=1;foreach ($expenses as $exp) { 
                        $total += $exp->amount;
                        ?>
                        <tr>
                          <td class="py-1">
                            <?php echo $i;?>
                          </td>
                          <td><?php echo $exp->detail;?></td>
                          <td><?php echo $exp->amount;?></td>
                          <td><?php echo $exp->added;?></td>
                          <td>
                            <a href="<?php echo $site_config->admin_url.$page;?>/delete_expense.php?id=<?php echo $exp->id;?>" class="btn btn-sm btn-inverse-danger delete-btn">Delete</a>
                            
                          </td>
                        </tr>
                       <?php $i++;} endif;?>
                      
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">Total</th>
                          <th colspan="3"><?php echo $total;?></th>
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