<?php
require_once '../class/Page.php';

$pageTitle = "Potwierdzenie";
$pg = new Page($pageTitle);

//Check if the variable after a successful order was set
if (isset($_SESSION['order_success']) && $_SESSION['order_success'] === true) {

    $pg->getHeader();

    $pg->getContent("orderConfirmWindow");

    unset($_SESSION['order_success']);

    $pg->getFooter();
} else {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}


