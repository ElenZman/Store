<?php
unset($_SESSION["id"]);
unset($_SESSION["user"]);
header("Location: index.php?page=1");
?>
