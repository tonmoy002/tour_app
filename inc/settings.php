<?php 
 namespace webSettings;
 //include('mysqlib/ActiveRecord.php');
 //include('flash.php');
 use mysqlib\ActiveRecord as dbQuery;
 use Exception;
 

	/**
	* ---- Setting Class ----
	*
	* @author_url : 
	*/
	class Settings {
		public $db;
		public $flash;
		private $tbl;

		/**
		* This is construct method which set up database configaration
		*
		* @param 
		* @return 
		* @author Tonmoy Deb
		* @version 2020-04-25
		*/
		function __construct() {

		    $this->db = new dbQuery();
		    $this->table = 'website_settings';
		    $this->flash = new \FlashMessage();
		    
		}

		function get_settings(){
			$this->db->select("*");
			$res=$this->db->get($this->table);
			$result = $res->result();
			return $result;
		}

		function get_settng_for_user(){
			$settings = $this->get_settings();
			$s_array = array();
			foreach ($settings as $setting) {
				$s_array[$setting->property] = $setting->value;
			}
			return (object) $s_array;
		}
		function update_settings(){
			try{
				$this->db->trans_begin();
				unset($_POST['save']);
				// echo "<pre>";
				// print_r($_POST);
				// echo "</pre>";
				 $updateData = $_POST;
				// echo "<pre>";
				// print_r($updateData);
				// echo "</pre>";
				foreach ($updateData as $updateKey => $updateValue) {
					$this->db->where("property",$updateKey);
					$data = array('value' => $updateValue);
					if(!$this->db->update_where($this->table,$data)){
						throw new Exception("Update Data Failed");
					}
				}

				
				if(count($_FILES)>0){
					// echo "<pre>";
					// print_r($_FILES);
					// echo "</pre>";
					// exit;
				 $files = $this->file_upload($_FILES);
				 foreach ($files as $updateKey => $updateValue) {
				 	$this->db->where("property",$updateKey);
				 	$data = array('value' => $updateValue);
				 	if(!$this->db->update_where($this->table,$data)){
				 		throw new Exception("Update Data Failed");
				 	}
				 }
				 // echo "<pre>";
					// print_r($files);
					// echo "</pre>";
				}
				$this->db->trans_commit();
				$this->flash->add('notification_msg','Updated.');
				$this->flash->add('notification_type', 'success');
				return true;

				exit;
			}
			catch(Exception $E){
				//echo $E->getMessage();
				$this->db->trans_rollback();
				$this->flash->add('notification_msg', $E->getMessage());
				$this->flash->add('notification_type', 'error');
				return false;
				//redirect(site_url('restaurant/categories/view/' )); 			  	 
				
			}
			
			
		}
		function update_password(){
			$updateData = $_POST;
			$pass = $updateData['password'];
			$pass = $this->db->encrypt_password($pass,"md5"); 
			$this->db->where("user_id",1);
			$data = array('user_pass' => $pass);
			if($this->db->update_where('user',$data)){
				$this->flash->add('notification_msg','Updated.');
				$this->flash->add('notification_type', 'success');
				return true;
			}else{
				$this->flash->add('notification_msg', "Update Data Failed. Try Again Later.");
				$this->flash->add('notification_type', 'error');
				return false;
			}
		}

		function file_upload(
					$files,
					$config = array(
						'max-size'=>500000, 
						'allowed'=>"jpg,png,jpeg,gif"
					)
				){
			
			
			$file_uplodable_array = array();
			foreach ($files as $key => $file) {
				if($file["name"]!==""){
					$target_dir = date('Y/m/d')."/";
					if (!file_exists("../uploads/".$target_dir)) {
					    mkdir("../uploads/".$target_dir, 0777, true);
					}
					$target_file =  basename($file["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					// get file's name 
					$filename = pathinfo($target_file, PATHINFO_FILENAME); 

					// Check if image file is a actual image or fake image
					$check = getimagesize($file["tmp_name"]);
					if($check !== false) {

					    // echo "File is an image - " . $check["mime"] . ".";
					    // $uploadOk = 1;
					} else {
						throw new Exception("File is not an image.");
					   
					}

					// Check if file already exists
					$i = 0;
					while (file_exists("../uploads/".$target_dir.$target_file))
					{ 
						$target_file = $filename . '-' . $i . '.' . $imageFileType;
					    $i++;
					}

					// Check file size
					if(isset($config['max-size'])){
						if ($file["size"] > $config['max-size']) {
							throw new Exception("Sorry, your file is too large.");
						}
					} 
					

					// Allow certain file formats
					if(!isset($config['allowed']) || $config['allowed'] == "*"){

					}else{
						$allowed = explode(",", $config['allowed']);
						if (!in_array($imageFileType, $allowed)) {
							throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
						}
					}

					if (move_uploaded_file($file["tmp_name"], "../uploads/".$target_dir.$target_file)) {
						$file_uplodable_array[$key] = $target_dir.$target_file;
					    //echo "The file ". basename( $file["name"]). " has been uploaded.";
					} else {
					    throw new Exception("Sorry, there was an error uploading your file.");
					}
				}
				
			}
			return $file_uplodable_array;
		}



	}