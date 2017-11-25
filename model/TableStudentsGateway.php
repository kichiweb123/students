
<?php


/*Класс нужен для соединия с БД, добавление, обновления, получения, поиска по БД*/
class TableStudentsGateway{

   

    public $db = null;
    

    function __construct(ConnectDb $connect){
       
        $this->db = $connect;

    }

    function addStudent(array $data){

            $stmt = $this->db->connect->prepare("INSERT INTO data(login, password_hash, name, second_name, class, email, score, birth_year, localy, sex)
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при добавлении студентов:'.$this->db->connect->error);
            }
            $param = $stmt->bind_param("ssssssssss", $data['login'], $data['hash'], $data['name'], $data['sname'], $data['class'], $data['email'], $data['score'], $data['age'], $data['local'], $data['sex']);
            $run = $stmt->execute();
            
                
            if(!$param){
                throw new Exception('Ошибка в задании параметров при добавлении студентов:'.$this->db->connect->error);
            }
            if(!$run){
                throw new Exception('Ошибка при исполнении добавления студентов:'.$this->db->connect->error);
            }
    }
    function getStudent($offset, $perPage, $sort = ''){

        $start = $perPage*$offset;

        if($sort){
            $order = $sort;
        }else{
            $order = "score DESC";
        }
        $stmt = $this->db->connect->prepare("SELECT name, second_name, class, score FROM data ORDER BY $order LIMIT ?, ?");
        if(!$stmt){
            throw new Exception('Ошибка в запросе при получении студентов:'.$this->db->connect->error);
        }
        $param = $stmt->bind_param("ii", $start, $perPage);
        $run = $stmt->execute();
        if(!$param){
            throw new Exception('Ошибка в задании параметров при получении студентов:'.$this->db->connect->error);
        }
        if(!$run){
            throw new Exception('Ошибка при исполнении получении студентов:'.$this->db->connect->error);
        }

                
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
        $stmt = $this->db->connect->prepare("SELECT COUNT(*) FROM data 
                WHERE name LIKE ?
                OR second_name LIKE ?
                OR class LIKE ?
                OR score LIKE ? 
                ORDER BY score DESC");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при подсчёте студентов:'.$this->db->connect->error);
            }
        $param = $stmt->bind_param("ssss", $likeSearch, $likeSearch, $likeSearch, $likeSearch);
        $run = $stmt->execute();
        }else{
        $stmt = $this->db->connect->prepare("SELECT COUNT(*) from data");
        $param = 1;
        $run = $stmt->execute();
        }
        if(!$param){
            throw new Exception('Ошибка в задании параметров при получении кол-ва студентов:'.$this->db->connect->error);
            }
        if(!$run){
            throw new Exception('Ошибка при исполнении количества студентов:'.$this->db->connect->error);
        }

        $result = $stmt->get_result();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }
        return $arr;
    }

    function getAuthUser($login, $pass){
        $stmt = $this->db->connect->prepare("SELECT name, second_name, class, email, score, birth_year
                FROM data
                WHERE login = ?
                AND password_hash = ?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при авторизации:'.$this->db->connect->error);
            }
        $param = $stmt->bind_param("ss", $login, $pass);
        $run = $stmt->execute();
        $result = $stmt->get_result();
        if(!$param){
            throw new Exception('Ошибка в задании параметров при авторизации:'.$this->db->connect->error);
            }
        if(!$run){
            throw new Exception('Ошибка при исполнении авторизации:'.$this->db->connect->error);
        }
        $arr = array();
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
        
        $param_name = $data['name'];
        $param_sname = $data['sname'];
        $param_class = $data['class'];
        $param_email = $data['email'];
        $param_score = $data['score'];
        $param_age = $data['age'];
        $param_login = $data['login'];
        $param_pass = $data['pass'];
        $params = array(&$type, &$param_name, &$param_sname, &$param_class, &$param_email, &$param_score, &$param_age, &$param_login, &$param_pass);

        for($i = 0; $i<=8; $i++){
            if($params[$i] == ""){
                unset($params[$i]);
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
        $stmt = $this->db->connect->prepare("UPDATE data
                                            SET ".$name.$sname.$class.$email.$score.$age."
                                            WHERE login = ?
                                            AND password_hash = ?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении студента:'.$this->db->connect->error);
            }
        $param1 = call_user_func_array(array($stmt, "bind_param"), $params);
        $run1 = $stmt->execute();
        if(!$param1){
            throw new Exception('Ошибка в параметрах при обновлении студента:'.$this->db->connect->error);
        }
        if(!$run1){
            throw new Exception('Ошибка при исполнении обвновления студента:'.$this->db->connect->error);
        }

    }

    function findPage($search, $offset, $perPage, $sort = ''){

        $start = $perPage*$offset;
        $likeSearch = '%'.$search.'%';
      
        if($sort){
            $order = $sort;
        }else{
            $order = "score DESC";
        }
        $stmt = $this->db->connect->prepare($sql = "SELECT name, second_name, class, score FROM data 
            WHERE name LIKE ?
            OR second_name LIKE ?
            OR class LIKE ?
            OR score LIKE ?
            ORDER BY $order LIMIT ?,?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при поиске:'.$this->db->connect->error);
            }
        $param = $stmt->bind_param("ssssii", $likeSearch, $likeSearch, $likeSearch, $likeSearch, $start, $perPage);
        $run = $stmt->execute();
        if(!$param){
            throw new Exception('Ошибка при изменении параметров поиска:'.$this->db->connect->error);
        }
        if(!$run){
            throw new Exception('Ошибка при исполнении поиска:'.$this->db->connect->error);
        }
        $result = $stmt->get_result();

        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }

        return $arr;
    }   

    function getLoginPass(){
            $sql = "SELECT login, password_hash
                    FROM data
                    ";
        
        
            $result = $this->db->connect->query($sql);
            echo $this->db->error;

            return $result;
        }

        
        

    function getEmail(){
        $sql = "SELECT email from data";
        $result = $this->db->connect->query($sql);
        return $result;
    }

}


?>