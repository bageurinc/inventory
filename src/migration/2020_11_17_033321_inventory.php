<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgr_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('nama_seo');
            $table->string('keterangan');
            $table->string('gambar')->nullable();
            $table->string('jenis_produk');
            $table->string('unit');
            $table->double('qty');
            $table->double('harga');
            $table->string('status')->default('aktif');
            $table->timestamps();
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgr_inventory');
    }
}
