<?php
class Database
{
    private static $instance = null;

    private $pdo,
            $errors = false,
            $query,
            $results,
            $count = 0;

    private function __construct()
    {
        try
        {
            $this->pdo = new PDO("mysql:host=".Config::get('mysql/host').";dbname=".Config::get('mysql/db_name'),Config::get('mysql/username'),Config::get('mysql/password'));
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql,$parameters = array())
    {
        $this->errors = false;

        if($this->query = $this->pdo->prepare($sql)){
            $x = 1;
            foreach ($parameters as $parameter) {
                $this->query->bindValue($x,$parameter);
                $x++;
            }
        }
        if($this->query->execute()){
            $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $this->query->rowCount();
        }else{
            echo $this->errors = "There was a problem executing this query";
        }
        return $this;
    }

    public function action($action,$table,$parameters = array())
    {
        if(count($parameters)){
            if(count($parameters) === 3){
                $column = $parameters[0];
                $operator = $parameters[1];
                $value = $parameters[2];

                $operators = array('<','>','=','<=','>=');

                if(in_array($operator,$operators)){
                    $sql = "{$action} FROM {$table} WHERE {$column} {$operator} ?";
                }
                if(!$this->query($sql,[$value])->errors()){
                    return $this;
                }
            }
        }
        return false;
    }

    public function insert($table,$parameters = array())
    {
        if(count($parameters)){
            $columns = implode(',',array_keys($parameters));

            $placeholders = "";
            $x = 1;
            foreach ($parameters as $parameter) {
                $placeholders .= "?";
                if ($x < count($parameters)) {
                    $placeholders .= ", ";
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

            if(!$this->query($sql,$parameters)->errors()){
                return true;
            }
        }
        return false;
    }

    public function update($table,$id,$parameters = array())
    {
        if(count($parameters)){
            $set = "";
            $x = 1;
            foreach ($parameters as $column => $value) {
                $set .= $column."=?";
                if($x < count($parameters)){
                    $set .= ", ";
                }
                $x++;
            }
            $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

            if(!$this->query($sql,$parameters)->errors()){
                return true;
            }
        }
        return false;
    }

    public function get($table,$parameters = array())
    {
        return $this->action('SELECT *',$table,$parameters);
    }

    public function delete($table,$parameters = array())
    {
        return $this->action('DELETE',$table,$parameters);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function results()
    {
        return $this->results;
    }

    public function first()
    {
        return $this->results()[0];
    }

    public function count()
    {
        return $this->count;
    }
}
