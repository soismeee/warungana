<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->uuid('trans_id')->index();
            $table->string('nama_barang');
            $table->string('kategori_harga');
            $table->string('harga_barang');
            $table->string('jml_barang');
            $table->string('total_harga');
            $table->timestamps();

            $table->foreign('trans_id')->references('id')->on('transaksis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksis');
    }
}
