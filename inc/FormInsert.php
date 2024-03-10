<?php 
 namespace userlib;
 session_start();
 include('mysqlib/ActiveRecord.php');
 use mysqlib\ActiveRecord as dbQuery;

 

	/**
	* ---- Insert Class ----
	*
	* @author_url : 
	*/
	class FormInsert {
		public $db;


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
		    
		}

		function file_upload($files,$type = 'image'){
			if($type == 'image'){

			}
		}
		function image_upload(){
			

		}
	}