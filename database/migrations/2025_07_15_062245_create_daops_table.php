<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daops', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('singkatan');
            $table->string('nomenklatur');
            $table->string('daop');
            $table->unsignedBigInteger('id_region')->nullable();
            $table->string('bus_area')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daops');
    }
};
