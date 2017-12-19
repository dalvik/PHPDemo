<?php
    /**
    *1���������ݿ�
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
		public $dbport;
        public $charset;

        function __construct($hostname, $username, $password, $dbname, $dbport, $charset){
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
			$this->dbport = $dbport;
            $this->charset = $charset;        
            //����mysql���ݿ�
         $this->conn = mysqli_connect($this->hostname ,$this->username,$this->password, $this->dbname, $this->dbport)or die("���ݿ�����ʧ��");
	        //echo "---".$this->getMySqlError();
            //ѡ����������ݿ�
        mysqli_select_db($this->conn, $this->dbname);

            //���ò����ı���
        $this->query("set names '".$this->charset."'", $this->conn);
        }

        //ִ��sql���ķ���
        function query($sql){
            return mysqli_query($this->conn, $sql);
        }

        //��Ӽ�¼
        function add($table, $set){
             $sql = "insert into {$table} set {$set}";
			 //echo $sql;
             return $this->query($sql);
      }

        //�޸ļ�¼
        function edit($table, $set, $where){
            $sql = "update {$table} set {$set} where {$where}";
			//echo $sql;
            return $this->query($sql);
        }
		
        //ɾ����¼
        function del($table, $where){
            $sql = "delete from {$table} where {$where}";
            return $this->query($sql);
        }

        //��ѯһ����¼
        function find($table, $where="", $fields="*", $order="", $limit=""){
            $where = empty($where) ? "": " where ".$where;
            $order = empty($order)? "" :  " order by" .$order;
            $limit= empty($limit)? "" :  " limit " .$limit;
            $sql = "select {$fields} from {$table}  {$where}  {$order} {$limit}";
            $result = $this->query($sql);
			if($result === FALSE){
				return NULL;
			} else {
				return $this->assoc($result);
			}
         }

         //��ѯ������¼
      function findMore($table, $where="", $fields="*", $group="", $order="", $limit=""){
            $where = empty($where) ?"": " where ".$where;
            $group= empty($group) ? "" :  " group by ".$group;
            $order = empty($order)? "" :  " order by ".$order." desc ";
            $limit= empty($limit)? "" :  " limit " .$limit;
            $sql = "select {$fields} from {$table}  {$where} {$group} {$order} {$limit}";
			//echo "---->".$sql;
            $query = $this->query($sql);
			if($query === FALSE){
				return NULL;
			} else {
				$result = array();
				while($rs = $this->assoc($query)){
					//��$rs��ֵ��ӵ�$result������ȥ
					$result[] = $rs;
				}
				return $result;
			}
         }

        function assoc($query){
            return mysqli_fetch_assoc($query);
        }

        function getInsertId(){
        	return mysqli_insert_id($this->conn);
        	//return ($id=mysql_insert_id($this->conn))>=0 ? $id : $this->query("select last_insert_id();");
        }
        
        function getMySqlError(){
            return mysqli_error($this->conn);
        }
        
        //������Դ
		function __destruct(){
            if($this->conn != NULL) {
				mysqli_close($this->conn);
			}
        }
    }
?>