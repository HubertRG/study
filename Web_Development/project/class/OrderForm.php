<?php

require_once "Order.php";

class OrderForm
{
    protected $order;

    public function generateOrderForm()
    { ?>
        <div class="container-xxl py-6">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Tutaj Złożysz Zamówienie Na Tort </h1>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-center mb-4">Ostateczna cena za złożone zamówienie będzie określona po jego
                        wykonaniu.</p>
                    <form class="row g-3" id="orderForm" action="#" method="post">
                        <div class="col-md-12 text-center">
                            <h4 class="mb-0">Wybierz Smak Tortu</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="flavour" name="flavour" required>
                                    <option value="" disabled selected>Wybierz smak</option>
                                    <option value="Truskawkowy">Truskawkowy - 50 zł/kg</option>
                                    <option value="Czekoladowy">Czekoladowy - 55 zł/kg</option>
                                    <option value="Śmietankowy">Śmietankowy - 48 zł/kg</option>
                                    <option value="Mieszany">Mieszany - 52 zł/kg</option>
                                    <option value="Waniliowy">Waniliowy - 45 zł/kg</option>
                                    <option value="Malinowy">Malinowy - 53 zł/kg</option>
                                    <option value="Kokosowy">Kokosowy - 60 zł/kg</option>
                                    <option value="Tiramisu">Tiramisu - 65 zł/kg</option>
                                    <option value="Orzechowy">Orzechowy - 58 zł/kg</option>
                                    <option value="Karmelowy">Karmelowy - 62 zł/kg</option>
                                    <option value="Cytrynowy">Cytrynowy - 47 zł/kg</option>
                                    <option value="Jagodowy">Jagodowy - 54 zł/kg</option>
                                    <option value="Bananowy">Bananowy - 50 zł/kg</option>
                                    <option value="Mango">Mango - 57 zł/kg</option>
                                    <option value="Truflowy">Truflowy - 70 zł/kg</option>
                                    <option value="Bezowy">Bezowy - 68 zł/kg</option>
                                    <option value="Miętowy">Miętowy - 55 zł/kg</option>
                                    <option value="Inny">Inny (cena przy odbiorze)</option>
                                </select>
                                <label for="flavour">Smak*</label>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <h4 class="mb-0">Wybierz Dodatki</h4>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="orzechy"
                                           value="Orzechy">
                                    <label class="form-check-label" for="orzechy">Orzechy - 10 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="owoce"
                                           value="Świeże Owoce">
                                    <label class="form-check-label" for="owoce">Świeże Owoce - 15 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="wiory"
                                           value="Wiórki Czekoladowe">
                                    <label class="form-check-label" for="wiory">Wiórki Czekoladowe - 12 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="posypka"
                                           value="Posypka Cukrowa">
                                    <label class="form-check-label" for="posypka">Posypka Cukrowa - 8 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="karmel"
                                           value="Karmel">
                                    <label class="form-check-label" for="karmel">Karmel - 10 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="bitaSmietana"
                                           value="Bita Śmietana">
                                    <label class="form-check-label" for="bitaSmietana">Bita Śmietana - 10 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="likier"
                                           value="Likier">
                                    <label class="form-check-label" for="likier">Likier - 20 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="ozdoby"
                                           value="Ozdoby Marcepanowe">
                                    <label class="form-check-label" for="ozdoby">Ozdoby Marcepanowe - 18 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="polewa"
                                           value="Polewa Czekoladowa">
                                    <label class="form-check-label" for="polewa">Polewa Czekoladowa - 12 zł</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="inne"
                                           value="Inne">
                                    <label class="form-check-label" for="inne">Inne - cena przy odbiorze</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="occasion" name="occasion" required>
                                    <option value="" disabled selected>Wybierz okazję</option>
                                    <option value="Wesele">Wesele</option>
                                    <option value="Komunia">Komunia</option>
                                    <option value="Urodziny">Urodziny</option>
                                    <option value="Inne">Inne</option>
                                </select>
                                <label for="occasion">Okazja*</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="weight" name="weight" min="0.15"
                                       max="5.00" step="any"
                                       required>
                                <label for="weight">Waga* (0,15 - 5.00 kg)</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="cakeText" name="text"
                                          placeholder="Tekst na torcie oraz inne uwagi"
                                          required></textarea>
                                <label for="cakeText">Tekst na torcie oraz inne uwagi*</label>
                            </div>
                        </div>
                        <div class="col-md-12 priceSpace">
                            <span class="badge bg-dark calculatedPrice"
                                  id="calculatedPrice">Przewidywana cena: 0.00 zł</span>
                            <input type="hidden" id="priceInput" name="price">
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5" name="action" value="zapisz"
                                    type="submit">Złóż Zamówienie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    public function checkOrder($userId)
    {
        $args = [
            'flavour' => FILTER_SANITIZE_STRING,
            'extras' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_ARRAY
            ],
            'occasion' => FILTER_SANITIZE_STRING,
            'text' => FILTER_SANITIZE_STRING,
            'weight' => [
                'filter' => FILTER_VALIDATE_FLOAT,
                'options' => [
                    'min_range' => 0.15,
                    'max_range' => 5.00
                ]
            ],
            'price' => FILTER_VALIDATE_FLOAT
        ];

        $data = filter_input_array(INPUT_POST, $args);

        $errors = "";
        foreach ($data as $key => $value) {
            if ($value === false || $value === null) {
                $errors .= "Nieprawidłowe dane w polu: $key.<br>";
            }
        }

        if ($errors === "") {
            $this->order = new Order(
                $userId,
                $data['flavour'],
                $data['extras'],
                $data['occasion'],
                $data['weight'],
                $data['text'],
                $data['price']
            );
        } else {
            echo "<p>$errors</p>";
            $this->order = null;
        }

        return $this->order;
    }
}