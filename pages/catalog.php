<form action="index.php?page=1" method="post">
    <div class="row w-50" style="margin: 50px;">
        <select class="pull-right form-select"  name="catid" onchange="getItemsCat(this.value)">
            <option value="0">Select category...</option>

            <?php
            $pdo = Tools::connect();
            $ps = $pdo->prepare("select * from categories");
            $ps->execute();
            while ($row = $ps->fetch()) {
                echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
            }
            ?>
        </select>
    </div>
   <?php  
   echo '<div id="card-container" class="row m-auto justify-content-between d-flex flex-wrap" style="width: 80%; height: fit-content;">';  
    $items = Item::GetItems();
    foreach ($items as $item) {
        $item->Draw();
    }
    echo '</div>';  
    ?>
</form>

<script>
    function getItemsCat(cat) {            
        if (cat == "") {
           //здесь был 'result' 
            document.getElementById('card-container').innerHTML = "";
        }
        if (window.XMLHttpRequest) {
            ao = new XMLHttpRequest();
        } else {
            ao = new ActiveXObject('Microsoft.XMLHTTP');
        }
        ao.onreadystatechange = function() {
            if (ao.readyState == 4 && ao.status == 200) {
                document.getElementById('card-container').innerHTML = ao.responseText;
            }
        }
        ao.open('post', 'pages/lists.php', true);
        ao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ao.send("cat=" + cat);
    }

    function createCookie(userName, id)
    {
       let date =new Date(new Date().getTime() + 60*1000*30);
       document.cookie = userName + "_" +id+ "; path=/;expires="+ date.toUTCString();    
    }
</script>
