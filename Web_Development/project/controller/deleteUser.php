<?php
require_once '../class/Page.php';
require_once '../class/UserManager.php';

$pageTitle = "Potwierdzenie usunięcia";
$pg = new Page($pageTitle);

$db = $pg->getDb();

//Check if any user is logged in, the user id was sent in the url and if the currently logged-in user or the admin wants to delete the account
$userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
$currentUserId = $pg->getUserId();
if (!$pg->isLoggedIn() || !$userId || (!$pg->isAdmin() && $currentUserId != $userId)) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

if (!$pg->isAdmin()) {
    $um = new UserManager();
    $um->logout($db);
}


$sql = "DELETE FROM users WHERE id = $userId";
$db->delete($sql);
if ($pg->isAdmin()) {
    $_SESSION['user_delete'] = true;
    if (!headers_sent()) {
        header("Location: ../views/admin.php");
    } else {
        echo "<script>window.location.href = '../views/admin.php';</script>";
    }
} else {
    if (!headers_sent()) {
        header("Location: ../views/login.php");
    } else {
        echo "<script>window.location.href = '../views/login.php';</script>";
    }
}
exit();

