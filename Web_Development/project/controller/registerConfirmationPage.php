<?php
require_once '../class/Page.php';

$pageTitle = "Potwierdzenie";
$pg = new Page($pageTitle);

//Check if the variable after a successful registration was set
if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {

    $pg->getHeader();

    $pg->getNavbar();

    $pg->getContent("registerConfirmWindow");

    unset($_SESSION['registration_success']);

    $pg->getFooter();
} else {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

