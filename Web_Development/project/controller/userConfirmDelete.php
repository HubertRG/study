<?php
require_once '../class/Page.php';

$pageTitle = "Potwierdzenie usunięcia";
$pg = new Page($pageTitle);

//Check if any user is logged-in, the user id was sent in the url and if the currently logged-in user or the admin wants to delete the account
$userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
$currentUserId = $pg->getUserId();
if (!$pg->isLoggedIn() || !$userId || (!$pg->isAdmin() && $userId != $currentUserId)) {
    if (!headers_sent()) {
        header("Location: ../views/index.php");
    } else {
        echo "<script>window.location.href = '../views/index.php';</script>";
    }
    exit();
}

//Check if user has no placed orders
$db = $pg->getDb();
$sqlCheckOrder = "SELECT COUNT(*) AS count FROM orders WHERE user_id = $userId";
$fieldsCheckOrder = ['count'];
$resultCheckOrder = $db->select($sqlCheckOrder, $fieldsCheckOrder);
if ($resultCheckOrder[0]['count'] != 0) {
    $noOrders = false;
} else {
    $noOrders = true;
}

$pg->getHeader();

?>
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <?php if ($noOrders): ?>
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color: white">Czy na pewno chcesz
                                        usunąć
                                        konto?</h2>
                                    <p>Tej operacji nie można cofnąć. Wiadomość z potwierdzeniem usunięcia konta
                                        otrzymasz na adres
                                        e-mail.</p>
                                    <div class="d-flex justify-content-around mt-4">
                                        <a href="deleteUser.php?user_id=<?php echo $userId; ?>" class="btn btn-danger">Usuń</a>
                                        <a href="../views/index.php" class="btn btn-secondary">Powrót</a>
                                    </div>
                                <?php else: ?>
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color: white">Na tym koncie są
                                        złożone jakieś
                                        zamówienia</h2>
                                    <p>Na koncie do usunięcia nie mogą być złożone żadne zamówienia.</p>
                                    <?php if ($pg->isAdmin()): ?>
                                        <div class="d-flex justify-content-around mt-4">
                                            <a href="../views/admin.php" class="btn btn-secondary">Powrót do panelu</a>
                                        </div>
                                    <?php else: ?>
                                        <div class="d-flex justify-content-around mt-4">
                                            <a href="../views/orders.php" class="btn btn-secondary">Powrót do
                                                zamówień</a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $pg->getFooter(); ?>


