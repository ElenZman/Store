
<?php 

class Customers
{
    public $id;
    public $login;
    public $pass;
    public $total;
    public $discount;
    public $imagepath;
    public $roleid;

    function __construct($login, $pass, $total, $discount, $imagepath, $id = 0)
    {
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
        $this->total = $total;
        $this->discount = $discount;
        $this->imagepath = $imagepath;
        $this->roleid = 2;
    }

    function intoDb()
    {
        try {
            $connection = Tools::connect();
            $select = $connection->prepare("insert into Customers
        (login, pass, roleid, discount, total, imagepath)
        VALUES(:login, :pass, :roleid, :discount, :total, :imagepath);");
            $array = (array)$this;
            array_shift($array);
            $select->execute($array);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    static function fromDb($id)
    {

        $user = null;
        try {
            $connection = Tools::connect();
            $ps = $connection->prepare("select *from Customers where id=?");
            $ps->execute(array($id));
            $row = $ps->fetch();
            $user = new Customers($row['login'], $row['pass'], $row['total'], $row['discount'], $row['imagepath'], $row['id']);
            return $user;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
}
?>