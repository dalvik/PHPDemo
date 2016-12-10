<?php
abstract class db{
    abstract function __construct($hostname,$username,$password,$dbname,$charset);
    abstract function query($sql);
    abstract function assoc($query);
}

class mysql extends db{
    function __construct(){
        echo "";
    }

    function query($sql){
    }
    
    function assoc(){
        
    }
}
?>