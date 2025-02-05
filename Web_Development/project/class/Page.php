<?php

require_once '../class/Baza.php';
require_once '../class/User.php';
require_once '../class/UserManager.php';

class Page
{
    protected $pageTitle;
    protected $isLoggedIn;
    protected $fullName;
    protected $userId;
    protected $db;
    protected $um;

    public function __construct($pageTitle)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $sessionId = session_id();
        $db = new Baza("localhost", "root", "", "project");
        $um = new UserManager();
        $userId = $um->getLoggedInUser($db, $sessionId);
        if ($userId != -1) {
            $this->fullName = $um->getUserFullName($db, $userId);
            $this->isLoggedIn = true;
        } else {
            $this->fullName = "Załóż konto";
            $this->isLoggedIn = false;
        }
        $this->pageTitle = $pageTitle;
        $this->userId = $userId;
        $this->db = $db;
        $this->um = $um;
    }

    public function isAdmin(): bool
    {
        $sql = "SELECT status 
            FROM users
            WHERE id = $this->userId";

        $fields = ['status'];

        $result = $this->db->select($sql, $fields);

        $status = $result[0]['status'];

        if ($status == User::STATUS_ADMIN) {
            return true;
        } else {
            return false;
        }
    }

    public function getPageTitle()
    {
        return $this->pageTitle;
    }


    public function setPageTitle($pageTitle): void
    {
        $this->pageTitle = $pageTitle;
    }

    public function isLoggedIn(): bool
    {
        return $this->isLoggedIn;
    }

    public function setIsLoggedIn(bool $isLoggedIn): void
    {
        $this->isLoggedIn = $isLoggedIn;
    }

    public function getFullName()
    {
        return $this->fullName;
    }


    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getDb(): Baza
    {
        return $this->db;
    }

    public function setDb(Baza $db): void
    {
        $this->db = $db;
    }

    public function getUm(): UserManager
    {
        return $this->um;
    }

    public function setUm(UserManager $um): void
    {
        $this->um = $um;
    }

    public function getNavbar()
    {
        $activePage = strtolower($this->pageTitle);
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn justify-content-center"
             data-wow-delay="0.1s">
            <a href="../views/index.php" class="navbar-brand ms-4 ms-lg-0">
                <h2 class="text-primary m-0">Ekstrakt</h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto p-4 p-lg-0 justify-content-center">
                    <a href="../views/index.php"
                       class="nav-item nav-link <?= $activePage === 'strona główna' ? 'active' : '' ?>">Strona
                        główna</a>
                    <a href="../views/product.php"
                       class="nav-item nav-link <?= $activePage === 'oferta' ? 'active' : '' ?>">Oferta</a>
                    <?php if ($this->isLoggedIn): ?>
                        <?php if ($this->isAdmin()): ?>
                            <a href="../views/admin.php"
                               class="nav-item nav-link <?= $activePage === 'panel administratora' ? 'active' : '' ?>">Panel
                                administratora</a>
                        <?php else: ?>
                            <a href="../views/orders.php"
                               class="nav-item nav-link <?= $activePage === 'zamówienia' ? 'active' : '' ?>">Zamówienia</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="../views/register.php"
                           class="nav-item nav-link <?= $activePage === 'rejestracja' ? 'active' : '' ?>">Rejestracja</a>
                    <?php endif; ?>
                    <a href="../views/contact.php"
                       class="nav-item nav-link <?= $activePage === 'kontakt' ? 'active' : '' ?>">Kontakt</a>
                </div>
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav d-flex flex-row align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if ($this->isLoggedIn): ?>
                                    <?php if ($this->isAdmin()): ?>
                                        <li><a class="dropdown-item" href="../views/admin.php">Panel administratora</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../views/login.php?akcja=wyloguj">Wyloguj</a>
                                        </li>
                                    <?php else: ?>
                                        <li><a class="dropdown-item" href="../views/orders.php">Moje zamówienia</a></li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="../controller/userConfirmDelete.php?user_id=<?php echo $this->userId; ?>">Usuń
                                                konto</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="../controller/updateUser.php?user_id=<?php echo $this->userId; ?>">Edytuj
                                                dane</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="../controller/changePassword.php?user_id=<?php echo $this->userId; ?>">Zmień
                                                hasło</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider"/>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../views/login.php?akcja=wyloguj">Wyloguj</a>
                                        </li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="../views/login.php">Logowanie</a></li>
                                    <li><a class="dropdown-item" href="../views/register.php">Rejestracja</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                    <div class="ps-3 d-none d-lg-block">
                        <?php echo "<p class=\"text-light fs-5 mb-0 align-middle\">$this->fullName</p>" ?>
                    </div>
                </div>
            </div>
        </nav>
        <?php
    }

    public function getHeader()
    {
        ?>
        <!DOCTYPE html>
        <html lang="pl">

        <head>
            <meta charset="utf-8">
            <title><?php echo htmlspecialchars($this->pageTitle); ?></title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta content="" name="keywords">
            <meta content="" name="description">

            <!-- Favicon -->
            <link href="../img/favicon.ico" rel="icon">

            <!-- Google Web Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap"
                  rel="stylesheet">

            <!-- Icon Font Stylesheet -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

            <!-- Libraries Stylesheet -->
            <link href="../lib/animate/animate.min.css" rel="stylesheet">
            <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

            <!-- Customized Bootstrap Stylesheet -->
            <link href="../css/bootstrap.min.css" rel="stylesheet">

            <!-- Template Stylesheet -->
            <link href="../css/style.css" rel="stylesheet">
        </head>

        <body>

        <div id="spinner"
             class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <?php
    }

    public function getFooter()
    {
        ?>
        <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-4">
                        <h4 class="text-light mb-4">Znajdź Nas Tutaj</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Nadbystrzycka 38a, Lublin, PL</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>534 345 678</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>kontakt@ekstrakt.pl</p>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h4 class="text-light mb-4">Szybkie Łącza</h4>
                        <a class="btn btn-link" href="../views/index.php">Strona główna</a>
                        <a class="btn btn-link" href="../views/product.php">Oferta</a>
                        <?php if ($this->isLoggedIn): ?>
                            <?php if ($this->isAdmin()): ?>
                                <a class="btn btn-link" href="../views/admin.php">Panel administratora</a>
                            <?php else: ?>
                                <a class="btn btn-link" href="../views/orders.php">Zamówienia</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="btn btn-link" href="../views/register.php">Rejestracja</a>
                        <?php endif; ?>
                        <a class="btn btn-link" href="../views/contact.php">Kontakt</a>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h4 class="text-light mb-4">Galeria zdjęć</h4>
                        <div class="row g-2">
                            <div class="col-4">
                                <a href="../img/product-1.jpg" data-toggle="lightbox" data-gallery="galeria"><img
                                            class="img-fluid bg-light rounded p-1" src="../img/product-1.jpg"
                                            alt="Image"></a>
                            </div>
                            <div class="col-4">
                                <a href="../img/product-2.jpg" data-toggle="lightbox" data-gallery="galeria"><img
                                            class="img-fluid bg-light rounded p-1" src="../img/product-2.jpg"
                                            alt="Image"></a>
                            </div>
                            <div class="col-4">
                                <a href="../img/product-3.jpg" data-toggle="lightbox" data-gallery="galeria"><img
                                            class="img-fluid bg-light rounded p-1" src="../img/product-3.jpg"
                                            alt="Image"></a>
                            </div>
                            <div class="col-4">
                                <a href="../img/product-2.jpg" data-toggle="lightbox" data-gallery="galeria"><img
                                            class="img-fluid bg-light rounded p-1" src="../img/product-2.jpg"
                                            alt="Image"></a>
                            </div>
                            <div class="col-4">
                                <a href="../img/product-3.jpg" data-toggle="lightbox" data-gallery="galeria"><img
                                            class="img-fluid bg-light rounded p-1" src="../img/product-3.jpg"
                                            alt="Image"></a>
                            </div>
                            <div class="col-4">
                                <a href="../img/product-1.jpg" data-toggle="lightbox" data-gallery="galeria"><img
                                            class="img-fluid bg-light rounded p-1" src="../img/product-1.jpg"
                                            alt="Image"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Start -->
        <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Ekstrakt</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br>Distributed By: <a class="border-bottom" href="https://themewagon.com"
                                               target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
                    class="bi bi-arrow-up"></i></a>

        <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
        <script src="../lib/wow/wow.min.js"></script>
        <script src="../lib/easing/easing.min.js"></script>
        <script src="../lib/waypoints/waypoints.min.js"></script>
        <script src="../lib/counterup/counterup.min.js"></script>
        <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="../js/main.js"></script>

        <?php
    }

    public function getPageHeader()
    {
        ?>
        <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="container text-center pt-5 pb-3">
                <h1 class="display-4 text-white animated slideInDown mb-3"><?php echo htmlspecialchars($this->pageTitle); ?></h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a class="text-white">Strona Główna</a></li>
                        <li class="breadcrumb-item"><a class="text-white">Strony</a></li>
                        <li class="breadcrumb-item text-primary active"
                            aria-current="page"><?php echo htmlspecialchars($this->pageTitle); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <?php
    }

    public function getContent($fileName)
    {
        $file = "../content/" . $fileName . ".php";
        if (file_exists($file)) {
            include($file);
        }
    }

}