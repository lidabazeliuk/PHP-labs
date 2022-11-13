<?php

class Repository
{
    public $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function createEmployee($array)
    {
        $this->dbh->query(
            'INSERT INTO Employees(name, position, salary, children, experience) VALUES (' .
            "'" . $array['name'] . "', " .
            "'" . $array['position'] . "', " .
            "'" . $array['salary'] . "', " .
            "'" . $array['children'] . "', " .
            "'" . $array['experience'] . "')"
        );
    }

    public function readEmployees()
    {
        return $this->dbh->query('SELECT * FROM Employees')->fetchAll();
    }

    public function updateEmployee($array)
    {
        $this->dbh->query(
            'UPDATE Employees SET ' .
            'name = ' . $array['name'] . ', ' .
            'position = ' . $array['position'] . ', ' .
            'salary = ' . $array['salary'] . ', ' .
            'children = ' . $array['children'] . ' , ' .
            'experience = ' . $array['experience'] . ' ' .
            'WHERE id = ' . $array['id']
        );
    }

    public function deleteEmployee($array)
    {
        return $this->dbh->query('DELETE FROM Employees WHERE id = ' . $array['id']);
    }
}
