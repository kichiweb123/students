
<?php
/*Класс нужен для соединия с БД, добавление, обновления, получения, поиска по БД*/
class TableStudentsGateway{
    const DB_ADDR = "localhost";
    const DB_LOGIN = "root";
    const DB_PASS = "";
    const DB_NAME = "table";

    public $_db = null;

    function __construct(){
         $connect = $this->_db = new mysqli(self::DB_ADDR, self::DB_LOGIN, self::DB_PASS, self::DB_NAME);
         if($this->_db->connect_error){
            throw new Exception('Невозможно подключиться к БД');
         }


    }

    function addStudent(array $data){

            $stmt = $this->_db->prepare("INSERT INTO data(login, pass, name, second_name, grup, email, score, age, localy, sex)
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при добавлении студентов');
            }
            $param = $stmt->bind_param("ssssssssss", $data['login'], $data['pass'], $data['name'], $data['sname'], $data['grup'], $data['email'], $data['score'], $data['age'], $data['local'], $data['sex']);
            $run = $stmt->execute();
            
                
            if(!$param){
                throw new Exception('Ошибка в задании параметров при добавлении студентов');
            }
            if(!$run){
                throw new Exception('Ошибка при исполнении добавления студентов');
            }
    }
    function getStudent($offset, $perPage, $sort = ''){

        $start = $perPage*$offset;

        if($sort){
            $stmt = $this->_db->prepare("SELECT name, second_name, grup, score FROM data ORDER BY $sort LIMIT ?, ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при получении студентов');
            }
            $stmt->bind_param("ii", $start, $perPage);
            $stmt->execute();
        }else{
            $stmt = $this->_db->prepare("SELECT name, second_name, grup, score FROM data ORDER BY score DESC LIMIT ?, ?"); 

            if(!$stmt){
                throw new Exception('Ошибка в запросе при получении студентов');
            }
            $param = $stmt->bind_param("ii", $start, $perPage);
            $run = $stmt->execute();
        }
            if(!$param){
                throw new Exception('Ошибка в задании параметров при получении студентов');
            }
            if(!$run){
                throw new Exception('Ошибка при исполнении получении студентов');
            }
        if($this->_db->error){
            echo "3";
        }
                
        $result = $stmt->get_result();


        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }
        return $arr;

    }
    function getPageCount($getStudentCount, $perPage){

        return ceil($getStudentCount/$perPage); 
    }

    function getStudentCount($search = '', $offset = '', $perPage =''){
        $start = $perPage*$offset;
        $likeSearch = '%'.$search.'%';
        if($search){
        $stmt = $this->_db->prepare("SELECT name, second_name, grup, score FROM data 
                WHERE name LIKE ?
                OR second_name LIKE ?
                OR grup LIKE ?
                OR score LIKE ? 
                ORDER BY score DESC");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при подсчёте студентов');
            }
        $param = $stmt->bind_param("ssss", $likeSearch, $likeSearch, $likeSearch, $likeSearch);
        $run = $stmt->execute();
        }else{
        $stmt = $this->_db->prepare("SELECT * from data");
        $param = 1;
        $run = $stmt->execute();
        }
        if(!$param){
            throw new Exception('Ошибка в задании параметров при получении кол-ва студентов');
            }
        if(!$run){
            throw new Exception('Ошибка при исполнении количества студентов');
        }

        $result = $stmt->get_result();
        return $this->_db->affected_rows;
    }

    function getAuthUser($login, $pass){
        $stmt = $this->_db->prepare("SELECT name, second_name, grup, email, score, age, localy, sex
                FROM data
                WHERE login = ?
                AND pass = ?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при авторизации');
            }
        $param = $stmt->bind_param("ss", $login, $pass);
        $run = $stmt->execute();
        $result = $stmt->get_result();
        if(!$param){
            throw new Exception('Ошибка в задании параметров при авторизации');
            }
        if(!$run){
            throw new Exception('Ошибка при исполнении авторизации');
        }
        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }

        return $arr;
    }

    function refreshStudent(array $data){
        if($data['name']){
            $stmt = $this->_db->prepare("UPDATE data
                    SET name = ?
                    WHERE login = ?
                    AND pass = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении имени');
            }
            $param1 = $stmt->bind_param("sss", $data['name'], $data['login'], $data['pass']);
            $run1 = $stmt->execute();

            if(!$param1){
                throw new Exception('Ошибка при изменении параметров имени');
            }
            if(!$run1){
                throw new Exception('Ошибка при исполнении изменения имени');
            }
    
        }   
        if($data['sname']){
            $stmt = $this->_db->prepare("UPDATE data
                    SET second_name = ?
                    WHERE login = ?
                    AND pass = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении фамилии');
            }
            $param2 = $stmt->bind_param("sss", $data['sname'], $data['login'], $data['pass']);
            $run2 = $stmt->execute();
            if(!$param2){
                throw new Exception('Ошибка при изменении параметров фамилии');
            }
            if(!$run2){
                throw new Exception('Ошибка при исполнении изменения фамилии');
            }
        }
        if($data['grup']){
            $stmt = $this->_db->prepare("UPDATE data
                    SET grup = ?
                    WHERE login = ?
                    AND pass = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении группы');
            }
            $param3 = $stmt->bind_param("sss", $data['grup'], $data['login'], $data['pass']);
            $run3 = $stmt->execute();
            if(!$param3){
                throw new Exception('Ошибка при изменении параметров группы');
            }
            if(!$run3){
                throw new Exception('Ошибка при исполнении изменения группы');
            }
        }
        if($data['email']){
            $stmt = $this->_db->prepare("UPDATE data
                    SET email = ?
                    WHERE login = ?
                    AND pass = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении емейла');
            }
            $param4 = $stmt->bind_param("sss", $data['email'], $data['login'], $data['pass']);
            $run4 = $stmt->execute();
            if(!$param4){
                throw new Exception('Ошибка при изменении параметров емейла');
            }
            if(!$run4){
                throw new Exception('Ошибка при исполнении изменения емейла');
            }
        }
        if($data['score']){
            $stmt = $this->_db->prepare("UPDATE data
                    SET score = ?
                    WHERE login = ?
                    AND pass = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении баллов ЕГЭ');
            }
            $param5 = $stmt->bind_param("sss", $data['score'], $data['login'], $data['pass']);
            $run5 = $stmt->execute();
            if(!$param5){
                throw new Exception('Ошибка при изменении параметров баллов ЕГЭ');
            }
            if(!$run5){
                throw new Exception('Ошибка при исполнении изменения баллов ЕГЭ');
            }
        }
        if($data['age']){
            $stmt = $this->_db->prepare("UPDATE data
                    SET age = ?
                    WHERE login = ?
                    AND pass = ?");
            if(!$stmt){
                throw new Exception('Ошибка в запросе при обновлении года рождения');
            }
            $param6 = $stmt->bind_param("sss", $data['age'], $data['login'], $data['pass']);
            $run6 = $stmt->execute();
            if(!$param6){
                throw new Exception('Ошибка при изменении параметров даты рождения');
            }
            if(!$run6){
                throw new Exception('Ошибка при исполнении изменения даты рождения');
            }
        }

    }

    function findPage($search, $offset, $perPage, $sort = ''){

        $start = $perPage*$offset;
        $likeSearch = '%'.$search.'%';
        if($sort){
        
        $stmt = $this->_db->prepare("SELECT name, second_name, grup, score FROM data 
            WHERE name LIKE ?
            OR second_name LIKE ?
            OR grup LIKE ?
            OR score LIKE ? 
            ORDER BY $sort LIMIT ?,?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при поиске');
            }
        $param = $stmt->bind_param("ssssii", $likeSearch, $likeSearch, $likeSearch, $likeSearch, $start, $perPage);
        $run = $stmt->execute();
        }else{
        $stmt = $this->_db->prepare($sql = "SELECT name, second_name, grup, score FROM data 
            WHERE name LIKE ?
            OR second_name LIKE ?
            OR grup LIKE ?
            OR score LIKE ?
            ORDER BY score DESC LIMIT ?,?");
        if(!$stmt){
                throw new Exception('Ошибка в запросе при поиске');
            }
        $param = $stmt->bind_param("ssssii", $likeSearch, $likeSearch, $likeSearch, $likeSearch, $start, $perPage);
        $run = $stmt->execute();
        
        }
        if(!$param){
            throw new Exception('Ошибка при изменении параметров поиска');
        }
        if(!$run){
            throw new Exception('Ошибка при исполнении поиска');
        }
        $result = $stmt->get_result();

        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $arr[] = $row;
        }

        return $arr;
    }   

    function isLogin($login, $pass = ''){
            $sql = "SELECT login, pass
                    FROM data
                    ";
        
        if($login and $pass){
            $result = $this->_db->query($sql);
            echo $this->_db->error;

            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                if(($row['login'] == $login) and ($row['pass'] == $pass)){
                    
                    return true;
                }else{
                
                    return false;
                }
            }
        }
        if($login){
            $result = $this->_db->query($sql);
            echo $this->_db->error;
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                if($row['login'] == $login){
                
                    return true;
                }else{
                    return false;
                }
            }
        }

    }

}


?>