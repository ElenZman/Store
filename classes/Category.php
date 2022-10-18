<?php 

class Category{
    public $id;
    public $name;

    function __construct($name, $id = 0)
    {
        $this->id = $id;
        $this->name = $name;
       
    }
    function Add()
    {
        try {
            $pdo = Tools::connect();
            $category =$this->name;
            $insert = $pdo->prepare("insert into categories (category) values (:category);");

            $insert->execute(['category'=>$category]);
            return true;
        } catch (PDOException $ex) {
            $message = $ex->getMessage();
            echo "<script> alert('Oops, something went wrong! ".$message.")</script>";
    
            return false;
        }
    }


}
?>