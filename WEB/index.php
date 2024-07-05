<!DOCTYPE html>
<html lang="tr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sera kontrol sistemi ile ilgili ana sayfa.">
    <meta name="keywords" content="sera, kontrol, otomasyon, bitki yetiştirme, tarım">
    <meta name="author" content="vedategunduz">
    <title>Uzaktan Kontrollü Akıllı Sera Sistemi</title>
    <link rel="icon" href="src/img/favicon_v2.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/style.css">
    <meta http-equiv="refresh" content="15">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <div class="container justify-content-between">
            <a class="navbar-brand" href="index.html"><b>U.K.A.S.S.</b></a>
            <span class="navbar-text user-select-none" data-bs-toggle="tooltip" title="Verilerin son güncellenme tarihi">
                <?php
                include "components/vt.php";
                $vt = new veritabani;
                ?>
            </span>
            <ul class="navbar-nav d-none">
                <li class="nav-item">
                    <a class="nav-link" href="#">Geçmiş</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- *Main-->
    <main class="container pt-4 d-flex justify-content-center align-items-center" style="min-height: 65vh;">
        <section class="row card-wrapper w-100 g-3">
            <div class="col-md-3">
                <div class="card bg-light text-dark">
                    <div class="text-center pt-4">
                        <img class="card-img-top" src="src/img/ortam_sicakligi.png" alt="toprak nem sensörü iconu" style="width:50%">
                    </div>
                    <div class="card-body">
                        <p class="text-center card-text">Sera ortamının sıcaklığını ölçen sensör.</p>
                        <h4 class="card-title">Ortam Sıcaklığı</h4>
                        <p class="card-text fs-4">
                            <span id="sicaklik_text">
                                <?php echo $vt->veri_getir("ortam_sicakligi"); ?>
                            </span>
                            <sup>&deg;</sup>C
                        </p>
                        <button class="btn rounded-1 btn-danger d-none w-100" disabled data-bs-toggle="modal" data-bs-target="#sicaklik_ayar">Ayarla</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light text-dark">
                    <div class="text-center pt-4">
                        <img class="card-img-top" src="src/img/toprak_nemi_v3.png" alt="toprak nem sensörü iconu" style="width:50%">
                    </div>
                    <div class="card-body">
                        <p class="text-center card-text">Sera ortamının toprak nem seviyesini ölçen sensör.</p>
                        <h4 class="card-title text-nowrap">Toprak Nemi</h4>
                        <p class="card-text fs-4">&percnt;<?php echo $vt->veri_getir("toprak_nemi"); ?></p>
                        <button class="btn rounded-1 btn-warning d-none w-100 disabled">Ayarla</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light text-dark">
                    <div class="text-center pt-4">
                        <img class="card-img-top" src="src/img/fan_durumu.png" alt="toprak nem sensörü iconu" style="width:50%">
                    </div>
                    <div class="card-body">
                        <p class="text-center card-text">Sera ortamının hava akışını kontrol etmek için.</p>
                        <h4 class="card-title text-nowrap">Fan Durumu</h4>
                        <p id="fan_text" class="card-text fs-4"><?php echo $vt->veri_getir("fan_durumu") == "1" ? "Çalışıyor" : "Çalışmıyor"; ?></p>
                        <button id="fan_button" class="btn rounded-1 btn-secondary d-block w-100"><?php echo $vt->veri_getir("fan_durumu") == "1" ? "Durdur" : "Çalıştır";  ?></button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light text-dark">
                    <div class="text-center pt-4">
                        <img class="card-img-top" src="src/img/su_durumu.png" alt="toprak nem sensörü iconu" style="width:50%">
                    </div>
                    <div class="card-body">
                        <p class="text-center card-text">Serayı sulamak için kullanılacak suyun seviyesini ölçen sensör.
                        </p>
                        <h4 class="card-title text-nowrap">Su Durumu</h4>
                        <p class="card-text fs-4"><?php echo $vt->veri_getir("su_durumu") == "1" ? "Su var." : "Su yok."; ?></p>
                        <button id="sula_button" class="btn rounded-1 btn-primary d-block w-100"><?php echo $vt->veri_getir("su_motoru") == "0" ? "Sula." : "Sulanıyor."; ?></button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- *Footer -->
    <footer class="d-flex justify-content-center align-items-center">
        <a href="https://github.com/vedategunduz" target="_blank"><b>VEG</b></a>&nbsp;&copy; 2024 - Tüm Hakları
        Saklıdır.
    </footer>

    <!-- *Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $("#fan_button").click(function() {
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {
                        fan_control: "toggle"
                    },
                    success: function(data) {
                        if (data == "1") {
                            $("#fan_button").html("Durdur");
                            $("#fan_text").html("Çalışıyor");
                        }
                        else {
                            $("#fan_button").html("Çalıştır");
                            $("#fan_text").html("Çalışmıyor");
                        }
                    }
                });
            });

            $("#sula_button").click(function() {
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {
                        su_motoru: "toggle"
                    },
                    success: function(data) { }
                });

                if ($("#sula_button").html() == "Sula.") {
                    $("#sula_button").html("Sulanıyor.");
                } else {
                    $("#sula_button").html("Sula.");
                }
            });
        });
    </script>
</body>

</html>