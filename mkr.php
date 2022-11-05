<?php

$sql = "select * from products";
$statement = $dbh->query($sql);
var_dump($statement);


$list_of_products = array(
    ["id" => 1, "name" => "Table", "country_of_manufacture" => "Spain", "price" => 3500],
    ["id" => 2, "name" => "Bag", "country_of_manufacture" => "France", "price" => 6000],
    ["id" => 3, "name" => "Lipstick", "country_of_manufacture" => "Poland", "price" => 300],
    ["id" => 4, "name" => "Case", "country_of_manufacture" => "China", "price" => 150],
    ["id" => 5, "name" => "Shoes", "country_of_manufacture" => "Italy", "price" => 4500],
);

function showTable($list_of_products)
{
    $table = "<table>";
    $table .= "<tr></tr>";
    foreach (array_keys($list_of_products[1]) as $key) {
        $table .=
            "<th style='border: 1px; border-style: solid'>$key</th>";
    }

    session_start();

    foreach ($list_of_products as $product) {
        $table .= "<tr></tr>";

        foreach ($product as $value) {
            $table .=
                "<td style='border: 1px; border-style: solid'>$value</td>";
        }
    }
    echo $table;
}

function filterByPrice($price, $arr)
{
    $newArr = [];
    foreach ($arr as $item) {
        if ($item['price'] <= $price) {
            array_push($newArr, $item);
        }
    }
    return $newArr;
}

function getProductsByPrice($list_of_products)
{
    $table = "<table>";
    $table .= "<tr></tr>";
    foreach (array_keys($list_of_products[1]) as $key) {
        $table .=
            "<th style='border: 1px; border-style: solid'>$key</th>";
    }
    foreach ($list_of_products as $product) {
        if (($product["price"] >= $_POST["price"])) {
            $table .= "<tr></tr>";
            foreach ($product as $value) {
                $table .= '<td style="border:1px;border-style: solid;">' . $value . '</td>';
            }
        }
    }
    echo $table;
}

?>

<?php
showTable($list_of_products) ?>

<?php
if (isset($_POST["getByPrice"])): ?>
    <?= getproductsByprice($list_of_products) ?>
<?php
endif; ?>

<form method="post">

    <label> Price:<br>
        <input type='number' name='price'><br><br>

        <button name="getByPrice" type="submit">button</button>
</form>
