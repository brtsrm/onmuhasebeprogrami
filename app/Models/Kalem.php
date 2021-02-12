<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function getPublicName($id)
    {
        $data = Musteriler::where("id", $id)->get();
        if ($data[0]["musteritipi"] == 0) {
            return $data[0]["ad"] . " " . $data[0]["soyad"];
        } else {
            return $data[0]["firmaAdi"];
        }
    }

    public static function getList($type)
    {
        $list = Kalem::where("kalemTipi", $type)->get();
        return $list;
    }
}
