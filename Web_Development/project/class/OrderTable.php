<?php

require_once 'Order.php';

class OrderTable
{
    protected $db;
    protected $userId;

    public function __construct($db, $userId)
    { ?>
        <div id="order_table" class="container-xxl py-6">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Złożone Zamówienia</h1>
            </div>
            <div class="col-md-12 text-center mb-3">
                <label for="occasionFilter" class="form-label">Filtruj po okazji:</label>
                <select id="occasionFilter" class="form-select" style="max-width: 300px; margin: 0 auto;">
                    <option value="">Wszystkie</option>
                    <option value="Wesele">Wesele</option>
                    <option value="Komunia">Komunia</option>
                    <option value="Urodziny">Urodziny</option>
                    <option value="Inne">Inne</option>
                </select>
            </div>
            <div id="ordersTable" class="col-md-12 table-responsive">
                <table class="table table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>Data złożenia zamówienia</th>
                        <th>Smak</th>
                        <th>Dodatki</th>
                        <th>Okazja</th>
                        <th>Waga</th>
                        <th>Tekst na Torcie</th>
                        <th>Przewidywana cena</th>
                        <th>Status</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                    <?php
                    $data = Order::getAllOrders($db, $userId);
                    if (!empty($data)) {
                        foreach ($data as $info) {
                            ?>
                            <tr>
                                <td><?php echo "{$info['formatted_date']}"; ?></td>
                                <td><?php echo "{$info['flavour']}"; ?></td>
                                <td><?php echo "{$info['extras']}"; ?></td>
                                <td><?php echo "{$info['occasion']}"; ?></td>
                                <td><?php echo "{$info['weight']}"; ?></td>
                                <td><?php echo "{$info['text']}"; ?></td>
                                <td><?php echo "{$info['price']} zł"; ?></td>
                                <td><?php if ($info['status'] == 'Złożone') {
                                        echo "<span class=\"badge rounded-pill bg-danger\">";
                                    } else if($info['status'] == 'W trakcie'){
                                        echo "<span class=\"badge rounded-pill bg-warning\">";
                                    } else if($info['status'] == 'Gotowe do odbioru'){
                                        echo "<span class=\"badge rounded-pill bg-info\">";
                                    } else if($info['status'] == 'Odebrane'){
                                        echo "<span class=\"badge rounded-pill bg-success\">";
                                    }?><?php echo "{$info['status']}</span>"; ?>
                                </td>
                                <td>
                                    <a href=../controller/updateOrder.php?order_id=<?php echo urlencode($info['id']); ?>>
                                        <button class="btn btn-primary btn-sm ">Edytuj</button>
                                    </a>
                                    <a href=../controller/orderConfirmDelete.php?order_id=<?php echo urlencode($info['id']); ?>>
                                        <button class="btn btn-danger btn-sm">Usuń</button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='9' style='text-align: center'>Brak zamówień do wyświetlenia.</td></tr>";
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
            if (isset($_SESSION['status_failure']) && $_SESSION['status_failure'] === true) {
                echo '<div class="alert alert-danger">Zamówienie o tym statusie nie może zostać zmienione ani usunięte.</div>';
                unset($_SESSION['status_failure']);
            }
            ?>
        </div>
        <?php
    }
}