
<?php


/*Класс нужен для соединия с БД, добавление, обновления, получения, поиска по БД*/
class TableStudentsGateway{

   

    public $db = null;
    

    function __construct(ConnectDb $connect){
       
        $this->db = $connect;

    }

    function addStudent(array $data){
            $sql = "INSERT INTO data(login, password_hash, name, second_name, class, email, score, birth_year, localy, sex)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $parameters = array();
            $parameters['error_prepare'] = 'Ошибка в запросе при добавлении студента:';
            $parameters['error_param'] = 'Ошибка в задании параметров при добавлении студента:';
            $parameters['error_run'] = 'Ошибка при исполнении добавления студента:';
            
            $parameters['bind_param'] = array();
            $type = 'ssssssssss';
            $parameters['bind_param']['type'] = &$type;
            $parameters['bind_param']['login'] = &$data['login'];
            $parameters['bind_param']['hash'] = &$data['hash'];
            $parameters['bind_param']['name'] = &$data['name'];
            $parameters['bind_param']['sname'] = &$data['sname'];
            $parameters['bind_param']['class'] = &$data['class'];
            $parameters['bind_param']['email'] = &$data['email'];
            $parameters['bind_param']['score'] = &$data['score'];
            $parameters['bind_param']['age'] = &$data['age'];
            $parameters['bind_param']['local'] = &$data['local'];
            $parameters['bind_param']['sex'] = &$data['sex'];
            $stmt = $this->executeQuery($sql, $parameters);
         
    }
    function executeQuery($sql, array $parameters, $enable_param = true){
        $stmt = $this->db->connect->prepare($sql);
        if(!$stmt){
            throw new Exception($parameters['error_prepare'].$this->db->connect->error);
        }
       
        if(!$enable_param){
            $param = 1;
        }else{
            $param = call_user_func_array(array($stmt, "bind_param"), $parameters['bind_param']);
        }
        $run = $stmt->execute();
        if(!$param){
            throw new Exception($parameters['error_param'].$this->db->connect->error);
        }
        if(!$run){
            throw new Exception($parameters['error_run'].$this->db->connect->error);
        }
        return $stmt;
    }
    function getStudent($offset, $perPage, $sort = ''){

        $start = $perPage*$offset;

        if($sort){
            $order = $sort;
        }else{
            $order = "score DESC";
        }

        $sql = "SELECT name, second_name, class, score FROM data ORDER BY $order LIMIT ?, ?";

        $parameters = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при получении студентов:';
        $parameters['error_param'] = 'Ошибка в задании параметров при получении студентов:';
        $parameters['error_run'] = 'Ошибка при исполнении получении студентов:';

        $parameters['bind_param'] = array();
        $type = 'ii';
        $parameters['bind_param']['type'] = &$type;
        $parameters['bind_param']['start'] = &$start;
        $parameters['bind_param']['perPage'] = &$perPage;
        $stmt = $this->executeQuery($sql, $parameters);

                
        $result = $stmt->get_result();


        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }
        return $arr;



        }  
    
    function getStudentCount($search = '', $offset = '', $perPage =''){
        $start = $perPage*$offset;
        $likeSearch = '%'.$search.'%';
        if($search){
            $sql = "SELECT COUNT(*) FROM data 
                WHERE name LIKE ?
                OR second_name LIKE ?
                OR class LIKE ?
                OR score LIKE ? 
                ORDER BY score DESC";
        }else{
            $sql = "SELECT COUNT(*) from data";
            $enable_off_param = true;
        }
        $parameters = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при подсчёте студентов:';
        $parameters['error_param'] = 'Ошибка в задании параметров при получении кол-ва студентов:';
        $parameters['error_run'] = 'Ошибка при исполнении количества студентов:';

        $parameters['bind_param'] = array();
        $type = 'ssss';
        $parameters['bind_param']['type'] = &$type;
        $parameters['bind_param']['search1'] = &$likeSearch;
        $parameters['bind_param']['search2'] = &$likeSearch;
        $parameters['bind_param']['search3'] = &$likeSearch;
        $parameters['bind_param']['search4'] = &$likeSearch;

        if($enable_off_param){
            $stmt = $this->executeQuery($sql, $parameters, false);
        }else{
            $stmt = $this->executeQuery($sql, $parameters);
        }


        $result = $stmt->get_result();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }
        return $arr;
    }

    function getAuthUser($login, $pass){

        $sql = "SELECT name, second_name, class, email, score, birth_year
                FROM data
                WHERE login = ?
                AND password_hash = ?";

        $parameters = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при авторизации:';
        $parameters['error_param'] = 'Ошибка в задании параметров при авторизации:';
        $parameters['error_run'] = 'Ошибка при исполнении авторизации:';

        $parameters['bind_param'] = array();
        $type = 'ss';
        $parameters['bind_param']['type'] = &$type;
        $parameters['bind_param']['login'] = &$login;
        $parameters['bind_param']['pass'] = &$pass;

        $stmt = $this->executeQuery($sql, $parameters);
     
        $result = $stmt->get_result();

        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }

        return $arr;
    }

    function refreshStudent(array $data){
        foreach($data as $d){
            if($d != ""){
                $type .="s";
            }
        }

        $parameters = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при обновлении студента:';
        $parameters['error_param'] = 'Ошибка в параметрах при обновлении студента:';
        $parameters['error_run'] = 'Ошибка при исполнении обвновления студента:';

        $parameters['bind_param'] = array();
        $parameters['bind_param']['type'] = &$type;
        $parameters['bind_param']['name'] = &$data['name'];
        $parameters['bind_param']['sname'] = &$data['sname'];
        $parameters['bind_param']['class'] = &$data['class'];
        $parameters['bind_param']['email'] = &$data['email'];
        $parameters['bind_param']['score'] = &$data['score'];
        $parameters['bind_param']['age'] = &$data['age'];
        $parameters['bind_param']['login'] = &$data['login'];
        $parameters['bind_param']['pass'] = &$data['pass'];

        foreach($parameters as &$p){
            if(is_array($p)){
                foreach($p as $a=>$k){
                    if($k == ""){
                        unset($p[$a]);

                    }
                }
            }
        }
        
       
        if($data['name']){
            $name = "name = ?";
        }

        if(!($data['name']) and $data['sname']){

            $sname = "second_name = ?";
        }elseif($data['name'] and $data['sname']){
            $sname = ", second_name = ?";
        }
        
        if(!$data['name'] and !$data['sname'] and $data['class']){
            $class = "class = ?";
        }elseif(($data['name'] or $data['sname']) and $data['class']){
            $class = ", class = ?";
        }

        if(!$data['name'] and !$data['sname'] and !$data['class'] and $data['email']){
            $email = "email = ?";
        }elseif(($data['name'] or $data['sname'] or $data['class']) and $data['email']){
            $email = ", email = ?";
        }

        if(!$data['name'] and !$data['sname'] and !$data['class'] and !$data['email'] and $data['score']){
            $score = "score = ?";
        }elseif(($data['name'] or $data['sname'] or $data['class'] or $data['email']) and $data['score']){
            $score = ", score = ?";
        }

        if(!$data['name'] and !$data['sname'] and !$data['class'] and !$data['email'] and !$data['score'] and $data['age']){
            $age = "birth_year = ?";
        }elseif(($data['name'] or $data['sname'] or $data['class'] or $data['email'] or $data['score']) and $data['age']){
            $age = ", birth_year = ?";
        }

        $sql = "UPDATE data
                SET ".$name.$sname.$class.$email.$score.$age."
                WHERE login = ?
                AND password_hash = ?";

        $stmt = $this->executeQuery($sql, $parameters);
    }

    function findPage($search, $offset, $perPage, $sort = ''){

        $start = $perPage*$offset;
        $likeSearch = '%'.$search.'%';
      
        if($sort){
            $order = $sort;
        }else{
            $order = "score DESC";
        }
        $parameters = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при поиске:';
        $parameters['error_param'] = 'Ошибка при изменении параметров поиска:';
        $parameters['error_run'] = 'Ошибка при исполнении поиска:';

        $parameters['bind_param'] = array();
        $type = 'ssssii';
        $parameters['bind_param']['type'] = &$type;
        $parameters['bind_param']['search1'] = &$likeSearch;
        $parameters['bind_param']['search2'] = &$likeSearch;
        $parameters['bind_param']['search3'] = &$likeSearch;
        $parameters['bind_param']['search4'] = &$likeSearch;
        $parameters['bind_param']['start'] = &$start;
        $parameters['bind_param']['perPage'] = &$perPage;


        $sql = "SELECT name, second_name, class, score FROM data 
            WHERE name LIKE ?
            OR second_name LIKE ?
            OR class LIKE ?
            OR score LIKE ?
            ORDER BY $order LIMIT ?,?";

        $stmt = $this->executeQuery($sql, $parameters);


        $result = $stmt->get_result();

        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }

        return $arr;
    }   

    function getLoginPass(){

        $parameters = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при выборке логинов и хеша:';
        $parameters['error_param'] = 'Ошибка в задании параметров при выборке логинов и хеша:';
        $parameters['error_run'] = 'Ошибка при исполнении выборки логинов и хеша:';
        $sql = "SELECT login, password_hash
                FROM data
                ";
    
        $stmt = $this->executeQuery($sql, $parameters, false);
        $result = $stmt->get_result();

        return $result;
        }

        
        

    function getEmail(){
        $parameters = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при выборке емейлов:';
        $parameters['error_param'] = 'Ошибка в задании параметров при выборке емейлов:';
        $parameters['error_run'] = 'Ошибка при исполнении выборки емейлов:';
        $sql = "SELECT email from data";
        $stmt = $this->executeQuery($sql, $parameters, false);
        $result = $stmt->get_result();

        return $result;
    }

}


?>