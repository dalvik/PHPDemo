<?php
	function create_unique(){
		$data = $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].ime.rand();
		return sha1($data);
	}
?>