<?php

class Display
{
    public static function displayEmployees($array)
    {
        $table = '<table>';
        $table .= "<caption> Employees </caption>";
        $table .= '<tr> <th>id</th> <th>name</th> <th>salary</th> <th>position</th> <th>children</th> <th>experience</th> </tr>';

        foreach ($array as $item) {
            $table .=
                "<tr><td>" . $item['id'] .
                "</td><td>" . $item['name'] .
                "</td><td>" . $item['position'] .
                "</td><td>" . $item['salary'] .
                "</td><td>" . $item['children'] .
                "</td><td>" . $item['experience'] .
                "</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}
