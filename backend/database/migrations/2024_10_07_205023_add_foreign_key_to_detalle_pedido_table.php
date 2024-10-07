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
        Schema::table('detalle_pedido', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mesa');

            $table->foreign('id_mesa')->references('id')->on('mesa')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_pedido', function (Blueprint $table) {
            $table->dropForeign(['id_mesa']);

            $table->dropColumn('id_mesa');
        });
    }
};
