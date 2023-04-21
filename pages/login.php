
<form action="index.php?page=5" method="POST">
    <div class="container text-center py-5">
        <div class="row m-3 ms-5">
            <div class="col-xs-8 col-sm-8 col-md-6 col-lg-4">
                <input class="form-control m-2" type="text" id="login" name="userLogin" placeholder="Login" required="required" />
                <input class="form-control m-2" type="password" id="password1" name="password" placeholder="Password" required="required" />
                <input class="btn btn-primary m-2 w-50" type="submit" name="login" value="Login" />
                <p>Don't have an account?<a href="../index.php?page=3"> Register here</a></p>
            </div>
        </div>
    </div>
</form>

<?php 
if(isset($_POST['login'])){
    $login = $_POST['userLogin'];
    $pass = $_POST['password'];    
    if($logged =Tools::login($login, $pass))
    {
        header("Location: index.php?page=1");
    }    
}
?>
