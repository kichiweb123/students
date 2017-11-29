
<?php
class ConnectDb{

    public $connect;

    function __construct(){
        $ini = parse_ini_file('cfg.ini');

         $this->connect = new mysqli($ini['addr'], $ini['login'], $ini['pass'], $ini['database']);
         $err = $this->connect->connect_error;
         $err = mb_convert_encoding($err, 'UTF-8', 'cp1251');

         if($this->connect->connect_error){
            throw new Exception('Невозможно подключиться к БД:'.$err);
            
         }
         return $this->connect;
    }
}
?>