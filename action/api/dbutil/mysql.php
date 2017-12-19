<?php
    /**
    *1、连接数据库
    *2、选择需要操作的库
    *3、设置操作的编码
    *4、添加、修改、删除、查询
    * 查询分两种情况：
    *A、查询一条语句
    *B、查询多条数据
    *5、关闭mysql的连接，节省系统资源
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
            //连接mysql数据库
         $this->conn = mysqli_connect($this->hostname ,$this->username,$this->password, $this->dbname, $this->dbport)or die("数据库连接失败");
	        //echo "---".$this->getMySqlError();
            //选择操作的数据库
        mysqli_select_db($this->conn, $this->dbname);

            //设置操作的编码
        $this->query("set names '".$this->charset."'", $this->conn);
        }

        //执行sql语句的方法
        function query($sql){
            return mysqli_query($this->conn, $sql);
        }

        //添加记录
        function add($table, $set){
             $sql = "insert into {$table} set {$set}";
			 //echo $sql;
             return $this->query($sql);
      }

        //修改记录
        function edit($table, $set, $where){
            $sql = "update {$table} set {$set} where {$where}";
			//echo $sql;
            return $this->query($sql);
        }
		
        //删除记录
        function del($table, $where){
            $sql = "delete from {$table} where {$where}";
            return $this->query($sql);
        }

        //查询一条记录
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

         //查询多条记录
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
					//将$rs的值添加到$result数组中去
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
        
        //回收资源
		function __destruct(){
            if($this->conn != NULL) {
				mysqli_close($this->conn);
			}
        }
    }
?>