
    <form action="index.php?page=1" method="POST" enctype="multipart/form-data">
        <div class="container text-center py-5">
            <div class="row m-3 ms-5">
                <div class="col-xs-8 col-sm-8 col-md-6 col-lg-4">
                    <input class="form-control m-2" type="text" id="login" name="login" placeholder="Login" required="required" />
                    <input class="form-control m-2" type="password" id="password1" name="password1" placeholder="Password" required="required" />
                    <input class="form-control m-2" type="password" id="password2" name="password2" placeholder="Password again" required="required" />
                    <input class="form-control m-2" type="file" id="avatar" name="avatar" placeholder="Avatar" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="66214400">
                    <input class="btn btn-primary m-2 w-50" type="submit" name="register" value="Register" />
                </div>
            </div>
        </div>
    </form>

<?php
if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $login = trim($login);

    $password1 = $_POST['password1'];
    $password1 = trim($password1);

    $password2 = $_POST['password2'];
    $password2 = trim($password2);

    if ($password1 !== $password2) {
        echo '<div>Password is incorrect</div>';
        exit();
    }
    
    if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
        $path = "images/" . $_FILES['avatar']['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
        Tools::createUser($login, $password1, $path);
    }
}
?>
