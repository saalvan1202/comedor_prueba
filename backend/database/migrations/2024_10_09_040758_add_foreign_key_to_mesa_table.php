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
        Schema::table('mesa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_sala');

            $table->foreign('id_sala')->references('id')->on('sala')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mesa', function (Blueprint $table) {
            $table->dropForeign(['id_sala']);

            $table->dropColumn('id_sala');
        });
    }
};
