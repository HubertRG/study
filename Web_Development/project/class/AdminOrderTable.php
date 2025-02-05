<?php
require_once '../class/Order.php';

class AdminOrderTable
{
    protected $db;

    public function __construct($db)
    { ?>
        <div id="admin_order_table" class="container-xxl py-6">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Wszystkie Zamówienia</h1>
            </div>
            <div id="ordersTable" class="col-md-12 table-responsive">
                <table class="table table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>ID Użytkownika</th>
                        <th>Data złożenia zamówienia</th>
                        <th>Smak</th>
                        <th>Dodatki</th>
                        <th>Okazja</th>
                        <th>Waga</th>
                        <th>Tekst na Torcie</th>
                        <th>Cena</th>
                        <th>Status</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                    <?php
                    $data = Order::getAllOrdersForAdmin($db);
                    if (!empty($data)) {
                        foreach ($data as $info) {
                            ?>
                            <tr>
                                <td><?php echo "{$info['user_id']}"; ?></td>
                                <td><?php echo "{$info['formatted_date']}"; ?></td>
                                <td><?php echo "{$info['flavour']}"; ?></td>
                                <td><?php echo "{$info['extras']}"; ?></td>
                                <td><?php echo "{$info['occasion']}"; ?></td>
                                <td><?php echo "{$info['weight']}"; ?></td>
                                <td><?php echo "{$info['text']}"; ?></td>
                                <td><?php echo "{$info['price']}"; ?></td>
                                <td>
                                    <form action="../controller/updateOrderStatus.php" method="post">
                                        <select name="status" class="form-control" onchange="this.form.submit()">
                                            <option value="Złożone" <?php echo ($info['status'] == 'Złożone') ? 'selected' : ''; ?>>
                                                Złożone
                                            </option>
                                            <option value="W trakcie" <?php echo ($info['status'] == 'W trakcie') ? 'selected' : ''; ?>>
                                                W trakcie
                                            </option>
                                            <option value="Gotowe do odbioru" <?php echo ($info['status'] == 'Gotowe do odbioru') ? 'selected' : ''; ?>>
                                                Gotowe do odbioru
                                            </option>
                                            <option value="Odebrane" <?php echo ($info['status'] == 'Odebrane') ? 'selected' : ''; ?>>
                                                Odebrane
                                            </option>
                                        </select>
                                        <input type="hidden" name="order_id" value="<?php echo $info['id']; ?>">
                                    </form>
                                </td>
                                <td>
                                    <a href=../controller/updateOrder.php?order_id=<?php echo urlencode($info['id']); ?>
                                       class="btn btn-primary btn-sm">Edytuj</a>
                                    <a href=../controller/orderConfirmDelete.php?order_id=<?php echo urlencode($info['id']); ?>
                                       class="btn btn-danger btn-sm">Usuń</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='8' style='text-align: center'>Brak zamówień do wyświetlenia.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['delete_success']) && $_SESSION['delete_success'] === true) {
                echo '<div class="alert alert-success">Zamówienie zostało usunięte.</div>';
                unset($_SESSION['delete_success']);
            }
            if (isset($_SESSION['update_success']) && $_SESSION['update_success'] === true) {
                echo '<div class="alert alert-success">Zamówienie zostało zmienione.</div>';
                unset($_SESSION['update_success']);
            }
            if (isset($_SESSION['status_update']) && $_SESSION['status_update'] === true) {
                echo '<div class="alert alert-success">Status zamówienia został zmieniony.</div>';
                unset($_SESSION['status_update']);
            }
            if (isset($_SESSION['status_failure']) && $_SESSION['status_failure'] === true) {
                echo '<div class="alert alert-danger">Zamówienie o tym statusie nie może zostać zmienione ani usunięte.</div>';
                unset($_SESSION['status_failure']);
            }
            ?>
        </div>
        <?php
    }
}

?>
