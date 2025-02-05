<?php
require_once '../class/Page.php';
require_once '../class/UserUpdate.php';

$pageTitle = "Edycja Użytkownika";
$pg = new Page($pageTitle);

$db = $pg->getDb();
$loggedInUserId = $pg->getUserId();

//Check if any user is logged-in, the user id was sent in the url, if the currently logged-in user wants to update his data and if the data was correctly selected from the database
$userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
$sql = "SELECT fullName, userName, email, phonenumber 
        FROM users 
        WHERE id = $userId";
$fields = ['fullName', 'userName', 'email', 'phonenumber'];
$result = $db->select($sql, $fields);
if (!$pg->isLoggedIn() || !$userId || $loggedInUserId != $userId || !$result) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

$userData = $result[0];

$pg->getHeader();

$pg->getNavbar();

echo "<div class=\"container-fluid page-header py-6 wow fadeIn\" data-wow-delay=\"0.1s\">
            <div class=\"container text-center pt-5 pb-3\">";

$uu = new UserUpdate();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $updateResult = $uu->updateUser($userId, $db);

    if ($updateResult) {
        $_SESSION['user_update'] = true;
        if (!headers_sent()) {
            header("Location: ../views/orders.php");
        } else {
            echo "<script>window.location.href = '../views/orders.php';</script>";
        }
        exit();
    }
}

$uu->displayForm($userData);

echo "</div></div>";

$pg->getFooter();

