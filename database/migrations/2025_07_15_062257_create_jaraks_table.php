<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jarak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_daop');
            $table->unsignedBigInteger('id_stasiun');
            $table->unsignedBigInteger('id_stasiun_sebelah');
            $table->unsignedBigInteger('id_lintas')->nullable();
            $table->unsignedBigInteger('id_tahun_gapeka')->nullable();
            $table->float('jarak');
            $table->integer('puncak_kecepatan');
            $table->string('taspat')->nullable();
            $table->integer('puncak_kecepatan_barang')->nullable();
            $table->string('status')->default('active');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('approved_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jarak'); // ✅ Fix di sini
    }
};
