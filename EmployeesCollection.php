<?php
class EmployeesCollection
{
    public $employees;

    public function __construct()
    {
    }

    public function defaultEmployees()
    {
        $this->employees = [
            new Employee(1, [
                'id' => 1,
                'name' => 'Anastasia',
                'position' => 'accounter with diploma',
                'salary' => 2000,
                'children' => 2,
                'experience' => 2,
            ]),
            new Employee(2, [
                'id' => 2,
                'name' => 'Suleyman',
                'position' => 'accountant-specialist',
                'salary' => 6500,
                'children' => 9,
                'experience' => 8,
            ]),
            new Employee(3, [
                'id' => 3,
                'name' => 'Muhammed',
                'position' => 'seniour-accountant',
                'salary' => 5000,
                'children' => 5,
                'experience' => 19,
            ]),
            new Employee(4, [
                'id' => 4,
                'name' => 'Elizabet',
                'position' => 'middle-accountant',
                'salary' => 3800,
                'children' => 1,
                'experience' => 12,
            ])
        ];
        return $this;
    }

    public function getEmployeeById($id)
    {
        foreach ($this->employees as $employee) {
            if ($employee->id == $id) {
                return $employee;
            }
        }
        return null;
    }

    public function filterEmployees($position, $children)
    {
        return array_filter(
            $this->employees,
            function ($value) use ($position, $children) {
                return ($value->position == $position and $value->children > $children);
            }
        );
    }

    public function addEmployee($employee)
    {
        $this->employees[] = $employee;
    }

    public function editEmployee($array)
    {
        $employee = $this->getEmployeeById($array['id']);
        if (!(empty($employee))) {
            $employee->position = $array['id'];
            $employee->phone = $array['phone'];
            $employee->address = $array['address'];
            $employee->children = $array['children'];
            $employee->experience = $array['experience'];
        }
    }
}
