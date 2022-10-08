<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Выполняет миграцию для создания таблицы products
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->float('price');
            $table->string('made')->default('Россия');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Отмена миграции
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
