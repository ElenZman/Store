<?php

class Item
{

    public $id;
    public $catid;
    public $imagepath;
    public $info;
    public $itemname;
    public $pricein;
    public $pricesale;
    public $rate;
    public $action;
    function __construct($itemname, $catid, $pricein, $pricesale, $info, $imagepath, $rate = 0, $action = 0, $id = 0)
    {

        $this->catid = $catid;
        $this->imagepath = $imagepath;
        $this->info = $info;
        $this->itemname = $itemname;
        $this->pricein = $pricein;
        $this->pricesale = $pricesale;
        $this->rate = $rate;
        $this->action = $action;
        $this->id = $id;
    }

    function Add()
    {
        try {
            $pdo = Tools::connect();
            $insert = $pdo->prepare("insert into items (itemname, catid, pricein, info, imagepath, rate, action,pricesale)
    values 
    (:itemname, :catid, :pricein,  :info, :imagepath, :rate, :action,:pricesale);");

            $ar = (array)$this;
            array_shift($ar);
            $insert->execute($ar);
        } catch (PDOException $ex) {
            $message = $ex->getMessage();
            echo "<script> alert('Oops, something went wrong! " . $message . ")</script>";
            return false;
        }
    }
    static function Show($id)
    {
        $item = null;
        try {
            $pdo = Tools::connect();
            $ps = $pdo->prepare("select * from  Items where id =?");
            $ps->execute(array($id));
            $row = $ps->fetch();
            $customer = new Item(
                $row['itemname'],
                $row['catid'],
                $row['pricein'],
                $row['pricesale'],
                $row['info'],
                $row['imagepath'],
                $row['rate'],
                $row['action'],
                $row['id']
            );
            return $customer;
        } catch (PDOException $ex) {
            echo "Oops! something went wrong!" . $ex->getMessage();
            return false;
        }
    }

    static function GetItems($catid = 0)
    {

        $items = null;
        try {
            $pdo = Tools::connect();
            if ($catid == 0) {

                $select = $pdo->prepare("select * from items;");
                $select->execute();
            } else {
                $select = $pdo->prepare("select * from items where catid =?;");
                $select->execute(array($catid));
            }
            while ($row = $select->fetch()) {
                // $item = new Item(
                // $row['itemname'],
                //  $row['catid'],
                //  $row['pricein'],
                // $row['pricesale'],
                // $row['info'],
                // $row['imagepath'],
                // $row['rate'],
                // $row['action'],
                // $row['id']
                // );
                $item = Item::Show($row['id']);
                $items[] = $item;
            }
            return $items;
        } catch (PDOException $ex) {
            echo "OOops! Something went wrong!" . $ex->getMessage();
            return false;
        }
    }
    function Draw()
    {
        //card!

        echo '<div id="card" class="col-sm-8 col-md-6 col-lg-3 d-flex flex-column mb-5">';
        //itemInfo.php contains detailed info about product
        echo "<div class='text-center p-1' style='background-color: #2c786c; height: fit-content'>";

        echo "<a style='color: #f0f8ff;' href='index.php?page=7&itemid=" . $this->id . "' target='_blank'>" . $this->itemname . "</a>";
        echo "<p>" . $this->rate . "&nbsp;rate</p>";
        echo '</div>';


        echo "<div style='width: 100%; height='150px'>";
        echo "<img class='d-block m-auto my-3' src='" . $this->imagepath . "' style='width: 65%; height: 150px;'/>";
        echo "<p class='m-2 me-3' style='float: right; color:red; font-size:14pt;'>$&nbsp;" . $this->pricesale . "</p>";
        echo "</div>";

        echo "<div style='padding: 3%; background-color:lightblue; height:60px;'>";
        echo "<p class='text-truncate'>" . $this->info . "</p>";
        echo "</div>";


        //creating cookies for the cart
        //will be explained later
        $ruser = '';
        if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
            $ruser = "cart";
        } else {
            $ruser = $_SESSION['user'];
        }
       
        echo "<button class='my-1 btn btn-success' onclick=createCookie('".$ruser."',$this->id)>
        Add To My Cart</button>";

        echo '</div>';
    }

    function DrawCart()
    {
        echo '<div class="row" style="margin:2px;">';
        echo '<img src="' . $this->imagepath . '"width="100" height="100" class="col-sm-2 col-md-2 col-lg-2">';
        echo "<span style='margin-right:10px; background-color:#ddeeaa; color:blue; font-size:16pt;' class='col-sm-3 col-md-3 col-lg-3'>";
        echo "$&nbsp;" . $this->pricesale;
        echo "</span>";
        $ruser = "";
        if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
            $ruser = "cart". "_" . $this->id;;
        } else {
            $ruser = $_SESSION['user'] . "_" . $this->id;
        }
        echo "<button class='btn btn-danger col-1' style='margin-left:10px;'
        onclick=eraseCookie('$ruser',$this->id)>x</button>";

        echo "</div>";
    }

    function Sale()
    {
        try {
            $pdo = Tools::connect();
            $ruser = 'cart';
            if (isset($_SESSION['user']) && $_SESSION['user'] != "") {
                $ruser = $_SESSION['user'];
            }
            $sql = "update Customers set total = total+? where login =?";
            $ps = $pdo->prepare($sql);
            $ps->execute(array($this->pricesale, $ruser));

            $ins = "insert into Sales(customername, itemname, pricein, pricesale, datesale) values (?,?,?,?,?)";
            $ps = $pdo->prepare($ins);
            $ps->execute(array($ruser, $this->itemname, $this->pricein, $this->pricesale, @date("Y/m/d H:i:s")));
            //Допиши метод
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>

<script>
    function createCookie(userName, id) {
        alert('i got here');
        let date = new Date(new Date().getTime() + 60 * 1000 * 30);
         document.cookie = userName + "_" + id + "; path=/;expires=" + date.toUTCString();
         let d=document.cookie;
         alert(d);
           
    

    }
</script>