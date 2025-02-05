<?php

class PasswordChange
{
    public function displayForm()
    {
        ?>
        <section class="h-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color: white">Zmiana
                                        hasła</h2>
                                    <form action="#" method="post">
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="password" id="currentPasswd" name="currentPasswd"
                                                   class="form-control form-control-lg"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!#%*?&])[A-Za-z\d@#$!%*?&]{8,}$"
                                                   title="Hasło musi zawierać co najmniej 8 znaków, w tym małą i dużą literę, cyfrę oraz znak specjalny."
                                                   required/>
                                            <label class="form-label" for="currentPasswd">Obecne hasło*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="password" id="passwd" name="passwd"
                                                   class="form-control form-control-lg"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$#!%*?&]{8,}$"
                                                   title="Hasło musi zawierać co najmniej 8 znaków, w tym małą i dużą literę, cyfrę oraz znak specjalny."
                                                   required/>
                                            <label class="form-label" for="passwd">Nowe hasło*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="password" id="confirmPasswd" name="confirmPasswd"
                                                   class="form-control form-control-lg"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!#%*?&])[A-Za-z\d@$!%#*?&]{8,}$"
                                                   title="Hasło musi zawierać co najmniej 8 znaków, w tym małą i dużą literę, cyfrę oraz znak specjalny."
                                                   required/>
                                            <label class="form-label" for="confirmPasswd">Potwierdź
                                                hasło*</label>
                                        </div>
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                                name="action">Zmień hasło
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    public function updatePasswd($userId, $db)
    {
        $args = [
            'currentPasswd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/']
            ],
            'passwd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*?#&]{8,}$/']
            ],
            'confirmPasswd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$!%*?#&]{8,}$/']
            ],
        ];

        $dane = filter_input_array(INPUT_POST, $args);

        $errors = "";

        $sql = "SELECT passwd from users WHERE id = $userId";
        $field = ['passwd'];
        $result = $db->select($sql, $field);
        $hash = $result[0]['passwd'];
        if (!password_verify($dane['currentPasswd'], $hash)) {
            $errors .= "Niepoprawne obecne hasło.<br>";
        }

        if ($dane['passwd'] != $dane['confirmPasswd']) {
            $errors .= "Podane hasła nie są identyczne.<br>";
        }
        foreach ($dane as $key => $value) {
            if ($value === false || $value === null) {
                $errors .= "Nieprawidłowe dane w polu: $key.<br>";
            }
        }

        if ($errors === "") {
            $password = password_hash($dane['passwd'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET passwd = '$password' WHERE id = $userId";
            return ($db->update($sql));
        } else {
            echo "<div class=\"container text-center pt-5 pb-3\"><h2 class=\"fw-bold mb-2 text-uppercase\" style='color: white'>$errors</h2></div>";
            return false;
        }
    }
}