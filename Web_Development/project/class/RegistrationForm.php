<?php

require_once 'User.php';
require_once 'Baza.php';

class RegistrationForm
{
    protected $user;

    public function displayForm()
    { ?>
        <section class="h-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color: white">
                                        Rejestracja</h2>
                                    <p class="text-white-50 mb-5">Proszę podać dane!</p>
                                    <form action="#" method="post">
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="fullName" name="fullName"
                                                   class="form-control form-control-lg"
                                                   placeholder="Imię Nazwisko"
                                                   pattern="^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,} [A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,}$"
                                                   required/>
                                            <label class="form-label" for="fullName">Imię i nazwisko*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="userName" name="userName"
                                                   class="form-control form-control-lg" pattern=".{3,}"
                                                   placeholder="Nazwa użytkownika"
                                                   required/>
                                            <label class="form-label" for="userName">Nazwa użytkownika*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="email" id="email" name="email" placeholder="Email"
                                                   class="form-control form-control-lg" required/>
                                            <label class="form-label" for="email">Email*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="phonenumber" name="phonenumber"
                                                   pattern="^[0-9]{9}$" placeholder="Numer telefonu"
                                                   class="form-control form-control-lg" required/>
                                            <label class="form-label" for="phonenumber">Numer telefonu*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="password" id="passwd" name="passwd"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*#?&]{8,}$"
                                                   placeholder="Hasło"
                                                   title="Hasło musi zawierać co najmniej 8 znaków, w tym małą i dużą literę, cyfrę oraz znak specjalny."
                                                   class="form-control form-control-lg" required/>
                                            <label class="form-label" for="passwd">Hasło*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="password" id="confirmPasswd" name="confirmPasswd"
                                                   placeholder="Potwierdź hasło"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@#$!%*?&]{8,}$"
                                                   title="Hasło musi zawierać co najmniej 8 znaków, w tym małą i dużą literę, cyfrę oraz znak specjalny."
                                                   class="form-control form-control-lg" required/>
                                            <label class="form-label" for="confirmPasswd">Potwierdź
                                                hasło*</label>
                                        </div>
                                        <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-outline-light btn-lg px-5" type="submit"
                                                name="action">Załóż konto
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <p class="mb-0">Masz już konto? <a href="login.php"
                                                                       class="text-white-50 fw-bold">Zaloguj
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

    public function checkUser($db)
    {
        $args = [
            'userName' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-z]{3,25}$/']
            ],
            'fullName' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,} [A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,}$/']
            ],
            'passwd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&])[A-Za-z\d@$!%#*?&]{8,}$/']
            ],
            'confirmPasswd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$!%*?#&]{8,}$/']
            ],
            'phonenumber' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9]{9}$/']
            ],
            'email' => FILTER_VALIDATE_EMAIL
        ];

        $dane = filter_input_array(INPUT_POST, $args);

        $errors = "";
        if ($dane['passwd'] != $dane['confirmPasswd']) {
            $errors .= "Podane hasła nie są identyczne.<br>";
        }
        foreach ($dane as $key => $value) {
            if ($value === false || $value === null) {
                $errors .= "Nieprawidłowe dane w polu: $key.<br>";
            }
        }


        $userName = $db->sanitize($dane['userName']);
        $email = $db->sanitize($dane['email']);

        $sql = "SELECT userName, email FROM users WHERE userName = '$userName' OR email = '$email'";
        $fields = ['userName', 'email'];

        $result = $db->select($sql, $fields);

        if (!empty($result)) {
            foreach ($result as $row) {
                if ($row['userName'] === $userName) {
                    $errors .= "Nazwa użytkownika jest już zajęta.<br>";
                }
                if ($row['email'] === $email) {
                    $errors .= "Adres e-mail jest już zajęty.<br>";
                }
            }
        }
        if ($errors === "") {
            $this->user = new User(
                $dane['userName'],
                $dane['fullName'],
                $dane['email'],
                $dane['phonenumber'],
                $dane['passwd']
            );
        } else {
            echo "<div class=\"container text-center pt-5 pb-3\"><h2 class=\"fw-bold mb-2 text-uppercase\" style='color: white'>$errors</h2></div>";
            $this->user = null;
        }

        return $this->user;
    }
}

?>
