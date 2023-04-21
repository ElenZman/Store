<?php
echo '<form action="index.php?page=4" method="post">';
$ruser = "";
if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
    $ruser = "cart";
} else {
    $ruser = $_SESSION['user'];
}

$total;   
foreach ($_COOKIE as $k => $v) {
    $pos = strpos($k, "_");
    if (substr($k, 0, $pos) == $ruser) {
        $id = substr($k, $pos + 1);
        $item = Item::Show($id);
        $total += $item->pricesale;
        $item->DrawCart();
    }
}
echo '<hr/>';
echo "<span>Total cost is: </span> <span>" . $total . "</span>";
echo '<button type="submit" class="btn btn-success" name="buy" style="margin-left:"150px";>Buy</button>';
echo '</form>';

if (isset($_POST['buy'])) {
    foreach ($_COOKIE as $k => $v) {
        $pos = strpos($k, "_");
        if (substr($k, 0, $pos) == $ruser) {
            $id = substr($k, $pos + 1);
            $item = Item::Show($id);
            $item->Sale();
            $total-=$item->pricesale;
        }
    }
    echo "<script>";
    echo "function DeleteAll(uname){";
?>

    let array = document.cookie.split(';');
    for (let i =1; i<=array.length; i++) { 
        if(array[i-1].indexOf(uname)===1)
         { 
            let theCookie = array[i-1].split('_');
            let date  = new Date(new Date().getTime()-60000);
            document.cookie = theCookie[0]+"=id; path=/; expires=" + date.toUTCString();
         }
    }
}

<?php
    echo "DeleteAll('$ruser');";
    echo "window.location = document.URL;";
    echo "</script>";
}
?>
                                   
<script>
     function createCookie(userName, id)
    {
        let date =new Date(new Date().getTime() + 60*1000*30);
        document.cookie = userName + "_" +id+ "; path=/;expires="+ date.toUTCString(); 
    }

    function eraseCookie(userName)
    {
        let array = document.cookie.split(';');
       for (let i=1; i<=array.length; i++)
       {
        if(array[i-1].indexOf(userName)===1)
        {
            let theCookie=array[i-1].split('_');
            let date  = new Date(new Date().getTime()-60000);
            document.cookie = theCookie[0]+"=id; path=/; expires=" + date.toUTCString();
        }
       }
    }
    </script>
