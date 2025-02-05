<?php

require_once 'Order.php';

class OrderUpdate
{

    public function __construct($orderData)
    {
        ?>
        <div class="container-xxl py-6">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Edytuj zamówienie</h1>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-center mb-4">Zmiana szczegółów zamówienia może wpłynąć na czas jego realizacji!</p>
                    <form class="row g-3" action="#" method="post">
                        <div class="col-md-12 text-center">
                            <h4 class="mb-0">Wybierz Smak Tortu</h4>
                        </div>
                        <div class="form-floating">
                            <select class="form-control" id="flavour" name="flavour" required>
                                <?php
                                $flavourOptions = array(
                                    'Truskawkowy' => '50 zł/kg',
                                    'Czekoladowy' => '55 zł/kg',
                                    'Śmietankowy' => '48 zł/kg',
                                    'Mieszany' => '52 zł/kg',
                                    'Waniliowy' => '45 zł/kg',
                                    'Malinowy' => '53 zł/kg',
                                    'Kokosowy' => '60 zł/kg',
                                    'Tiramisu' => '65 zł/kg',
                                    'Orzechowy' => '58 zł/kg',
                                    'Karmelowy' => '62 zł/kg',
                                    'Cytrynowy' => '47 zł/kg',
                                    'Jagodowy' => '54 zł/kg',
                                    'Bananowy' => '50 zł/kg',
                                    'Mango' => '57 zł/kg',
                                    'Truflowy' => '70 zł/kg',
                                    'Bezowy' => '68 zł/kg',
                                    'Miętowy' => '55 zł/kg',
                                    'Inny' => 'cena przy odbiorze'
                                );
                                foreach ($flavourOptions as $flavour => $flavourPrice) {
                                    $selected = $flavour === $orderData['flavour'] ? 'selected' : '';
                                    echo "<option value='$flavour' $selected>$flavour - $flavourPrice</option>";
                                }
                                ?>
                            </select>
                            <label for="flavour">Smak*</label>
                        </div>
                        <div class="col-md-12 text-center">
                            <h4 class="mb-0">Wybierz Dodatki</h4>
                        </div>
                        <div class="row g-3">
                            <?php
                            $extrasOptions = array(
                                'Orzechy' => '10 zł',
                                'Świeże Owoce' => '15 zł',
                                'Wiórki Czekoladowe' => '12 zł',
                                'Posypka Cukrowa' => '8 zł',
                                'Karmel' => '10 zł',
                                'Bita Śmietana' => '10 zł',
                                'Likier' => '20 zł',
                                'Ozdoby Marcepanowe' => '18 zł',
                                'Polewa Czekoladowa' => '12 zł',
                                'Inne' => 'cena przy odbiorze'
                            );
                            $selectedExtras = array_map('trim', explode(",", $orderData['extras']));
                            foreach ($extrasOptions as $extra => $extraPrice) {
                                $checked = in_array($extra, $selectedExtras) ? 'checked' : '';
                                echo "<div class='col-md-3'><div class='form-check'>
                                        <input class='form-check-input' type='checkbox' name='extras[]' id='$extra' value='$extra' $checked>
                                        <label class='form-check-label' for='$extra'>$extra - $extraPrice</label>
                                        </div></div>";
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="occasion" name="occasion" required>
                                    <?php
                                    $occasions = ['Wesele', 'Komunia', 'Urodziny', 'Inne'];
                                    foreach ($occasions as $occasion) {
                                        $selected = $occasion === $orderData['occasion'] ? 'selected' : '';
                                        echo "<option value='$occasion' $selected>$occasion</option>";
                                    }
                                    ?>
                                </select>
                                <label for="occasion">Okazja*</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="weight" name="weight"
                                       min="0.15" max="5.00" step="any"
                                       value="<?php echo $orderData['weight']; ?>" required>
                                <label for="weight">Waga* (0,15 - 5.00 kg)</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="cakeText" name="text"
                                          placeholder="Tekst na torcie oraz inne uwagi"
                                          required><?php echo htmlspecialchars($orderData['text']); ?></textarea>
                                <label for="cakeText">Tekst na torcie oraz inne uwagi*</label>
                            </div>
                        </div>
                        <div class="col-md-12 priceSpace">
                            <span class="badge bg-dark calculatedPrice"
                                  id="calculatedPrice">Przewidywana cena: <?php echo $orderData['price'] ?> zł</span>
                            <input type="hidden" id="priceInput" name="price"
                                   value="<?php echo $orderData['price']; ?>">
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5" name="update" value="Update"
                                    type="submit">Edytuj
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        }<?php

    }

    public function updateOrder($orderId, $db)
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
            $flavour = $data['flavour'];
            $extras = isset($data['extras']) ? implode(", ", $data['extras']) : "";
            $occasion = $data['occasion'];
            $weight = $data['weight'];
            $text = $data['text'];
            $price = $data['price'];
            $updateSql = "UPDATE orders SET flavour = '$flavour', extras = '$extras', occasion = '$occasion', weight = '$weight' ,price = '$price', text = '$text' WHERE id = '$orderId'";
            return ($db->update($updateSql));
        } else {
            echo "<div class=\"container text-center pt-5 pb-3\"><h2 class=\"fw-bold mb-2 text-uppercase\">$errors</h2></div>";
            return false;
        }
    }
}