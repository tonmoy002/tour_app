<?php 
 namespace userlib;
 session_start();
 include('mysqlib/ActiveRecord.php');
 include('flash.php');
 use mysqlib\ActiveRecord as dbQuery;

 

	/**
	* ---- User Login Class ----
	*
	* @author_url : 
	*/
	class User {

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
		    $this->table = 'user';
		    $this->flash = new \FlashMessage();
		    
		}


		/**
		* This is construct method which set up database configaration
		*
		* @param 
		* @return 
		* @author Tonmoy Deb
		* @version 2020-04-25
		*/
	
		function login($username,$pass){
			$pass = $this->db->encrypt_password($pass,"md5");

			$this->db->select("*");
			$this->db->where("user_name",$username);
			$this->db->where("user_pass",$pass);

			$res = $this->db->get($this->table);
			$result = $res->result_array();
			if($result){
				return $this->create_login_session($result);
			}else{
				return $this->create_error_message('Wrong UserName/Password.');
			}
			
			

		}
		function error_message_genrate(){
			// echo "<pre>";
			// print_r($_SESSION);
			$nmsg=$this->flash->render('notification_msg');
			$ntype=$this->flash->render('notification_type');
			$str = "";
			if($nmsg){
				$str .= '<div class="notificaton-msg msg-'.$ntype.'" style="top:20px;">';
    			$str .= '<span class="close-not">x</span>';
			    $str .= $nmsg;
				$str .= '</div>';
			}
			echo $str;
		}


		function create_login_session($result){
			
			$_SESSION['logged_in_admin'] = true;
			$_SESSION['adminid'] = $result[0]['user_id'];
			$_SESSION['adminname'] = $result[0]['user_name'];
			$this->flash->add("notification_msg","Logged in Successfully");
			$this->flash->add("notification_type","success");
			return true;
		}
		function create_error_message($msg){
			$this->flash->add("notification_msg",$msg);
			$this->flash->add("notification_type","error");
			return false;
		}

		function logout(){
			unset($_SESSION['logged_in_admin']);
			unset($_SESSION['adminid']);
			unset($_SESSION['adminname']);
			unset($_SESSION['tour_id']);
			return true;
		}

		function get_username(){
			return $_SESSION['adminname'];
		}

		function logged_in($type = true)
		{
			if($type == true){
				if (!isset($_SESSION['logged_in_admin']) || $_SESSION['logged_in_admin']==false) {
					$this->flash->add("notification_msg","You Are Not Loggedin.");
					$this->flash->add("notification_type","error");
					return false;
				}else{
					return true;
				}
			}else{
				if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin']==true) {
				
					$this->flash->add("notification_msg","You Are already Loggedin.");
					$this->flash->add("notification_type","success");
					return false;
				}else{
					return true;
				}
			}
			
		}



	}