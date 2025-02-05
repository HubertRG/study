<?php

class UserManager
{


    function loginForm()
    {
        ?>
        <section class="h-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color: white">Logowanie</h2>
                                    <p class="text-white-50 mb-5">Proszę podać login i hasło!</p>
                                    <form action="login.php" method="post">
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="userName" name="login"
                                                   class="form-control form-control-lg" required/>
                                            <label class="form-label" for="userName">Nazwa użytkownika*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="password" id="passwd" name="passwd"
                                                   class="form-control form-control-lg" required/>
                                            <label class="form-label" for="passwd">Hasło*</label>
                                        </div>
                                        <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-outline-light btn-lg px-5" type="submit" value="zaloguj"
                                                name="zaloguj">Login
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <p class="mb-0">Nie masz jeszcze konta? <a href="register.php"
                                                                               class="text-white-50 fw-bold">Zarejestruj
                                            się</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }


    function login($db)
    {
        $args = [
            'login' => FILTER_SANITIZE_ADD_SLASHES,
            'passwd' => FILTER_SANITIZE_ADD_SLASHES
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane['login'];
        $passwd = $dane['passwd'];

        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $sessionId = session_id();

            if (isset($_SESSION["userId"]) && $_SESSION["userId"] === $userId) {
                return -2; // User already logged-in
            }

            $sqlCheckUser = "SELECT * FROM logged_in_users WHERE userId = $userId";
            $result = $db->select($sqlCheckUser, ["sessionId"]);
            if (!empty($result)) {
                return -3; // User logged-in in other session
            }

            if (isset($_SESSION["userId"])) {
                return -4; // Other user logged-in
            }

            $_SESSION["userId"] = $userId;
            $sql = 'DELETE FROM logged_in_users WHERE userId=' . $userId . ';';
            $db->delete($sql);
            $date = date("Y-m-d H:i:s");
            $dateFormatted = date('Y-m-d H:i:s', strtotime($date));
            $sql = "INSERT INTO `logged_in_users` (`sessionId`, `userId`, `lastUpdate`) VALUES ('$sessionId', '$userId', '$dateFormatted')";
            $db->insert($sql);
            return $userId;
        }
        return -1;
    }

    function logout($db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $sessionId = session_id();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $sql = 'DELETE FROM logged_in_users WHERE sessionId="' . $sessionId . '";';
        $db->delete($sql);

    }

    function getLoggedInUser($db, $sessionId)
    {
        $userId = -1;
        $mysqli = $db->getMysqli();
        $sql = 'SELECT * FROM logged_in_users WHERE sessionId="' . $sessionId . '";';
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userId = $row["userId"];
            }
        }
        return $userId;
    }

    function getUserFullName($db, $userId)
    {

        $sql = "SELECT fullName FROM `users` WHERE id = " . $userId;
        $fields = [
            'fullName',
        ];
        $result = $db->select($sql, $fields);
        if (!empty($result)) {
            $fullName = $result[0]['fullName'];
        }
        return $fullName;
    }
}
