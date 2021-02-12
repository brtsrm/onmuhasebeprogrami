<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIslem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('islem', function (Blueprint $table) {
            $table->id();
            $table->integer("tip")->default(0)->comment("0 ise ödeme,1 ise tahsilat");
            $table->integer("musteriId");
            $table->integer("faturaId")->default(0);
            $table->double("fiyat");
            $table->date("tarih");
            $table->integer("bankaId");
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
        Schema::dropIfExists('islem');
    }
}
