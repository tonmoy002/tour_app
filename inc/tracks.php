<?php
include 'fileupload.php';
use mysqlib\ActiveRecord as dbQuery;
$flash = new \FlashMessage();

	function get_tracks(){
		$db = new dbQuery();
		$db->select('track.id,
    track.title,
    albums.title AS album,
    GROUP_CONCAT(track_artists.artist_id SEPARATOR ",") artist_ids,
    GROUP_CONCAT(artists.name SEPARATOR ",") artist_names');
		$db->from("track");
		$db->join("albums","albums.id","LEFT","track.album_id");
		$db->join("track_artists","track_artists.track_id","LEFT","track.id");
		$db->join("artists","artists.id","LEFT","track_artists.artist_id");
		$db->group_by('track.id');
		$res=$db->get();
		$result = $res->result();
		return $result;

	}
	function get_track($id){
		$db = new dbQuery();
		$db->select('
			track.id,
		    track.title,
		    track.track_src,
		    track.album_id,
		    GROUP_CONCAT(track_artists.artist_id SEPARATOR ",") artist_ids,
		    GROUP_CONCAT(track_genres.genre_id SEPARATOR ",") genre_ids,
		    GROUP_CONCAT(track_tags.tag_id SEPARATOR ",") tag_ids
    ');
		$db->from("track");
		$db->join("track_artists","track_artists.track_id","LEFT","track.id");
		$db->join("track_genres","track_genres.track_id","LEFT","track.id");
		$db->join("track_tags","track_tags.track_id","LEFT","track.id");
		$db->where("track.id",$id);
		$res=$db->get();
		$result = $res->result();
		return $result;

	}
	function update_track($postedData,$id){
		$flash = new \FlashMessage();
		$db = new dbQuery();
		unset($postedData['update']);
		try{
				$db->trans_begin();
				
				if($_FILES["track"]["name"]!==""){
					$config = array(
						'max-size'=>25000000, 
						'allowed'=>"mp3"
					);
					$files = file_upload($_FILES,$config);
					// echo "<pre>";
					// print_r($files);
					// echo "</pre>";
					$postedData['track_src'] = $files['track'];
				}
				// echo "<pre>";
				// 	print_r($postedData);
				// 	echo "</pre>";
				$artist_ids = (isset($postedData['artist_id']) ? $postedData['artist_id'] : array());
				$genre_ids = (isset($postedData['genre_id']) ? $postedData['genre_id'] : array());
				$tags_ids = (isset($postedData['tags_id']) ? $postedData['tags_id'] : array()); 
				unset($postedData['artist_id']);
				unset($postedData['genre_id']);
				unset($postedData['tags_id']);

				

				// echo "<pre>";
				// 	print_r($postedData);
				// 	echo "</pre>";
				//	exit;
				$db->where("id",$id);
				if($db->update_where('track',$postedData)){
					insert_extra($artist_ids,$id,'artist_id','track_artists');
					insert_extra($genre_ids,$id,'genre_id','track_genres');
					insert_extra($tags_ids,$id,'tag_id','track_tags');
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

	function add_track($postedData){
		unset($postedData['save']);
		$flash = new \FlashMessage();
		$db = new dbQuery();
		try{
				$db->trans_begin();
				$postedData['track_src'] = '';
				if($_FILES["track"]["name"]!==""){
					$config = array(
						'max-size'=>25000000, 
						'allowed'=>"mp3"
					);
					$files = file_upload($_FILES,$config);
					// echo "<pre>";
					// print_r($files);
					// echo "</pre>";
					$postedData['track_src'] = $files['track'];
				}
				$artist_ids = (isset($postedData['artist_id']) ? $postedData['artist_id'] : array());
				$genre_ids = (isset($postedData['genre_id']) ? $postedData['genre_id'] : array());
				$tags_ids = (isset($postedData['tags_id']) ? $postedData['tags_id'] : array()); 
				unset($postedData['artist_id']);
				unset($postedData['genre_id']);
				unset($postedData['tags_id']);

				// echo "<pre>";
				// print_r($postedData);
				// echo "</pre>";
				// exit;
			$track_id = $db->insert('track',$postedData);
			if($track_id){
				insert_extra($artist_ids,$track_id,'artist_id','track_artists');
				insert_extra($genre_ids,$track_id,'genre_id','track_genres');
				insert_extra($tags_ids,$track_id,'tag_id','track_tags');
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

	function insert_extra($extra_ids,$track_id,$extra_feild,$extra_tbl){
		$db = new dbQuery();
		$already_in = array();
		$db->select("*");
		$db->where("track_id",$track_id);
		$db->from($extra_tbl);
		$res=$db->get();
		$result = $res->result();
		if($result){
			foreach ($result as $r) {
				$already_in[]=$r->$extra_feild;
			}
		}

		$to_add_arr=array_diff($extra_ids,$already_in);
		$to_remove_arr=array_diff($already_in,$extra_ids);
		

		// echo "<pre>";
		// 	print_r($to_add_arr);
		// 	echo "</pre>";

		// 	echo "<pre>";
		// 	print_r($to_remove_arr);
		// 	echo "</pre>";
			//exit;
		if(count($to_add_arr)>0){
			foreach ($to_add_arr as $to_add) {
				$insert_arr = array(
					'track_id' =>$track_id,
					$extra_feild =>$to_add
				);
				$extra_id = $db->insert($extra_tbl,$insert_arr);
				if($track_id == FALSE){
					throw new Exception("Extra Inserted Error.");
				}
			}
		}
		if(count($to_remove_arr)>0){
			foreach ($to_remove_arr as $to_remove) {
				$condition = array(
					'track_id' =>$track_id,
					$extra_feild => $to_remove,
				);
				$delete=$db->delete_where($extra_tbl,$condition);
				if($delete == FALSE){
					throw new Exception("Extra Deleted Error.");
				}
			}
		}
	}

	function delete_track($id){
		$flash = new \FlashMessage();
		$db = new dbQuery();
		$condition = array('id' => $id);

		$result=$db->delete_where("track",$condition);
		if($result){
			reset_track($id);
			$flash->add("notification_msg","Deleted Successfully.");
			$flash->add("notification_type","success");
			return true;
		}else{
			$flash->add('notification_msg', 'Somthng Went Wrong try again later.');
			$flash->add('notification_type', 'error');
			return false;
		}
	}

	function reset_track($id){
		$db = new dbQuery();
		$condition = array(
			'track_id' =>$id,
		);
		$delete=$db->delete_where('track_artists',$condition);
		$delete=$db->delete_where('track_genres',$condition);
		$delete=$db->delete_where('track_tags',$condition);

	}


	function get_albums(){
		$db = new dbQuery();
		$db->select("*");
		$res=$db->get('albums');
		$result = $res->result();
		return $result;

	}
	function get_artists(){
		$db = new dbQuery();
		$db->select("*");
		$res=$db->get('artists');
		$result = $res->result();
		return $result;

	}
	function get_genres(){
		$db = new dbQuery();
		$db->select("*");
		$res=$db->get('genre');
		$result = $res->result();
		return $result;

	}
	function get_tags(){
		$db = new dbQuery();
		$db->select("*");
		$res=$db->get('tags');
		$result = $res->result();
		return $result;

	}

?>