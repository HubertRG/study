<?php

require_once 'User.php';

class UserUpdate
{
    public function displayForm($userData)
    {
        ?>
        <section class="h-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color: white">Edycja
                                        danych</h2>
                                    <form action="#" method="post">
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="fullName" name="fullName"
                                                   class="form-control form-control-lg"
                                                   value="<?php echo htmlspecialchars($userData['fullName']); ?>"
                                                   required/>
                                            <label class="form-label" for="fullName">Imię i nazwisko*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="userName" name="userName"
                                                   class="form-control form-control-lg"
                                                   value="<?php echo htmlspecialchars($userData['userName']); ?>"
                                                   required/>
                                            <label class="form-label" for="userName">Nazwa użytkownika*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="email" id="email" name="email"
                                                   class="form-control form-control-lg"
                                                   value="<?php echo htmlspecialchars($userData['email']); ?>"
                                                   required/>
                                            <label class="form-label" for="email">Email*</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="phonenumber" name="phonenumber"
                                                   class="form-control form-control-lg"
                                                   value="<?php echo htmlspecialchars($userData['phonenumber']); ?>"
                                                   required/>
                                            <label class="form-label" for="phonenumber">Numer telefonu*</label>
                                        </div>
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                                name="action">Zaktualizuj dane
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

    public function updateUser($userId, $db)
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
            'phonenumber' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9]{9}$/']
            ],
            'email' => FILTER_VALIDATE_EMAIL
        ];

        $dane = filter_input_array(INPUT_POST, $args);

        $errors = "";
        foreach ($dane as $key => $value) {
            if ($value === false || $value === null) {
                $errors .= "Nieprawidłowe dane w polu: $key.<br>";
            }
        }


        $userName = $db->sanitize($dane['userName']);
        $email = $db->sanitize($dane['email']);

        $sql = "SELECT userName, email, id FROM users WHERE userName = '$userName' OR email = '$email'";
        $fields = ['userName', 'email', 'id'];

        $result = $db->select($sql, $fields);

        if (!empty($result)) {
            foreach ($result as $row) {
                if ($row['userName'] === $userName && $row['id'] != $userId) {
                    $errors .= "Nazwa użytkownika jest już zajęta.<br>";
                }
                if ($row['email'] === $email && $row['id'] != $userId) {
                    $errors .= "Adres e-mail jest już zajęty.<br>";
                }
            }
        }
        if ($errors === "") {
            $fullName = $dane['fullName'];
            $userName = $dane['userName'];
            $phonenumber = $dane['phonenumber'];
            $email = $dane['email'];
            $sql = "UPDATE users SET fullName = '$fullName', userName = '$userName', email = '$email', phonenumber = '$phonenumber' WHERE id = $userId";
            return ($db->update($sql));
        } else {
            echo "<div class=\"container text-center pt-5 pb-3\"><h2 class=\"fw-bold mb-2 text-uppercase\" style='color: white'>$errors</h2></div>";
            return false;
        }
    }
}

