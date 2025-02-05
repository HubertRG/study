<?php
require_once '../class/Page.php';
require_once '../class/AdminOrderTable.php';
require_once '../class/AdminQuestionTable.php';
require_once '../class/AdminUserTable.php';

$pageTitle = "Panel Administratora";

$pg = new Page($pageTitle);

if ($pg->isAdmin()) {
    $pg->getHeader();
    $pg->getNavbar();
    $pg->getPageHeader();
    $db = $pg->getDb();
    $aut = new AdminUserTable($db);
    $aot = new AdminOrderTable($db);
    $aqt = new AdminQuestionTable($db);
    $pg->getFooter();
} else {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}