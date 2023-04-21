<?php
if (isset($_GET['itemid'])) {
    $id = $_GET['itemid'];
    $item = Item::Show($id);
} else {
    echo "<h3>Sorry! The item was not found</h3>";
}

if (isset($_SESSION['user'])) {
    $ruser = $_SESSION['user'];
} else {
    $ruser = "cart";
}
?>

<div class="row border border-danger m-5">
    <div class="col-sm-12 col-md-8 col-lg-6 border border-dark">
    <div class="row"><h3><?php echo $item->itemname ?></h3></div>
    <div class="row d-flex align-self-center">
        <?php
        if ($item->rate == 0) {
            for ($i = 0; $i < 5; $i++) {
                echo '<img style="width:40px;" src="/images/star-32.png" alt="star">';
            }
        } else {
            for ($i = 0; $i < $stars; $i++) {
                echo '<img style="width:25px; height:25px;" src="/images/star.png" alt="star">';
            }
        }
        ?>
    </div>
    <div class="row py-5">
        <div id="carousel"  style="min-height: 200px; min-width: 300px; height: 300px;">
            <div id="carouselExampleControls" class="carousel slide m-auto" data-bs-ride="carousel">
                <div class="carousel-inner text-center">
                    <?php
                    $res = makeSlides($item->id);
                    echo $res;
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" style="background-color: grey;" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" style="background-color: grey;" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <p><?php echo "$" . $item->pricesale ?></p>

        <form action=""  method="GET">           
            <button type="submit" class="btn btn-success" onclick="createCookie(<?php echo $ruser ?>, <?php echo $item->id ?>)">Add to cart</button>
        </form>
    </div>
    </div>
</div>

<?php
function makeSlides($id)
{
    $output = '';
    $counter = 0;
    $pdo = Tools::connect();
    $ps = $pdo->prepare('select imagepath from images where itemid=' . $id . ';');
    $ps->execute();
    while ($row = $ps->fetch()) {
        if ($counter == 0) {
            $output .= '<div class="carousel-item active">';
        } else {
            $output .= '<div class="carousel-item">';
        }
        $output .= '<img style="height: 300px;" src="../' . $row['imagepath'] . '"></div>';
        $counter++;
    }
    return $output;
}
?>
