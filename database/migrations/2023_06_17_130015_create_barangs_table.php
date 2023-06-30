<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kategori_id')->index();
            $table->string('nama_barang');
            $table->string('harga_grosir');
            $table->string('harga_eceran');
            $table->string('stok');
            $table->string('tanggal')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori_barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
