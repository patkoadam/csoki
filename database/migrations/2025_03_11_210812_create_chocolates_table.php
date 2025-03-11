<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('chocolates', function (Blueprint $table) {
            $table->id(); // Automatikusan növekvő kulcs (id)
            $table->string('brand'); // Márkanév
            $table->string('chocolate_name'); // Csokoládé neve
            $table->integer('price'); // Ár
            $table->date('expiry_date'); // Lejárati dátum
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chocolates');
    }
};
