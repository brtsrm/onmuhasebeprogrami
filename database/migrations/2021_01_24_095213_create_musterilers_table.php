<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusterilersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musterilers', function (Blueprint $table) {

            $table->id();
            $table->integer("musteriTipi")->default(0)->comment("0 Olursa Bireysel, 1 Olursa Kurumsal");
            $table->string("photo");
            $table->string("ad");
            $table->string("soyad");
            $table->date("dogumTarihi")->nullable();
            $table->string("tc")->nullable();

            $table->string("firmaAdi")->nullable();
            $table->string("vergiNumarasi")->nullable();
            $table->string("vergiDairesi")->nullable();


            $table->string("adres")->nullable();
            $table->string("email")->nullable();
            $table->string("telefon");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('musterilers');
    }
}
