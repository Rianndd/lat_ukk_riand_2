<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTotalHargaColumnInTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->decimal('total_harga', 15, 2)->change();
            $table->decimal('bayar', 15, 2)->change();
            $table->decimal('kembalian', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->float('total_harga')->change();
            $table->float('bayar')->change();
            $table->float('kembalian')->change();
        });
    }
}