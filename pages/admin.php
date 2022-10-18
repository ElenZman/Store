<div class="container">
    <div class="row m-5 d-flex justify-content-between">
        <div class="col-sm-12 col-md-5 col-lg-5 m-3">
            <p><b>Add items:</b></p>
            <form action="index.php?page=2" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group mb-2 w-100">
                        <label for="catid">Categories:</label></br>
                        <select class="w-100 form-select" name="catid">
                            <?php
                            $pdo = Tools::connect();
                            $list = $pdo->query("select * from categories");
                            while ($row = $list->fetch()) {
                                echo '<option value="' . $row["id"] . '">' . $row['category'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-2 w-100">
                        <label for="name">Name:</label>
                        <input type="text" class="w-100 form-control" name="name">
                    </div>
                    <div class="form-group mb-2 w-100">
                        <label for="pricein">Price in:</label>
                        <input type="number" class="w-100 form-control" name="pricein">
                    </div>
                    <div class="form-group mb-2 w-100">
                        <label for="pricein">Price sale:</label>
                        <input type="number" class="w-100 form-control" name="pricesale">
                    </div>

                    <div class="form-group mb-2 w-100">
                        <label for="info">Information:</label>
                        <div>
                            <textarea class="w-100 form-control" name="info"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-2 w-100">
                        <label for="imagepath">Image:</label>
                        <input type="file" class="w-100 form-control" name="imagepath">
                        <button type="submit" class="btn btn-primary w-50 my-3 form-control" name="add">Add Item</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-5 m-3">
            <div class="row">
                <form action="index.php?page=2" method="POST">
                    <p><b>Add categories:</b></p>
                    <div class="form-group mb-2 w-100">
                        <label for="category">Type new category:</label>
                        <input type="text" class="form-control" name="category">
                        <button type="submit" class="btn btn-primary w-50 my-3 form-control" name="addCategory">Add Category</button>
                    </div>
                </form>
            </div>
            <div class="row d-flex">
                <form action="index.php?page=2" method="POST" enctype="multipart/form-data">
                    <p><b>Add images:</b></p>
                    <div class="form-group mb-2 w-100">
                    <label for="catidForImg">Items:</label></br>
                        <select class="w-100 form-select mb-2" name="catidForImg">
                            <?php
                            $pdo = Tools::connect();
                            $list = $pdo->query("select * from items");
                            while ($row = $list->fetch()) {
                                echo '<option value="' . $row["id"] . '">' . $row['itemname'] . '</option>';
                            }
                            ?>
                        </select>
                        <input type="file" class="w-100 form-control mb-2s" name="files[]" multiple accept="image/*">
                        <button type="submit" class="btn btn-primary w-50 my-3 form-control" name="addImages">Add Images</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['add'])) {
    $path = "";
    if (is_uploaded_file($_FILES['imagepath']['tmp_name'])) {
        $path = "images/" . $_FILES['imagepath']['name'];
        move_uploaded_file($_FILES['imagepath']['tmp_name'], $path);
    }
    $catid = $_POST['catid'];
    $pricein = $_POST['pricein'];
    $pricesale = $_POST['pricesale'];
    $name = trim(htmlspecialchars($_POST['name']));
    $info = trim(htmlspecialchars($_POST['info']));
    $item = new Item($name, $catid, $pricein, $pricesale, $info, $path);
    if ($success = $item->Add()) {
        echo  "<script>alert('Item is added successfully'); </script>";
    }
}

if (isset($_POST['addCategory'])) {

    $categoryName = trim(htmlspecialchars($_POST['category']));
    $category = new Category($categoryName);

    if ($success = $category->Add()) {
        echo  "<script>alert('Item is added successfully'); </script>";
    }
}

if (isset($_POST['addImages'])) {
   
    $itemid=$_POST['catidForImg'];
    
    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
        $temp = $_FILES["files"]["tmp_name"][$key];
        $name = $_FILES["files"]["name"][$key];
        $uploadFolder = "images";
    

        if (empty($temp)) {
            break;
        }

         if(move_uploaded_file($temp, $uploadFolder . "/" . $name))
         {
            $counter++;

         }
          
         //Adding to database
         $imagepath = $uploadFolder . "/" . $name;
         $img= new Image($imagepath, $itemid);
         $img->Add();
        
    }
echo "<script>alert(".$counter."images were uploded)</script>";
   
}
?>