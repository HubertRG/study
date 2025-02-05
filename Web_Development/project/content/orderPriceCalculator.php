<script>
    const flavourPrices = {
        "Truskawkowy": 50,
        "Czekoladowy": 55,
        "Śmietankowy": 48,
        "Mieszany": 52,
        "Waniliowy": 45,
        "Malinowy": 53,
        "Kokosowy": 60,
        "Tiramisu": 65,
        "Orzechowy": 58,
        "Karmelowy": 62,
        "Cytrynowy": 47,
        "Jagodowy": 54,
        "Bananowy": 50,
        "Mango": 57,
        "Truflowy": 70,
        "Bezowy": 68,
        "Miętowy": 55,
        "Inny": 0
    };

    const extrasPrices = {
        "Orzechy": 10,
        "Świeże Owoce": 15,
        "Wiórki Czekoladowe": 12,
        "Posypka Cukrowa": 8,
        "Karmel": 10,
        "Bita Śmietana": 10,
        "Likier": 20,
        "Ozdoby Marcepanowe": 18,
        "Polewa Czekoladowa": 12,
        "Inne": 0
    }

    function calculatePrice() {
        const flavour = document.getElementById("flavour").value;
        const weight = parseFloat(document.getElementById("weight").value) || 0;
        const extras = Array.from(document.querySelectorAll('input[name="extras[]"]:checked'))
            .map(el => el.value);

        let price = (flavourPrices[flavour] || 0) * weight;

        extras.forEach(extra => {
            price += extrasPrices[extra] || 0;
        });

        document.getElementById("calculatedPrice").innerText = `Przewidywana cena: ${price.toFixed(2)} zł`;
        document.getElementById("priceInput").value = price.toFixed(2);
    }

    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("flavour").addEventListener("change", calculatePrice);
        document.getElementById("weight").addEventListener("input", calculatePrice);
        document.querySelectorAll('input[name="extras[]"]').forEach(input => {
            input.addEventListener("change", calculatePrice);
        });
    });
</script>
