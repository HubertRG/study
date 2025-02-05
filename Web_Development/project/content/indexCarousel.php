<?php
require_once '../class/Baza.php';
require_once '../class/UserManager.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sessionId = session_id();
$db = new Baza("localhost", "root", "", "project");
$um = new UserManager();
$userId = $um->getLoggedInUser($db, $sessionId);
if ($userId != -1) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}
?>
<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="../img/carousel-1.jpg" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-8">
                            <p class="text-primary text-uppercase fw-bold mb-2">//NAJLEPSZA PIEKARNIA W LUBLINIE</p>
                            <h1 class="display-1 text-light mb-4 animated slideInDown">Wypieki To Nasza Pasja</h1>
                            <p class="text-light fs-5 mb-4 pb-3">Nasza piekarnia oferuje świeże pieczywo i pyszne
                                wypieki każdego dnia. Jak również specjalne torty na każdą okazję dla
                                zarejestrowanych klientów. </p>
                            <?php
                            if ($isLoggedIn) {
                                echo "<a href=\"../views/orders.php\" class=\"btn btn-primary rounded-pill py-3 px-5\">Zamów już teraz!</a>";
                            } else {
                                echo "<a href=\"../views/register.php\" class=\"btn btn-primary rounded-pill py-3 px-5\">Załóż konto już teraz!</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->
