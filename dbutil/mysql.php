<?php
    /**
    * 1���������ݿ�
    *2��ѡ����Ҫ�����Ŀ�
    *3�����ò����ı���
    *4����ӡ��޸ġ�ɾ������ѯ
    * ��ѯ�����������
    *A����ѯһ�����
    *B����ѯ��������
    *5���ر�mysql�����ӣ���ʡϵͳ��Դ
    */
    class mysql{
        public $hostname;
        public $username;
        public $password;
        public $conn;
        public $dbname;
        public $charset;

        function __construct($hostname, $username, $password, $dbname, $charset){
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
            $this->charset = $charset;        
            //����mysql���ݿ�
         $this->conn = mysql_connect($this->hostname ,$this->username,$this->password)or die("���ݿ�����ʧ��");

            //ѡ����������ݿ�
        mysql_select_db($this->dbname, $this->conn);

            //���ò����ı���
        $this->query("set names '".$this->charset."'", $this->conn);
        }

        //ִ��sql���ķ���
     function query($sql){
//echo $sql;
            return mysql_query($sql, $this->conn);
        }

        //��Ӽ�¼
      function add($table, $set){
             $sql = "insert into {$table} set {$set}";
             return   $this->query($sql);
      }

        //�޸ļ�¼
        function edit($table, $set, $where){
            $sql = "update {$table} set {$set} where {$where}";
            return $this->query($sql);
        }
		
        //ɾ����¼
        function del($table, $where){
            $sql = "delete from {$table} where {$where}";
            return $this->query($sql);
        }

        //��ѯһ����¼
        function find($table, $where="", $fields="*", $order="", $limit=""){
            $where = empty($where) ?"": " where ".$where;
            $order = empty($order)? "" :  " order by" .$order;
            $limit= empty($limit)? "" :  " limit " .$limit;
            $sql = "select {$fields} from {$table}  {$where}  {$order} {$limit}";
            $query = $this->query($sql);
            return mysql_fetch_assoc($query);
         }

         //��ѯ������¼
      function findMore($table, $where="", $fields="*", $group="", $order="", $limit=""){
            $where = empty($where) ?"": " where ".$where;
            $group= empty($group) ? "" :  " group by ".$group;
            $order = empty($order)? "" :  " order by ".$order." desc ";
            $limit= empty($limit)? "" :  " limit " .$limit;
            $sql = "select {$fields} from {$table}  {$where} {$group} {$order} {$limit}";
            $query = $this->query($sql);
            $result = array();
            while($rs = $this->assoc($query)){
                //��$rs��ֵ��ӵ�$result������ȥ
                $result[] = $rs;
            }
            return $result;
         }

        function assoc($query){
            return mysql_fetch_assoc($query);
        }

        //������Դ
     function __destruct(){
            mysql_close($this->conn);
        }
    }
?>