<?php 
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

			// // Check if image file is a actual image or fake image
			// $check = getimagesize($file["tmp_name"]);
			// if($check !== false) {

			//     // echo "File is an image - " . $check["mime"] . ".";
			//     // $uploadOk = 1;
			// } else {
			// 	throw new Exception("File is not an image.");
			   
			// }

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
?>