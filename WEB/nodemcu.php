<?php

if ($_POST) {
    include "components/vt.php";
    $vt = new veritabani;

    $data = explode(",", $_POST["datas"]);
    // su durumu, toprak nemi, sicaklik
    $vt->veri_guncelle("su", $data[0]);
    $vt->veri_guncelle("toprak", $data[1]);
    $vt->veri_guncelle("sicaklik", $data[2]);

    echo $vt->veri_getir("fan_durumu").",";
    echo $vt->veri_getir("su_motoru").",";
}
else
    header("location:index.php");