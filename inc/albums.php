<?php
include 'fileupload.php';
use mysqlib\ActiveRecord as dbQuery;
$flash = new \FlashMessage();

	function get_albums(){
		$db = new dbQuery();
		$db->select("*");
		$res=$db->get('albums');
		$result = $res->result();
		return $result;

	}
	function get_album($id){
		$db = new dbQuery();
		$db->select("*");
		$db->where("id",$id);
		$res=$db->get('albums');
		$result = $res->result();
		return $result;

	}
	function update_album($postedData,$id){
		$flash = new \FlashMessage();
		$db = new dbQuery();
		unset($postedData['update']);
		try{
				$db->trans_begin();
				
				if($_FILES["cover"]["name"]!==""){
					$files = file_upload($_FILES);
					$postedData['cover'] = $files['cover'];
				}
				
				$db->where("id",$id);
				if($db->update_where('albums',$postedData)){
					$db->trans_commit();
					$flash->add("notification_msg","Updated Successfully.");
					$flash->add("notification_type","success");
					return true;
				}else{
					throw new Exception("Somthng Went Wrong try again later.");
				}
			}catch(Exception $E){
				//echo $E->getMessage();exit;
				$db->trans_rollback();
				$flash->add('notification_msg', $E->getMessage());
				$flash->add('notification_type', 'error');
				return false;
				//redirect(site_url('restaurant/categories/view/' )); 			  	 
				
			}
			
		
		
	}

	function add_album($postedData){
		unset($postedData['save']);
		$flash = new \FlashMessage();
		$db = new dbQuery();
		try{
				$db->trans_begin();
				$postedData['cover'] = '';
				if($_FILES["cover"]["name"]!==""){
					$files = file_upload($_FILES);
					// echo "<pre>";
					// print_r($files);
					// echo "</pre>";
					$postedData['cover'] = $files['cover'];
				}
				// echo "<pre>";
				// print_r($postedData);
				// echo "</pre>";
				// exit;
			if($db->insert('albums',$postedData)){
				$db->trans_commit();
				$flash->add("notification_msg","Added Successfully.");
				$flash->add("notification_type","success");
				return true;
			}else{
				throw new Exception("Somthng Went Wrong try again later.");
			}
			
		}catch(Exception $E){
			//echo $E->getMessage();exit;
			$db->trans_rollback();
			$flash->add('notification_msg', $E->getMessage());
			$flash->add('notification_type', 'error');
			return false;
			//redirect(site_url('restaurant/categories/view/' )); 			  	 
			
		}
		
	}

	function delete_album($id){
		$flash = new \FlashMessage();
		$db = new dbQuery();
		$condition = array('id' => $id);

		$result=$db->delete_where("albums",$condition);
		if($result){
			$flash->add("notification_msg","Deleted Successfully.");
			$flash->add("notification_type","success");
			return true;
		}else{
			$flash->add('notification_msg', 'Somthng Went Wrong try again later.');
			$flash->add('notification_type', 'error');
			return false;
		}
	}


?>