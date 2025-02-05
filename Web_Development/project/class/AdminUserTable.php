<?php
require_once '../class/User.php';

class AdminUserTable
{
    protected $db;

    public function __construct($db)
    { ?>
        <div id="user_table" class="container-xxl py-6">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Lista Użytkowników</h1>
            </div>
            <div id="usersTable" class="col-md-12 table-responsive">
                <table class="table table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>Id Użytkownika</th>
                        <th>Nazwa Użytkownika</th>
                        <th>Imię i Nazwisko</th>
                        <th>Email</th>
                        <th>Numer Telefonu</th>
                        <th>Data Rejestracji</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody id="usersTableBody">
                    <?php
                    $data = User::getAllUsersFromDB($db);
                    if (!empty($data)) {
                        foreach ($data as $info) {
                            if ($info['userName'] === 'admin') {
                                continue;
                            } ?>
                            <tr>
                                <td><?php echo "{$info['id']}"; ?></td>
                                <td><?php echo "{$info['userName']}"; ?></td>
                                <td><?php echo "{$info['fullName']}"; ?></td>
                                <td><?php echo "{$info['email']}"; ?></td>
                                <td><?php echo "{$info['phonenumber']}"; ?></td>
                                <td><?php echo "{$info['date']}"; ?></td>
                                <td>
                                    <a href=../controller/userConfirmDelete.php?user_id=<?php echo urlencode($info['id']); ?>
                                       class="btn btn-danger btn-sm">Usuń</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align: center'>Brak użytkowników do wyświetlenia.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['user_delete']) && $_SESSION['user_delete'] === true) {
                echo '<div class="alert alert-success">Użytkownik został usunięty.</div>';
                unset($_SESSION['user_delete']);
            }
            ?>
        </div>
        <?php
    }
}
