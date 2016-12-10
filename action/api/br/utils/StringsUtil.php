<?php
    class StringsUtil{
        function __construct(){
        }
        
        /**
        * ����numλ���ļ������㷨
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
         * ������ԶΨһ�ļ�����
         * @return string {8D6D7CD8-53D2-FE63-DC80-B08EA91F73D2}
         */
        function create_guid($namespace = null) {
            static $guid = '';
            $uid = uniqid ( "", true );
            
            $data = $namespace;
            $data .= $_SERVER ['REQUEST_TIME']; 	// ������һ�̵�ʱ���
            $data .= $_SERVER ['HTTP_USER_AGENT']; 	// ��ȡ����������ʲô����ϵͳ
            $data .= $_SERVER ['SERVER_ADDR']; 		// ������IP
            $data .= $_SERVER ['SERVER_PORT']; 		// �˿ں�
            $data .= $_SERVER ['REMOTE_ADDR']; 		// Զ��IP
            $data .= $_SERVER ['REMOTE_PORT']; 		// �˿���Ϣ
            
            $hash = strtoupper ( hash ( 'ripemd128', $uid . $guid . md5 ( $data ) ) );
            $guid = '{' . substr ( $hash, 0, 8 ) . '-' . substr ( $hash, 8, 4 ) . '-' . substr ( $hash, 12, 4 ) . '-' . substr ( $hash, 16, 4 ) . '-' . substr ( $hash, 20, 12 ) . '}';
            
            return $guid;
        }

        function __destruct(){
        }
    }
?>