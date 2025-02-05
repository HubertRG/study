<?php
require_once '../class/Page.php';
require_once '../class/RegistrationForm.php';

$pageTitle = "Rejestracja";

$pg = new Page($pageTitle);

$pg->getHeader();

$pg->getNavbar();

$db = $pg->getDb();

echo "<div class=\"container-fluid page-header py-6 wow fadeIn\" data-wow-delay=\"0.1s\">
            <div class=\"container text-center pt-5 pb-3\">";

$rf = new RegistrationForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $rf->checkUser($db);
    if ($user !== NULL) {
        $user->saveDB($db);
        $_SESSION['registration_success'] = true;
        if (!headers_sent()) {
            header("Location: ../controller/registerConfirmationPage.php");
        } else {
            echo "<script>window.location.href = '../controller/registerConfirmationPage.php';</script>";
        }
        exit();
    }

}

$rf->displayForm();

echo "</div></div>";

$pg->getFooter();

