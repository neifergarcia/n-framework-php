<?php

class EneModel {

    private $mWhere = null;
    private $mOrderBy = null;

    public $fields;
    public $error = false;
    public $errorMessage = "";

    function __construct($table = null, $where = null){
        DBConnection::connect();
    }

    function where($field, $value, $sign = "=")
    {
        if(!DBConnection::isConnected()) return "neifer";

        $this->mWhere = " WHERE " . $field . $sign . "'" . $value . "'";

        return $this;
    }

    function andWhere($field, $value, $sign = "=")
    {
        if(!DBConnection::isConnected()) return null;

        $mwhere = $field . $sign . $value;

        if($this->mWhere == null)
            $this->mWhere = " WHERE " . $mwhere;
        else
            $this->mWhere .= " AND " . $mwhere;

        return $this;
    }

    function orWhere($field, $value, $sign = "=")
    {
        if(!DBConnection::isConnected()) return null;

        $mwhere = $field . $sign . $value;

        if($this->mWhere == null)
            $this->mWhere = " WHERE " . $mwhere;
        else
            $this->mWhere .= " OR " . $mwhere;

        return $this;
    }

    function orderBy($field, $orden = "ASC"){
        if(!DBConnection::isConnected()) return null;

        $orderBy = " ORDER BY " . $field . " " . $orden;

        if($this->mOrderBy != null){
            $orderBy = $this->mOrderBy . ", " . $field;
        }

        $this->mOrderBy = $orderBy;

        return $this;
    }

    function create(array $arr)
    {
        $model = new EneModel();

        $keys = "";
        $values = "";
        $arrvalues = array();
        $lkey = end(array_keys($arr));  //Last Key
        foreach ($arr as $key => $value) {
            $keys .= $key;
            $values .= "?";
            $arrvalues[$key] = $value;
            if ($key != $lkey) {
                $keys .= ",";
                $values .= ",";
            }
        }

        $prepare = "INSERT INTO " . $this->table . "(" . $keys . ", created_at) VALUES(" . $values . ", CURRENT_TIMESTAMP)";



        try {

            $stmt = DBConnection::connection()->prepare($prepare);
            $i = 1;
            foreach ($arrvalues as $value) {
                $stmt->bindValue($i, $value);
                $i++;
            }
            $stmt->execute();
        } catch (Exception $e) {
            $model->error = true;
            $model->errorMessage = $e;
        }

        DBConnection::close();

        return $model;
    }

    function hasOne($classTable, $field1, $field2){

        $model = new $classTable();

        $model->fields = $model->where($field1, $this->fields->{$field2})->first()->fields;

        return $model;
    }

    function hasMany($classTable, $field1, $field2){
        $model = new $classTable();

        $model->rows = $model->where($field1, $this->fields->{$field2})->get();

        return $model;
    }

    function all(array $arr = null){
        if(!DBConnection::isConnected()) return null;

        $orderBy = "";
        if($this->mOrderBy != null)
           $orderBy = $this->mOrderBy;

        $model = new EneModel();

        if($arr == null){
            $prepare = "SELECT * FROM " . $this->table . $orderBy;
        }else{
            $selects = "";
            $lvalue = end(array_values($arr)); //Ultimo Key
            foreach ($arr as $value) {
                $selects .= $value;
                if ($value != $lvalue) {
                    $selects .= ",";
                }
            }

            $prepare = "SELECT $selects FROM " . $this->table . $orderBy;
        }

        try {
            $stmt = DBConnection::connection()->prepare($prepare);
            $stmt->execute();
        } catch (Exception $e) {
            $model->error = true;
        }
        $arr = $stmt->fetchAll();
        $newArr = array();
        foreach($arr as $row){
            $model = new $this;
            $model->fields = (object)$row;
            array_push($newArr, $model);
        }

        DBConnection::close();
        $result = new stdClass();
        $result->rows = (object) $newArr;
        return $result;
    }

    function get(array $arr = null)
    {
        if(!DBConnection::isConnected()) return null;

        $where = "";
        $orderby = "";
        if($this->mWhere != null)
            $where = $this->mWhere;

        if($this->mOrderBy != null)
            $orderby = $this->mOrderBy;

        if($arr == null){
            $prepare = "SELECT * FROM " . $this->table . $where . " " . $orderby;
        }else{
            $selects = "";
            $lvalue = end(array_values($arr)); //Ultimo Key
            foreach ($arr as $value) {
                $selects .= $value;
                if ($value != $lvalue) {
                    $selects .= ",";
                }
            }

            $prepare = "SELECT $selects FROM " . $this->table . $where . " " . $orderby;
        }

        try {
            $stmt = DBConnection::connection()->prepare($prepare);
            $stmt->execute();
        } catch (Exception $e) {
        }
        $arr = $stmt->fetchAll();
        $newArr = array();
        foreach($arr as $row){
            $model = new $this;
            $model->fields = (object)$row;
            array_push($newArr, $model);
        }

        DBConnection::close();
        $result = new stdClass();
        $result->rows = (object) $newArr;
        return $result;
    }

    function first(array $arr = null){

        $model = new $this;

        $model->error = true;
        $model->errorMessage = "Error Desconocido";

        foreach($this->get($arr)->rows as $item){
            $model->fields = $item->fields;
            $model->error = false;
            break;
        }

        return $model;
    }

    function last(array $arr = null){

        $model = new $this;

        $model->error = true;
        foreach($this->get($arr)->rows as $item){
            $model->fields = $item->fields;
            $model->error = false;
        }

        return $model;
    }

    function update(array $arr)
    {
        if(!DBConnection::isConnected()) return null;

        if($this->mWhere == null) return null;

        $model = new EneModel();

        $sets = "";
        $lkey = end(array_keys($arr)); //Ultimo Key
        foreach ($arr as $key => $value) {
            $sets .= $key . " = '" . $value . "'";
            if ($key != $lkey) {
                $sets .= ",";
            }
        }

        $prepare = "UPDATE " . $this->table . " SET " . $sets . $this->mWhere;

        try {
            $stmt = DBConnection::connection()->prepare($prepare);
            $stmt->execute();
        } catch (Exception $e) {
            $model->error = $e;
            print_r($prepare);
        }
        DBConnection::close();
        return true;
    }

    function delete()
    {
        if(!DBConnection::isConnected()) return null;

        if($this->mWhere == null) return null;

        $model = new EneModel();

        $prepare = "DELETE FROM " . $this->table . $this->mWhere;

        try {
            $stmt = DBConnection::connection()->prepare($prepare);
            $stmt->execute();
        } catch (Exception $e) {
            $model->error = true;
        }
        DBConnection::close();
        return true;
    }

} 