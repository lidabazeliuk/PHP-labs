<?php

class Employee
{
    public $id;
    public $name;
    public $position;
    public $salary;
    public $children;
    public $experience;

    public function __construct($id, $array)
    {
        $this->id = $id;
        $this->name = $array['name'];
        $this->salary = $array['position'];
        $this->position = $array['salary'];
        $this->children = $array['children'];
        $this->experience = $array['experience'];
    }

    public static function validationBaseEmployees($array)
    {
        return !(
            empty($array['name']) ||
            empty($array['position']) ||
            empty($array['salary']) ||
            empty($array['children']) ||
            empty($array['experience']) ||
            $array['salary'] < 0 ||
            $array['children'] < 0 ||
            $array['experience'] < 0 ||
            !isset($array)
        );
    }
}
