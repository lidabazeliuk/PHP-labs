<?php

include "Employee.php";
include "EmployeesCollection.php";

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['Employees'])) {
    $_SESSION['Employees'] = new EmployeesCollection();
    $_SESSION['Employees']->baseEmployees();
}

$actionToDo = $_POST['action'];

echo $_SESSION['Employees']->showEmployees();

if ($actionToDo == 'add') {
    if (Employee::validationDataEmployees($_POST)) {
        $_SESSION['Employees']->addEmployee(
            new Employee(5, $_POST)
        );
    }
} elseif ($actionToDo == 'edit') {
    if (Employee::validationDataEmployees($_POST)) {
        $_SESSION['Employees']->editEmployee(
            $_POST
        );
    }
} elseif ($actionToDo == 'filter') {
    echo $_SESSION['Employees']->filter($_POST['position'], $_POST['children']);
} elseif ($actionToDo == 'save') {
    $_SESSION['Employees']->save();
} elseif ($actionToDo == 'load') {
    $_SESSION['Employees']->load();
}


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
    <input type='submit' value='add'>
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
    <input type='submit' value='edit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
    Filter <br>
    <label> position:
        <input type='text' name='position'>
    </label><br>
    <label> children:
        <input type='number' name='children'>
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit' value='filter'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='save'>
    <input type='hidden' name='action' value='save'>
    <input type='submit' value='Save to file'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='load'>
    <input type='hidden' name='action' value='load'>
    <input type='submit' value='Upload from file'>
</form>

<style>
    #addForm {
        display: none;
    }

    #editForm {
        display: none;
    }

    #filterForm {
        display: none;
    }

    table {
        border: 1px solid black;
    }

    th, td {
        border: 1px solid grey;
    }
</style>


<script>
    function ShowAddForm() {
        document.querySelector('#addForm').style.display = 'inline';
    }

    function ShowEditForm() {
        document.querySelector('#editForm').style.display = 'inline';
    }

    function ShowFilterForm() {
        document.querySelector('#filterForm').style.display = 'inline';
    }
</script>
