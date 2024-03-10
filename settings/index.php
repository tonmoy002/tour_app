<?php 
include '../template-parts/header.php';
include '../template-parts/side-bar.php';
 $formDatas = $settings->get_settings();
 if(isset($_POST['save'])):
 	$formDatas2 = $settings->update_settings();
 	?>
    <script><?php echo("location.href = '".$site_config->admin_url."settings'");?></script>
    <?php
    exit;
 endif;
 if(isset($_POST['save_pass'])):
  $formDatas23 = $settings->update_password();
  ?>
    <script><?php echo("location.href = '".$site_config->admin_url."settings'");?></script>
    <?php
    exit;
 endif;
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Web Site Settings</h3>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" method="post" action="" enctype="multipart/form-data">
                    	<?php foreach ($formDatas as $formData) : 
                    		
	                    	switch ($formData->type) {
	                    		case 'text':
	                    		?>
	                			   <div class="form-group">
	                		    		<label for="<?php echo $formData->property;?>"><?php echo $formData->title;?></label>
	                		    		<input type="text" class="form-control" id="<?php echo $formData->property;?>" name="<?php echo $formData->property;?>" placeholder="<?php echo $formData->title;?>" value="<?php echo $formData->value;?>" required>
	                		  		</div>
	                    		<?php
	                    		break;
	                    		case 'email':
	                    		?>
	                			   <div class="form-group">
	                		    		<label for="<?php echo $formData->property;?>"><?php echo $formData->title;?></label>
	                		    		<input type="email" class="form-control" id="<?php echo $formData->property;?>" name="<?php echo $formData->property;?>" placeholder="<?php echo $formData->title;?>" value="<?php echo $formData->value;?>" required>
	                		  		</div>
	                    		<?php
	                    		break;
            		    		case 'image':
            		    		?>
            		    		<div class="form-group">
            		    		  <label><?php echo $formData->title;?></label>
            		    		  <input type="file" name="<?php echo $formData->property;?>" class="file-upload-default">
            		    		  <div class="input-group col-xs-12">
            		    		    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload <?php echo $formData->title;?>">
            		    		    <span class="input-group-append" style="display:inline-block;">
            		    		      <button class="file-upload-browse btn btn-gradient-primary file-upload" type="button">Upload</button>
            		    		    </span>

            		    		  </div>
            		    		  <div class="input-group col-xs-12">
            		    		  	<img src="<?php echo $site_config->admin_url;?>uploads/<?php echo $formData->value;?>" style="max-width: 120px;width: 100%;">
            		    		  </div>
            		    		   
            		    		</div>
            					   
            		    		<?php
            		    			# code...
            		    			break;
	                    		
	                    		default:
	                    			# code...
	                    			break;
	                    	}
                    		?>
                    	   
                      	<?php endforeach;?>
                      
                      
                      
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="save">Save</button>
                    </form>
                    <br>
                    <h1>Change Admin Password </h1>
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="password" value="" required="">
                      </div>
                      
                      
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2" name="save_pass">Save</button>
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