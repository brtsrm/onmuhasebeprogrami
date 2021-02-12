<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function insert($text,$islem)
    {
        Logger::create(["text" => $text, "islem" => $islem]);
    }
}
