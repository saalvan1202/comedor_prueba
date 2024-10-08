<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sala', function (Blueprint $table) {
            $table->unsignedBigInteger('id_piso');

            $table->foreign('id_piso')->references('id')->on('piso')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sala', function (Blueprint $table) {
            $table->dropForeign(['id_piso']);

            $table->dropColumn('id_piso');
        });
    }
};
