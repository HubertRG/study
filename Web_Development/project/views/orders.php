<?php
require_once '../class/Page.php';
require_once '../class/OrderForm.php';
require_once '../class/OrderTable.php';
require_once '../class/UserData.php';

$pageTitle = "Zamówienia";

$pg = new Page($pageTitle);

//Check if any user is logged-in
if (!$pg->isLoggedIn()) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

$pg->getHeader();

$pg->getNavbar();

$pg->getPageHeader();

$db = $pg->getDb();

$userId = $pg->getUserId();

if (!$pg->isAdmin()) {
    $ud = new UserData($userId, $db);
}

$of = new OrderForm();
$pg->getContent("orderPriceCalculator");
$of->generateOrderForm();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order = $of->checkOrder($userId);
    if ($order === NULL) {
        echo "<div class=\"container-xxl py-6\">
                    <div class=\"text-center mx-auto mb-5 wow fadeInUp\" data-wow-delay=\"0.1s\" style=\"max-width: 500px;\">
                        <h1 class=\"display-6 mb-4\" style='color: black'>Nie udało się złożyć zamówienia</h1>
                    </div>
                   </div>";
    } else {
        $order->saveToDB($db);
        $_SESSION['order_success'] = true;
        if (!headers_sent()) {
            header("Location: ../controller/orderConfirmationPage.php");
        } else {
            echo "<script>window.location.href = '../controller/orderConfirmationPage.php';</script>";
        }
        exit();
    }

}

$ot = new OrderTable($db, $userId);
$pg->getContent("orderFilter");

$pg->getFooter();



