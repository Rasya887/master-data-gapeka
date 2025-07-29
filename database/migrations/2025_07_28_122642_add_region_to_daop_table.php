<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('daops', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_region')->nullable()->after('nama');
        });
    }


    public function down()
    {
        Schema::table('daop', function (Blueprint $table) {
            $table->dropColumn('region');
        });
    }

};
