<div class="container-xxl bg-light my-6 py-6 pt-0">
    <div class="container">
        <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-light mb-0">Najlepsza Piekarnia W Lublinie</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="d-inline-flex align-items-center text-start">
                        <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                        <div class="ms-4">
                            <p class="fs-5 fw-bold mb-0">Zadzwoń Do Nas</p>
                            <p class="fs-1 fw-bold mb-0">534 345 678</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Oferta</p>
            <h1 class="display-6 mb-4">Dowiedz Się Więcej O Naszych Produktach</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3"></div>
                        <h3 class="mb-3">Ciasta</h3>
                        <span>Nasze ciasta są zawsze świeże i pełne smaku, idealne na każdą okazję</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="../img/product-1.jpg" alt="">
                        <div class="product-overlay">
                            <button id="cake_button" class="btn btn-lg-square btn-outline-light rounded-circle"
                                    onclick=""><i
                                        class="fa fa-eye text-primary"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3"></div>
                        <h3 class="mb-3">Pieczywo</h3>
                        <span>Pieczywo pieczemy codziennie z najlepszych składników, aby zapewnić najwyższą jakość i świeżość.</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="../img/product-2.jpg" alt="">
                        <div class="product-overlay">
                            <button id="bread_button" class="btn btn-lg-square btn-outline-light rounded-circle"
                                    onclick=""><i
                                        class="fa fa-eye text-primary"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                    <div class="text-center p-4">
                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3"></div>
                        <h4 class="mb-3">Torty</h4>
                        <span>Nasze torty na zamówienie są wyjątkowe i starannie przygotowane, aby uczynić każdą uroczystość niezapomnianą</span>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="../img/product-3.jpg" alt="">
                        <div class="product-overlay">
                            <button id="special_cake_button" class="btn btn-lg-square btn-outline-light rounded-circle"
                                    onclick=""><i
                                        class="fa fa-eye text-primary"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="produkt">

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const but1 = document.getElementById("bread_button");
        but1.addEventListener('click', function () {
                fetch("http://localhost/project/content/bread.php?v=" + new Date().getTime())
                    .then(response => {
                        return response.text();
                    })
                    .then(dane => {
                        document.getElementById("produkt").innerHTML = dane;
                    })
            },
            false);
        const but2 = document.getElementById("cake_button");
        but2.addEventListener('click', function () {
                fetch("http://localhost/project/content/cakes.php?v=" + new Date().getTime())
                    .then(response => {
                        return response.text();
                    })
                    .then(dane => {
                        document.getElementById("produkt").innerHTML = dane;
                    })
            },
            false);
        const but3 = document.getElementById("special_cake_button");
        but3.addEventListener('click', function () {
                fetch("http://localhost/project/content/specialCake.php?v=" + new Date().getTime())
                    .then(response => {
                        return response.text();
                    })
                    .then(dane => {
                        document.getElementById("produkt").innerHTML = dane;
                    })
            },
            false);
    })
</script>
