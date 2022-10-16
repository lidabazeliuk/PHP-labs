/*1. Об’єкт “Бухгалтерія” (Код, ПІБ; посада; заробітна плата; кількість
дітей; стаж). Запит працюючих, які обіймають посаду Х і мають не більше,
ніж Y дітей.*/

<?php
function getBaseEmployees()
{
    return [
        [
            'id' => 1,
            'name' => 'Anastasia',
            'position' => 'accounter with diploma',
            'salary' => 2000,
            'children' => 2,
            'experience' => 2,
        ],
        [
            'id' => 2,
            'name' => 'Suleyman',
            'position' => 'accountant-specialist',
            'salary' => 6500,
            'children' => 9,
            'experience' => 8,
        ],
        [
            'id' => 3,
            'name' => 'Muhammed',
            'position' => 'seniour-accountant',
            'salary' => 5000,
            'children' => 5,
            'experience' => 19,
        ],
        [
            'id' => 4,
            'name' => 'Elizabet',
            'position' => 'middle-accountant',
            'salary' => 3800,
            'children' => 1,
            'experience' => 12,
        ]
    ];
}

function CreateNewEmployee($array, $id)
{
    return [
        'id' => $id,
        'name' => $array['name'],
        'position' => $array['position'],
        'salary' => $array['salary'],
        'children' => $array['children'],
        'experience' => $array['experience'],
    ];
}

function validationBaseEmployees($array)
{
    return !(
        empty($array['name']) ||
        empty($array['position']) ||
        empty($array['salary']) ||
        empty($array['children']) ||
        empty($array['experience']) ||
        $array['children'] < 0 ||
        $array['experience'] < 0 ||
        !isset($array)
    );
}

function filterEmployeeByPositionAndChildren($arr, $position, $children)
{
    $newArr = [];
    for ($i = 0; $i < count($arr); $i++) {
        if ($position == $arr[$i]['position'] && $arr[$i]['children'] < $children) {
            array_push($newArr, $arr[$i]);
        }
    }
}

function displayTableEmployees($array, $caption)
{
    $table = '<table>';
    $table .= '<caption> $caption </caption>';
    $table .= '<tr> <th>id</th> <th>name</th> <th>position</th> <th>salary</th> <th>children</th> <th>experience</th> </tr>';

    foreach ($array as $item) {
        $table .= '<tr>' .
            '<td>$item[id]</td><td>$item[name]</td><td>$item[position]</td>' .
            '<td>$item[salary]</td><td>$item[children]</td><td>$item[experience]</td>' .
            '</tr>';
    }

    $table .= '</table>';
    echo $table;
}

session_start();


if (empty($_SESSION)) {
    $_SESSION['Employees'] = getBaseEmployees();
}


if ($_POST['action'] == 'add') {
    if (validationBaseEmployees($_POST)) {
        $nextEmployeeId = count($_SESSION['Employees']) + 1;
        $_SESSION['Employees'][] = CreateNewEmployee($_POST, $nextEmployeeId);
    }
}


if ($_POST['action'] == 'edit') {
    if (validationBaseEmployees($_POST)) {
        $idToEdit = $_POST['id'];
        foreach ($_SESSION['Employees'] as $key => $value) {
            if ($value['id'] == $idToEdit) {
                $_SESSION['Employees'][$key] = CreateNewEmployee($_POST, $idToEdit);
                break;
            }
        }
    }
}


displayTableEmployees($_SESSION['Employees'], 'Employees');
?>
<br>

<button onclick='ShowAddForm()'> ADD</button>
<button onclick='ShowEditForm()'> EDIT</button>
<button onclick='ShowFilterForm()'> FILTER</button>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='addForm'>
    ADD <br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> position:
        <input type='text' name='position'>
    </label><br>
    <label> salary:
        <input type='text' name='salary'>
    </label><br>
    <label> children:
        <input type='number' name='children'>
    </label><br>
    <label> experience:
        <input type='number' name='experience'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='editForm'>
    EDIT <br>
    <label> id:
        <input type='number' name='id'>
    </label><br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> position:
        <input type='text' name='position'>
    </label><br>
    <label> salary:
        <input type='text' name='salary'>
    </label><br>
    <label> children:
        <input type='number' name='children'>
    </label><br>
    <label> experience:
        <input type='number' name='experience'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
    Filter <br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> children:
        <input type='number' name='children'>
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit'>
</form>


<style>
    table {
        border: 1px solid black;
    }

    th, td {
        border: 1px solid grey;
    }
</style>


<form method='get' action=''>
    <p>Form</p>
    <label>
        <input type='number' name='edit' placeholder='Type id for edit'> <br>
        <input type='number' name='id' placeholder='Id'> <br>
        <input type='text' name='name' placeholder='Name'> <br>
        <input type='text' name='position' placeholder='Position'> <br>
        <input type='number' name='salary' type='number' placeholder='Salary'> <br>
        <input type='text' name='children' placeholder='Children'>
        <input type='text' name='experience' placeholder='Experience'>
        <input type='submit' name='btn-ok' value='ok'>

        <input type='hidden' name='x-position' value=''>
        <input type='hidden' name='x-children' value=''>
    </label>
</form>
