<?php
require_once '../class/Page.php';
require_once '../class/PasswordChange.php';

$pageTitle = "Zmiana hasła";
$pg = new Page($pageTitle);

$loggedInUserId = $pg->getUserId();
$db = $pg->getDb();

//Check if any user is logged in, the user id was sent in the url and if the currently logged-in user wants to change his password
$userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
if (!$pg->isLoggedIn() || !$userId || $loggedInUserId != $userId) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

$pg->getHeader();

$pg->getNavbar();

$pc = new PasswordChange();

echo "<div class=\"container-fluid page-header py-6 wow fadeIn\" data-wow-delay=\"0.1s\">
        <div class=\"container text-center pt-5 pb-3\">";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $updateResult = $pc->updatePasswd($userId, $db);
    if ($updateResult) {
        $_SESSION['password_change'] = true;
        if (!headers_sent()) {
            header("Location: ../views/orders.php");
        } else {
            echo "<script>window.location.href = '../views/orders.php';</script>";
        }
        exit();
    }
}

$pc->displayForm();

echo "</div></div>";

$pg->getFooter();


