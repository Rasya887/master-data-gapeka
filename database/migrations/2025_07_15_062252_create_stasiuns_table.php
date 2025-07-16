<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stasiuns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_daop');
            $table->string('singkatan');
            $table->string('nama');
            $table->double('dpl', 8, 2)->nullable();
            $table->string('kode')->nullable();
            $table->boolean('aktif')->default(0);
            $table->boolean('kotak')->default(0);
            $table->boolean('garis_tipis')->default(0);
            $table->boolean('garis_tebal')->default(0);
            $table->boolean('perhentian')->default(0);
            $table->boolean('batas_daop')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('track')->nullable();
            $table->boolean('ppkt')->default(0);
            
            // created_at dan updated_at (timestamp nullable)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stasiuns');
    }
};
