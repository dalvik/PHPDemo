<?php
    require_once("../../dbutil/mysql.php");
    require_once("../../dbutil/mysqlinfo.php");
    require_once("../utils/UserColumn.php");
    require_once("../utils/ErrorCode.php");
    require_once("../utils/HeaderKey.php");
    
    class BaseManager{
        
        private $hostname;
        private $username;
        private $password;
        private $dbname;
        private $charset;
        
        function __construct(){
            $hostname = $this->get('hostname');
            $username = $this->get('username');
            $password = $this->get('dbpassword');
            $dbname = $this->get('dbname');
            $charset = $this->get('charset');
        }
        
        function initMysql(){
            return new mysql($this->get('hostname'), $this->get('username'), $this->get('dbpassword'), $this->get('dbname'), $this->get('charset'));
        }
        
        function get($name){
            return constant($name);
        }
        
        function __destruct(){
        }
    }