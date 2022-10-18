<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid w-100">
        <a class="navbar-brand" href="#">Navigation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item px-3">
                    <a class="nav-link active" aria-current="page" href="../index.php?page=1">Catalog</a>
                </li>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) : ?>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../index.php?page=2">Admin</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item px-3">
                    <a class="nav-link" href="../index.php?page=3">#</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="../index.php?page=4"><img src="../images/shopping-cart.png" alt="shopping cart image" style="width: 20px; height: 20px;">&nbspCart</a>
                </li>
                <?php if (isset($_SESSION['id']) and isset($_SESSION['user'])) : ?>
                    <li class="nav-item d-flex px-3">
                        <span class="navbar-text">Hello,&nbsp<?php echo $_SESSION['user']?>!</span><a class="nav-link" href="index.php?page=6"><img src="../images/logout.png" alt="logout icon" style="width: 20px; height: 20px;">Logout</a>
                    </li>
                  
                    <?php else:?>

                    <li class="nav-item px-3s">
                        <a class="nav-link" href="../index.php?page=5"><img src="../images/user.png" alt="user icon" style="width: 20px; height: 20px;">&nbsp Login</a>
                    </li>
                    
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php
