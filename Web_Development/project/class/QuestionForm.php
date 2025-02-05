<?php

require_once 'Question.php';

class QuestionForm
{
    protected $Question;

    public function __construct()
    { ?>
        <div class="container-xxl py-6">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-6 mb-4">Jeśli Masz Jakieś Pytania, Napisz Do Nas</h1>
                </div>
                <div class="row g-0 justify-content-center">
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                        <p class="text-center mb-4"></p>
                        <form class="row g-3" action="#" method="post">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Imię i nazwisko"
                                           name="fullName"
                                           pattern="^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,} [A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,}$"
                                           required>
                                    <label for="name">Imię i nazwisko*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                           required>
                                    <label for="email">Email*</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject"
                                           placeholder="Temat"
                                           pattern=".{3,}" required>
                                    <label for="subject">Temat*</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a message here" id="message"
                                      name="message" minlength="10" maxlength="1000"
                                      style="height: 200px" required></textarea>
                                    <label for="message">Wiadomość (10 - 1000 znaków)*</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary rounded-pill py-3 px-5" name="action" type="submit">
                                    Wyślij Wiadomość
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['question_sucess']) && $_SESSION['question_sucess'] === true) {
                echo "<div class=\"container-xxl py-6 px-0 wow fadeInUp\" data-wow-delay=\"0.1s\">
                        <h2 class=\"fw-bold mb-2 text-uppercase\" style=\"color: black; text-align: center\">Pytanie zostało przesłane</h2>
                        <h5 class=\"fw-bold mb-2 text-uppercase\" style=\"color: black; text-align: center\">Odpowiedź zostanie przesłana na podany adres email</h5></div>";
                unset($_SESSION['question_sucess']);
            }
            ?>
        </div>
        <?php
    }


    public function checkMessage()
    {
        $args = [
            'fullName' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[A-Za-zĄąĆćĘęŁłŃńÓóŚśŹźŻż ]{2,50}$/']
            ],
            'email' => FILTER_VALIDATE_EMAIL,
            'subject' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[A-Za-zĄąĆćĘęŁłŃńÓóŚśŹźŻż0-9 .,!?-]{3,100}$/']
            ],
            'message' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^.{10,1000}$/']
            ]
        ];

        $dane = filter_input_array(INPUT_POST, $args);

        $errors = "";
        foreach ($dane as $key => $value) {
            if ($value === false || $value === null) {
                $errors .= "Nieprawidłowe dane w polu: $key.<br>";
            }
        }

        if ($errors === "") {
            $this->Question = new Question(
                $dane['fullName'],
                $dane['email'],
                $dane['subject'],
                $dane['message']
            );
        } else {
            $this->Question = null;
        }

        return $this->Question;
    }
}

?>