<?php
require_once '../class/Page.php';

$pageTitle = "Potwierdzenie usunięcia";
$pg = new Page($pageTitle);

$userId = $pg->getUserId();
$db = $pg->getDb();

//Check if any user is logged in, the order id was sent in the url and if the order's owner or the admin wants to delete it
$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;
$sqlOwn = "SELECT user_id, status FROM orders WHERE id = '$orderId'";
$fields = ['user_id', 'status'];
$result = $db->select($sqlOwn, $fields);
$owner = $result[0]['user_id'];
$status = $result[0]['status'];
if (!$pg->isLoggedIn() || !$orderId || (!$pg->isAdmin() && $owner != $userId)) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

if ($status != 'Złożone') {
    $_SESSION['status_failure'] = true;
    if ($pg->isAdmin()) {
        if (!headers_sent()) {
            header("Location: ../views/admin.php");
        } else {
            echo "<script>window.location.href = '../views/admin.php';</script>";
        }
    } else {
        if (!headers_sent()) {
            header("Location: ../views/orders.php");
        } else {
            echo "<script>window.location.href = '../views/orders.php';</script>";
        }
    }
    exit();
}

$sql = "DELETE FROM orders WHERE id = $orderId";
$db->delete($sql);

$_SESSION['delete_success'] = true;
if ($pg->isAdmin()) {
    if (!headers_sent()) {
        header("Location: ../views/admin.php");
    } else {
        echo "<script>window.location.href = '../views/admin.php';</script>";
    }
} else {
    if (!headers_sent()) {
        header("Location: ../views/orders.php");
    } else {
        echo "<script>window.location.href = '../views/orders.php';</script>";
    }
}
exit();


