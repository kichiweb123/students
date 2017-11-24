
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
                throw new Exception('Ошибка в запросе при добавлении студентов:'.$this->db->error);
            }
            $param = $stmt->bind_param("ssssssssss", $data['login'], $data['hash'], $data['name'], $data['sname'], $data['class'], $data['email'], $data['score'], $data['age'], $data['local'], $data['sex']);
            $run = $stmt->execute();
            
                
            if(!$param){
                throw new Exception('Ошибка в задании параметров при добавлении студентов:'.$this->db->error);
            }
            if(!$run){
                throw new Exception('Ошибка при исполнении добавления студентов:'.$this->db->error);
            }
    }
    function getStudent($offset, $perPage, $sort = ''){

        $start = $perPage*$offset;

        if($sort){
            $stmt = $this->db->connect->prepare("SELECT name, second_name, class, score FROM data ORDER BY $sort LIMIT ?, ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при получении студентов:'.$this->db->error);
            }
            $param = $stmt->bind_param("ii", $start, $perPage);
            echo $this->db->error;
            $run = $stmt->execute();
        }else{
            $stmt = $this->db->connect->prepare("SELECT name, second_name, class, score FROM data ORDER BY score DESC LIMIT ?, ?"); 

            if(!$stmt){
                throw new Exception('Ошибка в запросе при получении студентов:'.$this->db->error);
            }
            $param = $stmt->bind_param("ii", $start, $perPage);
            $run = $stmt->execute();
        }
            if(!$param){
                throw new Exception('Ошибка в задании параметров при получении студентов:'.$this->db->error);
            }
            if(!$run){
                throw new Exception('Ошибка при исполнении получении студентов:'.$this->db->error);
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
                throw new Exception('Ошибка в запросе при подсчёте студентов:'.$this->db->error);
            }
        $param = $stmt->bind_param("ssss", $likeSearch, $likeSearch, $likeSearch, $likeSearch);
        $run = $stmt->execute();
        }else{
        $stmt = $this->db->connect->prepare("SELECT COUNT(*) from data");
        $param = 1;
        $run = $stmt->execute();
        }
        if(!$param){
            throw new Exception('Ошибка в задании параметров при получении кол-ва студентов:'.$this->db->error);
            }
        if(!$run){
            throw new Exception('Ошибка при исполнении количества студентов:'.$this->db->error);
        }

        $result = $stmt->get_result();
        return $result;
    }

    function getAuthUser($login, $pass){
        $stmt = $this->db->connect->prepare("SELECT name, second_name, class, email, score, birth_year
                FROM data
                WHERE login = ?
                AND password_hash = ?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при авторизации:'.$this->db->error);
            }
        $param = $stmt->bind_param("ss", $login, $pass);
        $run = $stmt->execute();
        $result = $stmt->get_result();
        if(!$param){
            throw new Exception('Ошибка в задании параметров при авторизации:'.$this->db->error);
            }
        if(!$run){
            throw new Exception('Ошибка при исполнении авторизации:'.$this->db->error);
        }
        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }

        return $arr;
    }

    function refreshStudent(array $data){
        if($data['name']){
            $stmt = $this->db->connect->prepare("UPDATE data
                    SET name = ?
                    WHERE login = ?
                    AND password_hash = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении имени:'.$this->db->error);
            }
            $param1 = $stmt->bind_param("sss", $data['name'], $data['login'], $data['pass']);
            $run1 = $stmt->execute();

            if(!$param1){
                throw new Exception('Ошибка при изменении параметров имени:'.$this->db->error);
            }
            if(!$run1){
                throw new Exception('Ошибка при исполнении изменения имени:'.$this->db->error);
            }
    
        }   
        if($data['sname']){
            $stmt = $this->db->connect->prepare("UPDATE data
                    SET second_name = ?
                    WHERE login = ?
                    AND password_hash = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении фамилии:'.$this->db->error);
            }
            $param2 = $stmt->bind_param("sss", $data['sname'], $data['login'], $data['pass']);
            $run2 = $stmt->execute();
            if(!$param2){
                throw new Exception('Ошибка при изменении параметров фамилии:'.$this->db->error);
            }
            if(!$run2){
                throw new Exception('Ошибка при исполнении изменения фамилии:'.$this->db->error);
            }
        }
        if($data['class']){
            $stmt = $this->db->connect->prepare("UPDATE data
                    SET class = ?
                    WHERE login = ?
                    AND password_hash = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении группы:'.$this->db->error);
            }
            $param3 = $stmt->bind_param("sss", $data['class'], $data['login'], $data['pass']);
            $run3 = $stmt->execute();
            if(!$param3){
                throw new Exception('Ошибка при изменении параметров группы:'.$this->db->error);
            }
            if(!$run3){
                throw new Exception('Ошибка при исполнении изменения группы:'.$this->db->error);
            }
        }
        if($data['email']){
            $stmt = $this->db->connect->prepare("UPDATE data
                    SET email = ?
                    WHERE login = ?
                    AND password_hash = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении емейла:'.$this->db->error);
            }
            $param4 = $stmt->bind_param("sss", $data['email'], $data['login'], $data['pass']);
            $run4 = $stmt->execute();
            if(!$param4){
                throw new Exception('Ошибка при изменении параметров емейла:'.$this->db->error);
            }
            if(!$run4){
                throw new Exception('Ошибка при исполнении изменения емейла:'.$this->db->error);
            }
        }
        if($data['score']){
            $stmt = $this->db->connect->prepare("UPDATE data
                    SET score = ?
                    WHERE login = ?
                    AND password_hash = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении баллов ЕГЭ:'.$this->db->error);
            }
            $param5 = $stmt->bind_param("sss", $data['score'], $data['login'], $data['pass']);
            $run5 = $stmt->execute();
            if(!$param5){
                throw new Exception('Ошибка при изменении параметров баллов ЕГЭ:'.$this->db->error);
            }
            if(!$run5){
                throw new Exception('Ошибка при исполнении изменения баллов ЕГЭ:'.$this->db->error);
            }
        }
        if($data['age']){
            $stmt = $this->db->connect->prepare("UPDATE data
                    SET birth_year = ?
                    WHERE login = ?
                    AND password_hash = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении года рождения:'.$this->db->error);
            }
            $param6 = $stmt->bind_param("sss", $data['age'], $data['login'], $data['pass']);
            $run6 = $stmt->execute();
            if(!$param6){
                throw new Exception('Ошибка при изменении параметров даты рождения:'.$this->db->error);
            }
            if(!$run6){
                throw new Exception('Ошибка при исполнении изменения даты рождения:'.$this->db->error);
            }
        }

    }

    function findPage($search, $offset, $perPage, $sort = ''){

        $start = $perPage*$offset;
        $likeSearch = '%'.$search.'%';
        if($sort){
        
        $stmt = $this->db->connect->prepare("SELECT name, second_name, class, score FROM data 
            WHERE name LIKE ?
            OR second_name LIKE ?
            OR class LIKE ?
            OR score LIKE ? 
            ORDER BY $sort LIMIT ?,?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при поиске:'.$this->db->error);
            }
        $param = $stmt->bind_param("ssssii", $likeSearch, $likeSearch, $likeSearch, $likeSearch, $start, $perPage);
        $run = $stmt->execute();
        }else{
        $stmt = $this->db->connect->prepare($sql = "SELECT name, second_name, class, score FROM data 
            WHERE name LIKE ?
            OR second_name LIKE ?
            OR class LIKE ?
            OR score LIKE ?
            ORDER BY score DESC LIMIT ?,?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при поиске:'.$this->db->error);
            }
        $param = $stmt->bind_param("ssssii", $likeSearch, $likeSearch, $likeSearch, $likeSearch, $start, $perPage);
        $run = $stmt->execute();
        
        }
        if(!$param){
            throw new Exception('Ошибка при изменении параметров поиска:'.$this->db->error);
        }
        if(!$run){
            throw new Exception('Ошибка при исполнении поиска:'.$this->db->error);
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