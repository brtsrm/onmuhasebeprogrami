<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\front\home\indexController;
use App\Http\Controllers\front\musteriler\indexController as MusterilerController;
use App\Http\Controllers\front\kalem\indexController as KalemController;
use App\Http\Controllers\front\fatura\indexController as FaturaController;
use App\Http\Controllers\front\banka\indexController as BankaController;
use App\Http\Controllers\front\islem\indexController as IslemController;
use App\Http\Controllers\front\profil\indexController as ProfilController;
use App\Http\Controllers\front\urun\indexController as UrunController;
use App\Http\Controllers\front\user\indexController as UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace ("front")->middleware("auth")->group(function () {

    Route::namespace ("home")->as("home.")->group(function () {
        Route::get("/", [indexController::class, "index"]);
        Route::get("/tumislemler", [indexController::class, "tumislemler"])->name("tumislemler");
    });
    Route::middleware("permissioncontroller")->group(function () {

        
        Route::namespace ("profil")->as("profil.")->prefix("profil")->group(function () {
            Route::get("/", [ProfilController::class, "index"])->name("index");
            Route::post("/update", [ProfilController::class, "update"])->name("update");
            Route::get("/logout", [ProfilController::class, "logout"])->name("logout");
        });

        Route::namespace ("musteriler")->as("musteriler.")->prefix("musteriler")->group(function () {
            Route::get("/", [MusterilerController::class, "index"])->name("index");
            Route::get("/olustur", [MusterilerController::class, "create"])->name("create");
            Route::post("/olustur", [MusterilerController::class, "store"])->name("store");
            Route::get("/duzenle/{id}", [MusterilerController::class, "edit"])->name("edit");
            Route::post("/duzenle/{id}", [MusterilerController::class, "update"])->name("update");
            Route::get("/delete/{id}", [MusterilerController::class, "delete"])->name("delete");
            Route::post("/data", [MusterilerController::class, "data"])->name("data");
            Route::get("/extre/{id}", [MusterilerController::class, "extre"])->name("extre");

        });

        Route::namespace ("kalem")->as("kalem.")->prefix("kalem")->group(function () {
            Route::get("/", [KalemController::class, "index"])->name("index");
            Route::get("/olustur", [KalemController::class, "create"])->name("create");
            Route::post("/olustur", [KalemController::class, "store"])->name("store");
            Route::get("/duzenle/{id}", [KalemController::class, "edit"])->name("edit");
            Route::post("/duzenle/{id}", [KalemController::class, "update"])->name("update");
            Route::get("/delete/{id}", [KalemController::class, "delete"])->name("delete");
            Route::post("/data", [KalemController::class, "data"])->name("data");

        });

        Route::namespace ("urun")->as("urun.")->prefix("urun")->group(function () {
            Route::get("/", [UrunController::class, "index"])->name("index");
            Route::get("/olustur", [UrunController::class, "create"])->name("create");
            Route::post("/olustur", [UrunController::class, "store"])->name("store");
            Route::get("/duzenle/{id}", [UrunController::class, "edit"])->name("edit");
            Route::post("/duzenle/{id}", [UrunController::class, "update"])->name("update");
            Route::get("/delete/{id}", [UrunController::class, "delete"])->name("delete");
            Route::post("/data", [UrunController::class, "data"])->name("data");

        });

        Route::namespace ("banka")->as("banka.")->prefix("banka")->group(function () {
            Route::get("/", [BankaController::class, "index"])->name("index");
            Route::get("/olustur", [BankaController::class, "create"])->name("create");
            Route::post("/olustur", [BankaController::class, "store"])->name("store");
            Route::get("/duzenle/{id}", [BankaController::class, "edit"])->name("edit");
            Route::post("/duzenle/{id}", [BankaController::class, "update"])->name("update");
            Route::get("/delete/{id}", [BankaController::class, "delete"])->name("delete");
            Route::post("/data", [BankaController::class, "data"])->name("data");

        });

        Route::namespace ("fatura")->as("fatura.")->prefix("fatura")->group(function () {
            Route::get("/", [FaturaController::class, "index"])->name("index");
            Route::get("/olustur/{type}", [FaturaController::class, "create"])->name("create");
            Route::post("/olustur/{type}", [FaturaController::class, "store"])->name("store");
            Route::get("/duzenle/{id}", [FaturaController::class, "edit"])->name("edit");
            Route::post("/duzenle/{id}", [FaturaController::class, "update"])->name("update");
            Route::get("/delete/{id}", [FaturaController::class, "delete"])->name("delete");
            Route::post("/data", [FaturaController::class, "data"])->name("data");
        });

        Route::namespace ("islem")->as("islem.")->prefix("islem")->group(function () {
            Route::get("/", [IslemController::class, "index"])->name("index");
            Route::get("/olustur/{type}", [IslemController::class, "create"])->name("create");
            Route::post("/olustur/{type}", [IslemController::class, "store"])->name("store");
            Route::get("/duzenle/{id}", [IslemController::class, "edit"])->name("edit");
            Route::post("/duzenle/{id}", [IslemController::class, "update"])->name("update");
            Route::get("/delete/{id}", [IslemController::class, "delete"])->name("delete");
            Route::post("/data", [IslemController::class, "data"])->name("data");
        });

        Route::namespace ("user")->as("user.")->prefix("user")->group(function () {
            Route::get("/", [UserController::class, "index"])->name("index");
            Route::get("/olustur", [UserController::class, "create"])->name("create");
            Route::post("/olustur", [UserController::class, "store"])->name("store");
            Route::get("/duzenle/{id}", [UserController::class, "edit"])->name("edit");
            Route::post("/duzenle/{id}", [UserController::class, "update"])->name("update");
            Route::get("/delete/{id}", [UserController::class, "delete"])->name("delete");
            Route::post("/data", [UserController::class, "data"])->name("data");
        });
    });

});
