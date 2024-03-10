<?php 
	namespace mysqlib;
	use Database;
	include "config.php";

	/**
	* ---- Mysqlib ----
	* This Class is for Short Mysqli Query. Using This library row php coding for database query will be 
	* much faster. You can just call this class and its methods for writing big query ins small way and
	* oriented way.
	* @version 1.0.1
	* @author Tonmoy Deb
	* @author_url : 
	*/
	class ActiveRecord {
		
		public  $db;
		private $table;
		private $select="";
		private $limit="";
		private $group="";
		private $variable_type="";
		private $variable_name="";
		private $select_avg="";
		private $select_max="";
		private $select_min="";
		private $select_sum="";
		private $between="";
		private $password_hash="";
		private $result="";
		private $like=array();
		private $or_like=array();
		private $not_like=array();
		private $or_not_like=array();
		private $where=array();
		private $where_in=array();
		private $where_not_in=array();
		private $or_where=array();
		private $order_by=array();
		private $join=array();


		/**
		* This is construct method which set up database configaration
		*
		* @param 
		* @return 
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
		function __construct() {

		    $this->db = new Database();

		}


		/**
		* This function is for beginTransaction
		*
		* @param  
		* @return If Success then return 
		* @author Tonmoy Deb
		* @version 2020-04-26
		*/
		function trans_begin()
		{
			return $this->db->trans_begin();
		}

		/**
		* This function is for Transaction Commit
		*
		* @param  
		* @return If Success then return 
		* @author Tonmoy Deb
		* @version 2020-04-26
		*/
		function trans_commit()
		{
			return $this->db->trans_commit();
		}

		/**
		* This function is for Transaction Rollback
		*
		* @param  
		* @return If Success then return 
		* @author Tonmoy Deb
		* @version 2020-04-26
		*/
		function trans_rollback()
		{
			return $this->db->trans_rollback();
		}
		

		/**
		* This function is for count all data
		*
		* @param String, Name Of Table 
		* @return If Success then return array, Number of total row, else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
		function count_all($table_name="")
		{
	       	$sql = "SELECT * FROM $table_name";
	       	$result = $this->db->query($sql);
	       	if($result->num_rows > 0)
	       	{
		       	return $result->num_rows;
	        }
	        else
	        {
	        	return FALSE;
	        }
		}


		/**
		* This function is for empty a table
		*
		* @param String, Name Of Table
		* @return If Success then return TRUE, else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
		function empty_table($table_name="")
		{
	       	$sql = "DELETE FROM $table_name";
	       	$result = $this->db->query($sql);
	       	if($result === TRUE)
	       	{
		    	return TRUE;
	        }
	        else
	        {
	        	return FALSE;
	        }
		}


		/**
		* This function is for truncate a table as same as empty table
		*
		* @param String, Name Of Table
		* @return If Success then return TRUE, else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
		function truncate_table($table_name="")
		{
	       	$sql = "TRUNCATE TABLE $table_name";
	       	$result = $this->db->query($sql);
	       	if($result === TRUE)
	       	{
		    	return TRUE;
	        }
	        else
	        {
	        	return FALSE;
	        }
		}


		/**
		* This function is for drop a table 
		*
		* @param String, Name Of Table
		* @return If Success then return TRUE, else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
		function drop_table($table_name="")
		{
	       	$sql = "DROP TABLE $table_name";
	       	$result = $this->db->query($sql);
	       	if($result === TRUE)
	       	{
		    	return TRUE;
	        }
	        else
	        {
	        	return FALSE;
	        }
		}


		/**
		* This function is for encrypt password
		*
		* @param password(string)
		* @param type(string) md5/hash
		* @param options(array) array('cost' => 11,'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM))
    	* @return If Success then return encrypted password
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function encrypt_password($password="",$type="md5",$options = array())
   		{
   			
   			if($type=='md5'){
   				$password_hash=md5($password);
   			}
   			else
   			{
   				if(count($options)>0)
   				{
   					$password_hash=password_hash($password, PASSWORD_BCRYPT, $options);
   				}
   				else
   				{
   					$password_hash=password_hash($password, PASSWORD_DEFAULT);
   				}
   				
   			}
   			
   			return $this->password_hash = $password_hash;
   		}


		/**
		* This function is for Verify password
		*
		* @param password(string)
		* @param hash(string) is the enncrypted password
    	* @return If Success then return true / false
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function verify_password($password="",$hash="")
   		{
   			
   			if (password_verify($password, $hash)) {
   			    return TRUE;
   			} else {
   			    return FALSE;
   			}
   		}


   		/**
   		* This function is for Converted Date
   		*
   		* @param Date (Date)
   		* @return If Success then return converted date
   		* @author Tonmoy Deb
   		* @version 2018-03-28
   		*/
   		function date_convert($date=""){
   			return date( 'M d, Y h:i a',strtotime($date));
   		}
	    


	    /**
		* This function is single where condition
		*
		* @param only two paramiter support 1) table field(string) 2) value(string) . (Array Does Not Support)
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function where($field="",$value="")
   		{
   			$field_condition = explode(" ", $field);
   			if(empty($field_condition[1]))
   			{
   				$field_condition[1] = " = ";
   			}
   			else
   			{
   				$field_condition[1] = $field_condition[1];
   			}
   			$this->where[] = $field_condition[0]." ".$field_condition[1]." '".$value."'";
   		}



   		/**
		* This function is single OR where condition
		*
		* @param $feild(string)  this is the string of table feilds 
		* @param $value(string) this is the value of table feild
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function or_where($field="",$value="")
   		{
   			$field_condition = explode(" ", $field);
   			if(empty($field_condition[1]))
   			{
   				$field_condition[1] = " = ";
   			}
   			else
   			{
   				$field_condition[1] = $field_condition[1];
   			}
   			$this->or_where[] = $field_condition[0]." ".$field_condition[1]." '".$value."'";
   		}



   		/**
		* This function is WHERE IN condition
		*
		* @param $feild(string)  this is the string of table feilds 
		* @param $value(string) this is the value of table feild
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function where_in($field_name="",$value="")
   		{

   			$final_value = implode("','", $value);
   			$this->where_in[] = $field_name. " IN ('".$final_value."')";
   		}



   		/**
		* This function is WHERE NOT IN condition
		*
		* @param $feild(string)  this is the string of table feilds 
		* @param $value(string) this is the value of table feild
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function where_not_in($field_name="",$value="")
   		{
   			$final_value = implode("','", $value);
   			$this->where_not_in[] = $field_name. " NOT IN ('".$final_value."')";
   		}


   		/**
		* This function is for Select which table
		*
		* @param $table(string) Name of Table
		* @return If Success then return table name(string)
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function from($table=""){
   			$this->table=$table;
   		}


		/**
		* This function is sql for between condition
		*
		* @param $feild(string)  this is the string of table feilds 
		* @param $para1(int) this is the starting value 
		* @param $para2(int) this is the ending value 
		* @return If Success then return a string
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function between($field,$para1,$para2){
   			$this->between=$field." BETWEEN ".$para1." AND ".$para2;
   		}



   		/**
		* This function is for sql like condition also AND condition
		*
		* @param $feild(string)  this is the string of table feilds 
		* @param $value(string) this is the value of table feild
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function like($feild="",$value=""){
   			$this->like[]=$feild." LIKE '%".$value."%'";
   		}



		/**
		* This function is for sql or_like condition also OR Condition
		*
		* @param only two paramiter support 1) table field(string) 2) value(string) . (Array Does Not Support)
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function or_like($feild="",$value=""){
   			$this->or_like[]=$feild." LIKE '%".$value."%'";
   		}



		/**
		* This function is for sql NOT LIKE condition
		*
		* @param only two paramiter support 1) table field(string) 2) value(string) . (Array Does Not Support)
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function not_like($field="",$value="")
   		{
   			$this->not_like[]=$field." NOT LIKE '%".$value."%'";
   		}


		/**
		* This function is for sql OR NOT LIKE condition
		*
		* @param only two paramiter support 1) table field(string) 2) value(string) . (Array Does Not Support)
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function or_not_like($field="",$value="")
   		{
   			$this->or_not_like[]=$field." NOT LIKE '%".$value."%'";
   		}


   		/**
		* This function is for mysqli avg
		*
		* @param $feild(string)  this is the string of table feilds 
		* @return If Success then return an string
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function select_avg($feild=""){
   			$this->select_avg="AVG(".$feild.") as avg";
   		}


   		/**
		* This function is for mysqli max
		*
		* @param $feild(string)  this is the string of table feilds 
		* @return If Success then return an string
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function select_max($feild=""){
   			$this->select_max="MAX(".$feild.") as max";
   		}


   		/**
		* This function is for mysqli min
		*
		* @param $feild(string)  this is the string of table feilds 
		* @return If Success then return an string
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function select_min($feild=""){
   			$this->select_min="MIN(".$feild.") as min";
   		}


   		/**
		* This function is for mysqli sum
		* 
		* @param $feild(string)  this is the string of table feilds 
		* @return If Success then return an string
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function select_sum($feild=""){
   			$this->select_sum="SUM(".$feild.") as sum";
   		}


   		/**
		* This function is for Joining one or multiple table
		*
		* @param $join_table_name(string)  table for join 
		* @param $join_tble_field(string) this is the value of table feild
		* @param $join_type(string) join type inner/left/right
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function join($join_table_name="",$join_table_field="",$join_type="",$dis_table_feild=""){
   			if($dis_table_feild===""){
   				$dis_table_feild=$join_table_field;
   			}
   			$this->join[]= $join_type." JOIN ".$join_table_name ." ON ".$dis_table_feild."=".$join_table_field;
   		}




		/**
		* This function is for sql ORDER BY condition
		*
		* @param only two paramiter support 1) table field(string) 2) value(string) . (Array Does Not Support)
		* @return If Success then return an array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function order_by($field="",$value="")
   		{
   			$this->order_by[] = $field." ".$value." ";
   		}

		

		/**
		* This function is for Select table field or default *
		*
		* @param Name of Table Field(string)
		* @return If Success then return selected field
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function select($field="")
   		{
   			$this->select = $field;
   		}



   		/**
		* This function is for limit
		*
		* @param number of limit(int)
		* @return If Success then return number of limit(int)
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function limit($limit="")
   		{
   			$this->limit = $limit;
   		}

   		/**
		* This function is for group
		*
		* @param number of group(string)
		* @return If Success then return number of group(string)
		* @author Tonmoy Deb
		* @version 2020-05-05
		*/
   		function group_by($group="")
   		{
   			$this->group = $group;
   		}


		/**
		* This function is for delete a table
		*
		* @param name of table(string)
		* @return If Success then return TRUE else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function delete($table_name="")
   		{

	    	$where = $this->where;
	    	$total_where = count($where);
	    	$where_str = "";
	    	if($total_where > 0)
	    	{
	    		for($j=0;$j<$total_where;$j++)
	    		{
	    			$where_str .= " AND ".$where[$j];
	    		}
	    	}


	    	$or_where = $this->or_where;
	    	$total_or_where = count($or_where);
	    	$or_where_str = "";
	    	if($total_or_where > 0)
	    	{
	    		for($k=0;$k<$total_or_where;$k++)
	    		{
	    			$or_where_str .= " OR ".$or_where[$k];
	    		}
	    	}

	    	$sql='DELETE FROM '.$table_name.' WHERE 1'.$where_str.' '.$or_where_str;

	    	$result = $this->db->query($sql);
	       	if($result === TRUE)
	       	{
		    	return TRUE;
	        }
	        else
	        {
	        	return FALSE;
	        }
	        $this->reset_data();
   		}


   		/**
		* This function is for delete a table
		*
		* @param Two parameter support 1)name of table(string) 2)condition(array) . CONDITION MUST BE ARRAY
		* @return If Success then return TRUE else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function delete_where($table_name="",$delete_attr="")
   		{

   			$where_str = "";
   			foreach ($delete_attr as $key => $value) {
   				$divide_key = explode(" ", $key);

   				if(empty($divide_key[1]))
   				{
   					$divide_key[1] = " = ";
   				}
   				else
   				{
   					$divide_key[1] = $divide_key[1];
   				}
   				$where_str .= " AND ".$divide_key[0]." ".$divide_key[1]." '".$value."'";


	   		}
	    	$sql='DELETE FROM '.$table_name.' WHERE 1 '.$where_str;
	    	$result = $this->db->query($sql);
	       	if($result === TRUE)
	       	{
		    	return TRUE;
	        }
	        else
	        {
	        	return FALSE;

	        }
	        $this->reset_data();
   		}



		/**
		* This function is for Get Table With Where Condition
		*
		* @param Two parameter support 1)name of table(string) 2)condition(array) . CONDITION MUST BE ARRAY
		* @return If Success then return array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function get_where($table_name="",$where_array=array())
   		{

	    	$like=$this->like;
	    	$tot_like=count($like);
	    	$like_str="";
	    	if($tot_like>0){
	    		for($i=0;$i<$tot_like;$i++){
	    			$like_str.=" AND ".$like[$i];
	    		}
	    	}


	    	$or_like = $this->or_like;
	    	$total_or_like = count($or_like);
	    	$or_like_str = "";
	    	if($total_or_like>0)
	    	{
	    		for($o_l=0;$o_l<$total_or_like;$o_l++)
		    	{
		    		$or_like_str .= " OR ".$or_like[$o_l];
		    	}
	    	}

	    	$not_like = $this->not_like;
	    	$total_not_like = count($not_like);
	    	$not_like_str = "";
	    	if($total_not_like>0)
	    	{
	    		for($n_l=0;$n_l<$total_not_like;$n_l++)
	    		{
	    			$not_like_str .= " AND ".$not_like[$n_l];
	    		}
	    	}

	    	$or_not_like = $this->or_not_like;
	    	$total_or_not_like = count($or_not_like);
	    	$or_not_like_str = "";
	    	if($total_or_not_like>0)
	    	{
	    		for($o_n_l=0;$o_n_l<$total_or_not_like;$o_n_l++)
	    		{
	    			$or_not_like_str .= " OR ".$or_not_like[$o_n_l];
	    		}
	    	}

	    	$order_by = $this->order_by;
	    	$total_order_by = count($order_by);
	    	$order_by_str = "";

	    	if($total_order_by>0)
	    	{
	    		for($o_by=0;$o_by<$total_order_by;$o_by++)
	    		{
	    			$order_by_str .= $order_by[$o_by].",";
	    		}
	    	}

	    	if($this->select == "")
	    	{
	    		$this->select = "*";
	    	}
	    	else
	    	{
	    		$this->select = $this->select;
	    	}

	    	if($this->group == "")
	    	{
	    		$this->group = "";
	    	}
	    	else
	    	{
	    		$this->group = "GROUP BY ".$this->group;
	    	}

	    	if($this->limit == "")
	    	{
	    		$this->limit = "";
	    	}
	    	else
	    	{
	    		$this->limit = "LIMIT ".$this->limit;
	    	}

	    	if($this->table == "")
	    	{
	    		$this->table = $table_name;
	    	}
	    	else
	    	{
	    		$this->table = $this->table;
	    	}

	    	if($order_by_str == "")
	    	{
	    		$order_by_str = "";
	    	}
	    	else
	    	{
	    		$order_by_str = substr_replace($order_by_str ,"",-1);
	    		$order_by_str = "ORDER BY ".$order_by_str;
	    	}

   			


   			$get_where_str = "";
   			foreach ($where_array as $key => $value) {
   				$divide_key = explode(" ", $key);

   				if(empty($divide_key[1]))
   				{
   					$divide_key[1] = " = ";
   				}
   				else
   				{
   					$divide_key[1] = $divide_key[1];
   				}
   				$get_where_str .= " AND ".$divide_key[0]." ".$divide_key[1]." '".$value."'";
   			}


	    	$sql='SELECT '.$this->select.' FROM '.$this->table.' WHERE 1'.$get_where_str.' '.$like_str.' '.$or_like_str.' '.$not_like_str.' '.$or_not_like_str.' '.$this->group.' '.$this->limit.' '.$order_by_str;

	    	$this->reset_data();

	    	$this->result=$this->db->query($sql);
	    	return $this;
  		
	    }



	    /**
		* This function is for get data of a table with/without limit
		*
		* @param Name Of Table(String)
		* @param limit (int) of the condition
		* @return If Success then return an array, else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
	    function get_table($table_name="",$limit="") {
	    	$str="";
	    	if($limit!==""){
	    		$str.=" LIMIT $limit";
	    	}
	    	if($this->select === "")
	    	{
	    		$this->select = "*";
	    	}
	       	$sql = "SELECT ".$this->select." FROM $table_name".$str;
	       	$result = $this->db->query($sql);
	       	$this->reset_data();
	       	$this->result=$this->db->query($sql);
	       	return $this;
	    }



	    /**
		* This function is for Get
		*
		* @param 
		* @return If Success then return Object
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   	    function get($table=""){
   	    	if($table!=""){
   	    		$this->table=$table;
   	    	}
   	    	$join=$this->join;
	    	$total_join=count($join);
	    	$join_str="";
	    	if($total_join>0){
	    		for($t_j=0;$t_j<$total_join;$t_j++){
	    			$join_str.=" ".$join[$t_j];
	    		}
	    	}

	    	$like=$this->like;
	    	$tot_like=count($like);
	    	$like_str="";
	    	if($tot_like>0){
	    		for($i=0;$i<$tot_like;$i++){
	    			$like_str.=" AND ".$like[$i];
	    		}
	    	}


	    	$or_like = $this->or_like;
	    	$total_or_like = count($or_like);
	    	$or_like_str = "";
	    	if($total_or_like>0)
	    	{
	    		for($o_l=0;$o_l<$total_or_like;$o_l++)
		    	{
		    		$or_like_str .= " OR ".$or_like[$o_l];
		    	}
	    	}

	    	$not_like = $this->not_like;
	    	$total_not_like = count($not_like);
	    	$not_like_str = "";
	    	if($total_not_like>0)
	    	{
	    		for($n_l=0;$n_l<$total_not_like;$n_l++)
	    		{
	    			$not_like_str .= " AND ".$not_like[$n_l];
	    		}
	    	}

	    	$or_not_like = $this->or_not_like;
	    	$total_or_not_like = count($or_not_like);
	    	$or_not_like_str = "";
	    	if($total_or_not_like>0)
	    	{
	    		for($o_n_l=0;$o_n_l<$total_or_not_like;$o_n_l++)
	    		{
	    			$or_not_like_str .= " OR ".$or_not_like[$o_n_l];
	    		}
	    	}

	    	$order_by = $this->order_by;
	    	$total_order_by = count($order_by);
	    	$order_by_str = "";

	    	if($total_order_by>0)
	    	{
	    		for($o_by=0;$o_by<$total_order_by;$o_by++)
	    		{
	    			$order_by_str .= $order_by[$o_by].",";
	    		}
	    	}

	    	$where = $this->where;
	    	$total_where = count($where);
	    	$where_str = "";
	    	if($total_where > 0)
	    	{
	    		for($j=0;$j<$total_where;$j++)
	    		{
	    			$where_str .= " AND ".$where[$j];
	    		}
	    	}


	    	$or_where = $this->or_where;
	    	$total_or_where = count($or_where);
	    	$or_where_str = "";
	    	if($total_or_where > 0)
	    	{
	    		for($k=0;$k<$total_or_where;$k++)
	    		{
	    			$or_where_str .= " OR ".$or_where[$k];
	    		}
	    	}


	    	$where_in = $this->where_in;
	    	$total_where_in = count($where_in);
	    	$where_in_str = "";
	    	if($total_where_in > 0)
	    	{
	    		for($m=0;$m<$total_where_in;$m++)
	    		{
	    			$where_in_str .= " AND ".$where_in[$m];
	    		}
	    	}

	    	$where_not_in = $this->where_not_in;
	    	$total_where_not_in = count($where_not_in);
	    	$where_not_in_str = "";
	    	if($total_where_not_in > 0)
	    	{
	    		for($n=0;$n<$total_where_not_in;$n++)
	    		{
	    			$where_not_in_str .= " AND ".$where_not_in[$n];
	    		}
	    	}



	    	if($this->select == "" AND $this->select_avg == "" AND $this->select_max == "" AND $this->select_min == "" AND $this->select_sum == "")
	    	{
	    		$this->select = "*";
	    	}
	    	else if(!empty($this->select))
	    	{
	    		$this->select = $this->select;
	    	}
	    	else if(!empty($this->select_avg))
	    	{
	    		$this->select = $this->select_avg;
	    	}
	    	else if(!empty($this->select_max))
	    	{
	    		$this->select = $this->select_max;
	    	}
	    	else if(!empty($this->select_min))
	    	{
	    		$this->select = $this->select_min;
	    	}
	    	else if(!empty($this->select_sum))
	    	{
	    		$this->select = $this->select_sum;
	    	}

	    	if($this->group == "")
	    	{
	    		$this->group = "";
	    	}
	    	else
	    	{
	    		$this->group = "GROUP BY ".$this->group;
	    	}

	    	if($this->limit == "")
	    	{
	    		$this->limit = "";
	    	}
	    	else
	    	{
	    		$this->limit = "LIMIT ".$this->limit;
	    	}


	    	if($this->between == "")
	    	{
	    		$this->between = "";
	    	}
	    	else
	    	{
	    		$this->between = "AND ".$this->between;
	    	}

	    	if($order_by_str == "")
	    	{
	    		$order_by_str = "";
	    	}
	    	else
	    	{
	    		$order_by_str = substr_replace($order_by_str ,"",-1);
	    		$order_by_str = "ORDER BY ".$order_by_str;
	    	}

	    	if($join_str == "")
	    	{
	    		$join_str = "";
	    	}
	    	else
	    	{
	    		$join_str = $join_str;
	    	}



	    	$sql='SELECT '.$this->select.' FROM '.$this->table.' '.$join_str.' WHERE 1'.$where_str.' '.$where_in_str.' '.$where_not_in_str.' '.$or_where_str.' '.$like_str.' '.$or_like_str.' '.$not_like_str.' '.' '.$or_not_like_str.' '.$this->group.' '.$order_by_str.' '.$this->between.' '.$this->limit;

	    	$this->reset_data();
	    	$this->result=$this->db->query($sql);

	    	return $this;

	    	
	    }



		/**
		* This function is for Get Result Object
		*
		* @param 
		* @return If Success then return Object
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
	    function result(){
	    	$res=array();
	    	$i=0;
	    	if($this->result->num_rows > 0)
	       	{
	       		while($row=$this->result->fetch_object()){
		       		$res[$i++]=$row;
		       	}
		       	return $res;
	        }
	        else
	        {
	        	return FALSE;
	        }
	    	
	    }



		/**
		* This function is for Get Result Array
		*
		* @param 
		* @return If Success then return Array
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
	    function result_array(){
	    	$res=array();
	    	$i=0;
	    	if($this->result->num_rows > 0)
	       	{
	    		while($row=$this->result->fetch_array()){
	    			$res[$i++]=$row;
	    		}
    			return $res;
    		}else{
    			return FALSE;
    		}
	    }



	    /**
		* This function is for Insert Data
		*
		* @param $table_name(string) name of table 
		* @param $attr(array) Data which should be added
		* @return If Success then return last insert id else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
	
	    function insert($table_name="",$attr=array())
	    {

	    	$key_str = "";
	    	$value_str = "";
   			foreach ($attr as $key => $value) {
   				$key_str .= $key.",";
   				$value_str .= "'".$value."',";
   			}
   			$key_str = substr_replace($key_str, "", -1);
   			$value_str = substr_replace($value_str, "", -1);
   			
	    	$sql = 'INSERT INTO '.$table_name.' ('.$key_str.') VALUES ('.$value_str.')';
	    	$result = $this->db->query($sql);
	       	if($result === TRUE)
	       	{
	       		$last_id = $this->db->insert_id();
		    	return $last_id;
	        }
	        else
	        {
	        	return FALSE;
	        }
	        $this->reset_data();

	    }



	    /**
		* This function is for Insert Multiple Data That means Insert Batch
		*
		* @param $table_name(string) name of table
		* @param $attr(array) Multiple Data which should be added
		* @return If Success then return TRUE else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
	    function insert_batch($table_name="",$attr="")
	    {
	    	$key_str = "";
	    	$value_str = "";
	    	$value_str2 = "";
	    	$value_str3 = "";
	    	$final_str = "";
	    	$count = count($attr);

	    	for($i_b=0;$i_b<$count;$i_b++)
	    	{
	    		foreach ($attr[$i_b] as $key => $value) {
	    			if($i_b<1)
	    			{
	    				$key_str .= $key.",";
	    			}
	   				
	   				$value_str .= "'".$value."',";
	   			}
				$value_str2 .= substr_replace($value_str, "", -1);
				$value_str = "";
	   			$value_str3 .= "(".$value_str2."),";
				$value_str2 = "";
	    	}

   			$key_str = substr_replace($key_str, "", -1);
   			$final_str = substr_replace($value_str3, "", -1);

	    	$sql = 'INSERT INTO '.$table_name.' ('.$key_str.') VALUES '.$final_str;
	    	$result = $this->db->query($sql);
	       	if($result === TRUE)
	       	{
	       		return TRUE;
	        }
	        else
	        {
	        	return FALSE;
	        }
	        $this->reset_data();

	    }



		/**
		* This function is for Update Data with condition
		*
		* @param $table_name(string) name of table
		* @param $attr(array) Data which should be updated
		* @return If Success then return TRUE else return FALSE
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
	    function update_where($table_name="",$attr="")
	    {
	    	$where = $this->where;
	    	$total_where = count($where);
	    	$where_str = "";
	    	if($total_where > 0)
	    	{
	    		for($j=0;$j<$total_where;$j++)
	    		{
	    			$where_str .= " AND ".$where[$j];
	    		}
	    	}


	    	$or_where = $this->or_where;
	    	$total_or_where = count($or_where);
	    	$or_where_str = "";
	    	if($total_or_where > 0)
	    	{
	    		for($k=0;$k<$total_or_where;$k++)
	    		{
	    			$or_where_str .= " OR ".$or_where[$k];
	    		}
	    	}

	    	$update_set_str = "";
   			foreach ($attr as $key => $value) {
   				$update_set_str .= $key." = '".$value."',";
   			}
   			$update_set_str = substr_replace($update_set_str, "", -1);
   			

	    	$sql = 'UPDATE '.$table_name.' SET '.$update_set_str.' WHERE 1'.$where_str.' '.$or_where_str;

	    	$result = $this->db->query($sql);
	    	$this->reset_data();
	       	if($result === TRUE)
	       	{
		    	return TRUE;
	        }
	        else
	        {
	        	return FALSE;
	        }
	        

	    }



		/**
		* This function is for Prepare sql 
		*
		* @param Name of Table(string) and Table field(string)
		* @return If Success then return string
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
   		function prepare_query($table_field=""){
   
   			$total_field_array = explode(",", $table_field);
   			$total_table_field = count($total_field_array);
   			$what_str = "";
   			for($t_t_f=0;$t_t_f<$total_table_field;$t_t_f++)
   			{
   				if($t_t_f>0){$what_str.= ", ";}
   				$what_str.= "? ";
   			}
   			$sql="INSERT INTO ".$this->table." (".$table_field.") VALUES (".$what_str.")";
   			return $stmt = $this->db->prepare($sql);
   		}


	    /**
		* This function is for Reset All Data
		*
		* @param 
		* @return 
		* @author Tonmoy Deb
		* @version 2018-03-28
		*/
	    function reset_data(){
	    	$this->between="";
	    	$this->group="";
	    	$this->limit="";
	    	$this->like=array();
	    	$this->or_like=array();
	    	$this->not_like=array();
	    	$this->or_not_like=array();
	    	$this->where=array();
	    	$this->where_in=array();
	    	$this->where_not_in=array();
	    	$this->or_where=array();
	    	$this->order_by=array();
	    	$this->join=array();
	    	$this->table="";
	    	$this->result="";
	    }

	}

?>