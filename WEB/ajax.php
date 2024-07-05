<?php

if ($_POST) {
    include "components/vt.php";
    $vt = new veritabani;

    if (isset($_POST["fan_control"])) {
        if ($vt->veri_getir("fan_durumu") == "0") {
            $vt->veri_guncelle("fan", "1");
            echo "1";
        } else {
            $vt->veri_guncelle("fan", "0");
            echo "0";
        }
    }

    if (isset($_POST["su_motoru"])) {
        if ($vt->veri_getir("su_motoru") == "0") {
            $vt->veri_guncelle("su_motoru", "1");
        } else {
            $vt->veri_guncelle("su_motoru", "0");
        }
    }
}
else
    header("location:index.php");