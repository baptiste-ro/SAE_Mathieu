<?php

session_start();
session_unset();
session_write_close();
if(!isset($_SESSION["connecté"])){
    header("Location: ../index.php");
}
else {
    echo($_SESSION["connecté"]);
}
