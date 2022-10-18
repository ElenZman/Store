<?php 
foreach (glob("../classes/*.php") as $filename) {
    include_once $filename;
}


$cat = $_POST['cat'];
$pdo = Tools::connect();
$items = Item::GetItems($cat);
if($items == null) exit();

foreach($items as $item)
{
    $item->Draw();
}

?>