<?php

session_start();
unset($_SESSION['id_eleitor']);
session_destroy();
header("Location: login.php");

?>