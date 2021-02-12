<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getList($id)
    {

        return Fatura::where("faturatipi", $id)->get();
    }

    public static function getNo($id)
    {
        $all = Fatura::where("id", $id)->get();
        return $all[0]["faturaNo"];
    }

    public static function getTotal($id)
    {
        $getTotal = FaturaIslem::where("faturaId",$id)->sum("fiyat");

        return $getTotal;

    }
}
