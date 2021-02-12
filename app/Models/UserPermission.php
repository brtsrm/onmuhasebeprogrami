<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserPermission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getController($userId, $permissionId)
    {
        $c = UserPermission::where('userId', $userId)->where("permissionId", $permissionId)->count();

        return ($c != 0) ? true : false;

    }
    public static function getMyController($permissionId)
    {
        
        $c = UserPermission::where('userId', Auth::id())->where("permissionId", $permissionId)->count();
        return ($c != 0) ? true : false;

    }
}
