<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsAndStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('components')) {
            Schema::create('components', function (Blueprint $table) {
                $table->increments('ID');
                $table->string('storage', 20);
                $table->string('Description', 80);
                $table->string('Type', 20);
                $table->string('package', 10);
                $table->string('Category', 20);
                $table->integer('Stock');
                $table->boolean('stock_flag');
                $table->integer('imported_id');
                $table->string('supplier', 20);
                $table->string('text', 250);
                $table->string('datasheet', 250);
            });
        }

        if (!Schema::hasTable('storage')) {
            Schema::create('storage', function (Blueprint $table) {
                $table->increments('ID');
                $table->string('Name', 20);
                $table->timestamp('Date');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');

        Schema::dropIfExists('storage');
    }
}
