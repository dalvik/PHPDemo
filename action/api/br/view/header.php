<?php
include "../../dbutil/mysqlinfo.php";
include "../../dbutil/mysql.php";
include "../utils/StringsUtil.php";
include "../model/UserManager.php";

if(isset($_POST['userCode'])){
		$uuid = $_POST['userCode'];
		$base_path ="../"."upload/".$uuid.'/'."header/";// userCode/header/userCode.jpg
		create_dirs($base_path);
        $now = time();
        $name = $uuid."_".$now.".jpg";
		$target_path = $base_path.$name;
		$code = $_FILES['file']['error'];
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
			$rootPath = dirname(dirname($_SERVER['REQUEST_URI']));
			$realPath = $rootPath."/upload/".$uuid.'/'."header/".$name;
			$path = array("path"=>$realPath);
			$array = array("code"=>"200", "msg"=>"", "data"=>$path);
			echo json_encode($array);
		} else {
			$array = array("code"=>$code, "data"=>"move file failed.");
			echo json_encode($array);
		}
	} else {
		$array = array("code"=>"-1", "data"=>"parameter no correct.");
		echo json_encode($array);
	}
	
	function create_dirs($dir){
		return is_dir($dir) or (create_dirs(dirname($dir)) and mkdir($dir, 0777));
	}
?>