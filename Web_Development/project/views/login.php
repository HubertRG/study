<?php
require_once '../class/Page.php';

$pageTitle = "Logowanie";

$pg = new Page($pageTitle);

$pg->getHeader();

$pg->getNavbar();

$um = $pg->getUm();

$db = $pg->getDb();

echo "<div class=\"container-fluid page-header py-6 wow fadeIn\" data-wow-delay=\"0.1s\">
    <div class=\"container text-center pt-5 pb-3\">";
if (filter_input(INPUT_GET, "akcja") == "wyloguj") {
    $um->logout($db);
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}
if (filter_input(INPUT_POST, "zaloguj")) {
    $userId = $um->login($db);
    if ($userId > 0) {
        if (!headers_sent()) {
            header("Location: ../views/index.php");
        } else {
            echo "<script>window.location.href = '../views/index.php';</script>";
        }
        exit();
    } else if ($userId == -2) {
        echo "<h2 class=\"fw-bold mb-2 text-uppercase\" style=\"color: white\">Jesteś już zalogowany</h2>";
        $um->loginForm();
    } else if ($userId == -3) {
        echo "<h2 class=\"fw-bold mb-2 text-uppercase\" style=\"color: white\">Ten użytkownik jest już zalogowany w innym oknie</h2>";
        $um->loginForm();
    } else if ($userId == -4) {
        echo "<h2 class=\"fw-bold mb-2 text-uppercase\" style=\"color: white\">Inny użytkownik jest już zalogowany</h2>";
        $um->loginForm();
    } else {
        echo "<h2 class=\"fw-bold mb-2 text-uppercase\" style=\"color: white\">Błędna nazwa użytkownika lub hasło</h2>";
        $um->loginForm();
    }
} else {
    $um->loginForm();
}
echo "</div>
</div>";

$pg->getFooter();



