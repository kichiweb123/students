
<?php
class ConnectDb{
    public $db_address;
    public $db_login;
    public $db_pass;
    public $db_name;
    public $connect;

    function __construct(){
        $ini = parse_ini_file('cfg.ini');
        $this->db_address = $ini['addr'];
        $this->db_login = $ini['login'];
        $this->db_pass = $ini['pass'];
        $this->db_name = $ini['database'];
         $this->connect = new mysqli($this->db_address, $this->db_login, $this->db_pass, $this->db_name);
         $err = $this->connect->connect_error;
         $err = mb_convert_encoding($err, 'UTF-8', 'cp1251');

         if($this->connect->connect_error){
            throw new Exception('Невозможно подключиться к БД:'.$err);
            
         }
         return $this->connect;
    }
}
?>