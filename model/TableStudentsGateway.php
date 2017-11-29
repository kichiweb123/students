<?php


/*Класс нужен для добавления, обновления, получения, поиска информации по БД*/
class TableStudentsGateway
{
    
    
    
    private $db = null;
    
    
    function __construct(ConnectDb $connect)
    {
        
        $this->db = $connect;
        
    }
    
    function addStudent($student)
    {
        $sql                         = "INSERT INTO students(login, password_hash, name, second_name, class, email, score, birth_year, localy, sex)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $parameters                  = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при добавлении студента:';
        $parameters['error_param']   = 'Ошибка в задании параметров при добавлении студента:';
        $parameters['error_run']     = 'Ошибка при исполнении добавления студента:';
        
        $parameters['bind_param'] = array();
        $type                     = 'ssssssssss';
        $parameters['bind_param']['type'] =& $type;
        $parameters['bind_param']['login'] =& $student->login;
        $parameters['bind_param']['hash'] =& $student->hash;
        $parameters['bind_param']['name'] =& $student->name;
        $parameters['bind_param']['sname'] =& $student->sname;
        $parameters['bind_param']['class'] =& $student->class;
        $parameters['bind_param']['email'] =& $student->email;
        $parameters['bind_param']['score'] =& $student->score;
        $parameters['bind_param']['age'] =& $student->age;
        $parameters['bind_param']['local'] =& $student->local;
        $parameters['bind_param']['sex'] =& $student->sex;
        $stmt = $this->executeQuery($sql, $parameters);
        
    }
    function executeQuery($sql, array $parameters, $enable_param = true)
    {
        $stmt = $this->db->connect->prepare($sql);
        if (!$stmt) {
            throw new Exception($parameters['error_prepare'] . $this->db->connect->error);
        }
        
        if (!$enable_param) {
            $param = 1;
        } else {
            $param = call_user_func_array(array(
                $stmt,
                "bind_param"
            ), $parameters['bind_param']);
        }
        $run = $stmt->execute();
        if (!$param) {
            throw new Exception($parameters['error_param'] . $this->db->connect->error);
        }
        if (!$run) {
            throw new Exception($parameters['error_run'] . $this->db->connect->error);
        }
        return $stmt;
    }

    function getStudent($offset, $perPage, $sort = '', $search = '')
    {
        $whiteList = array('name', 'second_name', 'class');
        $start = $perPage * $offset;

        $likeSearch = '%' . $search . '%';


        if ($sort) {
            if( in_array($sort, $whiteList)) {
                $order = $sort;
            } else {
                $order = "score DESC";
            }

        } else {
            $order = "score DESC";
        }
        if($search){
            $sql_search = "WHERE name LIKE ?
            OR second_name LIKE ?
            OR class LIKE ?
            OR score LIKE ?";
        }
        $sql = "SELECT name, second_name, class, score FROM students $sql_search ORDER BY $order LIMIT ?, ?";
        
        $parameters                  = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при получении студентов:';
        $parameters['error_param']   = 'Ошибка в задании параметров при получении студентов:';
        $parameters['error_run']     = 'Ошибка при исполнении получении студентов:';
        
        $parameters['bind_param'] = array();
        if($search){
            $type                     = 'ssssii';
        } else {
            $type                     = 'ii';

        }
        $parameters['bind_param']['type'] =& $type;

        if($search){
            $parameters['bind_param']['search1'] =& $likeSearch;
            $parameters['bind_param']['search2'] =& $likeSearch;
            $parameters['bind_param']['search3'] =& $likeSearch;
            $parameters['bind_param']['search4'] =& $likeSearch;
        }

        $parameters['bind_param']['start'] =& $start;
        $parameters['bind_param']['perPage'] =& $perPage;
        $stmt = $this->executeQuery($sql, $parameters);
        
        
        $result = $stmt->get_result();
        
        
        $arr = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = new Student($row);

        }
        return $arr;
        
        
        
    }
    
    function getStudentCount($search = '', $offset = '', $perPage = '')
    {
        $start      = $perPage * $offset;
        $likeSearch = '%' . $search . '%';
        if ($search) {
            $sql = "SELECT COUNT(*) FROM students 
                WHERE name LIKE ?
                OR second_name LIKE ?
                OR class LIKE ?
                OR score LIKE ? 
                ORDER BY score DESC";
        } else {
            $sql              = "SELECT COUNT(*) from students";
            $enable_off_param = true;
        }
        $parameters                  = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при подсчёте студентов:';
        $parameters['error_param']   = 'Ошибка в задании параметров при получении кол-ва студентов:';
        $parameters['error_run']     = 'Ошибка при исполнении количества студентов:';
        
        $parameters['bind_param'] = array();
        $type                     = 'ssss';
        $parameters['bind_param']['type'] =& $type;
        $parameters['bind_param']['search1'] =& $likeSearch;
        $parameters['bind_param']['search2'] =& $likeSearch;
        $parameters['bind_param']['search3'] =& $likeSearch;
        $parameters['bind_param']['search4'] =& $likeSearch;
        
        if ($enable_off_param) {
            $stmt = $this->executeQuery($sql, $parameters, false);
        } else {
            $stmt = $this->executeQuery($sql, $parameters);
        }
        
        
        $result = $stmt->get_result();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = $row;
        }
        return $arr;
    }
    
    function getAuthUser($login, $pass)
    {
        
        $sql = "SELECT name, second_name, class, email, score, birth_year
                FROM students
                WHERE login = ?
                AND password_hash = ?";
        
        $parameters                  = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при авторизации:';
        $parameters['error_param']   = 'Ошибка в задании параметров при авторизации:';
        $parameters['error_run']     = 'Ошибка при исполнении авторизации:';
        
        $parameters['bind_param'] = array();
        $type                     = 'ss';
        $parameters['bind_param']['type'] =& $type;
        $parameters['bind_param']['login'] =& $login;
        $parameters['bind_param']['pass'] =& $pass;
        
        $stmt = $this->executeQuery($sql, $parameters);
        
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = new Student($row);

        }

        
        return $arr;
    }
    
    function refreshStudent($student)
    {
        foreach ($student as $s) {
            if ($s != "") {
                $type .= "s";
            }
        }
        
        $parameters                  = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при обновлении студента:';
        $parameters['error_param']   = 'Ошибка в параметрах при обновлении студента:';
        $parameters['error_run']     = 'Ошибка при исполнении обвновления студента:';
        
        $parameters['bind_param'] = array();
        $parameters['bind_param']['type'] =& $type;
        $parameters['bind_param']['name'] =& $student->name;
        $parameters['bind_param']['sname'] =& $student->sname;
        $parameters['bind_param']['class'] =& $student->class;
        $parameters['bind_param']['email'] =& $student->email;
        $parameters['bind_param']['score'] =& $student->score;
        $parameters['bind_param']['age'] =& $student->age;
        $parameters['bind_param']['login'] =& $student->login;
        $parameters['bind_param']['pass'] =& $student->hash;
        
        foreach ($parameters as &$p) {
            if (is_array($p)) {
                foreach ($p as $a => $k) {
                    if ($k == "") {
                        unset($p[$a]);
                        
                    }
                }
            }
        }
        
        
        if ($student->name) {
            $name = "name = ?";
        }
        
        if (!($student->name) and $student->sname) {
            
            $sname = "second_name = ?";
        } elseif ($student->name and $student->sname) {
            $sname = ", second_name = ?";
        }
        
        if (!$student->name and !$student->sname and $student->class) {
            $class = "class = ?";
        } elseif (($student->name or $student->sname) and $student->class) {
            $class = ", class = ?";
        }
        
        if (!$student->name and !$student->sname and !$student->class and $student->email) {
            $email = "email = ?";
        } elseif (($student->name or $student->sname or $student->class) and $student->email) {
            $email = ", email = ?";
        }
        
        if (!$student->name and !$student->sname and !$student->class and !$student->email and $student->score) {
            $score = "score = ?";
        } elseif (($student->name or $student->sname or $student->class or $student->email) and $student->score) {
            $score = ", score = ?";
        }
        
        if (!$student->name and !$student->sname and !$student->class and !$student->email and !$student->score and $student->age) {
            $age = "birth_year = ?";
        } elseif (($student->name or $student->sname or $student->class or $student->email or $student->score) and $student->age) {
            $age = ", birth_year = ?";
        }
        
        $sql = "UPDATE students
                SET " . $name . $sname . $class . $email . $score . $age . "
                WHERE login = ?
                AND password_hash = ?";
        
        $stmt = $this->executeQuery($sql, $parameters);
    }
    
    
    function getLoginPass($login, $pass = false, $onlyLogin = false)
    {
        
        $parameters                  = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при выборке логинов и хеша:';
        $parameters['error_param']   = 'Ошибка в задании параметров при выборке логинов и хеша:';
        $parameters['error_run']     = 'Ошибка при исполнении выборки логинов и хеша:';
        $sql                         = "SELECT login
                FROM students WHERE login = ?
                ";
        $type = "s";
        $parameters['bind_param']['type'] = & $type;
        $parameters['bind_param']['login'] = & $login;

        $stmt   = $this->executeQuery($sql, $parameters);
        $result = $stmt->get_result();

        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                
                if($row['login'] == $login){
                    if($onlyLogin == true){
                        return true;
                    }
                    $sql = "SELECT password_hash FROM students WHERE login = ?";
                    $stmt   = $this->executeQuery($sql, $parameters);
                    $result = $stmt->get_result();
                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        $hash = password_verify($pass, $row['password_hash']);
                        if($hash){
                            return $row['password_hash'];
                        }
                    }
                }
        }
        
    }
    
    
    
    
    function isEmailUsed($email)
    {
        $parameters                  = array();
        $parameters['error_prepare'] = 'Ошибка в запросе при выборке емейлов:';
        $parameters['error_param']   = 'Ошибка в задании параметров при выборке емейлов:';
        $parameters['error_run']     = 'Ошибка при исполнении выборки емейлов:';
        $type = "s";
        $parameters['bind_param']['type'] = & $type;
        $parameters['bind_param']['email'] = & $email;

        $sql                         = "SELECT email from students WHERE email LIKE ?";
        $stmt                        = $this->executeQuery($sql, $parameters);
        $result                      = $stmt->get_result();
        
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            
                if($row['email'] == $email){
                    
                    return true;
                }
        }
    }
    
}


?>