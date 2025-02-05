<?php

class UserData
{
    public function __construct($userId, $db)
    {
        $sql = "SELECT fullName, userName, email, phonenumber FROM users WHERE id = $userId";
        $fields = ['fullName', 'userName', 'email', 'phonenumber'];
        $result = $db->select($sql, $fields);
        $dane = $result[0];
        ?>
        <div class="container mt-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Dane użytkownika składającego zamówienie</h5>
                    <p class="card-text"><strong>Imię i
                            nazwisko:</strong> <?php echo htmlspecialchars($dane['fullName']); ?></p>
                    <p class="card-text"><strong>Nazwa
                            użytkownika:</strong> <?php echo htmlspecialchars($dane['userName']); ?></p>
                    <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($dane['email']); ?></p>
                    <p class="card-text"><strong>Numer
                            telefonu:</strong> <?php echo htmlspecialchars($dane['phonenumber']); ?></p>
                </div>
            </div>
            <?php
            if (isset($_SESSION['user_update']) && $_SESSION['user_update'] === true) {
                echo '<div class="alert alert-success">Dane zostały zmienione.</div>';
                unset($_SESSION['user_update']);
            }
            if (isset($_SESSION['password_change']) && $_SESSION['password_change'] === true) {
                echo '<div class="alert alert-success">Hasło zostało zmienione.</div>';
                unset($_SESSION['password_change']);
            }
            ?>
        </div>
        <?php
    }
}