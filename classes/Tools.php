<?php 
class Tools
{

    static function connect($host  = "localhost:3306", $user = "root", $pass = "1111", $dbname = "store")
    {

        $connect = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8;';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        );
        try {
            $pdo = new PDO($connect, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    static function createUser($login, $pass, $image)
    {
        if ($login == " " || $pass == "") {
            echo "<h1>Error ......</h1>";
            return false;
        }
        $obj = new Customers($login, $pass, 0, 0, $image);
        $obj->intoDb();
        return true;
    }

    static function login($login, $pass)
    {

        try {
            $connection = Tools::connect();
            $ps = $connection->prepare("select * from customers where login=? and pass=$pass");
            $ps->execute(array($login));
            $user = $ps->fetch();

            if ($user) {



                $_SESSION['id'] = $user['id'];
                $_SESSION['user'] = $user['login'];
                $_SESSION['role'] = $user['roleid'];
                return true;
            }
            else 
            {

             echo $message = "Invalid Username or Password!";  
            }

        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
}
?>