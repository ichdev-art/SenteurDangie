<?php
session_start();

if (!isset($_SESSION['use_id'])) {
    header('Location:  ../../index.php');
    exit();
}

include_once '../View/view_confirmation.php'
?>