<?php
use mysqlib\ActiveRecord as dbQuery;
$flash = new \FlashMessage();

function get_tour_users($id){
	$db = new dbQuery();
	$db->select("t.id,t.user_id,u.name,u.phone");
	$db->from("tour_user t");
	$db->join("users u","u.id","left","t.user_id");
	$db->where("t.tour_id",$id);
	$res=$db->get();
	$result = $res->result();
	return $result;

}
function get_total_payed($id){

	$db = new dbQuery();
	$db->select_sum("tp.payed");
	$db->from("tour_user_pay tp");
	$db->where("tp.tu_id",$id);
	$res=$db->get();
	$result = $res->result();
	if(count($result)>0){
		return $result[0]->sum;
	}else{
		return 0;
	}
	//exit;
	//print_r($result);
	//return $id;
	
}
function get_tour_user($id){
	$db = new dbQuery();
	$db->select("t.id,t.tour_id,t.user_id,u.name,u.phone");
	$db->from("tour_user t");
	$db->join("users u","u.id","left","t.user_id");
	$db->where("t.id",$id);
	$res=$db->get();
	$result = $res->result();
	return $result;
}
function get_tour_user_payment($id){
	$db = new dbQuery();
	$db->select("*");
	$db->from("tour_user_pay");
	$db->where("tu_id",$id);
	$res=$db->get();
	$result = $res->result();
	return $result;
}
function get_tour_expenses($id){
	$db = new dbQuery();
	$db->select("*");
	$db->from("expense");
	$db->where("tour_id",$id);
	$res=$db->get();
	$result = $res->result();
	return $result;
}
function add_tour_user($postedData){
	unset($postedData['save']);
		$flash = new \FlashMessage();
		$db = new dbQuery();
		try{
				$db->trans_begin();
				
			if($db->insert('tour_user',$postedData)){
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
function delete_user_tour($id){
	$flash = new \FlashMessage();
		$db = new dbQuery();
		$condition = array('id' => $id);

		$result=$db->delete_where("tour_user",$condition);
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
function add_expense($postedData){
	unset($postedData['save']);
	$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	$postedData['added'] = $dt->format('Y-m-d h:i:s');
		$flash = new \FlashMessage();
		$db = new dbQuery();
		try{
				$db->trans_begin();
				
			if($db->insert('expense',$postedData)){
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
function get_total_expense($id){
	$db = new dbQuery();
	$db->select_sum("amount");
	$db->from("expense");
	$db->where("tour_id",$id);
	$res=$db->get();
	$result = $res->result();
	if(count($result)>0){
		return $result[0]->sum;
	}else{
		return 0;
	}
}
function delete_expense($id){
	$flash = new \FlashMessage();
		$db = new dbQuery();
		$condition = array('id' => $id);

		$result=$db->delete_where("expense",$condition);
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
function delete_payment($id){
	$flash = new \FlashMessage();
		$db = new dbQuery();
		$condition = array('id' => $id);

		$result=$db->delete_where("tour_user_pay",$condition);
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
function update_tour_user($postedData){
	$flash = new \FlashMessage();
	$db = new dbQuery();
	unset($postedData['update']);
	$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	$postedData['added'] = $dt->format('Y-m-d h:i:s');

	try{
			$db->trans_begin();
			
			if($db->insert('tour_user_pay',$postedData)){
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