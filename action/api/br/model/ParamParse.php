<?php
    require_once("../utils/HeaderKey.php");
    
    class ParamParse{
        function __construct(){
        }
        
        function checkUserParameter($header){
        	//if(!isset($header[constant('header_id')])){
        	//	return -10000;//api not set
        	//}
            if(!isset($header[constant('header_api')])){
                return -10010;//api not set
            }
            if(!isset($header[constant('header_sid')])){
                return  -10020;//sid not set
            }
            if(!isset($header[constant('header_sign')])){
                return  -10030;//sign not set
            }
            if(!isset($header[constant('header_v')])){
                return  -10040;//v not set
            }
            if(!isset($header[constant('header_av')])){
                return  -10050;//av not set
            }
            if(!isset($header[constant('header_t')])){
                return  -10060;//t not set
            }
            return 1;
        }
        
        function __destruct(){
        }
    }
?>