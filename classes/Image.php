<?php 
class Image{

    public $id;
    public $imagepath;
    public $itemid;

    function __construct($imagepath, $itemid, $id = 0)
    {
        $this->id = $id;
        $this->imagepath = $imagepath;
        $this->itemid = $itemid;
       
    }
    function Add()
    {
        try {
            $pdo = Tools::connect();
            $imagepath=$this->imagepath;
            $itemid =$this->itemid;
            $insert = $pdo->prepare("insert into images (imagepath, itemid) values (:imagepath, :itemid);");
           $insert->execute(['imagepath'=>$imagepath, 'itemid'=>$itemid]);
           
           
        } catch (PDOException $ex) {
            $message = $ex->getMessage();
            echo "<script> alert('Oops, something went wrong! ".$message.")</script>";
    
            return false;
        }
    }




}

?>