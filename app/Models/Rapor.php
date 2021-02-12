<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    use HasFactory;

    public static function toplamGelirFatura()
    {

        return Fatura::where("faturaTipi", 0)->count();

    }

    public static function toplamGiderFatura()
    {

        return Fatura::where("faturaTipi", 1)->count();

    }

    public static function toplamOdeme()
    {
        return Islem::where("tip", 0)->sum("fiyat");
    }

    public static function toplamTahsilat()
    {
        return Islem::where("tip", 1)->sum("fiyat");
    }
    public static function FaturaHatirlatici()
    {
        $returnArray = [];
        if (Fatura::count() != 0) {
            $list = Fatura::all();

            foreach ($list as $k => $v) {
                if ($v["faturaTipi"] == 0) {
                    $c = Islem::where("tip", 0)->where("faturaId", $v["id"])->count();
                    $type = "Gelir Faturası";
                    $uri = route("islem.create", ["type" => 0]);
                } else {

                    $c = Islem::where("tip", 1)->where("faturaId", $v["id"])->count();
                    $type = "Gider Faturası";
                    $uri = route("islem.create", ["type" => 1]);
                }

                if ($c == 0) {
                    $returnArray[$k]["name"] = $v["faturaNo"] . "-" . $type;
                    $returnArray[$k]["musteriAdi"] = Musteriler::getPublicName($v["musteriId"]);
                    $returnArray[$k]["fiyat"] = Fatura::getTotal($v["id"]);
                    $returnArray[$k]["uri"] = $uri;
                }
            }
        }

        return $returnArray;
    }

    public static function getMusteriOdeme($id)
    {
        $fatura = FaturaIslem::leftJoin("faturas", "fatura_islems.faturaId", "=", "faturas.id")
            ->where("faturas.musteriId", $id)
            ->where("faturas.faturaTipi", 1)
            ->sum("fatura_islems.genelToplam");

        $islem = Islem::where("musteriId", $id)->where("tip", 0)->sum("fiyat");
        return $fatura - $islem;
    }

    public static function getMusteriTahsilat($id)
    {

        $fatura = FaturaIslem::leftJoin("faturas", "fatura_islems.faturaId", "=", "faturas.id")
            ->where("faturas.musteriId", $id)
            ->where("faturas.faturaTipi", 0)
            ->sum("fatura_islems.genelToplam");

        $islem = Islem::where("musteriId", $id)->where("tip", 1)->sum("fiyat");
        return $fatura - $islem;
    }

    public static function getMusteriBakiye($id)
    {
        return self::getMusteriTahsilat($id) - self::getMusteriOdeme($id);

    }

}
