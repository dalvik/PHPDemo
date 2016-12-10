<?php
	include "dbutil/mysqlinfo.php";
	include "dbutil/mysql.php";
	
	if(isset($_POST['uuid'])){
		$web_root = "http://".$_SERVER['HTTP_HOST'];
		$php_self = $_SERVER['PHP_SELF'];
		$self_path = substr($php_self, 0, strrpos($php_self, '/') + 1);
		$uuid = $_POST['uuid'];
		$year = date("Y");
		$month = date("m");
		$base_path ="upload/".$uuid.'/'.$year.'/'.$month.'/';// upload/uuid/year/month
		create_dirs($base_path);
		$target_path = $base_path.$_FILES['file']['name'];
		$code = $_FILES['file']['error'];
		$url = $web_root.$self_path.$target_path;
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
			$launch_mod = 3;
			if(isset($_POST['mode'])){
				$launch_mod = $_POST['mode'];
			}
			$TABLE_FILE_LIST="cloud_user_file_list";
			/**
			* connect mysql
			*/
			$db = new mysql($hostname, $username, $password, $dbname, $charset);
			$upload_ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$set = "uuid='".$uuid."', launch_mod='".$launch_mod."', upload_time='".time()."', user_agent='".$user_agent."', upload_ip ='".$upload_ip."', path='".$url."'";
			// add file upload record
			$db->add($TABLE_FILE_LIST, $set);
			$array = array("code"=>$code, "path"=>$url);
			echo json_encode($array);
		} else {
			$array = array("code"=>$code, "path"=>$url);
			echo json_encode($array);
		}
	} else {
		$array = array("code"=>"-1", "path"=>"unset uuid");
		echo json_encode($array);
	}
	
	function create_dirs($dir){
		return is_dir($dir) or (create_dirs(dirname($dir)) and mkdir($dir, 0777));
	}
?>