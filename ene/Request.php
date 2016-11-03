<?php

class Request
{

    protected $array = array();

    public function __construct($arr)
    {
        $this->array = $arr;
    }

    public function validateEmpty(array $arr)
    {
        $ret = false;
        $err = "";
        foreach ($arr as $value) {
            if ($this->array[$value] != "")
                $ret = true;
            else {
                $err .= "<li>El campo " . $value . " no debe estar vacío </li>";
                $ret = false;
            }
        }

        return array("error" => $ret, "message" => $err);
    }

    public function validateNumber(array $arr)
    {
        $ret = false;
        $err = "";
        foreach ($arr as $value) {
            if (is_numeric($this->array[$value]))
                $ret = true;
            else {
                $err .= "<li>El campo " . $value . " debe ser numerico </li>";
                $ret = false;
            }
        }

        return array("error" => $ret, "message" => $err);
    }

    public function validateDate(array $arr)
    {
        $ret = false;
        $err = "";
        foreach ($arr as $value) {
            $date = explode("/", $this->array[$value]);
            if (sizeof($date) > 1) {
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                if (checkdate($month, $day, $year))
                    $ret = true;
                else {
                    $err .= "<li>El campo " . $value . " debe ser de este formato yyyy/mm/dd </li>";
                    $ret = false;
                }
            } else {
                $err .= "<li>El campo " . $value . " debe ser de este formato yyyy/mm/dd </li>";
                $ret = false;
            }
        }

        return array("error" => $ret, "message" => $err);
    }

    public function input($key)
    {
        if(isset($this->array[$key]))
            return $this->array[$key];
        else
            return '';
    }

    public function all(array $arr = null)
    {
        if ($arr != null) {
            if (isset($arr['except'])) {
                $mArr = array();
                foreach ($arr['except'] as $except) {
                    foreach ($this->array as $key => $value) {
                        if ($key != $except) {
                            $mArr[$key] = $value;
                        }
                    }
                }

                return $mArr;
            }
        }
        return $this->array;
    }


}