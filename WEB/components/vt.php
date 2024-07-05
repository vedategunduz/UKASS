<?php


class veritabani
{
    private $conn;
    private $host = "localhost";
    private $dbname = "ved22dtr_sera";
    private $username = "ved22dtr_sera";
    private $password = "00c23e4D.";
    private $charset = "utf8";

    function veritabanina_baglan()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password);
        } catch (PDOException $th) {
            echo $th;
        }
    }

    function veri_getir($param)
    {
        $this->veritabanina_baglan();
        $sorgu = $this->conn->query("SELECT * FROM farm_durumu ORDER BY id DESC LIMIT 1");
        $kayit = $sorgu->fetch(PDO::FETCH_ASSOC);

        return $kayit[$param];
    }

    function veri_guncelle($who, $val)
    {
        try {
            $this->veritabanina_baglan();
            $sorgu = "";
            switch ($who) {
                case "su":
                    $sorgu = $this->conn->prepare("UPDATE farm_durumu SET su_durumu = ? WHERE id = 1");
                    break;
                case "toprak":
                    $sorgu = $this->conn->prepare("UPDATE farm_durumu SET toprak_nemi = ? WHERE id = 1");
                    break;
                case "fan":
                    $sorgu = $this->conn->prepare("UPDATE farm_durumu SET fan_durumu = ? WHERE id = 1");
                    break;
                case "su_motoru":
                    $sorgu = $this->conn->prepare("UPDATE farm_durumu SET su_motoru = ? WHERE id = 1");
                    break;
                case "sicaklik":
                    $sorgu = $this->conn->prepare("UPDATE farm_durumu SET ortam_sicakligi = ? WHERE id = 1");
                    break;
            }
            $sorgu->execute([$val]);
        } catch (PDOException $th) {
            echo $th;
        }
    }
}
