<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->double('price',8,2)->nullable();
            $table->integer('barcode')->nullable();;
            $table->foreignId('supplier_id')->references('id')->on('suppliers')->comments('Relacion con tabla Suppliers');
            $table->foreignId('user_id')->references('id')->on('users')->comments('Relacion con tabla Usuarios')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};
