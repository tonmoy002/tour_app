<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
include '../inc/tour.php';
$page  = "tour";
$tours = get_tours();
// echo "<pre>";
// print_r($users);
// echo "</pre>";exit;
?>
    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Tour List </h3>
              <a href="<?php echo $site_config->admin_url.$page;?>/add.php" class="btn btn-md btn-gradient-primary float-right">+ Add Tour</a>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th> ID</th>
                        <th> Title</th>
                        <th> Detail</th>
                        <th> Action </th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if($tours): $i=1;foreach ($tours as $tour) { ?>
                        <tr>
                          <td class="py-1">
                            <?php echo $i;?>
                          </td>
                          <td><?php echo $tour->title;?></td>
                          <td><?php echo $tour->detail;?></td>
                          <td>
                            <a href="<?php echo $site_config->admin_url.$page;?>/delete.php?id=<?php echo $tour->id;?>" class="btn btn-sm btn-inverse-danger delete-btn">Delete</a>
                            <a href="<?php echo $site_config->admin_url.$page;?>/edit.php?id=<?php echo $tour->id;?>" class="btn btn-sm btn-inverse-info">Edit</a>
                            <a href="<?php echo $site_config->admin_url.$page;?>/set_tour.php?tid=<?php echo $tour->id;?>" class="btn btn-sm btn-inverse-info">View</a>
                          </td>
                        </tr>
                       <?php } endif;?>
                      
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