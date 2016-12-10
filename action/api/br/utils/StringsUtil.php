<?php
    class StringsUtil{
        function __construct(){
        }
        
        /**
        * 生成num位数的激活码算法
        * showunique_rand(10000000,99999999,1);
        * @return 98688211
        */
        function showunique_rand($min, $max, $num=1) {
            $count = 0;
            $return = array();
            while ($count < $num) {
                $return[] = mt_rand($min, $max);
                $return = array_flip(array_flip($return));
                $count = count($return);
            }
            return $return[0];
        }
        
        /**
         * 生成永远唯一的激活码
         * @return string {8D6D7CD8-53D2-FE63-DC80-B08EA91F73D2}
         */
        function create_guid($namespace = null) {
            static $guid = '';
            $uid = uniqid ( "", true );
            
            $data = $namespace;
            $data .= $_SERVER ['REQUEST_TIME']; 	// 请求那一刻的时间戳
            $data .= $_SERVER ['HTTP_USER_AGENT']; 	// 获取访问者在用什么操作系统
            $data .= $_SERVER ['SERVER_ADDR']; 		// 服务器IP
            $data .= $_SERVER ['SERVER_PORT']; 		// 端口号
            $data .= $_SERVER ['REMOTE_ADDR']; 		// 远程IP
            $data .= $_SERVER ['REMOTE_PORT']; 		// 端口信息
            
            $hash = strtoupper ( hash ( 'ripemd128', $uid . $guid . md5 ( $data ) ) );
            $guid = '{' . substr ( $hash, 0, 8 ) . '-' . substr ( $hash, 8, 4 ) . '-' . substr ( $hash, 12, 4 ) . '-' . substr ( $hash, 16, 4 ) . '-' . substr ( $hash, 20, 12 ) . '}';
            
            return $guid;
        }

        function __destruct(){
        }
    }
?>