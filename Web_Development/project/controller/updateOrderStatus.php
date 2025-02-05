<?php

require_once "../class/Page.php";

$pageTitle = "Zmiana statusu";

$pg = new Page($pageTitle);

//Check if the admin is logged in
if ($pg->isAdmin()) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];

    $sql = "UPDATE orders SET status = '$newStatus' WHERE id = '$orderId'";
    if ($pg->getDb()->update($sql)) {
        $_SESSION['status_update'] = true;
    }
    if (!headers_sent()) {
        header("Location: ../views/admin.php");
    } else {
        echo "<script>window.location.href = '../views/admin.php';</script>";
    }
} else {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
}
