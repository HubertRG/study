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
                                <h2 class="fw-bold mb-2 text-uppercase" style="color: white">Czy na pewno chcesz usunąć
                                    to
                                    zamówienie?</h2>
                                <p>Tej operacji nie można cofnąć.</p>
                                <div class="d-flex justify-content-around mt-4">
                                    <a href="deleteOrder.php?order_id=<?php echo $orderId; ?>" class="btn btn-danger">Tak,
                                        usuń</a>
                                    <?php if ($pg->isAdmin()): ?>
                                        <a href="../views/admin.php" class="btn btn-secondary">Nie, powrót</a>
                                    <?php else: ?>
                                        <a href="../views/orders.php" class="btn btn-secondary">Nie, powrót</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $pg->getFooter(); ?>

