<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Automatikusan növekvő kulcs (id)
            $table->string('email'); // Vásárló e-mail címe
            $table->text('address'); // Szállítási cím
            $table->foreignId('chocolate_id')->constrained('chocolates')->onDelete('cascade'); // Csokoládé azonosító (FK)
            $table->integer('count'); // Rendelt darabszám
            $table->integer('all_price'); // Teljes ár
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
